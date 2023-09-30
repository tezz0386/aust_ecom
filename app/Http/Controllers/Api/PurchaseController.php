<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank\Card;
use App\Models\Bank\CardStatement;
use App\Models\Customer;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function purchaseItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qty'=>'required|numeric',
            'card_number'=>'required|numeric',
            'pin'=>'required|numeric',
        ]);
        if($validator->fails()){
            return $this->mobileValidationError($validator->errors());
        }
        $qty = $request->qty;
        $pin = $request->pin;
        $card_number = $request->card_number;
        $user = auth()->guard('customer')->user();
        $card = $user->card;
        // if (!Hash::check($card_number, $card->card_number) || !Hash::check($pin, $card->pin)) {
        //     return $this->mobileError("Sorry, the Card Number or PIN does not match.", 401);
        // }
        $product = $request->product;
        $total = $qty * $product['price_of_unit'];
        if($card->balance <= $total){
            return $this->mobileError("Sorry, You Have Insufficient Balance Please Add Balance First To Purchase.", 401);
        }
        if($qty > $product['stock_qty']){
            return $this->mobileError("Sorry, The Product Not Available.", 401);
        }

        DB::beginTransaction();
        try {
            $order = new Order();
            $saveData = [
                'seller_ip'=>$product['ip_address'],
                'customer_id'=>$user->id,
                'product_id'=>$product['id'],
                'name'=>$product['name'],
                'qty'=>$qty,
                'price'=>$product['price_of_unit'],
                'total'=>$total,
                'is_paid'=>true,
                'status'=>1,
                'is_new'=>true,
            ];
            $order->fill($saveData);
            $order->save();
            $cardStatement = new CardStatement();
            $newSaveData = [
                'customer_id'=>$user->id,
                'card_id'=>$card->id,
                'balance'=>$card->balance,
                'amount'=>$total,
                'is_debit'=>true,
                'remarks'=>'Purchase',
            ];
            $cardStatement->fill($newSaveData);
            $cardStatement->save();
            $card->balance = $card->balance - $total;
            $card->save();
            DB::commit();
            return $this->mobileSuccess("Successfully Your Order has been placed");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->mobileError();
        }
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Models\Bank\CardStatement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard');
    }

    public function getOrders(Request $request)
    {
        $filters = $request->all();
        $user = auth()->guard('customer')->user();
        $orders = Order::where('customer_id', $user->id)
        ->when(Arr::get($filters, 'search_query'), function($q, $value){
            $q->where('id', $value);
        })
        ->latest()->get();
        return $this->mobileData($orders);
    }

    public function cancelOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'=>'required|exists:orders,id',
        ]);
        if($validator->fails()){
            return $this->mobileValidationError($validator->errors());
        }

        DB::beginTransaction();
        try {
            $order = Order::findOrFail($request->order_id);
            $order->status = 2;
            $order->save();
            DB::commit();
            return $this->mobileSuccess("Successfully Cancelled");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->mobileError();
        }
    }

    public function checkCard(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number'=>'required|numeric',
            'pin'=>'required|numeric',
        ]);
        if($validator->fails()){
            return $this->mobileValidationError($validator->errors());
        }
        $user = auth()->guard('customer')->user();
        $card = $user->card;
        $pin = $request->pin;
        $card_number = $request->card_number;
        if(!Hash::check($card_number, $card->card_number) || !Hash::check($pin, $card->pin)) {
            return $this->mobileError("Sorry, the Card Number or PIN does not match.", 401);
        }
        return $this->mobileSuccess("Success, Your Card Number And The Card Pin Matched");
    }

    public function getCard()
    {
        $user = auth()->guard('customer')->user();
        $card = $user->card;
        return $this->mobileData($card);
    }

    public function addBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number'=>'required|numeric',
            'pin'=>'required|numeric',
            'balance'=>'required|numeric',
        ]);
        if($validator->fails()){
            return $this->mobileValidationError($validator->errors());
        }
        $user = auth()->guard('customer')->user();
        $card = $user->card;
        $pin = $request->pin;
        $card_number = $request->card_number;
        // if(!Hash::check($card_number, $card->card_number) || !Hash::check($pin, $card->pin)) {
        //     return $this->mobileError("Sorry, the Card Number or PIN does not match.", 401);
        // }
        $balance = $request->balance;
        DB::beginTransaction();
        try {
            $cardStatement = new CardStatement();
            $newSaveData = [
                'customer_id'=>$user->id,
                'card_id'=>$card->id,
                'balance'=>$card->balance,
                'amount'=>$balance,
                'is_debit'=>false,
                'remarks'=>'Purchase',
            ];
            $cardStatement->fill($newSaveData);
            $cardStatement->save();
            $card->balance = $card->balance + $balance;
            $card->save();
            DB::commit();
            return $this->mobileSuccess("Successfully Your Balance has been added");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->mobileError();
        }
    }
}

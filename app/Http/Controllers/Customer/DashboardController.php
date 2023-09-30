<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Market\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard');
    }

    public function getOrders()
    {
        $user = auth()->guard('customer')->user();
        $orders = Order::where('customer_id', $user->id)->latest()->get();
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
}

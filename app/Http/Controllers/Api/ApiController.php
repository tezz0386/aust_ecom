<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Arr;
use App\Models\Item\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getProducts(Request $request)
    {
        $filters = $request->all();
        $products = Product::where('status', true)
        ->when(Arr::get($filters, 'search_query'), function($q, $value){
            $q->where(DB::raw('LOWER(name)'), 'LIKE', '%' . strtolower($value) . '%');
        })->orderBy('price_of_unit', 'asc')->get();
        return $this->mobileData($products);
    }
}

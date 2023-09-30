<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getProducts()
    {
        $products = Product::where('status', true)->latest()->paginate(12);
        return $this->mobileData($products);
    }
}

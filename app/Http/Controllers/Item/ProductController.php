<?php

namespace App\Http\Controllers\Item;

use App\Helper\ImageSupport;
use Illuminate\Support\Str;
use App\Models\Item\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);
        $data['products'] = $products;
        return view('admin.views.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.views.product.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        DB::beginTransaction();
        try {
            $this->saveData($request, $product);
            DB::commit();
            session()->flash('success','Successfully Product has been added');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Sorry Internal Server Error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data['product'] = $product;
        return view('admin.views.product.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();
        // try {
            $this->saveData($request, $product);
            DB::commit();
            session()->flash('success','Successfully Product has been Updated');
            return redirect()->route('product.index');
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     session()->flash('error', 'Sorry Internal Server Error');
        //     return back()->withInput();
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $imageSupport = new ImageSupport();
            $imageSupport->removeImage($product->image);
            $product->delete();
            session()->flash('success', 'Successfully Deleted');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Sorry Internal Server error');
            return redirect()->route('product.index');
        }
    }

    private function saveData(Request $request, Product $product)
    {
            $imageSupport = new ImageSupport();
            $image = $product->image;
            if($request->has('image')){
                $image = $imageSupport->removeImage($image);
                $image = $imageSupport->uploadImage($request->image);
            }
            $user = auth()->user();
            $saveData = [
                'user_id'=>$user->id,
                'name'=>$request->name,
                'slug'=>Str::slug($request->name.' '.rand(4, 8)),
                'stock_qty'=>$request->stock_qty,
                'price_of_unit'=>$request->price_of_unit,
                'summary'=>$request->summary,
                'description'=>$request->description,
                'image'=>$image,
                'images'=>null,
                'status'=>$request->status,
            ];
            $product->fill($saveData);
            $product->save();
    }
}

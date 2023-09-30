@extends('admin.views.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Product List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product List</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            @if(session()->has('error'))
            <div class="bg-alert">
                <span>{{session()->get('error')}}</span>
            </div>
            @endif
            @if(session()->has('success'))
            <div class="bg-success">
                <span class="text-danger">{{session()->get('success')}}</span>
            </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <td>SN</td>
                        <td>Product</td>
                        <td>Image</td>
                        <td>Price</td>
                        <td>Stock</td>
                        <td>Status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $index=>$product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <img src="{{ $product->image }}" alt="" style="height: 45px; width:auto">
                            </td>
                            <td>
                                {{ "A$ " . $product->price_of_unit }}
                            </td>
                            <td>
                                {{ $product->stock_qty }}
                            </td>
                            <td>
                                @if($product->status == 0)
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                                @if($product->status == 1)
                                <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('product.edit', $product->id)}}" class="btn btn-xs btn-info m-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{route('product.destroy', $product->id)}}" method="post">
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="submit" class="btn btn-xs btn-danger m-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
@endsection

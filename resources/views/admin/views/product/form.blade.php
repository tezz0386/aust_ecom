@extends('admin.views.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ isset($product) ? 'Update' : 'Create' }} Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product List</a></li>
                            <li class="breadcrumb-item active">Products {{ isset($product) ? 'Update' : 'Create' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container">
                @if(isset($product))
                <form action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                @else
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @endif
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3>Product</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control form-control-sm" name="name"
                                            value="{{ old('name', @$product->name) }}">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price Of Unit</label>
                                        <input type="number" class="form-control form-control-sm" name="price_of_unit"
                                            value="{{ old('price_of_unit', @$product->price_of_unit) }}">
                                        <span class="text-danger">{{ $errors->first('price_of_unit') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Stock</label>
                                        <input type="number" class="form-control form-control-sm" name="stock_qty"
                                            value="{{ old('stock_qty', @$product->stock_qty) }}">
                                        <span class="text-danger">{{ $errors->first('stock_qty') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" id="status" class="form-control form-control-sm">
                                            <option value="1" {{ @$product->status == 1 ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ @$product->status == 0 ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Summary</label>
                                                <textarea name="summary" id="summary" class="form-control" rows="10">{{ old('summary', @$product->summary) }}</textarea>
                                                <span class="text-danger">{{ $errors->first('summary') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="description" id="description" class="form-control" rows="10">{{ old('description', @$product->description) }}</textarea>
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Image</label>
                                        <input type="file" class="form-control form-control-sm" name="image">
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-primary float-right">{{ isset($product) ? 'Update' : 'Save' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

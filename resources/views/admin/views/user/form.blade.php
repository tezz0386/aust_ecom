@extends('admin.views.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Create</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        User Addon Form
                    </div>
                    <div class="card-body">
                       @if(isset($user))
                       <form action="{{ route('user.update', $user) }}" method="post">
                        @method('PATCH')
                        @else
                        <form action="{{ route('user.store') }}" method="post">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Name*</label>
                                        <input type="text" class="form-control form-control-sm" name="name"
                                            value="{{ old('name', @$user->name) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Email*</label>
                                        <input type="email" class="form-control form-control-sm" name="email"
                                            value="{{ old('email', @$user->email) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Role*</label>
                                        <select name="role_id" id="role_id" class="form-control form-control-sm">
                                            <option value="">Please Select</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" {{(isset($user)) ? @$user->roleName() == $role->name ? 'selected' : '' : ''}}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" style="margin-top:28px">
                                        <button class="btn btn-primary btn-sm">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

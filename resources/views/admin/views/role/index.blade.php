@extends('admin.views.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User List</h1>
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
                        Users
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Name</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $index=>$role)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @php
                                                $permissions = collect(collect($role->permissions))->groupBy('col_name');
                                            @endphp
                                            @foreach($permissions as $index=>$p)
                                                <p class="m-0"><b>{{$index}}</b></p>
                                                <p class="m-0">
                                                    @foreach($p as $permission)
                                                        <span class="badge bg-success m-1">{{$permission->name}}</span>
                                                    @endforeach
                                                </p>
                                            @endforeach
                                        </td>
                                        <td>
                                          <div class="d-flex">
                                            @can('Edit Role')
                                            <a href="{{route('role.edit', $role)}}" class="btn btn-info btn-sm m-1"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('Delete Role')
                                            <a href="#" class="delete-btn btn btn-danger btn-sm m-1" data-action="{{route('role.destroy', $role)}}"><i class="fa fa-trash"></i></a>
                                            @endcan
                                          </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="#" method="post" id="delete-form" hidden>@method('DELETE') @csrf</form>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   <script>
     $(document).ready(function(){
        $('.delete-btn').on('click', function(e){
            e.preventDefault();
            $('#delete-form').attr('action', $(this).data('action'));
            $('#delete-form').submit();
        });
    });
   </script>
@endpush


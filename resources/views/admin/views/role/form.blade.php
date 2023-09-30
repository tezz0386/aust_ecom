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
                        @if (isset($role))
                            <form action="{{ route('role.update', $role) }}" method="post">
                                @method('PATCH')
                            @else
                                <form action="{{ route('role.store') }}" method="post">
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input type="text" class="form-control form-control-sm" name="name"
                                        value="{{ old('name', @$role->name) }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-top:28px">
                                    <button class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @php
                                $per = collect(@$role->permissions)
                                    ->pluck('id')
                                    ->toArray();
                            @endphp
                            @foreach ($permissions as $index => $p)
                                @php
                                    $newPer = collect($p)
                                        ->pluck('id')
                                        ->toArray();
                                @endphp
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6><input class="mr-2 select-all" type="checkbox"
                                                    {{ empty(array_diff($newPer, $per)) ? 'checked' : '' }}>{{ $index }}
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            @foreach ($p as $permission)
                                                <p class="m-0"><input type="checkbox" class="child-select"
                                                        name="role_id[]" class="mr-2" value="{{ $permission->id }}"
                                                        {{ in_array($permission->id, $per) ? 'checked' : '' }}>{{ $permission->name }}
                                                </p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
    
            $('.select-all').click(function() {
                // Find the card that contains the clicked select-all checkbox
                var card = $(this).closest('.card');

                // Find all child checkboxes within the same card
                var childCheckboxes = card.find('.child-select');

                // Check or uncheck the child checkboxes based on the state of the select-all checkbox
                childCheckboxes.prop('checked', $(this).prop('checked'));
            });

            // Listen for clicks on child checkboxes
            $('.child-select').click(function() {
                // Find the card that contains the clicked child checkbox
                var card = $(this).closest('.card');

                // Find all child checkboxes within the same card
                var childCheckboxes = card.find('.child-select');

                // Find the select-all checkbox within the same card
                var selectAllCheckbox = card.find('.select-all');

                // Check or uncheck the select-all checkbox based on the state of the child checkboxes
                selectAllCheckbox.prop('checked', childCheckboxes.length === childCheckboxes.filter(
                    ':checked').length);
            });
        });

        $(document).ready(function(){
        $('.delete-btn').on('click', function(e){
            e.preventDefault();
            $('#delete-form').attr('action', $(this).data('action'));
            $('#delete-form').submit();
        });
    });
    </script>
@endpush

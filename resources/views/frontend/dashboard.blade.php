@extends('frontend.layouts.app')
@push('styles')
    <style>
        .custom-sidebar {
            background-color: #dfd4d4;
            color: #fff;
            height: 400px
        }
        .custom-sidebar .list-group-item {
            background-color: #dfd4d4;
            border: none;
        }
        .custom-link {
            color: #000000;
            text-decoration: none;
        }
        /* Custom content styles */
        .custom-content {
            padding: 20px;
        }
        .active-custom-link{
            background-color: green !important;
        }
    </style>
@endpush
@section('content')
    @php
        $is_auth = 0;
        if (
            auth()
                ->guard('customer')
                ->check()
        ) {
            $is_auth = 1;
        }
    @endphp
    <customer-dashboard :is_auth="{{ $is_auth }}"></customer-dashboard>
@endsection

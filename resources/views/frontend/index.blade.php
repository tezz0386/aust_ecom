@extends('frontend.layouts.app')
@section('content')
@php
    $is_auth = 0;
    if(auth()->guard('customer')->check()){
        $is_auth = 1;
    }
@endphp
    <index-product :is_auth="{{$is_auth}}"></index-product>
@endsection


@extends('admin.master')
@section('dashboard', 'active')
{{-- @section('page_title', 'الرئيسية') --}}
@section('content')
    <style>
        h4.fw-bold.py-3.mb-4 {
            display: none;
        }
    </style>
    <img src="{{ asset('/admin/images/charity-10.jpg') }}" class="w-100 vh-100" alt="">
@endsection

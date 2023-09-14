@extends('admin.master')
@section('sub-menu', 'active')
@section('page_title', $subMenu->title)
@section('content')
    <div class="card">
        <div class="card-body">
            {!! $subMenu->content !!}
        </div>
    </div>
@endsection

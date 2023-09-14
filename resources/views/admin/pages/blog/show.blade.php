@extends('admin.master')
@section('blog', 'active')
 @section('page_title', 'عرض الخبر')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center">{{$blog->title}}</h2>
        </div>
        <img src="{{asset($blog->image)}}" class="img-fluid">
        <div class="card-body">
            <p class="card-text text-center">{{$blog->description}}</p>
        </div>
    </div>
@endsection

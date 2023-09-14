@extends('admin.master')
@section('boss', 'active')
@section('page_title', 'المدير التنفيذي')
@section('content')
    <div class="card mb-5">
        <hr class="my-0">
        <form action="{{route('association.boss.postAssociation')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="title">عنوان الصفحة</label>
                    <input type="text" name="title" id="title" value="{{$data->title}}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="name">الاسم</label>
                    <input type="text" name="name" id="name" value="{{$data->name}}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="email">البريد الالكتروني</label>
                    <input type="text" name="email" id="email" value="{{$data->email}}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="phone">الهاتف</label>
                    <input type="text" name="phone" id="phone" value="{{$data->phone}}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="address">العنوان</label>
                    <input type="text" name="address" id="address" value="{{$data->address}}" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="phone">الصورة</label>
                    <input type="file" name="image" accept="image/*" id="image" class="form-control mb-3">
                    @if(count($data->images) > 0)
                        <img src="{{asset($data->images[0]->path)}}" width="150" alt="">
                    @endif
                </div>
            </div>
            <hr class="my-0">
            <div class="card-footer">
                <button type="submit" class="btn btn-success">حفظ</button>
            </div>
        </form>
    </div>
@endsection

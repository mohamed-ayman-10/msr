@extends('admin.master')
@section('blog', 'active')
 @section('page_title', 'إضافة خبر جديد')
@section('content')
    <div class="card">
        <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="title">عنوان الخبر</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="عنوان الخبر">
                    @error('title') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="description">محتوي الخبر</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="محتوي الخبر" rows="5">{{old('description')}}</textarea>
                    @error('description') <small class="text-danger">{{$message}}</small> @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="description">محتوي الخبر</label>
                    <input type="file" accept="image/*" name="image" value="{{old('description')}}" class="form-control @error('image') is-invalid @enderror " id="description" placeholder="محتوي الخبر">
                    @error('image') <small class="text-danger">{{$message}}</small> @enderror
                </div>
            </div>
            <hr class="m-0" />
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </form>
    </div>
@endsection

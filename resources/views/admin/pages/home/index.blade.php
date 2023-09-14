@extends('admin.master')
@section('home', 'active')
{{-- @section('page_title', 'الرئيسية') --}}
@section('content')
    <div class="card">
        <div class="card-header">
            <button type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn btn-primary">إضافة صورة
                جديدة
            </button>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <div class="fw-bold">الصور :</div>
            <div class="row">
                @if(!empty($data))
                    @if(count($data->images))
                        @foreach($data->images as $image)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{asset($image->path)}}" class="card-img-top" alt="">
                                    <hr class="my-0">
                                    <div class="card-body text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#update{{$image->id}}"
                                                class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$image->id}}"
                                                class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Update -->
                            <div class="modal fade" id="update{{$image->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">تعديل الصورة</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('home.updateImage') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label class="form-label w-100">
                                                        الصورة
                                                        <span class="text-danger">*</span>
                                                        <input type="file" name="image" accept="image/*" class="form-control" required>
                                                    </label>
                                                    <input type="hidden" name="id" value="{{$image->id}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                                    إغلاق
                                                </button>
                                                <button type="submit" class="btn btn-primary">إضافة</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete -->
                            <div class="modal fade" id="delete{{$image->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">حذف الصورة</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('home.updateImage') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="bg-label-danger p-3">هل انت متاكد من حذف هذة الصورة
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                                    إغلاق
                                                </button>
                                                <a href="{{ route('home.deleteImage', $image->id) }}" class="btn btn-primary">حذف</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="fw-bold bg-label-danger text-center py-3 mt-2">لا يوجد صور لعرضها</div>
                    @endif
                @endif
            </div>
            <div class="mt-4 mb-2 fw-bold">من نحن :</div>
            <form action="{{route('home.store')}}" method="post" id="form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label w-100">
                            العنوان
                            <input type="text" name="who_are_we_title" class="form-control" value="{{old('who_are_we_title', $data->who_are_we_title)}}">
                        </label>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="form-label w-100">
                            الفيديو
                            <input type="file" name="video" class="form-control" accept="video/*">
                        </label>
                        <video src="{{asset($data->who_are_we_video)}}" controls width="300"></video>
                    </div>
                    <div class="form-group col-12">
                        <label class="form-label w-100">
                            الوصف
                            <textarea name="who_are_we_description" class="form-control" rows="7">{{old('who_are_we_description', $data->who_are_we_description)}}</textarea>
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <hr class="my-0">
        <div class="card-footer">
            <button type="submit" class="btn btn-success" form="form">حفظ</button>
        </div>
    </div>
    <!-- Modal Create -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">إضافة صورة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('home.storeImage') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label w-100">
                                الصورة
                                <span class="text-danger">*</span>
                                <input type="file" name="image" accept="image/*" class="form-control" required>
                            </label>
                            <input type="hidden" name="home_id" value="{{$data->id}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                            إغلاق
                        </button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

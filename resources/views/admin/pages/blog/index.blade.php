@extends('admin.master')
@section('blog', 'active')
@section('page_title', 'الاخبار')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('blog.create')}}" class="btn btn-primary">إضافة خبر جديد</a>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>المحتوي</th>
                        <th>الصورة</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($blogs as $key => $blog)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$blog->title}}</td>
                            <td><p class="over-p m-0">{{$blog->description}}</p></td>
                            <td>
                                <img src="{{asset($blog->image)}}" class="img" alt="{{$blog->title}}">
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{route('blog.show', $blog->id)}}" class="btn btn-icon btn-warning waves-effect waves-light">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{route('blog.edit', $blog->id)}}" class="btn btn-icon btn-success waves-effect waves-light">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-icon btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#delete{{$blog->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal Delete -->
                        <div class="modal fade" id="delete{{$blog->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">حذف الصورة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('blog.destroy', $blog->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-body">
                                            <div class="bg-label-danger p-3">هل انت متاكد من حذف هذا الخبر
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                                إغلاق
                                            </button>
                                            <button type="submit" class="btn btn-primary">حذف</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <td colspan="1000" class="fw-bold bg-label-danger text-center">لا يوجد بيانات لعرضها</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

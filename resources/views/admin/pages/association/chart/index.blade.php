@extends('admin.master')
@section('chart', 'active')
@section('page_title', 'الهيكل التنظيمي')
@section('content')
    <div class="card mb-5">
        <hr class="my-0">
        <form action="{{route('association.chart.postAssociation')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group-lg mb-3">
                    <label class="form-label" for="title">العنوان</label>
                    <input type="text" name="title" id="title" value="{{$data->title}}" class="form-control">
                </div>
            </div>
            <hr class="my-0">
            <div class="card-footer">
                <button type="submit" class="btn btn-success">حفظ</button>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header">
            <button type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn btn-primary">إضافة
                صورة
                جديد
            </button>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <div class="row">
                @forelse ($data->images as $item)
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <img src="{{asset($item->path)}}" class="card-img-top" alt="">
                            <div class="card-body text-center">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#update{{ $item->id }}"
                                        class="btn btn-icon btn-success waves-effect waves-light">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}"
                                        class="btn btn-icon btn-danger waves-effect waves-light">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Update -->
                    <div class="modal fade" id="update{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">تعديل الصورة</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('association.chart.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label w-100">
                                                الصورة
                                                <span class="text-danger">*</span>
                                                <input type="file" accept="image/*" name="image" class="form-control">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                            إغلاق
                                        </button>
                                        <button type="submit" class="btn btn-primary">تعديل</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Delete -->
                    <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">حذف</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('association.chart.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <div class="bg-label-danger p-3">هل انت متاكد من الحذف
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                            إغلاق
                                        </button>
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <td colspan="1000" class="fw-bold bg-label-danger text-center">لا يوجد بيانات لعرضها</td>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Modal Create -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">إضافة صورة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('association.chart.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label w-100">
                                الصورة
                                <span class="text-danger">*</span>
                                <input type="file" accept="image/*" name="image" class="form-control">
                            </label>
                        </div>
                        <input type="hidden" name="id" value="{{$data->id}}">
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

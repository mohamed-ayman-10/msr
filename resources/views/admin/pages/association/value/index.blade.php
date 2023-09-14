@extends('admin.master')
@section('objective', 'active')
@section('page_title', 'الاهداف')
@section('content')
    <div class="card mb-5">
        <hr class="my-0">
        <form action="{{route('association.value.postAssociation')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group-sm">
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
                هدف
                جديد
            </button>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="bg-primary">
                <tr>
                    <th>#</th>
                    <th>الهدف</th>
                    <th style="width: 120px;">العمليات</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($data->values as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#update{{ $item->id }}"
                                    class="btn btn-icon btn-success waves-effect waves-light">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}"
                                    class="btn btn-icon btn-danger waves-effect waves-light">
                                <i class="ti ti-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Modal Update -->
                    <div class="modal fade" id="update{{ $item->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">تعديل الهدف</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('association.value.update', $item->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label w-100">
                                                الهدف
                                                <span class="text-danger">*</span>
                                                <textarea name="value"  class="form-control">{{ $item->title }}</textarea>
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
                                    <h5 class="modal-title" id="exampleModalLabel1">حذف الهدف</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('association.value.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        <div class="bg-label-danger p-3">هل انت متاكد من حذف هذة القائمة
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
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Create -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">إضافة هدف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('association.value.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label w-100">
                                الهدف
                                <span class="text-danger">*</span>
                                <textarea name="value" class="form-control" placeholder="الهدف"></textarea>
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

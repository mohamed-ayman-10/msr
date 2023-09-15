@extends('admin.master')
@section('committee', 'active')
@section('page_title', 'لجان الجمعية')
@section('content')
    <div class="card mb-5">
        <hr class="my-0">
        <form action="{{route('association.committee.postAssociation')}}" method="post">
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
                PDF
            </button>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="bg-primary">
                <tr>
                    <th>#</th>
                    <th>PDF</th>
                    <th>العمليات</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($data->images as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{asset($item->path)}}" target="_blank">PDF</a>
                        </td>
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
                                <form action="{{ route('association.committee.update', $item->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="modal-body">
                                        <div class="form-group mb-3">
                                            <label class="form-label w-100">
                                                PDF
                                                <span class="text-danger">*</span>
                                                <input type="file" accept="application/pdf" name="pdf" class="form-control">
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
                                <form action="{{ route('association.committee.destroy', $item->id) }}" method="post">
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
                </tbody>
            </table>
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
                <form action="{{ route('association.committee.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label w-100">
                                PDF
                                <span class="text-danger">*</span>
                                <input type="file" accept="application/pdf" name="pdf" class="form-control">
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

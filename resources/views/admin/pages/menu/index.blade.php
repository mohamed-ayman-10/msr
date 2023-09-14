@extends('admin.master')
@section('menu', 'active')
@section('page_title', 'القوائم الرئيسية')
@section('content')
    <div class="card">
        <div class="card-header">
            <button type="button" data-bs-toggle="modal" data-bs-target="#basicModal" class="btn btn-primary">إضافة قائمة
                جديدة</button>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>الترتيب</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $index => $menu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $menu->title }}</td>
                            <td>{{ $menu->order }}</td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#update{{ $menu->id }}"
                                    class="btn btn-icon btn-success waves-effect waves-light">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $menu->id }}"
                                    class="btn btn-icon btn-danger waves-effect waves-light">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal Update -->
                        <div class="modal fade" id="update{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">تعديل القائمة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('menu.update', $menu->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div class="form-group mb-3">
                                                <label class="form-label w-100">
                                                    اسم القائمة
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="title" value="{{ $menu->title }}"
                                                        class="form-control" placeholder="اسم القائمة">
                                                </label>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label w-100">
                                                    الترتيب
                                                    <input type="number" name="order" value="{{ $menu->order }}"
                                                        class="form-control" placeholder="الترتيب">
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
                        <!-- Modal Update -->
                        <div class="modal fade" id="delete{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">حذف القائمة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="post">
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
                    <h5 class="modal-title" id="exampleModalLabel1">إضافة قائمة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('menu.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label w-100">
                                اسم القائمة
                                <span class="text-danger">*</span>
                                <input type="text" name="title" class="form-control" placeholder="اسم القائمة">
                            </label>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label w-100">
                                الترتيب
                                <input type="number" name="order" class="form-control" placeholder="الترتيب">
                            </label>
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

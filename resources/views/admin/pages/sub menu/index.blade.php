@extends('admin.master')
@section('sub-menu', 'active')
@section('page_title', 'القوائم الفرعية والصفحات')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('sub-menu.create') }}" class="btn btn-primary">إضافة صفحة
                جديدة</a>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="bg-primary">
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>القائمة الرئيسية</th>
                        <th>pdf</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subMenus as $index => $menu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $menu->title }}</td>
                            <td>{{ $menu->menu->title }}</td>
                            <td>
                                @if ($menu->pdf)
                                    <a href="{{ asset($menu->pdf) }}" target="_blanck">PDF</a>
                                @else
                                    <p class="badge bg-label-success m-0">لا يوجد</p>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sub-menu.edit', $menu->id) }}"
                                    class="btn btn-icon btn-success waves-effect waves-light">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $menu->id }}"
                                    class="btn btn-icon btn-danger waves-effect waves-light">
                                    <i class="ti ti-trash"></i>
                                </button>
                                @if (!$menu->pdf)
                                    <a href="{{ route('sub-menu.show', $menu->id) }}"
                                        class="btn btn-icon btn-warning waves-effect waves-light">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <!-- Modal Update -->
                        <div class="modal fade" id="delete{{ $menu->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">حذف القائمة</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('sub-menu.destroy', $menu->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-body">
                                            <div class="bg-label-danger p-3">هل انت متاكد من حذف هذة الصفحة
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
@endsection

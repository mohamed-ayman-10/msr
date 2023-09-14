@extends('admin.master')
@section('sub-menu', 'active')
@section('page_title', 'تعديل الصفحة')
@section('content')
    <div class="card">
        <form action="{{ route('sub-menu.update', $subMenu->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label w-100">
                            عنوان الصفحة
                            <span class="text-danger">*</span>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title', $subMenu->title) }}" placeholder="عنوان الصفحة">
                        </label>
                        @error('title')
                            <div class="text-danger w-100">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label w-100">
                            القائمة الرئيسية
                            <span class="text-danger">*</span>
                            <select name="menu" class="form-select @error('menu') is-invalid @enderror">
                                <option disabled selected>اختر القائمة الرئيسية</option>
                                @foreach ($menus as $menu)
                                    <option {{ old('menu', $subMenu->menu_id) == $menu->id ? 'selected' : '' }}
                                        value="{{ $menu->id }}">
                                        {{ $menu->title }}</option>
                                @endforeach
                            </select>
                        </label>
                        @error('menu')
                            <div class="text-danger w-100">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($subMenu->pdf)
                        <div class="col-md-6 form-group mb-3" id="pdf">
                            <label class="form-label w-100">
                                PDF
                                <input type="file" name="pdf" accept="application/pdf"
                                    class="form-control @error('pdf') is-invalid @enderror" value="{{ old('pdf') }}"
                                    placeholder="PDF">
                            </label>
                            @error('pdf')
                                <div class="text-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                    @elseif ($subMenu->content)
                        <div class="col-12 form-group mb-3" id="ckeditor">
                            <label class="form-label w-100">
                                المحتوي
                                <textarea id="editor" name="content" class="form-control @error('pdf') is-invalid @enderror">{{ old('content', $subMenu->content) }}</textarea>
                            </label>
                            @error('content')
                                <div class="text-danger w-100">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
                <input type="hidden" name="check" value="1">
            </div>
            <hr class="my-0">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">تعديل</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}',
                },
                language: 'ar',
            })
            .catch(error => {

            });
    </script>
    <script>
        var ckeditor = document.getElementById('ckeditor');
        var pdf = document.getElementById('pdf');
        var checkPdf = document.getElementById('checkPdf');
        var checkCkeditor = document.getElementById('checkCkeditor');

        checkPdf.addEventListener('click', function() {
            ckeditor.style.display = 'none'
            pdf.style.display = 'block'
        })

        checkCkeditor.addEventListener('click', function() {
            ckeditor.style.display = 'block'
            pdf.style.display = 'none'
        })
    </script>

@endsection

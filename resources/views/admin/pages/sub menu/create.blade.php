@extends('admin.master')
@section('sub-menu', 'active')
@section('page_title', 'إضافة صفحة')
@section('content')
    <div class="card">
        <form action="{{ route('sub-menu.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label w-100">
                            عنوان الصفحة
                            <span class="text-danger">*</span>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" placeholder="عنوان الصفحة">
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
                                    <option {{ old('menu') == $menu->id ? 'selected' : '' }} value="{{ $menu->id }}">
                                        {{ $menu->title }}</option>
                                @endforeach
                            </select>
                        </label>
                        @error('menu')
                            <div class="text-danger w-100">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <p class="w-100 fs-5 fw-bold">اختر محتوي الصفحة</p>
                        <div class="form-check cursor-pointer">
                            <input class="form-check-input cursor-pointer @error('check') in-invalid @enderror"
                                value="pdf" name="check" type="radio" id="checkPdf">
                            <label class="form-check-label cursor-pointer" for="checkPdf"> PDF </label>
                        </div>
                        <div class="form-check cursor-pointer">
                            <input class="form-check-input cursor-pointer @error('check') in-invalid @enderror"
                                value="ckeditor" name="check" type="radio" id="checkCkeditor">
                            <label class="form-check-label cursor-pointer" for="checkCkeditor"> محتوي </label>
                        </div>
                        @error('check')
                            <div class="text-danger w-100">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-3" id="pdf" style="display: none">
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
                    <div class="col-12 form-group mb-3" id="ckeditor" style="display: none">
                        <label class="form-label w-100">
                            المحتوي
                            <textarea id="editor" name="content" class="form-control @error('pdf') is-invalid @enderror"></textarea>
                        </label>
                        @error('content')
                            <div class="text-danger w-100">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">إضافة</button>
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
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'imageUpload',
                        'blockQuote',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'highlight',
                        'fontSize',
                        '-',
                        'codeBlock',
                        'code'
                    ],
                    shouldNotGroupWhenFull: true
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

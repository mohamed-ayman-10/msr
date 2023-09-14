@extends('admin.master')
@section('page_title', 'الملف الشخصي')
@section('content')
    <div class="card">
        <form action="{{ route('editProfile') }}" method="post" autocomplete="off">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-lable w-100">
                            الاسم
                            <span class="text-danger">*</span>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="الاسم">
                        </label>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-lable w-100">
                            اسم المستخدم
                            <span class="text-danger">*</span>
                            <input type="text" name="username" value="{{ $user->username }}"
                                class="form-control @error('username') is-invalid @enderror" placeholder="اسم المستخدم">
                        </label>

                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 form-group mb-3">
                        <label class="form-lable w-100">
                            البريد الالكتروني
                            <span class="text-danger">*</span>
                            <input type="email" name="email" value="{{ $user->email }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="البريد الالكتروني">
                        </label>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3 form-password-toggle">
                        <label class="form-lable">
                            كلمة المرور الجديدة
                        </label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" name="password" placeholder="كلمة المرور الجديدة"
                                autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 form-password-toggle">
                        <label class="form-lable">
                            تاكيد كلمة المرور
                        </label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password-confirmation" placeholder="تاكيد كلمة المرور" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                </div>
            </div>
            <hr class="my-0">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </form>
    </div>
@endsection

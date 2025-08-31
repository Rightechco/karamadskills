@extends('panel::layouts.master')

@section('title','کاربران')
@section('meta')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>ایجاد کاربر</h4>
                            <a href="{{ route('panel.user.users') }}" style="font-size: 35px"><i
                                    class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form action="{{ route('panel.user.usersStore') }}" method="post">
                                @csrf
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="name">نام</label><span class="text-danger">*</span>
                                                <input required name="name" type="text" id="name" class="form-control" placeholder="نام" value="{{ old('name') }}">
                                            @error('name')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="mobile">شماره موبایل</label><span class="text-danger">*</span>
                                        <input required name="mobile" type="text" class="form-control" id="mobile" placeholder="شماره موبایل" value="{{ old('mobile') }}">
                                        @error('mobile')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="password">رمز عبور</label><span class="text-danger">*</span>
                                        <input required name="password" type="password" class="form-control" id="password" placeholder="رمز عبور" value="">
                                        @error('password')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @if (auth()->user()->can('UserPermission'))
                                    <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="gender">وضعیت</label><span class="text-danger">*</span>
                                            <select class="form-control select2" data-live-search="true" id="status"
                                                    name="status"
                                                    style="width: 100%">
                                                <option>انتخاب کنید</option>
                                                @foreach(\Modules\User\Models\User::$statuses as $status)
                                                    <option value="{{ $status }}">{{ __('messages.'.$status) }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1 justify-content-end align-content-end">
                                        <div class="checkbox checkbox-pink form-check-inline">
                                            <input type="checkbox" id="employer" value="1" name="employer">
                                            <label for="employer"> دسترسی ایجاد شرکت و آگهی </label>
                                        </div>
                                        </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="roles">نقش ها</label>
                                        @foreach($roles as $role)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="role{{ $role->id }}" name="roles[{{ $role->slug }}]" value="{{ $role->id }}">
                                                <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                        @error('role')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                                <button class="btn btn-primary btn-block mb-4 mr-2 mt-4">ایجاد</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>

    </script>
@endsection

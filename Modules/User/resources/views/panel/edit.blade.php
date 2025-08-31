@extends('panel::layouts.master')

@section('title','ویرایش کاربر')
@section('meta')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>ویرایش کاربر</h4>
                            <a href="{{ route('panel.user.users') }}" style="font-size: 35px"><i
                                    class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form action="{{ route('panel.user.usersUpdate',$user->id) }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="name">نام</label><span class="text-danger">*</span>
                                        <input required name="name" type="text" id="name" class="form-control" value="{{ old('name',$user->name) }}">
                                        @error('name')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="mobile">شماره موبایل</label><span class="text-danger">*</span>
                                        <input required name="mobile" type="text" class="form-control" id="mobile" placeholder="شماره موبایل" value="{{ old('mobile',$user->mobile) }}">
                                        @error('mobile')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="password">رمز عبور</label><span class="text-danger">*</span>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="رمز عبور" value="">
                                        @error('password')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    @if (auth()->user()->can('CounselorPermission'))
                                        <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="counselor">هزینه مشاوره</label>
                                            <input name="counselor" type="text" class="form-control" id="counselor" placeholder="هزینه مشاوره (تومان)" value="{{ old('counselor',$user->counselor) }}">
                                            @error('counselor')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    @endif
                                    @if (auth()->user()->can('UserPermission'))
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="gender">وضعیت</label><span class="text-danger">*</span>
                                            <select class="form-control select2" data-live-search="true" id="status"
                                                    name="status"
                                                    style="width: 100%">
                                                <option>انتخاب کنید</option>
                                                @foreach(\Modules\User\Models\User::$statuses as $status)
                                                    <option @if($user->status == $status) selected @endif value="{{ $status }}">{{ __('messages.'.$status) }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1 justify-content-end align-content-end">
                                            <div class="checkbox checkbox-pink form-check-inline">
                                                <input type="checkbox" id="employer" value="1" name="employer" @if($user->employer) checked @endif>
                                                <label for="employer"> دسترسی ایجاد شرکت و آگهی </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="nationalCode">کد ملی </label><span class="text-danger">*</span>
                                            <input name="nationalCode" type="text" id="nationalCode" class="form-control" value="{{ old('nationalCode',$user->nationalCode) }}">
                                            @error('nationalCode')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="nationalCodePic">تصویر کارت ملی</label><span class="text-danger">*</span>
                                            <input type="file" name="nationalCodePic" class="form-control" id="nationalCodePic">
                                            @error('nationalCodePic')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                            @if($user->nationalCodePic)
                                                <img class="mt-3 w-100" src="{{ route('panel.user.fileShow',[$user->nationalCodePic,'userNationalCard']) }}" alt="">
                                            @endif
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="roles">نقش ها</label>
                                            @foreach($roles as $role)
                                                <div class="custom-control custom-checkbox">
                                                    <input @if($user->hasRole($role->slug)) checked @endif  type="checkbox" class="custom-control-input" id="role{{ $role->id }}" name="roles[{{ $role->slug }}]" value="{{ $role->id }}">
                                                    <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                                </div>
                                            @endforeach
                                            @error('role')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn-primary btn-block mb-4 mr-2 mt-4">ویرایش</button>
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

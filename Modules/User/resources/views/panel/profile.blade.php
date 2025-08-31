@extends('panel::layouts.master')

@section('title','پروفایل')
@section('meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jalali/jalalidatepicker.min.css') }}">
@endsection

@section('content')
    @if(auth()->user()->status == \Modules\User\Models\User::STATUS_NEW)
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="widget-content widget-content-area br-6">
                            <div class="row justify-content-between mx-0 align-items-center">
                                <h4>احراز هویت</h4>
                            </div>
                            <div class="mb-4 mt-4">
                                <form action="{{ route('panel.user.usersVerify') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <span class="d-block w-100 text-center">احراز هویت</span>
                                    <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                        <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="nationalCode">کد ملی </label><span class="text-danger">*</span>
                                            <input name="nationalCode" type="text" id="nationalCode" class="form-control" value="{{ old('nationalCode',auth()->user()->nationalCode) }}">
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
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block mb-4 mr-2 mt-4">ایجاد</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>اطلاعات کاربری</h4>
                            <a href="{{ route('panel') }}" style="font-size: 35px"><i
                                    class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form action="{{ route('panel.user.usersProfile') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <span class="d-block w-100 text-center">پروفایل</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="pic">تصویر پروفایل</label><span class="text-danger">*</span>
                                        <input type="file" name="pic" class="form-control" id="pic">
                                        <small class="form-text text-info">سایز مناسب: 250*250</small>
                                        @error('pic')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="email">ایمیل</label><span class="text-danger">*</span>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email',auth()->user()->email) }}">
                                        @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1 d-flex align-items-center">
                                        دانشگاه فعلی: {{ auth()->user()->university->name ?? '-' }}
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="type">نوع دانشگاه</label>
                                        <select class="form-control select2" name="type" id="type">
                                            <option value="">انتخاب</option>
                                            @foreach (\Modules\University\Models\University::$types as $type)
                                                <option @if (old('type') == $type) selected @endif
                                                value="{{ $type }}">{{ __('messages.' . $type) }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="state">مرکز استان</label>
                                        <select class="form-control select2" name="state" id="state">
                                            <option value="">انتخاب</option>

                                        </select>
                                        @error('state')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="uni">نام دانشگاه</label>
                                        <select class="form-control select2" name="uni" id="uni">
                                            <option value="">انتخاب</option>

                                        </select>
                                        @error('uni')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block mb-4 mr-2 mt-4">تغییر</button>
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

                $(document).ready(function() {
                    $("#type").on('change', function (e) {
                        e.preventDefault();
                        var type = $('#type').val();
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('university.getOstany') }}",
                            data: {type: type},
                            success: function (data) {
                                if ($.isEmptyObject(data.error)) {
                                    $('#state').find('option').remove();
                                    $.each(data, function (key, val) {
                                        $('#state').append(`<option value="${val.id}">${val.name}</option>`);
                                        var state = $('#state').val();
                                        $.ajax({
                                            type: 'GET',
                                            url: "{{ route('university.getVaheds') }}",
                                            data: {id: state},
                                            success: function (data1) {
                                                if ($.isEmptyObject(data1.error)) {
                                                    $('#uni').find('option').remove();
                                                    $.each(data1, function (key1, val1) {
                                                        $('#uni').append(`<option value="${val1.id}">${val1.name}</option>`);
                                                    });
                                                } else {

                                                }
                                            }
                                        });
                                    });
                                    $("#state").click();
                                } else {

                                }
                            }
                        });
                    });

                    $("#state").on('change', function (e) {
                        e.preventDefault();
                        var state = $('#state').val();
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('university.getVaheds') }}",
                            data: {id: state},
                            success: function (data) {
                                if ($.isEmptyObject(data.error)) {
                                    $('#uni').find('option').remove();
                                    $.each(data, function (key, val) {
                                        $('#uni').append(`<option value="${val.id}">${val.name}</option>`);
                                    });
                                } else {

                                }
                            }
                        });
                    });

                    $("#state").focus(function (e) {
                        e.preventDefault();
                        var state = $('#state').val();
                        $.ajax({
                            type: 'GET',
                            url: "{{ route('university.getVaheds') }}",
                            data: {id: state},
                            success: function (data) {
                                if ($.isEmptyObject(data.error)) {
                                    $('#uni').find('option').remove();
                                    $.each(data, function (key, val) {
                                        $('#uni').append(`<option value="${val.id}">${val.name}</option>`);
                                    });
                                } else {

                                }
                            }
                        });
                    });
                });
            </script>
        @endsection

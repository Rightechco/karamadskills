@extends('panel::layouts.master')

@section('title','ویرایش دانشگاه')
@section('meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>ویرایش دانشگاه</h4>
                            <a href="{{ route('panel.university.universities') }}" style="font-size: 35px"><i
                                    class='fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form action="{{ route('panel.university.universityUpdate',$university->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <input type="hidden" name="id" value="{{ $university->id }}">
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="name">نام</label><span class="text-danger">*</span>
                                                <input required name="name" type="text" id="name" class="form-control" placeholder="نام" value="{{ old('name',$university->name) }}">
                                            @error('name')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="slug">اسلاگ</label>
                                        <input name="slug" type="text" id="slug" class="form-control" placeholder="نام انگلیسی" value="{{ old('slug',$university->slug) }}">
                                        @error('slug')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="admins" class="">کاربران مدیر</label><span
                                            class="text-danger">*</span>
                                        <select class="select2 select2-multiple" name="admins[]" id="jobType"
                                                multiple="multiple" multiple data-placeholder="انتخاب کنید...">
                                            @if($university->admins)
                                            @foreach($university->admins as $admin)
                                                    <option selected value="{{ $admin->id }}">{{ $admin->name.' - '.$admin->mobile }}</option>
                                            @endforeach
                                            @endif
                                            @foreach ($users as $user)
                                                <option @if (old('admins') == $user->id) selected @endif
                                                value="{{ $user->id }}">{{ $user->name.' - '.$user->mobile }}</option>
                                            @endforeach
                                        </select>
                                        @error('admins')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="state" class="">نوع دانشگاه</label><span
                                            class="text-danger">*</span>
                                        <select class="select2" name="state" id="state" data-placeholder="انتخاب کنید...">
                                            <option value="" selected>انتخاب کنید</option>
                                            @foreach (\Modules\University\Models\University::$states as $state)
                                                <option @if (old('state') == $state || $university->state == $state) selected @endif
                                                value="{{ $state }}">{{ __('messages.' . $state) }}</option>
                                            @endforeach
                                        </select>
                                        @error('state')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="type" class="">نوع دانشگاه</label><span
                                            class="text-danger">*</span>
                                        <select class="select2" name="type" id="type" data-placeholder="انتخاب کنید...">
                                            @foreach (\Modules\University\Models\University::$types as $type)
                                                <option @if (old('type') == $type || $university->type == $type) selected @endif
                                                value="{{ $type }}">{{ __('messages.' . $type) }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="ostan">مرکز استان</label><small class="text-info mx-2">در صورت انتخاب واحد دانشگاهی، این قسمت را انتخاب کنید</small>
                                        <select class="form-control select2" name="ostan" id="ostan">
                                            <option value="">انتخاب</option>
                                            @if($university->parent_id)
                                                <option value="{{ $university->parent_id }}" selected>{{ $university->parent->name }}</option>
                                            @endif
                                        </select>
                                        @error('ostan')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="logo">لوگو</label>
                                        <input type="file" name="logo" class="form-control" id="logo">
                                        <small class="form-text text-info">سایز مناسب: 500*500</small>
                                        @error('logo')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @if($university->logo)
                                            <img class="mt-3 w-100" src="{{ asset($university->logo['indexArray']['small']) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="stamp">مهر دانشگاه</label>
                                        <input type="file" name="stamp" class="form-control" id="stamp">
                                        <small class="form-text text-info">سایز مناسب: 200*200</small>
                                        @error('stamp')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @if($university->stamp)
                                            <img class="mt-3 w-100" src="{{ asset($university->stamp['indexArray']['small']) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="tell">شماره تماس</label>
                                        <input name="tell" type="text" id="tell" class="form-control" placeholder="شماره تماس" value="{{ old('tell',$university->tell) }}">
                                        @error('tell')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="website">وب سایت</label>
                                        <input name="website" type="text" id="website" class="form-control" placeholder="آدرس وب سایت" value="{{ old('website',$university->website) }}">
                                        @error('website')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 my-1">
                                        <label for="gallery">گالری عکس</label>
                                        @if($university->gallery)
                                            @foreach($university->gallery as $gallery)
                                                <img src="{{ asset($gallery['indexArray']['medium']) }}" alt="">
                                            @endforeach
                                            <a onClick="sweetConfirm(event)" href="{{ route('panel.university.removeGallery',$university->id) }}" class="btn btn-sm btn-danger">حذف عکس های قبلی</a>
                                        @endif
                                        <div id="addedFilesDiv" class="row mx-0 col-11 px-0">

                                        </div>
                                        <div class="my-1 addFile col-1">
                                            <i class="mdi mdi-plus" id="addedFiles" data-toggle="tooltip" data-placement="top" title="افزودن فایل ، حداکثر 4MB"></i>
                                        </div>
                                    </div>
                                    <div class="col-12 my-1">
                                        <label for="text">محتوا صفحه ی دانشگاه</label>
                                        <textarea class="col-12" id="text"
                                                  name="text">{{ old('text',$university->text) }}</textarea>
                                        @error('text')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
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
@endsection

@section('js')
    <script src="{{ asset('assets/libs/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#text').summernote({
                height: '150px',
                onImageUpload: function (files, editor, $editable) {
                    sendFile(files[0], editor, $editable);
                }
            });
        });
        $("#addedFiles").on('click', function (e) {
            $('#addedFilesDiv').append('<div class="col-12 col-ms-6 col-lg-6 my-1 mx-0 px-0 pr-lg-1" style="min-width: 250px"><div class="file-area"><input type="file" required name="gallery[]"> <div class="file-dummy"> <span class="default">فایل مورد نظر خود انتخاب کنید</span><span class="success">فایل شما انتخاب شد</span></div><i class="mdi mdi-close text-danger" id="remove-image" onclick="removeImage(this)"></i></div></div>');
        })
        function removeImage(e){
            $(e).parent().parent().remove();
        };

        $("#state , #type").on('change', function(e) {
            e.preventDefault();
            var state = $('#state').val();
            if (state == 'vahed') {
                var type = $('#type').val();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('university.getOstany') }}",
                    data: { state: state,type: type },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $('#ostan').find('option').remove();
                            $.each(data, function(key, val) {
                                $('#ostan').append(`<option value="${val.id}">${val.name}</option>`);
                            });
                        } else {

                        }
                    }
                });
            }
        });
    </script>
@endsection

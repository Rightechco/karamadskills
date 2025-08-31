@extends('panel::layouts.master')

@section('title','ثبت بازدید')
@section('meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/leaflet/leaflet.css') }}">

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>ایجاد بازدید</h4>
                            <a href="{{ route('panel.visit.visits') }}" style="font-size: 35px"><i
                                    class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form id="form" action="{{ route('panel.visit.visitStore') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="name">نام</label><span class="text-danger">*</span>
                                        <input required name="name" type="text" id="name" class="form-control" placeholder="نام" value="{{ old('name') }}">
                                        @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror

                                        <label for="university_id" class="mt-2">مربوط به دانشگاه</label>
                                        <select class="form-control select2" id="university_id" name="university_id">
                                            <option value="">انتخاب کنید</option>
                                            @foreach ($universities as $university)
                                                <option @if (old('university_id') == $university['id']) selected @endif
                                                value="{{ $university['id'] }}">{{ $university['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('university_id')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror

                                        <label for="videoLink" class="mt-3">آدرس ویدیو</label>
                                        <input name="videoLink" type="text" id="videoLink" class="form-control" placeholder="آدرس ویدیو" value="{{ old('videoLink') }}">
                                        @error('videoLink')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="slug">اسلاگ</label>
                                        <input name="slug" type="text" class="form-control" id="slug" placeholder="اسلاگ" value="{{ old('slug') }}">
                                        @error('slug')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="image" class="mt-2">کاور <span class="text-danger">* <span class="mx-2 position-absolute text-info">سایز مناسب: 400*600</span></span></label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        @error('image')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="video" class="mt-3">ویدیو<small class="mx-2 position-absolute text-info">حداکثر حجم: 200MB</small></label>
                                        <input type="file" name="video" class="form-control" id="video">
                                        @error('video')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <span class="d-block w-100 text-center">توضیحات تکمیلی</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6">
                                        <label for="des">خلاصه بازدید رو اینجا وارد کن</label>
                                        <textarea class="col-12" id="expert" name="expert">{{ old('expert') }}</textarea>
                                        @error('expert')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6">
                                        <label for="des">مشخصات و توضیحات کامل بازدید رو اینجا بنویس</label>
                                        <textarea class="col-12" id="des" name="des">{{ old('des') }}</textarea>
                                        @error('des')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="tags" class="d-block">تگ ها</label>
                                        <input type="hidden" name="tags" value="{{ old('tags') }}" id="tags">
                                        <select id="select_tags" class="form-control form-control-sm tagging" multiple></select>
                                        @error('tags')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block mb-4 mr-2">ایجاد</button>
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
    <script src="{{ asset('assets/libs/leaflet/leaflet.js') }}"></script>

    <script>
        $(document).ready(function (){

            var tags_input = $('#tags');
            var select_tags = $('#select_tags');
            var default_tags = tags_input.val();
            var default_data = null;
            if(tags_input.val() !== null && tags_input.val().length > 0) {
                default_data = default_tags.split(',');
            }
            select_tags.select2({
                placeholder : 'تگ ها را وارد کنید',
                tags : true ,
                data : default_data
            });
            select_tags.children('option').attr('selected',true).trigger('change');
            $('#form').submit(function(event){
                if(select_tags.val() !== null && select_tags.val().length > 0){
                    var selectedSource = select_tags.val().join(',');
                    tags_input.val(selectedSource);
                }
            })
        });

        $(document).ready(function () {

            $('#expert').summernote({
                height: '150px',
                onImageUpload: function (files, editor, $editable) {
                    sendFile(files[0], editor, $editable);
                }
            });

            $('#des').summernote({
                height: '150px',
                onImageUpload: function (files, editor, $editable) {
                    sendFile(files[0], editor, $editable);
                }
            });
        });
    </script>
@endsection

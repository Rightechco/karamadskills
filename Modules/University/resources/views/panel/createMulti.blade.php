@extends('panel::layouts.master')

@section('title','ایجاد دانشگاه')
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
                            <h4>ایجاد دانشگاه</h4>
                            <a href="{{ route('panel.university.universities') }}" style="font-size: 35px"><i
                                    class='fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form action="{{ route('panel.university.universityStoreMulti') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="type" class="">نوع دانشگاه</label><span
                                            class="text-danger">*</span>
                                        <select class="select2" name="type" id="type" data-placeholder="انتخاب کنید...">
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
                                        <label for="ostan">مرکز استان</label><small class="text-info mx-2">در صورت انتخاب واحد دانشگاهی، این قسمت را انتخاب کنید</small>
                                        <select class="form-control select2" name="ostan" id="ostan">
                                            <option value="">انتخاب</option>

                                        </select>
                                        @error('ostan')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <span class="d-block w-100 text-center">نام دانشگاه ها</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" id="holder" style="border-radius: .25rem">
                                    <div class="col-12 d-flex">
                                        <div class="col-12 my-1">
                                            <label for="excel">آپلود با اکسل</label>
                                            <input type="file" name="excel" class="form-control" id="excel">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                    <div class="col-11 my-1">
                                        <label for="name">نام</label><span class="text-danger">*</span>
                                        <input name="name[]" type="text" id="name" class="form-control" placeholder="نام">
                                    </div>
                                        <div class="col-1 d-flex justify-content-end align-items-end my-1">
                                            <button type="button" id="metaBtn" class="btn btn-primary "><i class="fa fa-plus mr-1"></i></button>
                                        </div>
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
        $("#metaBtn").on('click', function (e) {
            $('#holder').append('<div class="col-12 d-flex"><div class="col-11 my-1"><label for="name">نام</label><span class="text-danger">*</span> <input required name="name[]" type="text" id="name" class="form-control" placeholder="نام"></div><div class="col-1 d-flex justify-content-end align-items-end my-1"><button type="button" onclick="metaDelBtnLang(this)" class="btn btn-danger"><i class="fas fa-window-close mr-1"></i></button></div></div>');
        });

        function metaDelBtnLang(event) {
            $(event).parent().parent().remove();
        }

        $("#type").on('change', function(e) {
            e.preventDefault();
            var state = 'vahed';
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

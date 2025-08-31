@extends('panel::layouts.master')

@section('title','ویرایش مشوق')
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
                            <h4>ویرایش مشوق</h4>
                            <a href="{{ route('panel.incentive.incentives') }}" style="font-size: 35px"><i class='fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form id="form" action="{{ route('panel.incentive.incentiveUpdate',$incentive->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12 row mx-0 justify-content-between my-2">
                                    <div class="text-danger">دلیل رد شدن: {{ $incentive->reject }}</div>
                                    <button type="button" id="metaBtnProject"
                                            class="btn btn-primary "><i
                                            class="fa fa-plus mr-1"></i> <span>افزودن</span></button>
                                </div>
                                <span class="d-block w-100 text-center small">جزئیات مهارت یا دوره</span>
                                @foreach(json_decode($incentive->incentive,true) as $inc)
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="name">نام دوره</label><span class="text-danger">*</span>
                                        <input name="name[]" type="text" class="form-control" id="name" placeholder="نام دوره" value="{{ $inc['name'] }}">
                                        @error('name.*')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="time">دوره چند ساعت بوده؟</label><span class="text-danger">*</span><span class="text-info small mx-2">فقط عدد وارد کنید</span>
                                        <input name="time[]" type="text" class="form-control" oninput="fixInput(this)" id="time" placeholder="زمان به ساعت" value="{{ $inc['time'] }}">
                                        @error('time.*')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="location">محل آموزش</label><span class="text-danger">*</span>
                                        <input name="location[]" type="text" class="form-control" id="location" placeholder="مثلا دانشگاه مغان" value="{{ $inc['location'] }}">
                                        @error('location.*')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="file">مدرک</label><span class="text-danger">*</span><span class="text-info small mx-2">در قالب عکس یا pdf باشد</span><span class="text-danger small mx-2">کمتر از ۲ مگابایت</span>
                                        <input type="file" name="file[]" class="form-control" id="file">
                                        @error('file.*')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <img src="{{ route('panel.file.incentiveFileShow',$inc['file']) }}" alt="">
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="type">نوع مهارت</label><span class="text-danger">*</span>
                                        <select class="form-control select2" id="type" name="type[]">
                                            <option @if($inc['type'] == 1) selected @endif value="1">مهارت های تخصصی</option>
                                            <option @if($inc['type'] == 2) selected @endif value="2">مهارت های شغلی عمومی</option>
                                            <option @if($inc['type'] == 3) selected @endif value="3">سابقه دستیار پژوهشی</option>
                                            <option @if($inc['type'] == 4) selected @endif value="4">سابقه دستیار آزمایشگاهی , کارآموزی , انجام امور کارگاهی , کارورزی</option>
                                            <option @if($inc['type'] == 5) selected @endif value="5">سابقه تدریس دروس دانشگاهی و دوره های تخصصی</option>
                                            <option @if($inc['type'] == 6) selected @endif value="6">دروس عملی و آزمایشگاهی و کارگاهی هر رشته</option>
                                        </select>
                                        @error('type.*')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="unit">در صورت انتخاب گزینه دروس عملی و آزمایشگاهی و کارگاهی ،تعداد واحد درسی را وارد نمایید</label>
                                        <input name="unit[]" type="text" class="form-control" id="unit" oninput="fixInput(this)" placeholder="فقط عدد وارد کنید" value=" {{ $inc['unit'] }}">
                                        @error('unit.*')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                @endforeach
                                <div id="added" class="w-100"></div>
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
    <script>
        $("#metaBtnProject").on('click', function (e) {
            $('#added').append('<div class="border row mt-1 mb-4 p-2 p-lg-4 position-relative" style="border-radius: .25rem"><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="name">نام دوره</label><span class="text-danger">*</span><input name="name[]" type="text" class="form-control" id="name" placeholder="نام دوره" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"> <label for="time">دوره چند ساعت بوده؟</label><span class="text-danger">*</span><span class="text-info small mx-2">فقط عدد وارد کنید</span><input name="time[]" type="text" class="form-control" id="time" oninput="fixInput(this)" placeholder="زمان به ساعت" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="location">محل آموزش</label><span class="text-danger">*</span><input name="location[]" type="text" class="form-control" id="location" placeholder="مثلا دانشگاه مغان" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="file">مدرک</label><span class="text-danger">*</span><span class="text-info small mx-2">در قالب عکس یا pdf باشد</span><span class="text-danger small mx-2">کمتر از ۲ مگابایت</span><input type="file" name="file[]" class="form-control" id="file"></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="type">نوع مهارت</label><span class="text-danger">*</span><select class="form-control select2" id="type" name="type[]"><option value="">انتخاب کنید</option><option value="1">مهارت های تخصصی</option><option value="2">مهارت های شغلی عمومی</option><option value="3">سابقه دستیار پژوهشی</option><option value="4">سابقه دستیار آزمایشگاهی , کارآموزی , انجام امور کارگاهی , کارورزی</option><option value="5">سابقه تدریس دروس دانشگاهی و دوره های تخصصی</option><option value="6">دروس عملی و آزمایشگاهی و کارگاهی هر رشته</option></select></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="unit">در صورت انتخاب گزینه دروس عملی و آزمایشگاهی و کارگاهی ،تعداد واحد درسی را وارد نمایید</label><input name="unit[]" type="text" class="form-control" id="unit" oninput="fixInput(this)" placeholder="فقط عدد وارد کنید" value=""></div><div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div></div>');
        })

        function metaDelBtn(event) {
            $(event).parent().parent().remove();
        }

        var persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
        var arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
        function fixNumbers(str)
        {
            if(typeof str === 'string')
            {
                for(var i=0; i<10; i++)
                {
                    str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
                }
            }
            return str;
        };

        function fixInput(event) {
            var currentValue = $(event).val();
            var updatedValue = fixNumbers(currentValue);
            $(event).val(updatedValue);
        };
    </script>
@endsection

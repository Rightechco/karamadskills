@extends('panel::layouts.master')

@section('title','شرکت ها')
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
                            <h4>ایجاد شرکت</h4>
                            <a href="{{ route('panel.company.companies') }}" style="font-size: 35px"><i class='fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form id="form" action="{{ route('panel.company.companiesStore') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="name">نام</label><span class="text-danger">*</span>
                                        <input required name="name" type="text" id="name" class="form-control" placeholder="نام" value="{{ old('name') }}">
                                        @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="slug">اسلاگ</label>
                                        <input name="slug" type="text" class="form-control" id="slug" placeholder="اسلاگ" value="{{ old('slug') }}">
                                        @error('slug')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="logo">لوگو</label>
                                        <input type="file" name="logo" class="form-control" id="logo">
                                        <small class="form-text text-info">سایز مناسب: 100*100</small>
                                        @error('logo')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="logo">کاور</label>
                                        <input type="file" name="cover" class="form-control" id="cover">
                                        <small class="form-text text-info">سایز مناسب: 450*1366</small>
                                        @error('cover')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="population">جمعیت شرکت</label>
                                        <input name="population" type="text" id="population" class="form-control" placeholder="مثلا: بین 10 تا 30 نفر" value="{{ old('population') }}">
                                        @error('population')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="website" class="mt-3">آدرس وب سایت</label>
                                        <input name="website" type="text" id="website" class="form-control" placeholder="مثلا: google.com" value="{{ old('website') }}">
                                        @error('website')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="foundation" class="mt-3">زمان تاسیس</label>
                                        <input name="foundation" type="text" id="foundation" class="form-control" placeholder="مثلا: سال 1387" value="{{ old('foundation') }}">
                                        @error('foundation')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @can('CompanyPermission')
                                        <label for="user" class="mt-3">ثبت بنام کاربر دیگر</label>
                                        <select class="form-control select2" id="user" name="user">
                                            <option value="">انتخاب کنید</option>
                                                @foreach($users as $user)
                                                    @if(isset($user->name))
                                                    <option @if(old('user') == $user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                        @error('user')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @endcan
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="map">آدرس شرکت</label>
                                        <p class="desc-label-form">
                                            روی نقشه حتما <strong> کلیک </strong> کنید
                                        </p>
                                        <div class="box-view-map position-relative">
                                            <a href="javascript:;" class="currentlocate">
                                                <i class="mdi mdi-map-marker-circle text-dark map-icon"></i>
                                            </a>
                                            <div class="box-map" id="map" style="width: 100%; height: 400px; z-index:1;"></div>
                                            <div class="marker-position"></div>
                                            <input type="hidden" id="poslat" name="companyLat" />
                                            <input type="hidden" id="poslng" name="companyLang" />
                                            @error('announcementLat')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                            @error('announcementLang')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block w-100 text-center">توضیحات تکمیلی</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="expert">یک توضیح کوتاه از شرکت رو اینجا بنویس</label>
                                        <textarea class="col-12" id="expert"
                                                  name="expert">{{ old('expert') }}</textarea>
                                        @error('expert')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="des">مشخصات و توضیحات کامل شرکت رو اینجا بنویس</label>
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
        });

        $(document).ready(function () {
            $('#des').summernote({
                height: '150px',
                onImageUpload: function (files, editor, $editable) {
                    sendFile(files[0], editor, $editable);
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function() {

            var map = L.map('map').setView([38.079728602288625, 46.29035247472123], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            $('.currentlocate').click(function() {

                map.locate({
                    setView: true,
                    maxZoom: 16
                });

                function onLocationFound(e) {
                    var radius = e.accuracy;

                    L.circle(e.latlng, radius).addTo(map);
                }

                map.on('locationfound', onLocationFound);

                function onLocationError(e) {
                    alert(e.message);
                }

                map.on('locationerror', onLocationError);

            });

            var greenIcon = L.icon({
                iconUrl: 'img/marker.svg',

                iconSize: [50, 50], // size of the icon
            });

            var theMarker = null;

            // add marker on click
            map.on("click", addMarker);

            function addMarker(e) {

                if (theMarker != null) {
                    map.removeLayer(theMarker);
                };

                $('#poslat').val(e.latlng.lat);
                $('#poslng').val(e.latlng.lng);
                var myIcon = L.divIcon({className: 'mdi mdi-map-marker text-dark currentIconLocation'});

                theMarker = L.marker(e.latlng, {
                    icon: myIcon,
                    draggable: true,
                }).addTo(map)
                    .bindPopup(buttonRemove);

                theMarker = theMarker.on('dragend', function(event) {
                    var marker = event.target;
                    var position = marker.getLatLng();
                    theMarker.setLatLng(new L.LatLng(position.lat, position.lng), {
                        draggable: 'true'
                    });
                    map.panTo(new L.LatLng(position.lat, position.lng));
                    $('#poslat').val(position.lat);
                    $('#poslng').val(position.lng);
                });
                map.addLayer(theMarker);

            }

            const buttonRemove =
                '<span>موقعیت انتخابی شما</span>';

        });
    </script>
@endsection

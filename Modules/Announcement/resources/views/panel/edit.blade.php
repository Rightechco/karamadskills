@extends('panel::layouts.master')

@section('title','آگهی ها')
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
                            <h4>ویرایش آگهی</h4>
                            <a href="{{ route('panel.announcement.announcements') }}" style="font-size: 35px"><i
                                    class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form id="form" action="{{ route('panel.announcement.announcementsUpdate',$announcement->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $announcement->id }}">
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    @if(auth()->user()->can('AnnouncementPermission'))
                                        <div class="col-12 col-ms-12 col-lg-12 my-1">
                                            <label for="gender">وضعیت</label><span class="text-danger">*</span>
                                            <select class="form-control select2" data-live-search="true" id="status"
                                                    name="status"
                                                    style="width: 100%">
                                                <option>انتخاب کنید</option>
                                                @foreach(\Modules\Announcement\Models\Announcement::$statuses as $status)
                                                    <option @if($announcement->status == $status) selected @endif value="{{ $status }}">{{ __('messages.'.$status) }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    @endif
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label for="name">عنوان آگهی</label><span class="text-danger">*</span>
                                        <input required name="name" type="text" id="name" class="form-control" placeholder="مثل: حسابدار" value="{{ old('name',$announcement->name) }}">
                                        @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="company" class="mt-3">شرکت</label><span class="text-danger">*</span>
                                        <select class="form-control select2" id="company" name="company">
                                            <option value="">انتخاب کنید</option>
                                            <option value="{{ $announcement->company->id }}" selected>{{ $announcement->company->name }}</option>
                                            @can('AnnouncementPermission')
                                                @foreach($allCompanies as $allCompany)
                                                    <option @if(old('company') == $allCompany->id || old('company') == $allCompany->id) selected @endif value="{{ $allCompany->id }}">{{ $allCompany->name }}</option>
                                                @endforeach
                                            @else
                                            @foreach($companies as $company)
                                                <option @if($announcement->company_id == $company->id || old('company') == $company->id) selected @endif value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                            @endcan
                                        </select>
                                        @error('company')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="jobType" class="mt-3">نوع شغل</label><span class="text-danger">*</span>
                                        <select class="select2 select2-multiple" name="jobType[]" id="jobType"
                                                multiple="multiple" multiple data-placeholder="انتخاب کنید...">
                                            @foreach(\Modules\Resume\Models\Resume::$jobTypes as $jobType)
                                                <option @if((isset($announcement->jobType) && in_array($jobType,json_decode($announcement->jobType,true))) || old('jobType') == $jobType) selected @endif
                                                value="{{ $jobType }}">{{ __('messages.'.$jobType) }}</option>
                                            @endforeach
                                        </select>
                                        @error('jobType')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="universityIntership" class="mt-3">کارآموز دانشگاهی</label>
                                        <select class="select2 select2-multiple" name="universityIntership" id="universityIntership">
                                            <option @if($announcement->universityIntership == 0) selected @endif value="0">قبول نمی کنم</option>
                                            <option @if($announcement->universityIntership == 1) selected @endif value="1">قبول می کنم</option>
                                        </select>
                                        @error('universityIntership')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="ostan" class="mt-3">استان</label><span class="text-danger">*</span>
                                        <select class="form-control select2" name="ostan" id="ostan">
                                            <option value="">انتخاب</option>
                                            @foreach($ostans as $ostan)
                                                <option @if($announcement->ostan_id == $ostan->id) selected @endif value="{{ $ostan->id }}">{{ $ostan->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ostan')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="shahrestan" class="mt-3">شهر</label><span class="text-danger">*</span>
                                        <select name="shahrestan" id="shahrestan" class="form-control select2">
                                                <option value="{{ $announcement->shahrestan->id }}" selected>{{ $announcement->shahrestan->name }}</option>
                                        </select>
                                        @error('shahrestan')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="wage" class="mt-3">حقوق (میلیون تومان)</label>
                                        <input name="wage" type="text" class="form-control" id="wage" placeholder="مثل: 10" value="{{ old('wage',$announcement->wage) }}">
                                        <small class="form-text text-info">در صورت خالی بودن این فیلد، حقوق بصورت "تواقفی" نمایش داده می شود</small>
                                        @error('wage')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="background" class="mt-3">حداقل سابقه</label>
                                        <input name="background" type="text" class="form-control" id="background" placeholder="مثل: حداقل یک سال" value="{{ old('background',$announcement->background) }}">
                                        @error('background')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="edu" class="mt-3">حداقل مدرک تحصیلی</label>
                                        <select class="form-control select2" id="edu" name="edu">
                                            <option @if($announcement->edu == 'مهم نیست') selected @endif>مهم نیست</option>
                                            <option @if($announcement->edu == 'دیپلم') selected @endif>دیپلم</option>
                                            <option @if($announcement->edu == 'لیسانس') selected @endif>لیسانس</option>
                                            <option @if($announcement->edu == 'فوق لیسانس') selected @endif>فوق لیسانس</option>
                                        </select>
                                        @error('edu')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="gender" class="mt-3">جنسیت</label>
                                        <select class="form-control select2" id="gender" name="gender">
                                            <option @if(is_null($announcement->gender)) @endif value="">فرقی نمی کند</option>
                                            @foreach(\Modules\Resume\Models\Resume::$genders as $gender)
                                                <option @if($announcement->gender == $gender || old('gender') == $gender ) selected @endif value="{{ $gender }}">{{ __('messages.'.$gender) }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="military" class="mt-3">وضعیت خدمت سربازی</label>
                                        <select class="form-control select2" id="military" name="military">
                                            <option @if(is_null($announcement->military)) selected @endif value="">فرقی نمی کند</option>
                                            <option @if($announcement->military == 'دارای کارت پایان خدمت' || old('military') == 'دارای کارت پایان خدمت') selected @endif>دارای کارت پایان خدمت</option>
                                        </select>
                                        @error('military')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-ms-6 col-lg-6 my-1">
                                        <label class="d-block w-100 text-center mt-3 text-dark">اجباری کردن آزمون های شخصیت شناسی</label>
                                        <div class="col-12 border p-2 row justify-content-between mx-0" style="border-radius: 8px">
                                            @foreach(\Modules\Test\Models\Test::$types as $type)
                                                <div class="n-chk" style="width: 200px">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" @if($announcement->test && in_array($type,json_decode($announcement->test,true))) checked @endif value="{{ $type }}"  id="t{{ $type }}" name="test[]">
                                                        <label class="custom-control-label" for="t{{ $type }}">{{ __("messages." . $type) }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <label for="map" class="mt-4">آدرس موقعیت شغلی</label>
                                        <p class="desc-label-form">
                                            روی نقشه حتما <strong> کلیک </strong> کنید
                                        </p>
                                        <div class="box-view-map position-relative">
                                            <a href="javascript:;" class="currentlocate">
                                                <i class="mdi mdi-map-marker-circle text-dark map-icon"></i>
                                            </a>
                                            <div class="box-map" id="map" style="width: 100%; height: 400px; z-index:1;"></div>
                                            <div class="marker-position"></div>
                                            <input type="hidden" id="poslat" name="announcementLat" />
                                            <input type="hidden" id="poslng" name="announcementLang" />
                                            @error('announcementLat')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                            @error('announcementLang')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        @php
                                            if(isset($announcement->categories)){
                                                $categoriesIDs = array_column($announcement->categories->select('id')->toArray(),'id');
                                            } else {
                                                $categoriesIDs = [];
                                            }
                                        @endphp
                                        <span class="d-block w-100 text-center small mt-3">دسته بندی های آگهی خود را انتخاب کنید</span>
                                        <div class="col-12 border p-2" style="border-radius: 8px">
                                            <div id="category_section">
                                                @foreach($categories as $category)
                                                    <div class="n-chk">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" @if(in_array($category->id,$categoriesIDs)) checked @endif value="{{ $category->id }}"  id="c{{ $category->id }}" name="category_id[]">
                                                            <label class="custom-control-label" for="c{{ $category->id }}">{{ $category->name }}</label>
                                                        </div>
                                                        <div class="n-chk2 d-none">
                                                        @forelse ($category->childs as $child)
                                                            <div class="custom-control custom-checkbox ml-3">
                                                                <input type="checkbox" class="custom-control-input" @if(in_array($child->id,$categoriesIDs)) checked @endif value="{{ $child->id }}"  id="c{{ $child->id }}" name="category_id[]">
                                                                <label class="custom-control-label" for="c{{ $child->id }}">{{ $child->name }}</label>
                                                            </div>
                                                            <div class="n-chk2 d-none">
                                                            @forelse ($child->childs as $ch)
                                                                <div class="custom-control custom-checkbox ml-5">
                                                                    <input type="checkbox" class="custom-control-input" @if(in_array($ch->id,$categoriesIDs)) checked @endif value="{{ $ch->id }}"  id="c{{ $ch->id }}" name="category_id[]">
                                                                    <label class="custom-control-label" for="c{{ $ch->id }}">{{ $ch->name }}</label>
                                                                </div>
                                                            @empty
                                                            @endforelse
                                                            </div>
                                                        @empty
                                                        @endforelse
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('category_id')
                                            <small id="sh-text1"
                                                   class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block w-100 text-center">توضیحات تکمیلی</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12">
                                        <label for="des">مشخصات و توضیحات کامل شرکت رو اینجا بنویس</label>
                                        <textarea class="col-12" id="des" name="des">{{ old('des') ?? $announcement->des ?? null }}</textarea>
                                        @error('des')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="tags">تگ ها</label>
                                        <input type="hidden" name="tags" value="{{ old('tags',$announcement->tags) }}" id="tags">
                                        <select id="select_tags" class="form-control form-control-sm tagging" multiple>
                                            @error('tags')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </select>
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
        $('.select2').select2({})

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
            $('input[type^="checkbox"]').click(function (e) {
                $(this).parent().next().removeClass('d-none');
            });

            $('#des').summernote({
                height: '150px',
                onImageUpload: function (files, editor, $editable) {
                    sendFile(files[0], editor, $editable);
                }
            });
        });
        $("#ostan").on('change', function (e) {
            e.preventDefault();
            var ostan = $('#ostan').val();
            $.ajax({
                type: 'GET',
                url: "{{ route('common.getShahrestan') }}",
                data: {ostan: ostan},
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        $('#shahrestan').find('option').remove();
                        $.each(data, function (key, val) {
                            $('#shahrestan').append(`<option value="${val.id}">${val.name}</option>`);
                        });
                    } else {

                    }
                }
            });
        });
    </script>
    <script>
        jQuery(document).ready(function() {

            var map = L.map('map').setView({!! $announcement->location !!}, 13);

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

            var preIcon = L.divIcon({className: 'mdi mdi-map-marker text-dark currentIconLocation'});
            var theMarker = L.marker([{{ json_decode($announcement->location,true)[0] }},{{ json_decode($announcement->location,true)[1] }}],
                {icon: preIcon});
            map.addLayer(theMarker);

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
                })

                map.addLayer(theMarker);

            }

            const buttonRemove =
                '<span>موقعیت انتخابی شما</span>';

        });
    </script>
@endsection

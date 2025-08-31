@extends('panel::layouts.master')

@section('title','رزومه ساز')
@section('meta')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jalali/jalalidatepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="card-body">
                    <div class="row justify-content-between mx-0 mb-3 align-items-center">
                        <h4 class="header-title mb-3 px-1">رزومه شما</h4>
                        @if($resume)
                            <a href="{{ route('seeResume',auth()->user()->id) }}" class="btn btn-dark  text-white"><i
                                class="fab fa-centos mr-1"></i> <span>مشاهده رزومه</span></a>
                        @endif
                    </div>
                    <form action="{{ route('panel.resume.editResume') }}" method="post">
                        @csrf
                        <div id="progressbarwizard">

                            <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-2">
                                <li class="nav-item">
                                    <a href="#personal" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                        <i class="mdi mdi-account-circle mr-1"></i>
                                        <span class="d-none d-sm-inline">مشخصات فردی</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#career" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-account-card-details-outline mr-1"></i>
                                        <span class="d-none d-sm-inline">سوابق شغلی</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#edu" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-school mr-1"></i>
                                        <span class="d-none d-sm-inline">سوابق تحصیلی</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#projects" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-worker mr-1"></i>
                                        <span class="d-none d-sm-inline">پروژه ها</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#courses" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-hail mr-1"></i>
                                        <span class="d-none d-sm-inline">دوره ها</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#other" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-ticket-account mr-1"></i>
                                        <span class="d-none d-sm-inline">تکمیلی</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content border-0 mb-0">

                                <div id="bar" class="progress mb-3" style="height: 7px;">
                                    <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                </div>

                                <div class="tab-pane active" id="personal">
                                    <div class="row">
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="name">نام کامل شما</label>
                                            <input readonly type="text" class="form-control" id="name"
                                                   value="{{ old('name',auth()->user()->name) }}">
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="email">ایمیل</label>
                                            <input readonly type="text" class="form-control" id="email"
                                                   value="{{ old('email',auth()->user()->email) }}">
                                        </div>

                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="birthday">تاریخ تولد</label><span class="text-danger">*</span>
                                            @php
                                                $birth = (isset($resume->birthday)) ? verta($resume->birthday)->format('Y/m/d') : null;
                                            @endphp
                                            <input data-jdp name="birthday" type="text" id="birthday"
                                                   class="form-control" value="{{ old('birthday') ?? $birth ?? null }}">
                                            @error('birthday')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="gender">جنسیت</label><span class="text-danger">*</span>
                                            <select class="form-control select2" id="gender" name="gender">
                                                <option value="">انتخاب کنید</option>
                                                @foreach(\Modules\Resume\Models\Resume::$genders as $gender)
                                                    <option @if((isset($resume) && $resume->gender == $gender) || old('gender') == $gender ) selected @endif value="{{ $gender }}">{{ __('messages.'.$gender) }}</option>
                                                @endforeach
                                            </select>
                                            @error('gender')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="military">وضعیت خدمت سربازی</label>
                                            <select class="form-control select2" id="military" name="military">
                                                <option value="">انتخاب کنید</option>
                                                <option @if(old('military') == 'دارای کارت پایان خدمت' || (isset($resume->military) && $resume->military == 'دارای کارت پایان خدمت')) selected @endif>دارای کارت پایان خدمت</option>
                                                <option @if(old('military') == 'معافیت دائم' || (isset($resume->military) && $resume->military == 'معافیت دائم')) selected @endif>معافیت دائم</option>
                                                <option @if(old('military') == 'معافیت تحصیلی' || (isset($resume->military) && $resume->military == 'معافیت تحصیلی')) selected @endif>معافیت تحصیلی</option>
                                                <option @if(old('military') == 'مشمول' || (isset($resume->military) && $resume->military == 'مشمول')) selected @endif>مشمول</option>
                                            </select>
                                            @error('military')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="skill">تخصص شما</label>
                                            <input type="text" name="skill" class="form-control" id="skill"
                                                   placeholder="مثال: برنامه نویس وب" value="{{ old('skill') ?? $resume->skill ?? null }}">
                                            @error('skill')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="martial">وضعیت تاهل</label><span class="text-danger">*</span>
                                            <select class="form-control select2" id="martial" name="martial">
                                                <option value="">انتخاب کنید</option>
                                                @foreach(\Modules\Resume\Models\Resume::$martials as $martial)
                                                    <option @if(old('martial') == $martial || (isset($resume->martial) && $resume->martial == $martial)) selected @endif value="{{ $martial }}">{{ __('messages.'.$martial) }}</option>
                                                @endforeach
                                            </select>
                                            @error('martial')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="status">وضعیت شغلی</label><span class="text-danger">*</span>
                                            <select class="form-control select2" id="status" name="status">
                                                <option value="">انتخاب کنید</option>
                                                @foreach(\Modules\Resume\Models\Resume::$status as $status)
                                                    <option @if((isset($resume->status) && $resume->status == $status) || old('status') == $status) selected
                                                            @endif value="{{ $status }}">{{ __('messages.'.$status) }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="ostan" class="small">استان هایی که می توانید در آن مشغول بکار
                                                شوید</label><span class="text-danger">*</span>
                                            <select class="form-control select2" name="ostan" id="ostan">
                                                <option value="">انتخاب</option>
                                                @foreach($ostans as $ostan)
                                                    <option value="{{ $ostan->id }}">{{ $ostan->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('ostan')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="shahrestan" class="small">شهر هایی که می توانید در آن مشغول بکار
                                                شوید</label><span class="text-danger">*</span>
                                            <select name="shahrestan[]" id="shahrestan" multiple
                                                    class="form-control select2">
                                                    <option value="">انتخاب</option>
                                                    @if(isset($resume->shahrestan) && $resume->shahrestan->count())
                                                        @foreach($resume->shahrestan as $shahr)
                                                        <option value="{{ $shahr->id }}" selected>{{ $shahr->name }}</option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                            @error('shahrestan')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="wageDemand">حقوق مورد انتظار</label>
                                            <input type="text" class="form-control" id="wageDemand"
                                                   value="{{ old('wageDemand') ?? $resume->wageDemand ?? null }}" name="wageDemand"
                                                   placeholder="مثلا: حداقل ۱۰ میلیون تومان">
                                            @error('wageDemand')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-3 my-1">
                                            <label for="jobType">نوع شغل موردنظر</label>
                                            <select class="select2 select2-multiple" name="jobType[]" id="jobType"
                                                    multiple="multiple" multiple data-placeholder="انتخاب کنید...">
                                                @foreach(\Modules\Resume\Models\Resume::$jobTypes as $jobType)
                                                    <option @if((isset($resume->jobType) && in_array($jobType,json_decode($resume->jobType,true))) || old('jobType') == $jobType) selected @endif
                                                        value="{{ $jobType }}">{{ __('messages.'.$jobType) }}</option>
                                                @endforeach
                                            </select>
                                            @error('jobType')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 my-1">
                                            <label for="aboutMe">درباره ی شما</label>
                                            <textarea style="min-height: 150px" class="form-control" id="aboutMe" name="aboutMe"
                                                      placeholder="مختصری در مورد خودتان بنویسید ...">{{ old('aboutMe') ?? $resume->aboutMe ?? null }}</textarea>
                                            @error('aboutMe')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div> <!-- end row -->
                                </div>
                                <div class="tab-pane" id="career">
                                    <div class="row mx-0" id="metaDiv">
                                        <div class="col-12 row mx-0 justify-content-end my-2">
                                            <button type="button" id="metaBtn"
                                                    class="btn btn-primary "><i
                                                    class="fa fa-plus mr-1"></i> <span>افزودن</span></button>
                                        </div>
                                        @if(isset($resume->career)) @foreach(json_decode($resume->career) as $career)
                                            <div class="row mx-0 col-12 border p-lg-2 p-0 mb-2" style="border-radius: 8px;">
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="career_name">نام شرکت یا سازمان</label>
                                                    <input type="text" class="form-control" id="career_name"
                                                           name="career_name[]" placeholder="مثال: شرکت کارآمد"
                                                           value="{{ $career->career_name ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="career_title">عنوان شغلی شما</label>
                                                    <input type="text" class="form-control" id="career_title"
                                                           name="career_title[]" placeholder="مثال: مدیر بخش فروش"
                                                           value="{{ $career->career_title ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="career_time">تاریخ اشتغال</label>
                                                    <input type="text" class="form-control" id="career_time"
                                                           name="career_time[]" placeholder="مثال: آبان ۱۴۰۱ تا تیر ۱۴۰۳"
                                                           value="{{ $career->career_time ?? null }}">
                                                </div>
                                                <div
                                                    class="col-12 col-ms-6 col-lg-6 my-1 row mx-0 justify-content-between align-items-end">
                                                    <label>آیا هنوز در این شغل حضور دارید؟</label>
                                                    <select class="form-control select2" name="career_job[]">
                                                        <option value="">انتخاب کنید</option>
                                                        <option @if(isset($career->career_job) && $career->career_job = 1) selected @endif value="1">بله</option>
                                                        <option @if(isset($career->career_job) && $career->career_job = 0) selected @endif value="0">خیر</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 my-1">
                                                    <label for="career_des">توضیحات</label>
                                                    <textarea type="text" class="form-control" id="career_des"
                                                              name="career_des[]" placeholder="تجربیات خود در این شرکت را توضیح دهید و اگر از این شرکت جدا شده اید، دلیل آن را ذکر کنید"> {{ $career->career_des ?? null }}</textarea>
                                                </div>
                                                <div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div>
                                            </div>
                                        @endforeach @endif
                                        <div class="row mx-0 col-12 border p-lg-2 p-0" style="border-radius: 8px;">
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="career_name">نام شرکت یا سازمان</label>
                                                <input type="text" class="form-control" id="career_name"
                                                       name="career_name[]" placeholder="مثال: شرکت کارآمد"
                                                       value="">
                                                @error('career_name.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="career_title">عنوان شغلی شما</label>
                                                <input type="text" class="form-control" id="career_title"
                                                       name="career_title[]" placeholder="مثال: مدیر بخش فروش"
                                                       value="">
                                                @error('career_title.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="career_time">تاریخ اشتغال</label>
                                                <input type="text" class="form-control" id="career_time"
                                                       name="career_time[]" placeholder="مثال: آبان ۱۴۰۱ تا تیر ۱۴۰۳"
                                                       value="">
                                                @error('career_time.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div
                                                class="col-12 col-ms-6 col-lg-6 my-1 row mx-0 justify-content-between align-items-end">
                                                <label>آیا هنوز در این شغل حضور دارید؟</label>
                                                <select class="form-control select2" name="career_job[]">
                                                    <option value="" selected>انتخاب کنید</option>
                                                    <option value="1">بله</option>
                                                    <option value="0">خیر</option>
                                                </select>
                                                @error('career_job.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 my-1">
                                                <label for="career_des">توضیحات</label>
                                                <textarea type="text" class="form-control" id="career_des"
                                                          name="career_des[]" placeholder="تجربیات خود در این شرکت را توضیح دهید و اگر از این شرکت جدا شده اید، دلیل آن را ذکر کنید"></textarea>
                                                @error('career_des.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="edu">
                                    <div class="row mx-0" id="metaDivEdu">
                                        <div class="col-12 row mx-0 justify-content-end my-2">
                                            <button type="button" id="metaBtnEdu"
                                                    class="btn btn-primary "><i
                                                    class="fa fa-plus mr-1"></i> <span>افزودن</span></button>
                                        </div>
                                        @if(isset($resume->edu)) @foreach(json_decode($resume->edu) as $edu)
                                            <div class="row mx-0 col-12 border p-lg-2 p-0 mb-2" style="border-radius: 8px;">
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="edu_degree">مقطع تحصیلی</label>
                                                    <select class="form-control select2" name="edu_degree[]"
                                                            id="edu_degree">
                                                        <option value="" selected>انتخاب کنید</option>
                                                        <option @if(isset($edu->edu_degree) && $edu->edu_degree == 'دانش آموز') selected @endif>دانش آموز</option>
                                                        <option @if(isset($edu->edu_degree) && $edu->edu_degree == 'دیپلم') selected @endif>دیپلم</option>
                                                        <option @if(isset($edu->edu_degree) && $edu->edu_degree == 'کاردانی') selected @endif>کاردانی</option>
                                                        <option @if(isset($edu->edu_degree) && $edu->edu_degree == 'کارشناسی') selected @endif>کارشناسی</option>
                                                        <option @if(isset($edu->edu_degree) && $edu->edu_degree == 'کارشناسی ارشد') selected @endif>کارشناسی ارشد</option>
                                                        <option @if(isset($edu->edu_degree) && $edu->edu_degree == 'دکتر') selected @endif>دکتر</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="edu_name">نام موسسه آموزشی</label>
                                                    <input type="text" class="form-control" id="edu_name"
                                                           name="edu_name[]" placeholder="مثال: دانشگاه فردوسی مشهد"
                                                           value="{{ $edu->edu_name ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="edu_field">رشته تحصیلی</label>
                                                    <input type="text" class="form-control" id="edu_field"
                                                           name="edu_field[]" placeholder="مثال: مهندسی عمران"
                                                           value="{{ $edu->edu_field ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="edu_time">تاریخ تحصیل</label>
                                                    <input type="text" class="form-control" id="edu_time"
                                                           name="edu_time[]" placeholder="مثال: مهر ۱۳۹۸ تا تیر ۱۴۰۲"
                                                           value="{{ $edu->edu_time ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="edu_point">معدل</label>
                                                    <input type="text" class="form-control" id="edu_point"
                                                           name="edu_point[]" placeholder="مثال:  ۱۶.۴۵"
                                                           value="{{ $edu->edu_point ?? null }}">
                                                </div>
                                                <div
                                                    class="col-12 col-ms-6 col-lg-6 my-1 row mx-0 justify-content-between align-items-end">
                                                    <label>آیا هنوز مشغول به تحصیل هستید؟</label>
                                                    <select class="form-control select2" name="edu_continue[]">
                                                        <option value="" selected>انتخاب کنید</option>
                                                        <option @if(isset($edu->edu_continue) && $edu->edu_continue == 1) selected @endif value="1">بله</option>
                                                        <option @if(isset($edu->edu_continue) && $edu->edu_continue != 1) selected @endif value="0">خیر</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 my-1">
                                                    <label for="edu_des">توضیحات</label>
                                                    <textarea type="text" class="form-control" id="edu_des"
                                                              name="edu_des[]" placeholder="توضیحاتی کوتاهی را می توانید از دوران تحصیل خود در این مقطع بنویسید">{{ $edu->edu_des ?? null }}</textarea>
                                                </div>
                                                <div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div>
                                            </div>
                                        @endforeach @endif
                                        <div class="row mx-0 col-12 border p-lg-2 p-0" style="border-radius: 8px;">
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="edu_degree">مقطع تحصیلی</label>
                                                <select class="form-control select2" name="edu_degree[]"
                                                        id="edu_degree">
                                                    <option value="" selected>انتخاب کنید</option>
                                                    <option>دانش آموز</option>
                                                    <option>دیپلم</option>
                                                    <option>کاردانی</option>
                                                    <option>کارشناسی</option>
                                                    <option>کارشناسی ارشد</option>
                                                    <option>دکتر</option>
                                                </select>
                                                @error('edu_degree.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="edu_name">نام موسسه آموزشی</label>
                                                <input type="text" class="form-control" id="edu_name"
                                                       name="edu_name[]" placeholder="مثال: دانشگاه فردوسی مشهد"
                                                       value="">
                                                @error('edu_name.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="edu_field">رشته تحصیلی</label>
                                                <input type="text" class="form-control" id="edu_field"
                                                       name="edu_field[]" placeholder="مثال: مهندسی عمران"
                                                       value="">
                                                @error('edu_field.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="edu_time">تاریخ تحصیل</label>
                                                <input type="text" class="form-control" id="edu_time"
                                                       name="edu_time[]" placeholder="مثال: مهر ۱۳۹۸ تا تیر ۱۴۰۲"
                                                       value="">
                                                @error('edu_time.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="edu_point">معدل</label>
                                                <input type="text" class="form-control" id="edu_point"
                                                       name="edu_point[]" placeholder="مثال:  ۱۶.۴۵"
                                                       value="">
                                                @error('edu_point.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div
                                                class="col-12 col-ms-6 col-lg-6 my-1 row mx-0 justify-content-between align-items-end">
                                                <label>آیا هنوز مشغول به تحصیل هستید؟</label>
                                                <select class="form-control select2" name="edu_continue[]">
                                                    <option value="" selected>انتخاب کنید</option>
                                                    <option value="1">بله</option>
                                                    <option value="0">خیر</option>
                                                </select>
                                                @error('edu_continue.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 my-1">
                                                <label for="edu_des">توضیحات</label>
                                                <textarea type="text" class="form-control" id="edu_des"
                                                          name="edu_des[]" placeholder="توضیحاتی کوتاهی را می توانید از دوران تحصیل خود در این مقطع بنویسید"></textarea>
                                                @error('edu_des.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="projects">
                                    <div class="row mx-0" id="metaDivProject">
                                        <div class="col-12 row mx-0 justify-content-end my-2">
                                            <button type="button" id="metaBtnProject"
                                                    class="btn btn-primary "><i
                                                    class="fa fa-plus mr-1"></i> <span>افزودن</span></button>
                                        </div>
                                        @if(isset($resume->projects)) @foreach(json_decode($resume->projects) as $project)
                                            <div class="row mx-0 col-12 border p-lg-2 p-0 mb-2" style="border-radius: 8px;">
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="project_name">عنوان</label>
                                                    <input type="text" class="form-control" id="project_name"
                                                           name="project_name[]" placeholder="مثال: سامانه کاریابی کارآمد"
                                                           value="{{ $project->project_name ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="project_address">آدرس</label>
                                                    <input type="text" class="form-control" id="project_address"
                                                           name="project_address[]" placeholder="مثال: kaarasan.ir"
                                                           value="{{ $project->project_address ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="project_time">تاریخ پروژه</label>
                                                    <input type="text" class="form-control" id="project_time"
                                                           name="project_time[]" placeholder="مثال: مهر ۱۳۹۸"
                                                           value="{{ $project->project_time ?? null }}">
                                                </div>
                                                <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                    <label for="project_skills">مهارت های استفاده شده در این پروژه</label>
                                                    <input type="text" class="form-control" id="project_skills"
                                                           data-role="tagsinput"
                                                           name="project_skills[]" placeholder="مثال:  لاراول"
                                                           value="{{ $project->project_skills ?? null }}">
                                                </div>
                                                <div class="col-12 my-1">
                                                    <label for="project_des">توضیحات</label>
                                                    <textarea type="text" class="form-control" id="project_des"
                                                              name="project_des[]" placeholder="توضیحات کوتاهی از نقش خود در این پروژه را بنویسید">{{ $project->project_des ?? null }}</textarea>
                                                </div>
                                                <div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div>
                                            </div>
                                        @endforeach @endif
                                        <div class="row mx-0 col-12 border p-lg-2 p-0" style="border-radius: 8px;">
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="project_name">عنوان</label>
                                                <input type="text" class="form-control" id="project_name"
                                                       name="project_name[]" placeholder="مثال: سامانه کاریابی کارآمد"
                                                       value="">
                                                @error('project_name.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="project_address">آدرس</label>
                                                <input type="text" class="form-control" id="project_address"
                                                       name="project_address[]" placeholder="مثال: kaarasan.ir"
                                                       value="">
                                                @error('project_address.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="project_time">تاریخ پروژه</label>
                                                <input type="text" class="form-control" id="project_time"
                                                       name="project_time[]" placeholder="مثال: مهر ۱۳۹۸"
                                                       value="">
                                                @error('project_time.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-ms-6 col-lg-6 my-1">
                                                <label for="project_skills">مهارت های استفاده شده در این پروژه</label>
                                                <input type="text" class="form-control" id="project_skills"
                                                       data-role="tagsinput"
                                                       name="project_skills[]" placeholder="مثال:  لاراول"
                                                       value="">
                                                @error('project_skills.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 my-1">
                                                <label for="project_des">توضیحات</label>
                                                <textarea type="text" class="form-control" id="project_des"
                                                          name="project_des[]" placeholder="توضیحات کوتاهی از نقش خود در این پروژه را بنویسید"></textarea>
                                                @error('project_des.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="courses">
                                    <div class="row mx-0" id="metaCourses">
                                        <div class="col-12 row mx-0 justify-content-end my-2">
                                            <button type="button" id="metaBtnCourses"
                                                    class="btn btn-primary "><i
                                                    class="fa fa-plus mr-1"></i> <span>افزودن</span></button>
                                        </div>
                                        @if(isset($resume->courses)) @foreach(json_decode($resume->courses) as $course)
                                            <div class="row mx-0 col-12 border p-lg-2 p-0 mb-2" style="border-radius: 8px;">
                                                <div class="col-12 col-lg-4 my-1">
                                                    <label for="course_name">عنوان دوره</label>
                                                    <input type="text" class="form-control" id="course_name"
                                                           name="course_name[]" placeholder="مثال: دوره بازاریابی"
                                                           value="{{ $course->course_name ?? null }}">
                                                </div>
                                                <div class="col-12 col-lg-4 my-1">
                                                    <label for="course_link">لینک گواهینامه (در صورت وجود) و یا نام موسسه</label>
                                                    <input type="text" class="form-control" id="course_link"
                                                           name="course_link[]" placeholder=""
                                                           value="{{ $course->course_link ?? null }}">
                                                </div>
                                                <div class="col-12 col-lg-4 my-1">
                                                    <label for="course_time">تاریخ گذراندن دوره</label>
                                                    <input type="text" class="form-control" id="course_time"
                                                           name="course_time[]" placeholder="مثال: مهر ۱۳۹۸"
                                                           value="{{ $course->course_time ?? null }}">
                                                </div>
                                                <div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div>
                                            </div>
                                        @endforeach @endif
                                        <div class="row mx-0 col-12 border p-lg-2 p-0" style="border-radius: 8px;">
                                            <div class="col-12 col-lg-4 my-1">
                                                <label for="course_name">عنوان دوره</label>
                                                <input type="text" class="form-control" id="course_name"
                                                       name="course_name[]" placeholder="مثال: دوره بازاریابی"
                                                       value="">
                                                @error('course_name.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-4 my-1">
                                                <label for="course_link">لینک گواهینامه (در صورت وجود) و یا نام موسسه</label>
                                                <input type="text" class="form-control" id="course_link"
                                                       name="course_link[]" placeholder=""
                                                       value="">
                                                @error('course_link.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-4 my-1">
                                                <label for="course_time">تاریخ گذراندن دوره</label>
                                                <input type="text" class="form-control" id="course_time"
                                                       name="course_time[]" placeholder="مثال: مهر ۱۳۹۸"
                                                       value="">
                                                @error('course_time.*')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="other">
                                    <div class="row mx-0 align-items-start">
                                        <div class="col-12 col-md-7 col-lg-7 row mx-0 px-0">
                                            <div class="col-12 pr-1 pl-0">
                                                <span class="d-block w-100 text-center small">مهارت های تخصصی خودت رو وارد کن</span>
                                                <div class="row w-100 mx-0 border p-lg-1 p-0 mb-2" id="metaDivSkill" style="border-radius: 8px;">
                                                    @if(isset($resume->skills)) @foreach(json_decode($resume->skills) as $skill)
                                                        <div class="row col-12 mx-0 px-0">
                                                            <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                                <label for="skill_name">نام مهارت</label><span
                                                                    class="text-danger">*</span>
                                                                <input type="text" class="form-control" id="skill_name"
                                                                       name="skill_name[]" placeholder="مثال: کار با نرم افزار اکسل"
                                                                       value="{{ $skill->skill_name ?? null }}">
                                                            </div>
                                                            <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                                <label for="skill_level">سطح مهارت</label><span
                                                                    class="text-danger">*</span>
                                                                <select class="form-control select2" id="skill_level"
                                                                        name="skill_level[]">
                                                                    <option value="">انتخاب کنید</option>
                                                                    <option @if(isset($skill->skill_level) && $skill->skill_level == 'مبتدی') selected @endif>مبتدی</option>
                                                                    <option @if(isset($skill->skill_level) && $skill->skill_level == 'متوسط') selected @endif>متوسط</option>
                                                                    <option @if(isset($skill->skill_level) && $skill->skill_level == 'کاملا حرفه ای')  selected @endif>کاملا حرفه ای</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-ms-2 col-lg-2 my-1 row px-0 mx-0 justify-content-end align-items-end">
                                                                <button type="button"onclick="metaDelBtnSkill(this)"class="btn btn-danger btn-sm "><i class="fas fa-window-close mr-1"></i><span>حذف </span></button>
                                                            </div>
                                                        </div>
                                                    @endforeach @endif
                                                    <div class="row col-12 mx-0 px-0">
                                                        <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                            <label for="skill_name">نام مهارت</label><span
                                                                class="text-danger">*</span>
                                                            <input type="text" class="form-control" id="skill_name"
                                                                   name="skill_name[]" placeholder="مثال: کار با نرم افزار اکسل"
                                                                   value="">
                                                            @error('skill_name.*')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                            <label for="skill_level">سطح مهارت</label><span
                                                                class="text-danger">*</span>
                                                            <select class="form-control select2" id="skill_level"
                                                                    name="skill_level[]">
                                                                <option value="">انتخاب کنید</option>
                                                                <option>مبتدی</option>
                                                                <option>متوسط</option>
                                                                <option>کاملا حرفه ای</option>
                                                            </select>
                                                            @error('skill_level.*')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 col-ms-2 col-lg-2 my-1 row px-0 mx-0 justify-content-end align-items-end">
                                                            <button type="button" id="metaBtnSkill"
                                                                    class="btn btn-primary "><i
                                                                    class="fa fa-plus mr-1"></i> <span>افزودن</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <span class="d-block w-100 text-center small">زبان هایی که به آنها مسلط هستی رو بنویس</span>
                                            <div class="row w-100 mx-0 border p-lg-1 p-0 mb-2" id="metaDivLang" style="border-radius: 8px;">
                                                @if(isset($resume->langs)) @foreach(json_decode($resume->langs) as $lang)
                                                    <div class="row col-12 mx-0 px-0">
                                                        <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                            <label for="lang_name">زبان</label><span
                                                                class="text-danger">*</span>
                                                            <input type="text" class="form-control" id="lang_name"
                                                                   name="lang_name[]" placeholder="مثال: زبان انگلیسی"
                                                                   value="{{ $lang->lang_name ?? null }}">
                                                        </div>
                                                        <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                            <label for="lang_level">سطح مهارت</label><span
                                                                class="text-danger">*</span>
                                                            <select class="form-control select2" id="lang_level"
                                                                    name="lang_level[]">
                                                                <option value="">انتخاب کنید</option>
                                                                <option @if(isset($lang->lang_level) && $lang->lang_level == 'زبان مادری') selected @endif>زبان مادری</option>
                                                                <option @if(isset($lang->lang_level) && $lang->lang_level == 'مبتدی') selected @endif>مبتدی</option>
                                                                <option @if(isset($lang->lang_level) && $lang->lang_level == 'متوسط') selected @endif>متوسط</option>
                                                                <option @if(isset($lang->lang_level) && $lang->lang_level == 'کاملا حرفه ای') selected @endif>کاملا حرفه ای</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-ms-2 col-lg-2 my-1 row px-0 mx-0 justify-content-end align-items-end">
                                                            <button type="button"onclick="metaDelBtnSkill(this)"class="btn btn-danger btn-sm "><i class="fas fa-window-close mr-1"></i><span>حذف </span></button>
                                                        </div>
                                                    </div>
                                                @endforeach @endif
                                                <div class="row col-12 mx-0 px-0">
                                                    <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                        <label for="lang_name">زبان</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="lang_name"
                                                               name="lang_name[]" placeholder="مثال: زبان انگلیسی"
                                                               value="">
                                                        @error('lang_name.*')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                        <label for="lang_level">سطح مهارت</label><span
                                                            class="text-danger">*</span>
                                                        <select class="form-control select2" id="lang_level"
                                                                name="lang_level[]">
                                                            <option value="">انتخاب کنید</option>
                                                            <option>زبان مادری</option>
                                                            <option>مبتدی</option>
                                                            <option>متوسط</option>
                                                            <option>کاملا حرفه ای</option>
                                                        </select>
                                                        @error('lang_level.*')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-ms-2 col-lg-2 my-1 row px-0 mx-0 justify-content-end align-items-end">
                                                        <button type="button" id="metaBtnLang"
                                                                class="btn btn-primary "><i
                                                                class="fa fa-plus mr-1"></i> <span>افزودن</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="d-block w-100 text-center small">لینک های ارتباطی</span>
                                            <div class="row w-100 mx-0 border p-lg-1 p-0" id="metaDivSocial" style="border-radius: 8px;">
                                                @if(isset($resume->links)) @foreach(json_decode($resume->links) as $link)
                                                    <div class="row col-12 mx-0 px-0">
                                                        <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                            <label for="social_name">نوع لینک</label><span
                                                                class="text-danger">*</span>
                                                            <select class="form-control select2" id="social_name"
                                                                    name="social_name[]">
                                                                <option value="">انتخاب کنید</option>
                                                                <option @if(isset($link->social_name) && $link->social_name == 'شماره تماس') @endif>شماره تماس</option>
                                                                <option @if(isset($link->social_name) && $link->social_name == 'تلگرام') @endif>تلگرام</option>
                                                                <option @if(isset($link->social_name) && $link->social_name == 'گیت هاب') @endif>گیت هاب</option>
                                                                <option @if(isset($link->social_name) && $link->social_name == 'لینکدین') @endif>لینکدین</option>
                                                                <option @if(isset($link->social_name) && $link->social_name == 'توئیتر') @endif>توئیتر</option>
                                                                <option @if(isset($link->social_name) && $link->social_name == 'اینستاگرام') @endif>اینستاگرام</option>
                                                                <option @if(isset($link->social_name) && $link->social_name == 'سایت شخصی') @endif>سایت شخصی</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                            <label for="social_value">آدرس</label><span
                                                                class="text-danger">*</span>
                                                            <input type="text" class="form-control" id="social_value"
                                                                   name="social_value[]" placeholder="آدرس"
                                                                   value="{{ $link->social_value ?? null }}">
                                                        </div>
                                                        <div class="col-12 col-ms-2 col-lg-2 my-1 row px-0 mx-0 justify-content-end align-items-end">
                                                            <button type="button" onclick="metaDelBtnSkill(this)"class="btn btn-danger btn-sm "><i class="fas fa-window-close mr-1"></i><span>حذف </span></button>
                                                        </div>
                                                    </div>
                                                @endforeach @endif
                                                <div class="row col-12 mx-0 px-0">
                                                    <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                        <label for="social_name">نوع لینک</label><span
                                                            class="text-danger">*</span>
                                                        <select class="form-control select2" id="social_name"
                                                                name="social_name[]">
                                                            <option value="">انتخاب کنید</option>
                                                            <option>شماره تماس</option>
                                                            <option>تلگرام</option>
                                                            <option>گیت هاب</option>
                                                            <option>لینکدین</option>
                                                            <option>توئیتر</option>
                                                            <option>اینستاگرام</option>
                                                            <option>سایت شخصی</option>
                                                        </select>
                                                        @error('social_name.*')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-ms-5 col-lg-5 my-1">
                                                        <label for="social_value">آدرس</label><span
                                                            class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="social_value"
                                                               name="social_value[]" placeholder="آدرس"
                                                               value="">
                                                        @error('social_value.*')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12 col-ms-2 col-lg-2 my-1 row px-0 mx-0 justify-content-end align-items-end">
                                                        <button type="button" id="metaBtnSocial"
                                                                class="btn btn-primary "><i
                                                                class="fa fa-plus mr-1"></i> <span>افزودن</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        @php
                                        if(isset($resume->categories)){
                                            $categoriesIDs = array_column($resume->categories->select('id')->toArray(),'id');
                                        } else {
                                            $categoriesIDs = [];
                                        }
                                        @endphp
                                        <div class="col-12 col-md-5 col-lg-5 row mx-0 px-0">
                                        <span class="d-block w-100 text-center small">دسته بندی مشاغلی که دنبالش می گردی رو انتخاب
                                            کن</span>
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
                                </div>

                                <ul class="list-inline mb-0 wizard mt-3">
                                    <li class="previous list-inline-item">
                                        <a href="javascript: void(0);" class="btn btn-secondary">قبلی</a>
                                    </li>
                                    <li class="next list-inline-item float-right mx-2">
                                        <button class="btn btn-info" type="submit">ثبت</button>
                                    </li>
                                    <li class="next list-inline-item float-right mx-2">
                                        <a href="javascript: void(0);" class="btn btn-secondary">بعدی</a>
                                    </li>
                                </ul>

                            </div> <!-- tab-content -->
                        </div> <!-- end #basicwizard-->
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script src="{{ asset('assets/libs/jalali/jalalidatepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('input[type^="checkbox"]').click(function (e) {
                $(this).parent().next().removeClass('d-none');
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
                        var selected = $('#shahrestan').find('option:selected');
                        $('#shahrestan').find('option').remove();
                        selected.each(function () {
                            $('#shahrestan').append('<option selected value="' + $(this).val() + '">' + $(this).text() + '</option>');
                        });
                        $.each(data, function (key, val) {
                            $('#shahrestan').append(`<option value="${val.id}">${val.name}</option>`);
                        });
                    } else {

                    }
                }
            });
        });

        jalaliDatepicker.startWatch();

        $("#metaBtn").on('click', function (e) {
            $('#metaDiv').append('<div class="row mx-0 col-12 border p-lg-2 p-0 mt-2 position-relative" style="border-radius: 8px;"><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="career_name">نام شرکت یا سازمان</label><span class="text-danger">*</span><input type="text" class="form-control" id="career_name" name="career_name[]" placeholder="مثال: شرکت کارآمد" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="career_title">عنوان شغلی شما</label><span class="text-danger">*</span><input type="text" class="form-control" id="career_title" name="career_title[]" placeholder="مثال: مدیر بخش فروش" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="career_time">تاریخ اشتغال</label><span class="text-danger">*</span><input type="text" class="form-control" id="career_time" name="career_time[]" placeholder="مثال: آبان ۱۴۰۱ تا تیر ۱۴۰۳" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1 row mx-0 justify-content-between align-items-end"><label>آیا هنوز در این شغل حضور دارید؟</label> <select class="form-control select2" name="career_job[]"><option value="" selected>انتخاب کنید</option><option value="1">بله</option><option value="0">خیر</option></select></div><div class="col-12 my-1"><label for="career_des">توضیحات</label><textarea type="text" class="form-control" id="career_des" name="career_des[]" placeholder="تجربیات خود در این شرکت را توضیح دهید و اگر از این شرکت جدا شده اید، دلیل آن را ذکر کنید"></textarea></div><div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div></div>');
            $('.select2').select2({})
        })
        $("#metaBtnEdu").on('click', function (e) {
            $('#metaDivEdu').append('<div class="row mx-0 col-12 border p-lg-2 p-0 mt-2 position-relative" style="border-radius: 8px;"><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="edu_degree">مقطع تحصیلی</label><span class="text-danger">*</span><select class="form-control select2" name="edu_degree[]" id="edu_degree"><option value="" selected>انتخاب کنید</option><option>دانش آموز</option><option>دیپلم</option><option>کاردانی</option><option>کارشناسی</option><option>کارشناسی ارشد</option><option>دکتر</option></select></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="edu_name">نام موسسه آموزشی</label><span class="text-danger">*</span><input type="text" class="form-control" id="edu_name" name="edu_name[]" placeholder="مثال: دانشگاه فردوسی مشهد" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="edu_field">رشته تحصیلی</label><span class="text-danger">*</span><input type="text" class="form-control" id="edu_field" name="edu_field[]" placeholder="مثال: مهندسی عمران" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="edu_time">تاریخ تحصیل</label><span class="text-danger">*</span><input type="text" class="form-control" id="edu_time" name="edu_time[]" placeholder="مثال: مهر ۱۳۹۸ تا تیر ۱۴۰۲" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="edu_point">معدل</label><input type="text" class="form-control" id="edu_point" name="edu_point[]" placeholder="مثال:  ۱۶.۴۵" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1 row mx-0 justify-content-between align-items-end"><label>آیا هنوز مشغول به تحصیل هستید؟</label><select class="form-control select2" name="edu_continue[]"> <option value="" selected>انتخاب کنید</option><option value="1">بله</option><option value="0">خیر</option></select></div><div class="col-12 my-1"><label for="edu_des">توضیحات</label><textarea type="text" class="form-control" id="edu_des" name="edu_des[]" placeholder="توضیحاتی کوتاهی را می توانید از دوران تحصیل خود در این مقطع بنویسید"></textarea></div><div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div></div>');
            $('.select2').select2({})
        })
        $("#metaBtnProject").on('click', function (e) {
            $('#metaDivProject').append('<div class="row mx-0 col-12 border p-lg-2 p-0 mt-2 position-relative" style="border-radius: 8px;"><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="project_name">عنوان</label><span class="text-danger">*</span><input type="text" class="form-control" id="project_name" name="project_name[]" placeholder="مثال: سامانه کاریابی کارآمد" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="project_address">آدرس</label><input type="text" class="form-control" id="project_address" name="project_address[]" placeholder="مثال: kaarasan.ir" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="project_time">تاریخ پروژه</label><input type="text" class="form-control" id="project_time" name="project_time[]" placeholder="مثال: مهر ۱۳۹۸" value=""></div><div class="col-12 col-ms-6 col-lg-6 my-1"><label for="project_skills">مهارت های استفاده شده در این پروژه</label><input type="text" class="form-control" id="project_skills" data-role="tagsinput" name="project_skills[]" placeholder="مثال:  لاراول" value=""></div><div class="col-12 my-1"><label for="project_des">توضیحات</label><textarea type="text" class="form-control" id="project_des" name="project_des[]" placeholder="توضیحات کوتاهی از نقش خود در این پروژه را بنویسید"></textarea></div><div class="remove-btn"><button type="button" onclick="metaDelBtn(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div></div>');
            $('[data-role="tagsinput"]:last').tagsinput()
        })
        $("#metaBtnLang").on('click', function (e) {
            $('#metaDivLang').append('<div class="row col-12 mx-0 px-0"><div class="col-12 col-ms-5 col-lg-5 my-1"><label for="lang_name">زبان</label><span class="text-danger">*</span><input type="text" class="form-control" id="lang_name" name="lang_name[]" placeholder="مثال: زبان انگلیسی" value=""></div><div class="col-12 col-ms-5 col-lg-5 my-1"><label for="lang_level">سطح مهارت</label><span class="text-danger">*</span><select class="form-control select2" id="lang_level" name="lang_level[]"><option value="">انتخاب کنید</option><option>زبان مادری</option><option>مبتدی</option><option>متوسط</option><option>کاملا حرفه ای</option></select></div><div class="col-12 col-ms-2 col-lg-2 my-1 row mx-0 px-0 justify-content-end align-items-end"><button type="button" onclick="metaDelBtnLang(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div></div>');
            $('.select2').select2({})
        })
        $("#metaBtnSocial").on('click', function (e) {
            $('#metaDivSocial').append('<div class="row col-12 mx-0 px-0"><div class="col-12 col-ms-5 col-lg-5 my-1"><label for="social_name">نوع لینک</label><span class="text-danger">*</span><select class="form-control select2" id="social_name" name="social_name[]"><option value="">انتخاب کنید</option><option>تلگرام</option><option>گیت هاب</option><option>لینکدین</option><option>توئیتر</option><option>اینستاگرام</option><option>سایت شخصی</option></select></div><div class="col-12 col-ms-5 col-lg-5 my-1"><label for="social_value">آدرس</label><span class="text-danger">*</span><input type="text" class="form-control" id="social_value" name="social_value[]" placeholder="آدرس" value=""></div><div class="col-12 col-ms-2 col-lg-2 my-1 row mx-0 px-0 justify-content-end align-items-end"><button type="button" onclick="metaDelBtnLang(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div></div>');
            $('.select2').select2({})
        })
        $("#metaBtnSkill").on('click', function (e) {
            $('#metaDivSkill').append('<div class="row col-12 mx-0 px-0"><div class="col-12 col-ms-5 col-lg-5 my-1"><label for="skill_name">نام مهارت</label><span class="text-danger">*</span><input type="text"class="form-control"id="skill_name"name="skill_name[]"placeholder="مثال: کار با نرم افزار اکسل"value=""/></div><div class="col-12 col-ms-5 col-lg-5 my-1"><label for="skill_level">سطح مهارت</label><span class="text-danger">*</span><select class="form-control select2"id="skill_level"name="skill_level[]"><option value="">انتخاب کنید</option><option>مبتدی</option><option>متوسط</option><option>کاملا حرفه ای</option></select></div><div class="col-12 col-ms-2 col-lg-2 my-1 row px-0 mx-0 justify-content-end align-items-end"><button type="button"onclick="metaDelBtnSkill(this)"class="btn btn-danger btn-sm "><i class="fas fa-window-close mr-1"></i><span>حذف </span></button></div></div>');
            $('.select2').select2({})
        })
        $("#metaBtnCourses").on('click', function (e) {
            $('#metaCourses').append('<div class="row mx-0 col-12 border p-lg-2 p-0 mt-2 position-relative" style="border-radius: 8px;"><div class="col-12 col-lg-4 my-1"><label for="course_name">عنوان دوره</label><input type="text" class="form-control" id="course_name" name="course_name[]" placeholder="مثال: دوره بازاریابی" value=""></div><div class="col-12 col-lg-4 my-1"><label for="course_link">لینک گواهینامه (در صورت وجود) و یا نام موسسه</label><input type="text" class="form-control" id="course_link" name="course_link[]" placeholder="" value=""></div><div class="col-12 col-lg-4 my-1"><label for="course_time">تاریخ گذراندن دوره</label><input type="text" class="form-control" id="course_time" name="course_time[]" placeholder="مثال: مهر ۱۳۹۸" value=""></div><div class="remove-btn"><button type="button" onclick="metaDelBtnLang(this)" class="btn btn-danger btn-sm "> <i class="fas fa-window-close mr-1"></i> <span> حذف </span> </button></div></div>');
        })

        function metaDelBtn(event) {
            $(event).parent().parent().remove();
        }

        function metaDelBtnSkill(event){
            $(event).parent().parent().remove();
            $('.select2').select2({})
        }

        function metaDelBtnLang(event) {
            $(event).parent().parent().remove();
            $('.select2').select2({})
        }
    </script>
@endsection

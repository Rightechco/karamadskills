<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets-front/img/fav.png') }}">
    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/added.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets-front/css/root.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/fontiran.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}">
    <title>رزومه | کارآمد</title>
        <style>
            .resume {
                min-height: 842px;
                width: 595px;
                margin-left: auto;
                margin-right: auto;
                background-color: white;
                direction: rtl;
                display: flex;
            }

            .side {
                width: 155px;
                min-height: 842px;
                background-color: var(--first-100);
            }

            .content {
                width: 440px;
                min-height: 842px;
            }

            .top-side {
                width: 155px;
                height: 15px;
                background-color: var(--first-200);
            }

            .bb {
                border-top: 1px solid var(--first-200);
                margin-top: 15px;
                padding-top: 15px;
            }

            .bt {
                border-top: 1px solid var(--first-200);
            }

            .about-me p {
                font-size: 12px;
                text-align: justify;
            }

            .career ul li {
                font-size: 12px;
            }

            .career ul,.side ul {
                list-style: none;
            }

            .side ul {
                font-size: 12px;
            }

            .resume .badge:hover {
                color: #fff;
            }
        </style>
</head>
<body>
    <div class="resume">
        <div class="content p-3 text-right">
            <h3>{{ $resume->user->name }}</h3>
            <h6>{{ $resume->skill }}</h6>
            <div class="about-me bb">
                <p>{{ $resume->aboutMe }}</p>
            </div>
            @if(isset($resume->career))
            <label for="">سوابق شغلی</label>
            <div class="career bt row mx-0">
                @foreach(json_decode($resume->career) as $career)
                    <ul class="col-6 pt-1 px-0">
                        <li><i class="fas fa-building ml-1"></i>{{ $career->career_name }}</li>
                        <li><i class="fas fa-hammer ml-1"></i>{{ $career->career_title }}</li>
                        <li><i class="fas fa-calendar-alt ml-1"></i>{{ $career->career_time }}</li>
                        @if($career->career_job)
                            <li><i class="fas fa-neuter ml-1"></i>هنوز مشغول به کار هستم</li>
                            @else
                            <li><i class="fas fa-neuter ml-1"></i>اتمام همکاری</li>
                        @endif
                    </ul>
                @endforeach
            </div>
            @endif
            @if(isset($resume->edu))
            <label for="">سوابق تحصیلی</label>
            <div class="career bt row mx-0">
                @foreach(json_decode($resume->edu) as $edu)
                    <ul class="col-6 pt-1 px-0">
                        <li><i class="fas fa-list ml-1"></i>{{ $edu->edu_degree }}</li>
                        <li><i class="fas fa-university ml-1"></i>{{ $edu->edu_name }}</li>
                        <li><i class="fas fa-solar-panel ml-1"></i>{{ $edu->edu_field }}</li>
                        <li><i class="fas fa-calendar-alt ml-1"></i>{{ $edu->edu_time }}</li>
                        @if($edu->edu_continue)
                            <li><i class="fas fa-neuter ml-1"></i>در حال تحصیل</li>
                        @else
                            <li><i class="fas fa-neuter ml-1"></i>پایان یافته</li>
                        @endif
                    </ul>
                @endforeach
            </div>
            @endif
            @if(isset($resume->projects))
                <label for="">پروژه ها</label>
                <div class="career bt row mx-0 mb-2">
                    @foreach(json_decode($resume->projects) as $project)
                        <ul class="col-12 pt-1 px-0 d-inline-flex mb-1">
                            <li><i class="fab fa-delicious ml-1 mx-1"></i>{{ $project->project_name }}</li>
                            <li><i class="fas fa-calendar-alt ml-1 mx-1"></i>{{ $project->project_time }}</li>
                            <li><i class="fab fa-chrome ml-1 mx-1"></i>{{ $project->project_skills }}</li>
                            <li><i class="fas fas fa-cubes ml-1 mx-1"></i>{{ $project->project_address }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif
            @if(isset($resume->skills))
                <label for="">مهارت ها</label>
                <div class="career bt row mx-0">
                        <ul class="col-12 pt-1 px-0 mb-1">
                            @foreach(json_decode($resume->skills) as $skill)
                            <li><i class="fab fa-delicious ml-1 mx-1"></i>{{ $skill->skill_name }} - سطح: {{ $skill->skill_level }}</li>
                            @endforeach
                        </ul>
                </div>
            @endif
        </div>
        <div class="side">
            <div class="top-side"></div>
            <div class="py-4 px-2">
                <div class="w-100 text-center">
                    @if($resume->user->pic)
                        <img class="img-thumbnail avatar-lg" src="{{ route('user.avatarShow',[$resume->user->pic,'userAvatar']) }}" alt="تصویر کاربر" title="{{ $resume->user->name }}">
                    @else
                        <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="تصویر کاربر" title="{{ auth()->user()->name }}" class="rounded-circle img-thumbnail avatar-lg">
                    @endif
                </div>
                <ul class="col-12 w-100 pt-1 px-0 text-white text-right mt-2">
                    <li><i class="fas fa-user ml-1 mt-1"></i>سن: {{ \Carbon\Carbon::createFromDate($resume->birthday)->diff(\Carbon\Carbon::now())->format('%y سال و %m ماه') }}</li>
                    @if($resume->gender == 'male')
                        <li><i class="fas fa-award ml-1 mt-1"></i>سربازی: {{ $resume->military }}</li>
                    @endif
                    <li><i class="fas fa-restroom ml-1 mt-1"></i>وضعیت تاهل: {{ __('messages.'.$resume->martial) }}</li>
                    <li><i class="fab fa-sistrix ml-1 mt-1"></i>{{ __('messages.'.$resume->status) }}</li>
                    @php
                        $jobs = json_decode($resume->jobType,true);
                    @endphp
                    @if(isset($jobs))
                    @foreach(\Modules\Resume\Models\Resume::$jobTypes as $jobType)
                            @if(in_array($jobType,$jobs))
                        <li><i class="fas fa-check-square ml-1 mt-1"></i>{{ __('messages.'.$jobType) }}</li>
                            @endif
                    @endforeach
                    @endif
                    @if($resume->wageDemand)
                    <li><i class="far fa-money-bill-alt ml-1 mt-1"></i>{{ $resume->wageDemand }}</li>
                    @endif
                </ul>
                <ul class="col-12 w-100 pt-1 px-0 text-white text-left mt-2">
                    @if(isset($resume->links))
                        @foreach(json_decode($resume->links) as $link)
                            <li>
                                {{ $link->social_value }}
                                @if($link->social_name == 'شماره تماس')
                                    <i class="fas fa-phone mr-1 mt-1"></i>
                                @elseif ($link->social_name == 'تلگرام')
                                    <i class="fab fa-telegram mr-1 mt-1"></i>
                                @elseif ($link->social_name == 'گیت هاب')
                                    <i class="fab fa-github mr-1 mt-1"></i>
                                @elseif ($link->social_name == 'لینکدین')
                                    <i class="fab fa-linkedin mr-1 mt-1"></i>
                                @elseif ($link->social_name == 'توئیتر')
                                    <i class="fab fa-twitter mr-1 mt-1"></i>
                                @elseif ($link->social_name == 'اینستاگرام')
                                    <i class="fab fa-instagram mr-1 mt-1"></i>
                                @elseif ($link->social_name == 'سایت شخصی')
                                    <i class="fab fa-firefox mr-1 mt-1"></i>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
                @if($resume->user->tests->count())
                    <h6 class="text-right text-white"><i class="mdi mdi-format-list-bulleted-type ml-1"></i>تست های شخصیتی</h6>
                    <ul class="col-12 w-100 pt-1 px-0 text-white text-right">
                        @foreach($resume->user->tests->select('type','id')->toArray() as $test)
                            <li style="font-size: 12px">{{ __("messages." . $test['type']) }} <a class="badge bg-info" href="{{ route('test.'.strtolower($test['type']).'ResultShow',$test['id']) }}">مشاهده نتیجه</a></li>
                        @endforeach
                    </ul>
                @endif
                <div class="d-flex justify-content-start">
                    <a href="{{ route('panel.ticket.send',$resume->user->slug) }}" class="btn btn-sm btn-warning">ارسال پیام</a>
                </div>
                <span class="logo-lg text-center w-100 d-block">
                            <img src="{{ asset('assets-front/img/fav.png') }}" alt="تصویر" height="45">
                    <p class="text-white small">Karamad.msrt.ir</p>
                        </span>
            </div>
        </div>
    </div>
</body>
</html>

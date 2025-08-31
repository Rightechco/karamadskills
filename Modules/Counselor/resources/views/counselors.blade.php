@extends('home::layouts.master')

@section('title','مشاوره')
@section('meta')
    <meta name="description" content="">
    <meta name="keywords" content="">
@endsection
@section('content')

    </main>

    <div class="scroller-area scroller-consultants d-flex justify-content-cetner align-items-center">
        <div class="container consultants-page-wrapper">
            <div class="consultants__section consultants__section--1">
                <div class="consultants__section--1__right">
                    <div class="consultants__section--1__right--content-wrapper">
                        <div class="consultants__section--1__right--content">
                            <span class="consultants__section--1__right--content__title">
                                مسیر درست توسعه شغلی در کسب و کار
                            </span>
                            <p class="consultants__section--1__right--content__text">
                                مشاوره فردی و انتخاب مسیر شغلی
                            </p>
                        </div>
                        <div class="consultants__section--1__right-tabs">
                            <div class="consultants__section--1__right-buttons">
                                <span class="consultants__button active">مشاوره شغلی و حرفه ای</span>
                                <span class="consultants__button">مشاوره منابع انسانی</span>
                            </div>
                            <div class="consultants__section--1__right-tab-content">
                                <p>
                                    داشتن مشاور شغلی حرفه ای می‌تواند موفقیت شغلی شما را تضمین کند و با توسعه فردی و رشد
                                    مهارت های
                                    نرم و سخت، شما را به یک متخصص واقعی در شغلتان تبدیل کند.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="consultants__section--1__left">
                    <img src="{{ asset('assets-front/img/Consultants.jpg') }}" alt="employer">
                </div>
                <div class="types-of-consultations container">
                    <section class="consultations-box-wrapper">
                        <div class="consultations-box">
                            <div class="consultations-num">۰۱</div>
                            <div class="consultations-content">
                                <span class="fs-18 fw-sb le-6">مشاوره استعدادیابی شغلی</span>
                                <p class="fs-14 fw-l le-8 leading-17">پیدا کردن استعدادهای اصلی خود و قدم گذاشتن در مسیرشان،
                                    راه را لذت بخش‌تر و رضایت فردی را بالاتر خواهد برد.</p>
                            </div>
                            <div class="consultations-backnum">۰۱</div>
                        </div>
                        <div class="consultations-box">
                            <div class="consultations-num">۰۲</div>
                            <div class="consultations-content">
                                <span class="fs-18 fw-sb le-6">مشاوره انتخاب شغل</span>
                                <p class="fs-14 fw-l le-8 leading-17">بسیاری از آزمون و خطاها برای پیدا کردن مسیر شغلی درست
                                    حذف می‌شود و با انتخاب آگاهانه تری وارد این مسیر خواهید شد.</p>
                            </div>
                            <div class="consultations-backnum">۰۲</div>
                        </div>
                        <div class="consultations-box">
                            <div class="consultations-num">۰۳</div>
                            <div class="consultations-content">
                                <span class="fs-18 fw-sb le-6">مشاوره تغییر شغل و بهبود وضعیت شغلی</span>
                                <p class="fs-14 fw-l le-8 leading-17">با شفاف سازی مسیر و داشتن یک استراتژی حرفه‌ای به اهداف
                                    بزرگ شغلی و سازمانی خود برسید.</p>
                            </div>
                            <div class="consultations-backnum">۰۳</div>
                        </div>
                        <div class="consultations-box">
                            <div class="consultations-num">۰۴</div>
                            <div class="consultations-content">
                                <span class="fs-18 fw-sb le-6">شروع یک شغل</span>
                                <p class="fs-14 fw-l le-8 leading-17">رشد برند، کسب و کار و تیم شما نیاز به توسعه و رشد تک
                                    تک اعضای سازمان شما دارد.</p>
                            </div>
                            <div class="consultations-backnum">۰۴</div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="scroller-area consultants">
        <div class="container consultants__section consultants__section--2">
            <span>در مسیر رشد شغلی و سازمانی شما همراهتان هستیم</span>
            <div class="switch-content">
                <div class="switch-col">
                    <div class="switch-content-num">
                        <p class="before">+۱۰۰۰</p>
                        <!-- <p class="active">980%</p> -->
                    </div>
                    <span>تعداد ساعات مشاوره</span>
                    <img src="{{ asset('assets-front/img/bg-chart3.png') }}" loading="lazy" alt="تعداد ساعات مشاوره">
                </div>
                <div class="switch-col">
                    <div class="switch-content-num">
                        <p class="before">+۹۰۰</p>
                        <!-- <p class="active">34,369</p> -->
                    </div>
                    <span>تعداد جلسات مشاوره</span>
                    <img src="{{ asset('assets-front/img/bg-chart2.png') }}" loading="lazy" alt="تعداد جلسات مشاوره">
                </div>
                <div class="switch-col">
                    <div class="switch-content-num">
                        <p class="before">+۸</p>
                        <!-- <p class="active">314,297</p> -->
                    </div>
                    <span>تعداد مشاورین</span>
                    <img src="{{ asset('assets-front/img/bg-chart1.png') }}" loading="lazy" alt="تعداد مشاورین">
                </div>
            </div>
        </div>
    </div>

    <div class="scroller-area" style="margin-block-end: 5rem;">
        <div class="container consultants__section consultants__section--3">
            <div class="consultants__tabs--wrapper row">
                <div class="w-100 our-team">
                    <div class="our-team-header">
                        <div class="d-flex flex-column">
                            <span>مشاورین باتجربه</span>
                            <span>مشاورین تخصصی فنی</span>
                            <span>ما یک تیم حرفه ای هستیم</span>
                        </div>
                    </div>
                </div>
                <div class="nav flex-column nav-pills col-12 col-md-4 col-lg-3 px-3" style="align-self: center;" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    @foreach($counselorPermission->roles as $counselorRole)
                        @if($counselorRole->users->count())
                    <button class="nav-link @if ($loop->first) active @endif" id="v-pills-{{ $counselorRole->id }}-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-{{ $counselorRole->id }}" type="button" role="tab" aria-controls="v-pills-{{ $counselorRole->id }}"
                            aria-selected="@if ($loop->first) true @else false @endif">{{ $counselorRole->name }}</button>
                        @endif
                    @endforeach
                </div>
                <div class="tab-content consultants-tab col-12 col-md-8 col-lg-9" id="v-pills-tabContent">
                    @foreach($counselorPermission->roles as $counselorRole)
                        @if($counselorRole->users->count())
                    <div class="tab-pane consultants-slider fade @if ($loop->first) show active @endif" id="v-pills-{{ $counselorRole->id }}" role="tabpanel"
                         aria-labelledby="v-pills-{{ $counselorRole->id }}-tab" tabindex="0">

                        <div class="swiper swiper-1">
                            <div class="swiper-wrapper">
                                @foreach($counselorRole->users as $counselor)
                                <div class="swiper-slide">
                                    <div class="personnel">
                                        <div class="personnel-image">
                                            @if($counselor->pic)
                                                <img src="{{ route('user.avatarShow',[$counselor->pic,'userAvatar']) }}" alt="تصویر کاربر" class="rounded-circle" style="max-height: 200px">
                                            @else
                                                <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="تصویر کاربر" class="rounded-circle" style="max-height: 200px">
                                            @endif
                                        </div>
                                        <div class="personnel-info">
                                            <h4>{{ $counselor->name }}</h4>
{{--                                            <h5>متخصص بهینه سازی وب</h5>--}}
                                            <div class="contact-personnel">
                                                <div class="contact-menu">
                                                    <button type="button" data-bs-toggle="modal" onclick="counselorBtn({{ $counselor->id }})"
                                                            data-bs-target="#{{ $counselor->slug }}m" class="contact-btn">
                                                        <span>+</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- دکمه‌های navigation -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>

                            <!-- pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                        @endif
                    @endforeach
                        @foreach($counselorPermission->roles as $counselorRole)
                            @foreach($counselorRole->users as $counselor)
                        <div class="modal fade" id="{{ $counselor->slug }}m" tabindex="-1" aria-labelledby="{{ $counselor->slug }}mLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                    <span class="modal-title fs-18 fw-b" data-consultants-modal id="exampleModalLabel"
                          style="display: inline-block;">بسته های
                        مشاوره</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                                style="margin-inline-start: auto; margin-inline-end: 0;"></button>
                                    </div>
                                    <div class="modal-body" style="margin-block-start: 2rem;">
                                        <div class="consultants-page__pricing-table pricing-table-container">
                                            @foreach(config('tests.counselorTypes') as $type)
                                                <div class="price-card">
                                                    <div class="price-card--top">
                                                        <h3>{{ config('tests.'.$type.'Name') }}</h3>
                                                        <h5>{{ config('tests.'.$type) }} % تخفیف</h5>
                                                        <hr />
                                                    </div>
                                                    <div class="price-card--bottom">
                                                        <ul>
                                                            <li>
                                                                <i class="fa fa-check"></i>تحلیل شخصیتی
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-check"></i>تحلیل استعدادیابی و نقاط قوت
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-check"></i>ارئه راهکار های موثر
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-check"></i>ترسیم مسیر شغلی - تحصیلی
                                                            </li>
                                                        </ul>
                                                        <form action="{{ route('panel.counselor.reserve') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="counselor" class="counselor">
                                                            <input type="hidden" name="type" value="{{ $type }}">
                                                            <button type="submit" class="btn">خرید</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-secondary fs-16 fw-r" data-bs-dismiss="modal">خروج</button>
                                        <button type="button" class="btn btn-primary fs-16 fw-r">ذخیره</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                          @endforeach
                        @endforeach
                </div>
            </div>
            <div class="sessioncontentbox">
                <h2>مشاوره شغلی چیست؟</h2>
                <p>امروزه باتوجه به پیشرفت تکنولوژی و جوامع بشری، شغل‌های متعدد و گوناگونی به وجود آمده‌اند. همین تنوع بالا،
                    سبب ایجاد سردرگمی برای متقاضیان شغل شده است.</p>
                <p>مشاوره شغلی، فرآیندی مانند تمامی جلسات مشاوره دارد با این تفاوت که در این فرآیند، فرد متخصص به شما کمک
                    می‌کند تا بتوانید پتانسیل‌های درونی خود را بشناسید و با استفاده از شرایط و ضوابط موجود در بازار کار، شغل
                    و کسب و کار مدنظرتان را بیابید. مشاوره شغلی، پایه و اساسی کاملا علمی دارد و افرادی که به عنوان مشاور در
                    این حوزه فعالیت دارند، با استفاده از دانشی که به وسیله تحصیل در این رشته به دست آورده‌اند، به شما کمک
                    می‌کنند تا به آنچه که می‌خواهید، برسید.</p>
                <p>اگر تا به حال در جلسات مشاوره شرکت کرده باشید، می‌دانید که در این گفتگوها پارامترهای مشخصی مورد بررسی
                    قرار می‌گیرند که به وسیله آن‌ها فرد می‌تواند بهترین شغل را برای خود برگزیند. از جمله مهم‌ترین این
                    پارامترها عبارتند از:</p>
                <ul>
                    <li>مدارک تحصیلی</li>
                    <li>تخصص فرد</li>
                    <li>مهارت‌های فردی</li>
                    <li>اوضاع خانوادگی</li>
                    <li>استعدادها و پتانسیل‌های نهفته فرد</li>
                    <li>شخصیت شناسی</li>
                    <li>علایق فردی</li>
                    <li>شرایط زندگی</li>
                </ul>
                <p>بر مبنای این پارامترها، می‌توان بهترین شغل را باتوجه به تمامی معیارها، پیشنهاد و انتخاب کرد. در نتیجه
                    تمامی بررسی‌هایی که در جلسات مشاوره شغلی انجام می‌شود، بهترین شغل متناسب با شخصیت فرد معرفی شده و بدین
                    ترتیب از بروز فرسودگی شغلی پیشگیری می‌شود. با شرکت در این جلسات مشاوره می‌توانید در انرژی و زمانتان صرفه
                    جویی کرده و دیگر نیاز به اتلاف وقت برای آزمون و خطا شغل‌های مختلف نیست.</p>
            </div>
        </div>
    </div>

    <main style="display: none;">
@endsection
@php

@endphp
@section('js')
    <script>
        $('.select2').select2({})
        function counselorBtn(id){
            $('.counselor').val(id);
        }

        const swiperOne = new Swiper('.swiper-1', {

            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,

            breakpoints: {

                320: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },

                768: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },

                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20
                }
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    </script>
@endsection

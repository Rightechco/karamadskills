@extends('home::layouts.master')

@section('title',$announcement->name)
@section('meta')

@endsection
@section('content')
    </main>
    <div class="advertisement-details-banner d-flex flex-column justify-content-end" @if($announcement->company->cover) style="background-image: url('{{ str_replace('\\','/',asset($announcement->company->cover['indexArray']['full'])) }}')" @else style="background-image: url('{{ asset('assets-front/img/pic.jpg') }}')" @endif>
        <div class="advertisement-details-banner-buttons">
            <a href="{{ route('company.company',$announcement->company->slug) }}" class="karasan-btn karasan-btn-yellow" style="--btn-width: 200px; --btn-height: 50px;">معرفی شرکت</a>
            <a href="{{ route('company.companyJobs',$announcement->company->slug) }}" class="karasan-btn karasan-btn-yellow" style="--btn-width: 200px; --btn-height: 50px;">سایر فرصت های شغلی</a>
        </div>
        <div class="advertisement-details-banner__logoSection">
            <div class="container d-flex flex-column justify-content-center justify-content-md-start align-items-center flex-md-row gap-4">
                <div class="advertisement-details-banner__logo d-flex justify-content-center align-items-center">
                    @if($announcement->company->logo)
                        <img
                            src="{{ asset($announcement->company->logo['indexArray'][$announcement->company->logo['currentImage']]) }}"
                            alt="company logo" style="object-fit: fill"/>
                    @else
                        <img src="{{ asset('assets-front/img/resume.png') }}" alt="company logo"/>
                    @endif
                </div>
                <div class="advertisement-details-banner__information d-flex flex-column justify-content-end">
                    <h5 class="advertisement-details-banner__company-name">{{ $announcement->company->name }}</h5>
                    <div class="d-flex flex-row gap-1 gap-md-5">
                        @if($announcement->company->foundation)
                            <h5 class="advertisement-details-banner__company-info d-flex justify-content-center align-items-center gap-2"><i class="bi bi-alarm"></i> <span>سال تاسیس: {{ $announcement->company->foundation }}</span></h5>
                        @endif
                        @if($announcement->company->website)
                            <span class="advertisement-details-banner__company-info d-flex justify-content-center align-items-center gap-2"><i class="bi bi-globe2"></i> <span>آدرس وبسایت: {{ $announcement->company->website }}</span></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="advertisement-details-page-body container">

        <div class="advertisement-details-content">
            <div class="advertisement-details-rightSidebar">
                <div class="general-specifications card d-flex flex-column">
                    <!--<div class="advertisement-details-page-title">برنامه نویس ارشد فول استک</div>-->
                    <div class="advertisement-details-page-description d-flex flex-column">
                        <h2 class="title-head">{{ $announcement->name }}</h2>
                        <h5 class="text-info">این آگهی کارآموز دانشگاهی قبول می کند!</h5>
                    </div>
                    <div class="advertisement-details-page-general-info d-flex flex-column">
                        {!! $announcement->des !!}
                    </div>
{{--                    <div class="advertisement-details-page-specific-specifications d-flex flex-column">--}}
{{--                        <h2 class="title-head">شرایط اختصاصی:</h2>--}}
{{--                        <ul>--}}
{{--                            <li>تجربه ساخت اپلیکیشن‌های تک صفحه‌ای (SPA) با استفاده از React</li>--}}
{{--                            <li>آشنایی با مفاهیم طراحی واکنش‌گرا</li>--}}
{{--                            <li>تجربه کار با سرویس‌های ابری مانند AWS یا Azure</li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                    <div class="highlight-text">--}}
{{--                        🌟 اگر شما به دنبال یک چالش جدید و هیجان‌انگیز هستید و می‌خواهید در یک تیم حرفه‌ای کار کنید، رزومه خود را برای ما ارسال کنید.--}}
{{--                    </div>--}}
                    <div class="advertisement-details-card">
                        <div class="advertisement-details-card__tag">
                            <span>حقوق:</span>
                            <span>{{ $announcement->wage }}میلیون تومان</span>
                        </div>
                        <div class="advertisement-details-card__tag">
                            <span>جنسیت:</span>
                            <span>{{ ($announcement->gender) ? __('messages.'.$announcement->gender) : 'فرقی نمی کند' }}</span>
                        </div>
                        <div class="advertisement-details-card__tag">
                            <span>نوع همکاری:</span>
                            <span>@foreach (json_decode($announcement->jobType,true) as $jobType)
                                    {{ __('messages.'.$jobType).', ' }}
                                @endforeach</span>
                        </div>
                        <div class="advertisement-details-card__tag">
                            <span>موقعیت مکانی:</span>
                            <span>{{ $announcement->shahrestan->name }}</span>
                        </div>
                        <div class="advertisement-details-card__tag">
                            <span>سابقه:</span>
                            <span>{{ $announcement->background }}</span>
                        </div>
                        <div class="advertisement-details-card__tag">
                            <span>وضعیت سربازی:</span>
                            <span>{{ $announcement->military ?? 'مهم نیست' }}</span>
                        </div>
                        <div class="advertisement-details-card__tag">
                            <span>حداقل مدرک تحصیلی:</span>
                            <span>{{ $announcement->edu ?? 'مهم نیست' }}</span>
                        </div>
                    </div>
                    <div class="product-tags" style="font-style: italic">تگ ها: {{ $announcement->tags }}</div>
                </div>

            </div>
            <div class="advertisement-details-leftSidebar">
                <div class="sticky d-flex flex-column gap-2 justify-content-center align-items-center">
                    @auth
                    <a href="{{ route('intership.intership',$announcement->slug) }}" class="karasan-btn karasan-btn-yellow" style="--btn-width: 260px; --btn-height: 50px;">ارسال رزومه</a>
                        @if($announcement->test)
                        <div class="border p-3 testRequire" style="border-radius: var(--radius)">
                            <h4>کارفرمای این آگهی، ارسال رزومه برای این آگهی را مشروط به شرکت در آزمون های ذیل کرده است:</h4>
                            <ul class="mt-4">
                                @foreach(json_decode($announcement->test,true) as $test)
                                    <li>{{ __("messages." . $test) }} <a class="badge bg-info" href="{{ route('test.'.strtolower($test)) }}">ورود به آزمون</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    @endauth
                    @guest
                    <a href="{{ route('login') }}" class="karasan-btn karasan-btn-blue" style="--btn-width: 260px; --btn-height: 50px;">برای ارسال رزومه ابتدا وارد شوید</a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <section class="related-jobs d-flex flex-column gap-5">
        <div class="container">
            <h6 class="title-head">شغل های مرتبط</h6>
        </div>
        <div class="swiper-container swiper-container-1">
            <div class="swiper-wrapper">
                @if($relatedAnnouncements)
                @foreach($relatedAnnouncements as $rel)
                    <div class="swiper-slide">
                        <div class="swiper-card">
                            <div class="test-pages__box modern-shadow">
                                <div class="test-pages__box-text">
                                    <h2><a href="{{ route('announcement.announcement',$rel->slug) }}">{{ $rel->name }}</a></h2>
                                    <div class="advertisements-box-info">
                                        <div class="d-flex gap-2">
                                            <span>نام شرکت:</span>
                                            <span>{{ $rel->company->name }}</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <span>تاریخ آگهی:</span>
                                            <span>{{ verta($rel->created_at)->formatDifference() }}</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <span>نوع همکاری:</span>
                                            <span>@foreach (json_decode($rel->jobType,true) as $jobType)
                                                    {{ __('messages.'.$jobType).', ' }}
                                                @endforeach</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <span>حقوق پرداختی:</span>
                                            <span>{{ $rel->wage }} میلیون تومان</span>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <span>شهر:</span>
                                            <span>{{ $rel->shahrestan->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="test-pages__box-image">
                                    @if($rel->company->logo)
                                        <img
                                            src="{{ asset($rel->company->logo['indexArray'][$rel->company->logo['currentImage']]) }}"
                                            alt="company logo"/>
                                    @else
                                        <img src="{{ asset('assets-front/img/resume.png') }}" alt="company logo"/>
                                    @endif
                                </div>
                                <div class="send-resume-btn">
                                    <a href="{{ route('announcement.announcement',$rel->slug) }}">ارسال رزومه</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        var swiper = new Swiper('.swiper-container-1', {
            slidesPerView: 'auto', // تعداد اسلایدهای قابل مشاهده بر اساس عرض محتوای آنها
            spaceBetween: 30, // فاصله بین اسلایدها
            loop: true, // فعال‌سازی حالت حلقه
            loopFillGroupWithBlank: false, // جلوگیری از افزودن اسلایدهای خالی
            grabCursor: true, // فعال‌سازی امکان کشیدن اسلایدها
            centeredSlides: false, // جلوگیری از متمرکز شدن اسلایدها
            on: {
                resize: function () {
                    const swiperContainer = document.querySelector('.swiper-container-2');
                    const containerWidth = swiperContainer.offsetWidth;
                    const slides = swiperContainer.querySelectorAll('.swiper-slide');
                    let totalWidth = 0;

                    slides.forEach((slide) => {
                        totalWidth += slide.offsetWidth + 10; // عرض اسلایدها + فاصله بین آنها
                    });

                    // اگر عرض اسلایدر کوچک‌تر از اسلایدها باشد، overflow را حذف کنید
                    if (totalWidth <= containerWidth) {
                        swiperContainer.style.overflow = 'hidden';
                    }
                },
            },
        });
    </script>
@endsection

@extends('home::layouts.master')

@section('title',$company->name)
@section('meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/leaflet/leaflet.css') }}">
    @endsection
    @section('content')
        </main>
    <div class="advertisement-details-banner d-flex flex-column justify-content-end" @if($company->cover) style="background-image: url('{{ str_replace('\\','/',asset($company->cover['indexArray']['full'])) }}')" @else style="background-image: url('{{ asset('assets-front/img/pic.jpg') }}')" @endif>
        <div class="advertisement-details-banner-buttons">
            <a href="{{ route('company.company',$company->slug) }}" class="karasan-btn karasan-btn-yellow" style="--btn-width: 200px; --btn-height: 50px;">معرفی شرکت</a>
            <a href="{{ route('company.companyJobs',$company->slug) }}" class="karasan-btn karasan-btn-yellow" style="--btn-width: 200px; --btn-height: 50px;">فرصت های شغلی</a>
        </div>
        <div class="advertisement-details-banner__logoSection">
            <div class="container d-flex flex-column justify-content-center justify-content-md-start align-items-center flex-md-row gap-4">
                <div class="advertisement-details-banner__logo d-flex justify-content-center align-items-center">
                    @if($company->logo)
                        <img
                            src="{{ asset($company->logo['indexArray'][$company->logo['currentImage']]) }}"
                            alt="company logo" style="object-fit: fill"/>
                    @else
                        <img src="{{ asset('assets-front/img/resume.png') }}" alt="company logo"/>
                    @endif
                </div>
                <div class="advertisement-details-banner__information d-flex flex-column justify-content-end">
                    <h5 class="advertisement-details-banner__company-name">{{ $company->name }}</h5>
                    <div class="d-flex flex-row gap-1 gap-md-5">
                        @if($company->foundation)
                            <h5 class="advertisement-details-banner__company-info d-flex justify-content-center align-items-center gap-2"><i class="bi bi-alarm"></i> <span>سال تاسیس: {{ $company->foundation }}</span></h5>
                        @endif
                        @if($company->website)
                            <span class="advertisement-details-banner__company-info d-flex justify-content-center align-items-center gap-2"><i class="bi bi-globe2"></i> <span>آدرس وبسایت: {{ $company->website }}</span></span>
                        @endif
                        @if($company->population)
                            <span class="advertisement-details-banner__company-info d-flex justify-content-center align-items-center gap-2"><i class="bi bi-globe2"></i> <span>جمعیت شرکت: {{ $company->population }}</span></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container">
        <h1 class="mt-5 fs-26 fw-sb le-6 color-primary text-center">فرصت های شغلــــــی</h1>
        <div class="my-5 d-flex flex-column gap-4">
            @foreach($announcements as $announcement)
            <div class="test-pages__box modern-shadow job-opportunities-box @if($announcement->status == \Modules\Announcement\Models\Announcement::STATUS_STOP) expired @endif">
                <div class="test-pages__box-text">
                    <h2><a href="{{ route('announcement.announcement',$announcement->slug) }}">{{ $announcement->name }}</a></h2>
                    <div class="advertisements-box-info">
                        <div class="d-flex gap-2">
                            <span>نام شرکت:</span>
                            <span>{{ $announcement->company->name }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>تاریخ آگهی:</span>
                            <span>{{ verta($announcement->created_at)->formatDifference() }}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>نوع همکاری:</span>
                            <span>@foreach (json_decode($announcement->jobType,true) as $jobType)
                                    {{ __('messages.'.$jobType).', ' }}
                                @endforeach</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>حقوق پرداختی:</span>
                            <span>{{ $announcement->wage }} میلیون تومان</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span>شهر:</span>
                            <span>{{ $announcement->shahrestan->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="test-pages__box-image job-opportunities-page__card-image">
                    @if($announcement->company->logo)
                        <img
                            src="{{ asset($announcement->company->logo['indexArray'][$announcement->company->logo['currentImage']]) }}"
                            alt="company logo"/>
                    @else
                        <img src="{{ asset('assets-front/img/ka.png') }}" alt="company logo"/>
                    @endif
                </div>
                <div class="send-resume-btn">
                    <a href="{{ route('announcement.announcement',$announcement->slug) }}">ارسال رزومه</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

@endsection
@section('js')
    <script src="{{ asset('assets/libs/leaflet/leaflet.js') }}"></script>
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
    <script>
        jQuery(document).ready(function() {

            @if(json_decode($company->location,true)[0])
            var map = L.map('map').setView({!! $company->location !!}, 13);
            @else
            var map = L.map('map').setView([38.079728602288625, 46.29035247472123], 13);
            @endif

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var greenIcon = L.icon({
                iconUrl: 'img/marker.svg',
                iconSize: [50, 50], // size of the icon
            });

            var preIcon = L.divIcon({className: 'mdi mdi-map-marker text-dark currentIconLocation'});
            var theMarker = L.marker([{{ json_decode($company->location,true)[0] }},{{ json_decode($company->location,true)[1] }}],
                {icon: preIcon});
            map.addLayer(theMarker);

        });
    </script>
@endsection

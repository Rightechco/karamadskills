@extends('home::layouts.master')

@section('title', 'کارفرمایان')

@section('content')
    </main>
    <div class="scroller-area">
        <div class="job-seeker__section job-seeker__section-1">
            <div class="job-seeker__section-right-side">
                <span class="fs-18 fw-sb le-6">نیروی انسانی نه ! سرمایه سازمانی استخدام کن</span>
                <p class="fs-14 fw-l le-8">
                    اینکه نیروهای انسانی یک شرکت در واقع سرمایه های اصلی آنجا هستند
                    یک امر کامال انکار ناشندنی است. طبیعتاً نیروهای انسانی خبره و متخصص
                    اصلی ترین و مهمترین رکن پیشرفت و توسعه یک سازمان یا کسب وکار
                    هستند. برای اینکه بهترین استخدام ها رو تجربه کنید باید شناخت کافی از
                    تخصص ها ،استعدادها ، سوابق و عالیق کارجویان داشته باشید. ما در کارآمد
                    این اطالعات را قبل از استخدام دراختیارتان قرار میدهیم.
                </p>
            </div>
            <div class="job-seeker__section-left-side emploerys">
                <div class="blob-container">
                    <img src="{{ asset('assets-front/img/prog.avif') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="scroller-area">
        <div class="job-seeker__section job-seeker__section-2">
            <div class="w-100 d-flex flex-column gap-3" style="grid-column: 1 / -1;">
                <span class="heading fs-18 fw-b le-6">موفقیت در کسب و کار اتفاقی نیست</span>
                <span class="heading fs-14 fw-sb le-6">داده های ارزشمند و هنر استخدام کردن را در کارآمد تجربه کن</span>
            </div>

            <div class="job-seeker__boxes-wrapper">
                <div class="karasan-card d-flex flex-column">
                    <div class="karasan-card-header d-flex flex-row gap-4">
                        <span class="flex flex-row justify-content-center align-items-center"><i
                                class="fas fa-search"></i></span>
                        <span class="fs-22 fw-xb le-6">مشاهده استعدادهای کارجو</span>
                    </div>
                    <div class="karasan-card-body">
                        <p class="line-clamp-2 fs-14 fw-l le-8">
                            بهره گیری از هوش مصنوعی و آزمون استاندارد
                        </p>
                    </div>
                    <div class="karasan-card-footer d-flex justify-content-end">
                        <a href="http://127.0.0.1:8000/tests" class="d-flex gap-3">
                            <span>اطلاعات بیشـــتر</span>
                            <span class="d-flex justify-content-center align-items-center"><i
                                    class="fas fa-arrow-left "></i></span>
                        </a>
                    </div>
                </div>
                <div class="karasan-card d-flex flex-column">
                    <div class="karasan-card-header d-flex flex-row gap-4">
                        <span class="flex flex-row justify-content-center align-items-center"><i
                                class="fas fa-search"></i></span>
                        <span class="fs-22 fw-xb le-6">مشاهده رزومه کاری و تحصیلی</span>
                    </div>
                    <div class="karasan-card-body">
                        <p class="line-clamp-2 fs-14 fw-l le-8">
                            ارائه خالصه رزومه کاری و تحصیلی در یک نگاه
                        </p>
                    </div>
                    <div class="karasan-card-footer d-flex justify-content-end">
                        <a href="http://127.0.0.1:8000/tests" class="d-flex gap-3">
                            <span>اطلاعات بیشـــتر</span>
                            <span class="d-flex justify-content-center align-items-center"><i
                                    class="fas fa-arrow-left "></i></span>
                        </a>
                    </div>
                </div>
                <div class="karasan-card d-flex flex-column">
                    <div class="karasan-card-header d-flex flex-row gap-4">
                        <span class="flex flex-row justify-content-center align-items-center"><i
                                class="fas fa-search"></i></span>
                        <span class="fs-22 fw-xb le-6"> مشاهده علایق کاری</span>
                    </div>
                    <div class="karasan-card-body">
                        <p class="line-clamp-2 fs-14 fw-l le-8">
                            بهره گیری از آزمونهای استاندارد وتحلیل داده ها
                        </p>
                    </div>
                    <div class="karasan-card-footer d-flex justify-content-end">
                        <a href="http://127.0.0.1:8000/tests" class="d-flex gap-3">
                            <span>اطلاعات بیشـــتر</span>
                            <span class="d-flex justify-content-center align-items-center"><i
                                    class="fas fa-arrow-left "></i></span>
                        </a>
                    </div>
                </div>
                <div class="karasan-card d-flex flex-column">
                    <div class="karasan-card-header d-flex flex-row gap-4">
                        <span class="flex flex-row justify-content-center align-items-center"><i
                                class="fas fa-search"></i></span>
                        <span class="fs-22 fw-xb le-6">مشاهده تخصص ها و مهارت ها</span>
                    </div>
                    <div class="karasan-card-body">
                        <p class="line-clamp-2 fs-14 fw-l le-8">
                            بهترین متخصص ها رو بهت پیشنهاد میدهیم
                        </p>
                    </div>
                    <div class="karasan-card-footer d-flex justify-content-end">
                        <a href="http://127.0.0.1:8000/tests" class="d-flex gap-3">
                            <span>اطلاعات بیشـــتر</span>
                            <span class="d-flex justify-content-center align-items-center"><i
                                    class="fas fa-arrow-left "></i></span>
                        </a>
                    </div>
                </div>
                <div class="karasan-card d-flex flex-column">
                    <div class="karasan-card-header d-flex flex-row gap-4">
                        <span class="flex flex-row justify-content-center align-items-center"><i
                                class="fas fa-search"></i></span>
                        <span class="fs-22 fw-xb le-6">پیشنهادهای متناسب با آگهی شما</span>
                    </div>
                    <div class="karasan-card-body">
                        <p class="line-clamp-2 fs-14 fw-l le-8">
                            ارائه رزومه های مرتبط با تحلیل هوش مصنوعی
                        </p>
                    </div>
                    <div class="karasan-card-footer d-flex justify-content-end">
                        <a href="http://127.0.0.1:8000/tests" class="d-flex gap-3">
                            <span>اطلاعات بیشـــتر</span>
                            <span class="d-flex justify-content-center align-items-center"><i
                                    class="fas fa-arrow-left "></i></span>
                        </a>
                    </div>
                </div>
                <div class="karasan-card d-flex flex-column">
                    <div class="karasan-card-header d-flex flex-row gap-4">
                        <span class="flex flex-row justify-content-center align-items-center"><i
                                class="fas fa-search"></i></span>
                        <span class="fs-22 fw-xb le-6">مصاحبه آنلاین با کارجویان</span>
                    </div>
                    <div class="karasan-card-body">
                        <p class="line-clamp-2 fs-14 fw-l le-8">
                            مکان برگزاری مصاحبه آنلاین با کارجو
                        </p>
                    </div>
                    <div class="karasan-card-footer d-flex justify-content-end">
                        <a href="http://127.0.0.1:8000/tests" class="d-flex gap-3">
                            <span>اطلاعات بیشـــتر</span>
                            <span class="d-flex justify-content-center align-items-center"><i
                                    class="fas fa-arrow-left "></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="scroller-area">

        <div class="job-seeker__section job-seeker__section-3">
            <div class="w-100 d-flex flex-column gap-3 mb-5">
                <span class="heading fs-18 fw-b le-6">کارآمد چه خدماتی برای کارفرمایان ارائه میدهد؟</span>
            </div>
            <div class="job-seeker__cards-wrapper">
                <div class="job-seeker__card">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                            </div>
                            <div class="flip-card-back">
                                <img src="{{ asset('assets-front/img/prog.avif') }}" alt="Avatar"
                                    style="width:300px;height:300px;object-fit: cover; filter: opacity(0.1);">
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <div class="icon-wrapper">
                            <i class="fas fa-search fs-22" style="color: var(--yellow);"></i>
                        </div>
                        <span class="fs-18 fw-sb le-6">کاهش زمان و هزینه</span>
                        <p class="fs-14 le-8 fw-l">
                            نیازی نیست از بین صدها رزومه
                            ارسال شده، بهترین رزومه را انتخاب
                            و دعوت به مصاحبه کنی. کارآمد
                            بهترین و مرتبط ترین رزومه هارو
                            به شما معرفی میکند
                        </p>
                    </div>
                </div>

                <div class="job-seeker__card">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                            </div>
                            <div class="flip-card-back">
                                <img src="{{ asset('assets-front/img/prog.avif') }}" alt="Avatar"
                                    style="width:300px;height:300px;object-fit: cover; filter: opacity(0.1);">
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <div class="icon-wrapper">
                            <i class="fas fa-hands-helping fs-22" style="color: var(--yellow);"></i>
                        </div>
                        <span class="fs-18 fw-sb le-6">صحت سنجی تخصص</span>
                        <p class="fs-14 le-8 fw-l">ما نیروهای انسانی متخصص را
                            تربیت میکنیم ، صاحب تجربه
                            میکنیم و با توجه به نیازهای شما
                            معرفی میکنیم. با کارآمد بی دغدغه
                            استخدام کن
                        </p>
                    </div>
                </div>



                <div class="job-seeker__card">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                            </div>
                            <div class="flip-card-back">
                                <img src="{{ asset('assets-front/img/prog.avif') }}" alt="Avatar"
                                    style="width:300px;height:300px;object-fit: cover; filter: opacity(0.1);">
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <div class="icon-wrapper">
                            <i class="fas fa-chart-line fs-22" style="color: var(--yellow);"></i>
                        </div>
                        <span class="fs-18 fw-sb le-6">ستفاده از تسهیالت کاریابی</span>
                        <p class="fs-14 le-8 fw-l">
                            مجموعه کارآمد دارای مجوز
                            کاریابی از وزارت کار و رفاه اجتماعی
                            بوده و با استخدام از کارآمد
                            میتوانید از تسهیالت بیمه و مالیاتی
                            بهره مند شوید
                        </p>
                    </div>
                </div>



                <div class="job-seeker__card">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                            </div>
                            <div class="flip-card-back">
                                <img src="{{ asset('assets-front/img/prog.avif') }}" alt="Avatar"
                                    style="width:300px;height:300px;object-fit: cover; filter: opacity(0.1);">
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <div class="icon-wrapper">
                            <i class="fas fa-book fs-22" style="color: var(--yellow);"></i>
                        </div>
                        <span class="fs-18 fw-sb le-6">مصاحبه آنالین</span>
                        <p class="fs-14 le-8 fw-l">
                            ما در کارآمد بستری برای شما
                            فراهم کردیم تا روند استخدام رو
                            حرفه ای تر انجام دهید. مصاحبه
                            آنالین با کارجوبان یکی از ابزارهای
                            حرفه ای ماست
                        </p>
                    </div>
                </div>



                <div class="job-seeker__card">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                            </div>
                            <div class="flip-card-back">
                                <img src="{{ asset('assets-front/img/prog.avif') }}" alt="Avatar"
                                    style="width:300px;height:300px;object-fit: cover; filter: opacity(0.1);">
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <div class="icon-wrapper">
                            <i class="fas fa-lightbulb fs-22" style="color: var(--yellow);"></i>
                        </div>
                        <span class="fs-18 fw-sb le-6">آموزش دوره های مدیریتی</span>
                        <p class="fs-14 le-8 fw-l">
                            بهره گیری از برترین اساتید حوزه
                            کسب و کار و مدیریت در آموزش
                            های ویژه تعالی سازمانی ،
                            کارفرمایان را در بحث مدیریت
                            سازمان خبره تر میکند.
                        </p>
                    </div>
                </div>




                <div class="job-seeker__card">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">

                            </div>
                            <div class="flip-card-back">
                                <img src="{{ asset('assets-front/img/prog.avif') }}" alt="Avatar"
                                    style="width:300px;height:300px;object-fit: cover; filter: opacity(0.1);">
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <div class="icon-wrapper">
                            <i class="fas fa-compass fs-22" style="color: var(--yellow);"></i>
                        </div>
                        <span class="fs-18 fw-sb le-6">خدمات دیجیتال مارکتینگ</span>
                        <p class="fs-14 le-8 fw-l">
                            عالوه بر کمک در تعالی سازمان ، از
                            متخصصین دیجیتال مارکتینگ برای
                            بهبود کسب و کارتان کمک گرفتیم.
                            طراحی سایت و ارائه بانک اطالعات
                            مرتبط از جمله این خدمات است
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="scroller-area">
        <div class="job-seeker__section job-seeker__section-4">
            <div class="job-seeker__section--right-side emploerys__section">
                <span class="fs-22 fw-b le-6 text-center">هرآنچه که برای بازاریابی و توسعه کسب و کارتان نیاز دارید</span>
                <div class="karasan-key-features-boxe-wrapper">
                    <div class="karasan-key-features-box">
                        <p class="line-clamp-3 fs-14 fw-l le-8" style="padding-inline-start: 5rem; padding-inline-end: 1rem; text-align: justify; text-wrap: pretty">
                            بهره گیری آزمون های شخصیت شناسی ، استعدادیابی و رغبت ،
                            سنجش هوش
                        </p>
                    </div>
                    <div class="karasan-key-features-box">
                        <p class="line-clamp-3 fs-14 fw-l le-8" style="padding-inline-start: 5rem; padding-inline-end: 1rem; text-align: justify; text-wrap: pretty">
                            ارائه فرصت های شغلی متناسب با شخصیت ، استعداد ،
                            مهارت ها و علائق
                        </p>
                    </div>
                    <div class="karasan-key-features-box">
                        <p class="line-clamp-3 fs-14 fw-l le-8" style="padding-inline-start: 5rem; padding-inline-end: 1rem; text-align: justify; text-wrap: pretty">
                            آموزش مهارت با استفاده از تحلیل شخصیت ، استعداد و
                            علائق شغلی
                        </p>
                    </div>
                </div>
            </div>
            <div class="job-seeker__section--left-side emploerys__section">
                <img src="{{ asset('assets-front/img/employers-vector.webp') }}" alt="man desktop vector">
            </div>
        </div>
    </div>

    <div class="scroller-area">
        <div class="job-seeker__section job-seeker__section-5 employers-section">
            <div class="job-seeker__section--right-side">
                <span class="fs-20 fw-sb le-6">بهترین فرصت های شغلیتان را از کارآمد بخواهید</span>
                <p class="fs-16 fw-l le-8 text-center">با استفاده از امکانات و خدمات کارآ سان، کارجویان میتوانند به جایگاه
                    بهتری در بازار کار برسند و به شغل و حرفهای که با تواناییها و اهدافشان
                    همخوانی دارد، دست پیدا کنند.</p>
                    <a href="{{ route('auth.register') }}" class="sign-btn text-dark">ثبت نام کارفرمایان</a>
            </div>
            <div class="job-seeker__section--left-side">
                <img src="http://127.0.0.1:8000/assets-front/img/man-behind-desktop-2.webp" alt="man desktop vector">
            </div>
        </div>
    </div>

    <div class="scroller-area">
        <div class="job-seeker__section d-flex justify-content-center align-items-center">
            <div class="w-100 d-flex flex-column gap-3" style="grid-column: 1 / -1;">
                <span class="heading fs-18 fw-b le-6">دوره های تعالی سازمانی ویژه شما</span>
                <span class="heading fs-14 fw-sb le-6">همین حالا رشد کسب و کارتان را شروع کنید</span>
            </div>
        </div>
    </div>
    <main style="display: none;">
    @endsection

    @section('js')

    {{-- <script>
        const blob = document.querySelector('.blob-container img');

        let startTime = null;

        const durationObjPos = 40000;

        function interpolate(start, end, progress) {
          return start + (end - start) * progress;
        }

        function animate(time) {
          if (!startTime) startTime = time;
          const elapsedTime = time - startTime;

          const progressObjPos = (elapsedTime % durationObjPos) / durationObjPos;

          const objectPositionX = interpolate(0, 100, progressObjPos);
          blob.style.objectPosition = `${objectPositionX}% 100%`;

          requestAnimationFrame(animate);
        }

        requestAnimationFrame(animate);
      </script> --}}

    @endsection

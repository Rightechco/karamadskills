@extends('home::layouts.master')

@section('title',$university->name)
@section('meta')
    <style>
        .post-container {
            background-color: #f8f8f8;
            padding: 30px 8px;
            background-size: auto;
            text-align: center;
            border-radius: 15px;
            margin-bottom: 25px;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }
    </style>
@endsection
@section('content')

<div class="row mx-0">
    <div class="col-12 col-lg-6 row align-items-center justify-content-center">
        @if($university->logo)
            <div class="col-12 row align-items-center justify-content-center">
                <img src="{{ asset($university->logo['indexArray']['full']) }}" alt="" style="width: 150px">
            </div>
        @endif
            <div class="about-university col-12 mt-2">
                <h2 class="fs-18 le-6 fw-b color-secondary">مرکز هدایت شغلی {{ $university->name }}</h2>
                <p class="fs-16 fw-l le-8 color-gray-1 text-justify mt-2">{!! $university->text !!}</p>
            </div>
    </div>
    <div class="col-12 col-lg-6 my-5">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @if($university->gallery)
                    @foreach($university->gallery as $gallery)
                <div class="swiper-slide position-relative">
                    <img src="{{ asset($gallery['indexArray']['full']) }}" alt="ai-pic" style="height: 400px">
                    <div class="swiper-slide-description d-flex justify-content-start align-items-end">
                        <div>
                            {{ $university->name }}
                        </div>
                    </div>
                </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="col-12 row my-5">
        <div class="roadmap-container col-lg-6 col-12">
            <img src="{{ asset('assets-front/img/roadmap.png') }}" alt="roadmap svg" />
        </div>
        <section class="d-flex flex-row karasan-home-cards university-page__cards col-12 col-lg-6">
            <div class="karasan-card d-flex flex-column">
                <div class="karasan-card-header d-flex flex-row gap-3">
            <span
                class="flex flex-row justify-content-center align-items-center"
            ><i class="fas fa-search"></i
                ></span>
                    <span>خودشناسی</span>
                </div>
                <div class="karasan-card-body">
                    <p>
                        شامل استعدادیابی، رغبت سنجی، سنجش هوش و هوش هیجانی در قالب آزمون
                    </p>
                </div>
                <div class="karasan-card-footer d-flex justify-content-end">
                    <a href="{{  route('test.tests') }}" class="d-flex gap-3">
                        <span>اطلاعات بیشـــتر</span>
                        <span class="d-flex justify-content-center align-items-center"
                        ><i class="fas fa-arrow-left "></i
                            ></span>
                    </a>
                </div>
            </div>
            <div class="karasan-card d-flex flex-column">
                <div class="karasan-card-header d-flex flex-row gap-3">
            <span
                class="flex flex-row justify-content-center align-items-center"
            ><i class="fas fa-tools"></i
                ></span>
                    <span>مهارت آموزی</span>
                </div>
                <div class="karasan-card-body">
                    <p>
                        شامل آموزش مهارت شغلی و کارآموزی براساس تحلیل خود شناسی و مشاوره
                        شغلی
                    </p>
                </div>
                <div class="karasan-card-footer d-flex justify-content-end">
                    <a href="{{ route('course.courses') }}" class="d-flex gap-3">
                        <span>اطلاعات بیشـــتر</span>
                        <span class="d-flex justify-content-center align-items-center"
                        ><i class="fas fa-arrow-left "></i
                            ></span>
                    </a>
                </div>
            </div>
            <div class="karasan-card d-flex flex-column">
                <div class="karasan-card-header d-flex flex-row gap-3">
            <span
                class="flex flex-row justify-content-center align-items-center"
            ><i class="fas fa-pen-nib"></i
                ></span>
                    <span>رزومه سازی</span>
                </div>
                <div class="karasan-card-body">
                    <p>
                        طراحی رزومه حرفه ای و هوشمند با بهره گیری از مهارت های قبلی و
                        آموزه های فعلی 
                    </p>
                </div>
                <div class="karasan-card-footer d-flex justify-content-end">
                    <a href="{{ route('panel.resume.resume') }}" class="d-flex gap-3">
                        <span>اطلاعات بیشـــتر</span>
                        <span class="d-flex justify-content-center align-items-center"
                        ><i class="fas fa-arrow-left "></i
                            ></span>
                    </a>
                </div>
            </div>
            <div class="karasan-card d-flex flex-column">
                <div class="karasan-card-header d-flex flex-row gap-3">
            <span
                class="flex flex-row justify-content-center align-items-center"
            ><i class="fas fa-suitcase"></i
                ></span>
                    <span>شروع به کار</span>
                </div>
                <div class="karasan-card-body">
                    <p>
                        معرفی فرصت های شغلی بر اساس علایق و استعدادها و یا تربیت نیروی
                        کارآفرین
                    </p>
                </div>
                <div class="karasan-card-footer d-flex justify-content-end">
                    <a href="{{ route('announcement.announcements') }}" class="d-flex gap-3">
                        <span>اطلاعات بیشـــتر</span>
                        <span class="d-flex justify-content-center align-items-center"
                        ><i class="fas fa-arrow-left "></i
                            ></span>
                    </a>
                </div>
            </div>
        </section>
    </div>
    @if($university->publishes->count())
    <div class="col-12 my-3">
        <h2>دوره ها</h2>
        <div class="vertical-tab-content active-vertical-content" id="vcontent1">
            <div class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    @foreach($university->publishes->whereIn('status',[\Modules\Course\Models\Course::STATUS_VERIFIED,\Modules\Course\Models\Course::STATUS_FINISHED]) as $course)
                    <div class="swiper-slide"><div class="card-test d-flex flex-column">
                            <div class='top'>
                                @if($course->cover)
                                    <img
                                        src="{{ asset($course->cover['indexArray'][$course->cover['currentImage']]) }}"
                                        alt="company logo"/>
                                @else
                                    <img src="{{ asset('assets-front/img/ka.png') }}" alt="company logo"/>
                                @endif
                            </div>
                            <div class="bottom flex-grow-1 d-flex flex-column">
                                <div class="content d-flex flex-column flex-grow-1">
                                    <a href="{{ route('course.course',$course->id) }}" class="text-dark fs-14 fw-b le-6 line-clamp-2 text-right">{{ $course->name }}</a>
{{--                                    <p class="fs-12 leading15 fw-l le-8 line-clamp-2" style="color: var(--gray-text); text-align: right;">بعد از یادگیری HTML و CSS، افراد با یک چالش بزرگ روبرو می‌شوند، و آن این است که</p>--}}
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex flex-row justify-content-between pb-4">
                                        <span class="d-flex align-items-center gap-2 color-gray-3 fs-14 fw-r le-6"><i class="fas fa-school"></i>برگزاری توسط: {{ $course->courseable->name }}</span>
                                        {{--                                    <span class="d-flex align-items-center gap-2 flex-row-reverse fs-14 fw-r le-6">--}}
                                        {{--                                            <i class="fas fa-star" style="color: var(--yellow)"></i>--}}
                                        {{--                                            <span style="color: var(--yellow)">5.0</span>--}}
                                        {{--                                        </span>--}}
                                    </div>
                                    <div class="d-flex flex-row justify-content-between pb-4 bb-1">
                                        <span class="d-flex align-items-center gap-2 color-gray-3 fs-14 fw-r le-6"><i class="fas fa-chalkboard-teacher"></i>مدرس: {{ $course->teacher->name }}</span>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between pb-4 mt-2">
                                    <span class="d-flex align-items-end gap-2 color-gray-3 fs-16 fw-r le-6"><i
                                            class="fas fa-users"
                                            style="padding-bottom: .5rem;"></i> <span>ظرفیت: @if($course->limit) {{ $course->limit }} نفر @else نامحدود @endif</span></span>
                                        <span class="d-flex flex-column">
                                            <!--<del class="fs-14 fw-l le-8 color-gray-3">900,000</del>-->
                                            <span class="fs-16 fw-b le-6"
                                                  style="color: var(--green)">@if($course->price) {{ number_format($course->price) }} تومان @else رایگان @endif</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($university->visits->count())
        <div class="col-12 my-3">
            <h2>بازدید ها</h2>
            <div class="swiper mySwiperVisit mt-3">
                <div class="swiper-wrapper">
                @foreach($university->visits->where('status',\Modules\Visit\Models\Visit::STATUS_VERIFIED) as $visit)
                    <div class="col-lg-4 col-md-6 col-sm-6 swiper-slide">
                        <div class="single-virtual-visit karamad-aparat-videos">
                            <video preload="metadata" class="video-js vjs-default-skin"
                                   style="max-width: 100%;" controls="">
                                <source src="{{ $visit->videoLink }}" type="video/mp4" label="Original" selected="">
                            </video>
                            <div class="virtual-visit-content">
                                <h3>{{ $visit->name }}</h3>
                                @if($visit->university_id)
                                    <p>دانشگاه: {{ $visit->university->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    @endif
    @if($university->posts->count())
        <div class="col-12 my-3">
            <h2>اخبار و مقالات</h2>
            <div class="swiper mySwiperBlog mt-3">
                <div class="swiper-wrapper">
                    @foreach($university->posts->where('status',\Modules\Post\Models\Post::STATUS_VERIFIED) as $post)
                        <div class="col-lg-4 col-md-6 col-sm-6 swiper-slide post-container">
                            <img src="{{ asset($post->image['indexArray']['medium']) }}" alt="">
                            <h3 class="my-2">{{ $post->name }}</h3>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#postDes" lll="{{ route('post.postsContent',$post->id) }}" onclick="setPost({{ $post->id }},this)">
                                مشاهده خبر
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

<div class="my-4 bg-primary p-3" style="border-radius: 12px">
    <p class="text-center mb-3 text-white">اطلاعات تماس دانشگاه:</p>
    <div class="row">
        <div class="col-6">
            <p class="text-white text-center">وب سایت دانشگاه: <span>{{ $university->website ?? '-' }}</span></p>
        </div>
        <div class="col-6">
            <p class="text-white text-center">شماره تماس دانشگاه: <span>{{ $university->tell ?? '-' }}</span></p>
        </div>
    </div>
</div>
</main>
<div class="modal fade" id="postDes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
            <div class="modal-body my-3" id="postContent">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script>
        function setPost(id,e) {
            var url = $(e).attr('lll');
            $('#postContent').html('<td>لطفا صبر کنید ...</td>');
            $.ajax({
                type: 'get',
                url: url,
                success: function (list) {
                    $('#postContent').html(list);
                }
            });
        }

        $(document).ready(function () {
            const swiper_3 = new Swiper('.mySwiper', {
                direction: 'horizontal',
                loop: true,
                speed: 500,
                slidesPerView: 1,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
            });
        });
        var swiper = new Swiper(".mySwiper2", {
            slidesPerView: 4,
            spaceBetween: 0,
            loop: true,
            grabCursor: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
            },
        })
        var swiperVisit = new Swiper(".mySwiperVisit", {
            slidesPerView: 3,
            spaceBetween: 0,
            loop: true,
            grabCursor: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
        var swiperPost = new Swiper(".mySwiperBlog", {
            slidesPerView: 3,
            spaceBetween: 0,
            loop: true,
            grabCursor: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
            },
        });
    </script>
@endsection

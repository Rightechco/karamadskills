@extends('home::layouts.master')

@section('title',$company->name)
@section('meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/leaflet/leaflet.css') }}">
@endsection
@section('content')
    </main>
<div class="advertisement-details-banner d-flex flex-column justify-content-end" @if($company->cover) style="background-image: url('{{ str_replace('\\','/',asset($company->cover['indexArray']['full'])) }}')" @else style="background-image: url('{{ asset('assets-front/img/pic.jpg') }}')" @endif>
    <div class="advertisement-details-banner-buttons">
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

<section class="company-profile__page-body container">
    <div class="company-profile__page--left-sidebar d-flex flex-column justify-content-start align-items-center">
        <div class="map-box">
            <div class="box-view-map position-relative">
                <div class="box-map" id="map" style="width: 100%; height: 400px; z-index:1;"></div>
                <div class="marker-position"></div>
                <input type="hidden" id="poslat" name="companyLat" />
                <input type="hidden" id="poslng" name="companyLang" />
            </div>
        </div>
        <div class="address d-flex flex-column gap-3">
            {!! $company->expert !!}
        </div>
    </div>
    <div class="company-profile__page--right-sidebar d-flex flex-column justify-content-start align-items-center">
        <div class="about-company d-flex flex-column">
            {!! $company->des !!}
            <div class="product-tags" style="font-style: italic">تگ ها: {{ $company->tags }}</div>
        </div>
    </div>
</section>
    <div class="container">
    <div class="course-detail__comments w-100 br-.75 bg-cloud">
        <div class="course-detail__comments-header d-flex flex-row justify-content-between align-items-center">
            <h2 class="fs-20 fw-b le-6 d-flex justify-content-start gap-2 align-items-center color-primary"><i class="mdi mdi-wechat d-flex"></i>بخش نظرات</h2>
            @if(auth()->check())
                <button type="button" class="signIn-btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#signupModal">
                    <span>ایجاد نظر</span>
                    <span><i class="mdi mdi-chat-processing d-flex justify-content-center align-items-center"></i></span>
                </button>
            @endif
        </div>
        <div class="course-detail__comment">
            @foreach($company->comments->where('status',\Modules\Comment\Models\Comment::ACTIVE)->whereNull('parent_id') as $comment)
                <div class="comment-box">
                    <div class="gradient-bg"></div>
                    <div class="comment-header">
                        @if($comment->user->pic)
                            <img class="user-avatar" src="{{ route('user.avatarShow',[$comment->user->pic,'userAvatar']) }}" alt="تصویر کاربر" title="{{ $comment->user->name }}">
                        @else
                            <img class="user-avatar" src="{{ asset('assets/images/users/user-1.jpg') }}" alt="تصویر کاربر" title="{{ $comment->user->name }}">
                        @endif
                        <div class="user-info">
                                        <span class="d-flex flex-row align-items-center gap-2">
                                            <span class="user-name fs-16 fw-sb le-6 color-secondary">{{ $comment->user->name }}</span>
{{--                                            <span>|</span>--}}
                                            {{--                                            <span class="user-role fs-16 fw-l le-6 color-gray-3">مدیر</span>--}}
                                        </span>
                            <span class="comment-date fs-12 fw-r le-6 color-gray-1">{{ verta($comment->created_at)->formatDifference() }}</span>
                        </div>
                    </div>
                    <hr class="divider">
                    <div class="comment-body le-8">{{ $comment->body }}</div>
                    @if($comment->childs->count())
                        <div class="reply" style="padding-right: 50px">
                            @foreach($comment->childs as $child)
                                <div class="comment-box" style="background-color: skyblue">
                                    <div class="gradient-bg"></div>
                                    <div class="comment-header">
                                        @if($child->user->pic)
                                            <img class="user-avatar" src="{{ route('user.avatarShow',[$child->user->pic,'userAvatar']) }}" alt="تصویر کاربر" title="{{ $child->user->name }}">
                                        @else
                                            <img class="user-avatar" src="{{ asset('assets/images/users/user-1.jpg') }}" alt="تصویر کاربر" title="{{ $child->user->name }}">
                                        @endif
                                        <div class="user-info">
                                        <span class="d-flex flex-row align-items-center gap-2">
                                            <span class="user-name fs-16 fw-sb le-6 color-secondary">پاسخ: {{ $child->user->name }}</span>
{{--                                            <span>|</span>--}}
                                            {{--                                            <span class="user-role fs-16 fw-l le-6 color-gray-3">مدیر</span>--}}
                                        </span>
                                            <span class="comment-date fs-12 fw-r le-6 color-gray-1">{{ verta($child->created_at)->formatDifference() }}</span>
                                        </div>
                                    </div>
                                    <hr class="divider">
                                    <div class="comment-body le-8">{{ $child->body }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
            {{--                            <div class="d-flex justify-content-center align-items-center">--}}
            {{--                                <div class="signIn-btn d-flex justify-content-center align-items-center">--}}
            {{--                                    <span>مشاهده بیشتر</span>--}}
            {{--                                    <span><i class="mdi mdi-chevron-down d-flex justify-content-center align-items-center"></i></span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
        </div>
    </div>
    </div>
    @if(auth()->check())
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-end">
                        <!--<h5 class="modal-title" id="signupModalLabel"></h5>-->
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <form id="fromComment" action="{{ route('panel.comment.createComment') }}" method="post">
                            @csrf
                            <input type="hidden" name="commentable_id" value="{{ $company->id }}">
                            <input type="hidden" name="commentable_type" value="{{ \Modules\Company\Models\Company::class }}">
                            <div class="mb-3">
                                <label for="feedback" class="form-label fs-16 fw-r le-6 color-secondary">نظر شما</label>
                                <textarea class="form-control" name="body" id="feedback" rows="4" placeholder="نظر خود را اینجا بنویسید"></textarea>
                            </div>
                            <div class="d-flex justify-content-star align-items-center">
                                <span class="fs-14 fw-r le-6 color-gray-1">امتیاز شما به این دوره:</span>
                                <div class="starrating d-flex justify-content-center flex-row-reverse">
                                    <input type="radio" id="star-5" name="rating" value="5">
                                    <label class="fas fa-star" for="star-5" title="5 ستاره"></label>
                                    <input type="radio" id="star-4" name="rating" value="4">
                                    <label class="fas fa-star" for="star-4" title="4 ستاره"></label>
                                    <input type="radio" id="star-3" name="rating" value="3">
                                    <label class="fas fa-star" for="star-3" title="3 ستاره"></label>
                                    <input type="radio" id="star-2" name="rating" value="2">
                                    <label class="fas fa-star" for="star-2" title="2 ستاره"></label>
                                    <input type="radio" id="star-1" name="rating" value="1">
                                    <label class="fas fa-star" for="star-1" title="1 ستاره"></label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="fromComment" type="submit" class="karasan-btn karasan-btn-blue" style="--btn-width: 10rem; --btn-height: 4rem;">ثبت نظر</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

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

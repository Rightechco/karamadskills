@extends('home::layouts.master')

@section('title','فرصت های شغلی')
@section('meta')
    <meta name="description" content="فرصت های شغلی و کارآموزی بخش دیگری از خدمات کارآمد است که
کارجویان پس ترسیم مسیر شغلی خود ، میتوانند از فرصت های شغلی مرتبط با
خود استفاده کنند">
    <meta name="keywords" content="فرصت های شغلی">
@endsection
@section('content')
    <section class="advertisements-page-body">
        <aside class="advertisements-sidebar">
            <div class="filter-section modern-shadow">
                <div class="filter-section-header">
                    <h5>فیلتـــــرها</h5>
                </div>
                <form class="filters" action="">
                    <div class="row p-2 p-lg-4 mx-0">
                        <div class="col-12 my-1">
                            <div class="advertisements-search">
                                <div class="search-wrapper modern-shadow">
                                    <input class="search-input" type="text" name="s" placeholder="عنوان..."
                                           value="{{ request('s') ?? null }}"/>
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        class="feather feather-search"
                                        viewBox="0 0 24 24"
                                    >
                                        <defs></defs>
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="M21 21l-4.35-4.35"></path>
                                    </svg>
                                </div>
                            </div>
                            <label for="ostan" class="mt-3">استان</label>
                            <select class="form-control select2" name="ostan" id="ostan">
                                <option value="">انتخاب</option>
                                @foreach($ostans as $ostan)
                                    <option value="{{ $ostan->id }}" @if($ostan->id == request('ostan')) selected @endif>{{ $ostan->name }}</option>
                                @endforeach
                            </select>
                            <label for="gender" class="mt-3">جنسیت</label>
                            <select class="form-control select2" id="gender" name="gender">
                                <option value="">فرقی نمی کند</option>
                                @foreach(\Modules\Resume\Models\Resume::$genders as $gender)
                                    <option @if(request('gender') == $gender ) selected
                                            @endif value="{{ $gender }}">{{ __('messages.'.$gender) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="more-btn">
                            <button type="submit" class="modern-shadow">فیلتر گذاری</button>
                        </div>
                    </div>
                </form>
                {{--                <div class="advertisements-banners">--}}
                {{--                    <a href="#" class="advertisements-banner modern-shadow blue"><span>دوره ها</span><span><i class="bi bi-link-45deg"></i></span></a>--}}
                {{--                    <a href="#" class="advertisements-banner modern-shadow yellow"><span>آزمون ها</span><span><i class="bi bi-link-45deg"></i></span></a>--}}
                {{--                    <a href="#" class="advertisements-banner modern-shadow darkBlue"><span>تست ها</span><span><i class="bi bi-link-45deg"></i></span></a>--}}
                {{--                </div>--}}
            </div>
        </aside>
        <div class="advertisements-content">
            <div class="test-pages__boxes-container" id="announcementDiv">
                @foreach($announcements as $announcement)
                    <div class="test-pages__box modern-shadow">
                        <div class="test-pages__box-text">
                            <h2><a href="{{ route('announcement.intership',$announcement->slug) }}">{{ $announcement->name }}</a></h2>
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
                                    <span>کارآموزی دانشگاه</span>
                                </div>
{{--                                <div class="d-flex gap-2">--}}
{{--                                    <span>حقوق پرداختی:</span>--}}
{{--                                        <span>{{ $announcement->wage }} میلیون تومان</span>--}}
{{--                                </div>--}}
                                <div class="d-flex gap-2">
                                    <span>شهر:</span>
                                    <span>{{ $announcement->shahrestan->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="test-pages__box-image">
                            @if($announcement->company->logo)
                                <img
                                    src="{{ asset($announcement->company->logo['indexArray'][$announcement->company->logo['currentImage']]) }}"
                                    alt="company logo"/>
                            @else
                                <img src="{{ asset('assets-front/img/ka.png') }}" alt="company logo"/>
                            @endif
                        </div>
                        <div class="send-resume-btn">
                            <a href="{{ route('announcement.intership',$announcement->slug) }}">ارسال رزومه</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="more-btn">
                <button type="button" id="moreBtn" url="{{ route('announcement.intershipsMore') }}" num="1" class="modern-shadow">
                    موارد بیشتر
                </button>
            </div>
        </div>
    </section>
@endsection
@php
    $urlMore = [
       's' => request('s'),
       'ostan' => request('ostan'),
       'category' => request('category'),
       'gender' => request('gender'),
   ];
    if (!empty(request('jobType'))) {
        foreach (request('jobType') as $jobType) {
            $urlMore['jobType'][] = $jobType;
        }
    }
@endphp
@section('js')
    <script>
        $('.select2').select2({})
        $('#moreBtn').click(function (e) {
            $.ajax({
                type: 'POST',
                url: $(this).attr('url'),
                data: {
                    'num': $(this).attr('num'),
                    '_token': "{{ csrf_token() }}",
                    'req': {!! json_encode($urlMore) !!}
                },
                success: function (data) {
                    if (data) {
                        $('#announcementDiv').append(data);
                        var num = $('#moreBtn').attr('num');
                        num++;
                        $('#moreBtn').attr('num', num)
                    } else {
                        toastr.info('مورد دیگری یافت نشد');
                        $('#moreBtn').remove()
                    }
                },
                error: function (data) {
                    toastr.error('خطایی رخ داده');
                },
            });
        });
    </script>
@endsection

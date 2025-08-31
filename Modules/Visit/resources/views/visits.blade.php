@extends('home::layouts.master')

@section('title', 'بازدید های صنعتی')

@section('meta')
    <style>
        .karamad-aparat-videos {
            height: 350px !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-title-area">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <h2>بازدیدهای صنعتی مجازی</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title -->


    <section class="shop-area ptb-80">
        <div class="container">
            <div class="row" id="items">

                @foreach($visits as $visit)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-virtual-visit karamad-aparat-videos">
                            <video id="player_270995_19243749" preload="metadata" class="video-js vjs-default-skin"
                                   style="max-width: 100%;" controls="">
                                @if($visit->video)
                                <source src="{{ asset($visit->video) }}" type="video/mp4"
                                        label="Original" selected="">
                                @else
                                    {!! $visit->videoLink !!}
                                @endif
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

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-virtual-visit karamad-aparat-videos">
                        <video id="player_270995_19243749" preload="metadata" class="video-js vjs-default-skin"
                               style="max-width: 100%;" controls="">
                            <source src="https://cdn.yjc.ir/files/fa/news/1403/2/9/19254047_598.mp4" type="video/mp4"
                                    label="Original" selected="">
                        </video>
                        <div class="virtual-visit-content">
                            <h3>کارخانه ساخت لیفتراک</h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-virtual-visit karamad-aparat-videos">
                        <!--<video controls>-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/mp4">-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/ogg">-->
                        <!--</video>-->
                        <style>.h_iframe-aparat_embed_frame {
                                position: relative;
                            }

                            .h_iframe-aparat_embed_frame .ratio {
                                display: block;
                                width: 100%;
                                height: auto;
                            }

                            .h_iframe-aparat_embed_frame iframe {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                            }</style>
                        <div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span>
                            <iframe src="https://www.aparat.com/video/video/embed/videohash/qBxUR/vt/frame"
                                    allowfullscreen="true" webkitallowfullscreen="true"
                                    mozallowfullscreen="true"></iframe>
                        </div>
                        <div class="virtual-visit-content">
                            <h3>بازدید از شرکت فولاد مبارکه</h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-virtual-visit karamad-aparat-videos">
                        <!--<video controls>-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/mp4">-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/ogg">-->
                        <!--</video>-->
                        <style>.h_iframe-aparat_embed_frame {
                                position: relative;
                            }

                            .h_iframe-aparat_embed_frame .ratio {
                                display: block;
                                width: 100%;
                                height: auto;
                            }

                            .h_iframe-aparat_embed_frame iframe {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                            }</style>
                        <div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span>
                            <iframe src="https://www.aparat.com/video/video/embed/videohash/r3RBw/vt/frame"
                                    allowfullscreen="true" webkitallowfullscreen="true"
                                    mozallowfullscreen="true"></iframe>
                        </div>
                        <div class="virtual-visit-content">
                            <h3>نوین پروتئین</h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-virtual-visit karamad-aparat-videos">
                        <!--<video controls>-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/mp4">-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/ogg">-->
                        <!--</video>-->
                        <style>.h_iframe-aparat_embed_frame {
                                position: relative;
                            }

                            .h_iframe-aparat_embed_frame .ratio {
                                display: block;
                                width: 100%;
                                height: auto;
                            }

                            .h_iframe-aparat_embed_frame iframe {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                            }</style>
                        <div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span>
                            <iframe src="https://www.aparat.com/video/video/embed/videohash/OKHPC/vt/frame"
                                    allowfullscreen="true" webkitallowfullscreen="true"
                                    mozallowfullscreen="true"></iframe>
                        </div>
                        <div class="virtual-visit-content">
                            <h3>بهمن دیزل</h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-virtual-visit karamad-aparat-videos">
                        <!--<video controls>-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/mp4">-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/ogg">-->
                        <!--</video>-->
                        <style>.h_iframe-aparat_embed_frame {
                                position: relative;
                            }

                            .h_iframe-aparat_embed_frame .ratio {
                                display: block;
                                width: 100%;
                                height: auto;
                            }

                            .h_iframe-aparat_embed_frame iframe {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                            }</style>
                        <div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span>
                            <iframe src="https://www.aparat.com/video/video/embed/videohash/ePI4Y/vt/frame"
                                    allowfullscreen="true" webkitallowfullscreen="true"
                                    mozallowfullscreen="true"></iframe>
                        </div>
                        <div class="virtual-visit-content">
                            <h3>صنایع غذایی گلها</h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-virtual-visit karamad-aparat-videos">
                        <!--<video controls>-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/mp4">-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/ogg">-->
                        <!--</video>-->
                        <style>.h_iframe-aparat_embed_frame {
                                position: relative;
                            }

                            .h_iframe-aparat_embed_frame .ratio {
                                display: block;
                                width: 100%;
                                height: auto;
                            }

                            .h_iframe-aparat_embed_frame iframe {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                            }</style>
                        <div class="h_iframe-aparat_embed_frame"><span style="display: block;padding-top: 57%"></span>
                            <iframe src="https://www.aparat.com/video/video/embed/videohash/muIvb/vt/frame"
                                    allowfullscreen="true" webkitallowfullscreen="true"
                                    mozallowfullscreen="true"></iframe>
                        </div>
                        <div class="virtual-visit-content">
                            <h3>بازدید از کارخانه نوآوری آزادی</h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-virtual-visit karamad-aparat-videos">
                        <!--<video controls>-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/mp4">-->
                        <!--<source src="https://www.aparat.com/video/video/embed/videohash/Md1bn/vt/frame?isamp" type="video/ogg">-->
                        <!--</video>-->
                        <div id="13933676298">
                            <style>.h_iframe-aparat_embed_frame {
                                    position: relative;
                                }

                                .h_iframe-aparat_embed_frame .ratio {
                                    display: block;
                                    width: 100%;
                                    height: auto;
                                }

                                .h_iframe-aparat_embed_frame iframe {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                }</style>
                            <div class="h_iframe-aparat_embed_frame"><span
                                    style="display: block;padding-top: 57%"></span>
                                <iframe width="100%" height="100%" title="خط تولید لاستیک بارز" allowfullscreen="true"
                                        webkitallowfullscreen="true" mozallowfullscreen="true"
                                        src="https://www.aparat.com/video/video/embed/videohash/Yse4O/vt/frame"></iframe>
                            </div>
                        </div>
                        <div class="virtual-visit-content">
                            <h3>کارخانه لاستیک بارز</h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                    <div class="more-btn">
                        <button type="button" id="moreBtn" url="{{ route('visit.moreVisits') }}" num="1" class="modern-shadow">
                            موارد بیشتر
                        </button>
                    </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $('#moreBtn').click(function (e) {
            $.ajax({
                type: 'POST',
                url: $(this).attr('url'),
                data: {
                    'num': $(this).attr('num'),
                    '_token': "{{ csrf_token() }}",
                },
                success: function (data) {
                    if (data) {
                        $('#items').append(data);
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

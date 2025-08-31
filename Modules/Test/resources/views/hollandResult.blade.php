@extends('home::layouts.master')

@section('title','نتیجه تست هالند')

@section('content')
    <div class="container">
        <div id="testForm">
            <div class="tabResult row mx-0 my-4">
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-tag-multiple c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4>نتیجه تست هالند</h4></div>
                        </div>
                        <div class="chartjs-chart">
                            <canvas id="radar"></canvas>
                        </div>
                        <h4>تیپ های شخصیتی به ترتیب:</h4>
                        <ul>
                            <li class="badge @if(array_keys($scoreArray)[0] == 'واقع گرا') bg-realistic @elseif(array_keys($scoreArray)[0] == 'جستجوگر') bg-investigative @elseif(array_keys($scoreArray)[0] == 'هنری') bg-artistic @elseif(array_keys($scoreArray)[0] == 'اجتمائی') bg-social @elseif(array_keys($scoreArray)[0] == 'متهور') bg-enterprising @elseif(array_keys($scoreArray)[0] == 'قراردادی') bg-conventional @endif"><i class="mdi mdi-account ms-1"></i>{{ array_keys($scoreArray)[0] }} - {{ array_values($scoreArray)[0] }} امتیاز</li>
                            <li class="badge @if(array_keys($scoreArray)[1] == 'واقع گرا') bg-realistic @elseif(array_keys($scoreArray)[1] == 'جستجوگر') bg-investigative @elseif(array_keys($scoreArray)[1] == 'هنری') bg-artistic @elseif(array_keys($scoreArray)[1] == 'اجتمائی') bg-social @elseif(array_keys($scoreArray)[1] == 'متهور') bg-enterprising @elseif(array_keys($scoreArray)[1] == 'قراردادی') bg-conventional @endif"><i class="mdi mdi-account ms-1"></i>{{ array_keys($scoreArray)[1] }} - {{ array_values($scoreArray)[1] }} امتیاز</li>
                            <li class="badge @if(array_keys($scoreArray)[2] == 'واقع گرا') bg-realistic @elseif(array_keys($scoreArray)[2] == 'جستجوگر') bg-investigative @elseif(array_keys($scoreArray)[2] == 'هنری') bg-artistic @elseif(array_keys($scoreArray)[2] == 'اجتمائی') bg-social @elseif(array_keys($scoreArray)[2] == 'متهور') bg-enterprising @elseif(array_keys($scoreArray)[2] == 'قراردادی') bg-conventional @endif"><i class="mdi mdi-account ms-1"></i>{{ array_keys($scoreArray)[2] }} - {{ array_values($scoreArray)[2] }} امتیاز</li>
                        </ul>
                    </div>
                </div>
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-worker c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4>شغل های پیشنهادی</h4></div>
                        </div>
                        @if(array_keys($scoreArray)[0] == 'واقع گرا')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-realistic ms-3" style="font-size: 24px"></i>تیپ شغلی واقع گرا (اشیاگرا): </h6>
                                <span>هر نوع شغلی که مرتبط با ابزار آلات و صنعت و ساخت و ساز باشد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[0] == 'جستجوگر')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-investigative ms-3" style="font-size: 24px"></i>تیپ شغلی جست و جو گر (داده گرا): </h6>
                                <span>هر نوع شغلی که مرتبط به پردازش داده های ریاضی و منطقی است</span>
                            </div>
                        @elseif(array_keys($scoreArray)[0] == 'هنری')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-artistic ms-3" style="font-size: 24px"></i>تیپ شغلی هنری (داده گرا و اشیاگرا): </h6>
                                <span>هر نوع شغلی که منجر به یک نوع خلاقیت و تولید آثار هنری و خلاقانه باشد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[0] == 'اجتمائی')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-social ms-3" style="font-size: 24px"></i>تیپ شغلی اجتمائی (مردم گرا): </h6>
                                <span>هر نوع شغلی که در ارتباط با مردم باشد و شما یک جامعه مردمی باشد (آموزش و رفاه اجتمائی)</span>
                            </div>
                        @elseif(array_keys($scoreArray)[0] == 'متهور')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-enterprising ms-3" style="font-size: 24px"></i>تیپ شغلی متهور (مردم گرا): </h6>
                                <span>هر نوع شغلی که در ارتباط با مردم و مدیریت یک کسب و کار مردمی را دارد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[0] == 'قراردادی')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-conventional ms-3" style="font-size: 24px"></i>تیپ شغلی قراردادی (داده گرا): </h6>
                                <span>هر نوع شغلی که نیازمند یکسری کار های منظم و ریزه کاری در پردازش داده ها باشد</span>
                            </div>
                        @endif
                        @if(array_keys($scoreArray)[1] == 'واقع گرا')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-realistic ms-3" style="font-size: 24px"></i>تیپ شغلی واقع گرا (اشیاگرا): </h6>
                                <span>هر نوع شغلی که مرتبط با ابزار آلات و صنعت و ساخت و ساز باشد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[1] == 'جستجوگر')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-investigative ms-3" style="font-size: 24px"></i>تیپ شغلی جست و جو گر (داده گرا): </h6>
                                <span>هر نوع شغلی که مرتبط به پردازش داده های ریاضی و منطقی است</span>
                            </div>
                        @elseif(array_keys($scoreArray)[1] == 'هنری')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-artistic ms-3" style="font-size: 24px"></i>تیپ شغلی هنری (داده گرا و اشیاگرا): </h6>
                                <span>هر نوع شغلی که منجر به یک نوع خلاقیت و تولید آثار هنری و خلاقانه باشد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[1] == 'اجتمائی')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-social ms-3" style="font-size: 24px"></i>تیپ شغلی اجتمائی (مردم گرا): </h6>
                                <span>هر نوع شغلی که در ارتباط با مردم باشد و شما یک جامعه مردمی باشد (آموزش و رفاه اجتمائی)</span>
                            </div>
                        @elseif(array_keys($scoreArray)[1] == 'متهور')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-enterprising ms-3" style="font-size: 24px"></i>تیپ شغلی متهور (مردم گرا): </h6>
                                <span>هر نوع شغلی که در ارتباط با مردم و مدیریت یک کسب و کار مردمی را دارد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[1] == 'قراردادی')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-conventional ms-3" style="font-size: 24px"></i>تیپ شغلی قراردادی (داده گرا): </h6>
                                <span>هر نوع شغلی که نیازمند یکسری کار های منظم و ریزه کاری در پردازش داده ها باشد</span>
                            </div>
                        @endif
                        @if(array_keys($scoreArray)[2] == 'واقع گرا')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-realistic ms-3" style="font-size: 24px"></i>تیپ شغلی واقع گرا (اشیاگرا): </h6>
                                <span>هر نوع شغلی که مرتبط با ابزار آلات و صنعت و ساخت و ساز باشد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[2] == 'جستجوگر')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-investigative ms-3" style="font-size: 24px"></i>تیپ شغلی جست و جو گر (داده گرا): </h6>
                                <span>هر نوع شغلی که مرتبط به پردازش داده های ریاضی و منطقی است</span>
                            </div>
                        @elseif(array_keys($scoreArray)[2] == 'هنری')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-artistic ms-3" style="font-size: 24px"></i>تیپ شغلی هنری (داده گرا و اشیاگرا): </h6>
                                <span>هر نوع شغلی که منجر به یک نوع خلاقیت و تولید آثار هنری و خلاقانه باشد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[2] == 'اجتمائی')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-social ms-3" style="font-size: 24px"></i>تیپ شغلی اجتمائی (مردم گرا): </h6>
                                <span>هر نوع شغلی که در ارتباط با مردم باشد و شما یک جامعه مردمی باشد (آموزش و رفاه اجتمائی)</span>
                            </div>
                        @elseif(array_keys($scoreArray)[2] == 'متهور')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-enterprising ms-3" style="font-size: 24px"></i>تیپ شغلی متهور (مردم گرا): </h6>
                                <span>هر نوع شغلی که در ارتباط با مردم و مدیریت یک کسب و کار مردمی را دارد</span>
                            </div>
                        @elseif(array_keys($scoreArray)[2] == 'قراردادی')
                            <div>
                                <h6 class="mt-3"><i class="mdi mdi-wunderlist c-conventional ms-3" style="font-size: 24px"></i>تیپ شغلی قراردادی (داده گرا): </h6>
                                <span>هر نوع شغلی که نیازمند یکسری کار های منظم و ریزه کاری در پردازش داده ها باشد</span>
                            </div>
                        @endif
                        <table class="table table-kaarasan table-hover table-responsive mt-4">
                            <thead>
                            <tr>
                                <th colspan="4" class="text-center"> شغل های پیشنهادی</th>
                            </tr>
                            </thead>
                            @php
                                $realisticJobs = ['مهندسی مکانیک','خلبان بالگرد','صنعت کیف و کفش','صنعت نفت و گاز','صنایع مونتاژ','تکنیسین هواپیما'];
                                $investigativeJobs = ['پزشک','فیزیکدان','مهندس  نرم افزار کامپیوتر','ریاضی دان','داروساز','مهندس و برنامه ریز کامپیوتر'];
                                $artisticJobs = ['معمار','موسیقیدان','بازیگر','عکاس','فیلمبردار','گرافیک'];
                                $socialJobs = ['معلم','روان شناس','مددکار اجتمائی','افسر پلیس','مربی مهد کودک','استاد یا مشاور'];
                                $enterprisingJobs = ['مدیریت بازرگانی','مدیر امور بانکی','سیاست مدار','مدیریت منابع انسانی','مدیر تجاری','نماینده مردم'];
                                $conventionalJobs = ['حسابدار','تحلیلگر امور مالیاتی','مسئول دفتر','مدیر دفاتر','ثبت احوال','تحلیل گر بودجه'];
                            @endphp
                            <tbody>
                            <tr>
                                @if(array_keys($scoreArray)[0] == 'واقع گرا')
                                <th class="bg-realistic">{{ $realisticJobs[0] }}</th>
                                <th class="bg-realistic">{{ $realisticJobs[1] }}</th>
                                <th class="bg-realistic">{{ $realisticJobs[2] }}</th>
                                <th class="bg-realistic">{{ $realisticJobs[3] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-realistic">{{ $realisticJobs[4] }}</th>
                                <th class="bg-realistic">{{ $realisticJobs[5] }}</th>
                                @elseif(array_keys($scoreArray)[0] == 'جستجوگر')
                                    <th class="bg-investigative">{{ $investigativeJobs[0] }}</th>
                                    <th class="bg-investigative">{{ $investigativeJobs[1] }}</th>
                                    <th class="bg-investigative">{{ $investigativeJobs[2] }}</th>
                                    <th class="bg-investigative">{{ $investigativeJobs[3] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-investigative">{{ $investigativeJobs[4] }}</th>
                                <th class="bg-investigative">{{ $investigativeJobs[5] }}</th>
                                @elseif(array_keys($scoreArray)[0] == 'هنری')
                                    <th class="bg-artistic">{{ $artisticJobs[0] }}</th>
                                    <th class="bg-artistic">{{ $artisticJobs[1] }}</th>
                                    <th class="bg-artistic">{{ $artisticJobs[2] }}</th>
                                    <th class="bg-artistic">{{ $artisticJobs[3] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-artistic">{{ $artisticJobs[4] }}</th>
                                <th class="bg-artistic">{{ $artisticJobs[5] }}</th>
                                @elseif(array_keys($scoreArray)[0] == 'اجتمائی')
                                    <th class="bg-social">{{ $socialJobs[0] }}</th>
                                    <th class="bg-social">{{ $socialJobs[1] }}</th>
                                    <th class="bg-social">{{ $socialJobs[2] }}</th>
                                    <th class="bg-social">{{ $socialJobs[3] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-social">{{ $socialJobs[4] }}</th>
                                <th class="bg-social">{{ $socialJobs[5] }}</th>
                                @elseif(array_keys($scoreArray)[0] == 'متهور')
                                    <th class="bg-enterprising">{{ $enterprisingJobs[0] }}</th>
                                    <th class="bg-enterprising">{{ $enterprisingJobs[1] }}</th>
                                    <th class="bg-enterprising">{{ $enterprisingJobs[2] }}</th>
                                    <th class="bg-enterprising">{{ $enterprisingJobs[3] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-enterprising">{{ $enterprisingJobs[4] }}</th>
                                <th class="bg-enterprising">{{ $enterprisingJobs[5] }}</th>
                                @elseif(array_keys($scoreArray)[0] == 'قراردادی')
                                    <th class="bg-conventional">{{ $conventionalJobs[0] }}</th>
                                    <th class="bg-conventional">{{ $conventionalJobs[1] }}</th>
                                    <th class="bg-conventional">{{ $conventionalJobs[2] }}</th>
                                    <th class="bg-conventional">{{ $conventionalJobs[3] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-conventional">{{ $conventionalJobs[4] }}</th>
                                <th class="bg-conventional">{{ $conventionalJobs[5] }}</th>
                                @endif
                                @if(array_keys($scoreArray)[1] == 'واقع گرا')
                                    <th class="bg-realistic">{{ $realisticJobs[0] }}</th>
                                    <th class="bg-realistic">{{ $realisticJobs[1] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-realistic">{{ $realisticJobs[2] }}</th>
                                < class="bg-realistic">{{ $realisticJobs[3] }}</th>
                                @elseif(array_keys($scoreArray)[1] == 'جستجوگر')
                                    <th class="bg-investigative">{{ $investigativeJobs[0] }}</th>
                                    <th class="bg-investigative">{{ $investigativeJobs[1] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-investigative">{{ $investigativeJobs[2] }}</th>
                                <th class="bg-investigative">{{ $investigativeJobs[3] }}</th>
                                @elseif(array_keys($scoreArray)[1] == 'هنری')
                                    <th class="bg-artistic">{{ $artisticJobs[0] }}</th>
                                    <th class="bg-artistic">{{ $artisticJobs[1] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-artistic">{{ $artisticJobs[2] }}</th>
                                <th class="bg-artistic">{{ $artisticJobs[3] }}</th>
                                @elseif(array_keys($scoreArray)[1] == 'اجتمائی')
                                    <th class="bg-social">{{ $socialJobs[0] }}</th>
                                    <th class="bg-social">{{ $socialJobs[1] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-social">{{ $socialJobs[2] }}</th>
                                <th class="bg-social">{{ $socialJobs[3] }}</th>
                                @elseif(array_keys($scoreArray)[1] == 'متهور')
                                    <th class="bg-enterprising">{{ $enterprisingJobs[0] }}</th>
                                    <th class="bg-enterprising">{{ $enterprisingJobs[1] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-enterprising">{{ $enterprisingJobs[2] }}</th>
                                <th class="bg-enterprising">{{ $enterprisingJobs[3] }}</th>
                                @elseif(array_keys($scoreArray)[1] == 'قراردادی')
                                    <th class="bg-conventional">{{ $conventionalJobs[0] }}</th>
                                    <th class="bg-conventional">{{ $conventionalJobs[1] }}</th>
                            </tr>
                            <tr>
                                <th class="bg-conventional">{{ $conventionalJobs[2] }}</th>
                                <th class="bg-conventional">{{ $conventionalJobs[3] }}</th>
                                @endif
                                @if(array_keys($scoreArray)[2] == 'واقع گرا')
                                <th class="bg-realistic">{{ $realisticJobs[0] }}</th>
                                <th class="bg-realistic">{{ $realisticJobs[1] }}</th>
                                @elseif(array_keys($scoreArray)[2] == 'جستجوگر')
                                <th class="bg-investigative">{{ $investigativeJobs[0] }}</th>
                                <th class="bg-investigative">{{ $investigativeJobs[1] }}</th>
                                @elseif(array_keys($scoreArray)[2] == 'هنری')
                                <th class="bg-artistic">{{ $artisticJobs[0] }}</th>
                                <th class="bg-artistic">{{ $artisticJobs[1] }}</th>
                                @elseif(array_keys($scoreArray)[2] == 'اجتمائی')
                                <th class="bg-social">{{ $socialJobs[0] }}</th>
                                <th class="bg-social">{{ $socialJobs[1] }}</th>
                                @elseif(array_keys($scoreArray)[2] == 'متهور')
                                <th class="bg-enterprising">{{ $enterprisingJobs[0] }}</th>
                                <th class="bg-enterprising">{{ $enterprisingJobs[1] }}</th>
                                @elseif(array_keys($scoreArray)[2] == 'قراردادی')
                                <th class="bg-conventional">{{ $conventionalJobs[0] }}</th>
                                <th class="bg-conventional">{{ $conventionalJobs[1] }}</th>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 col-lg-8 col-md-10 my-4 text-center">

                    </div>
                </div>

                <a href="{{ route('home') }}" class="btn bg-first-100">برگشت به صفحه اصلی</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/libs/chart-js/Chart.bundle.min.js') }}"></script>
    <script>
        const radar = document.getElementById('radar');
        const data = {
            labels: {!! json_encode(array_keys($scoreArray),JSON_UNESCAPED_UNICODE) !!},
            datasets: [{
                label: 'تایپ شخصیتی',
                data: {{ json_encode(array_values($scoreArray)) }},
                fill: true,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                pointBackgroundColor: 'rgb(255, 99, 132)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 99, 132)'
            }]
        };
        new Chart(radar, {
            type: 'radar',
            data: data,
            options: {
                elements: {
                    line: {
                        borderWidth: 3
                    }
                }
            },
        });
    </script>
    <script>
        function updateSegmentOpacities(score) {
            const text = document.querySelector('text#text');
            const segments = document.querySelectorAll("#chart-iq path");
            segments.forEach((segment) => {
                const segmentValue = parseInt(segment.getAttribute("data-value"), 10);
                segment.setAttribute("fill-opacity", score >= segmentValue ? 1 : 0.15);
            });

            text.textContent = score;
        }

        const score = parseInt(
            document.getElementById("chart-iq").getAttribute("data-score"),
            10
        );
        updateSegmentOpacities(score);

    </script>
@endsection

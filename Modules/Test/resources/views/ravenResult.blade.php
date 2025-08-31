@extends('home::layouts.master')

@section('title','نتیجه تست ریون')

@section('content')
    <div class="container">
        <div id="testForm">
            <div class="tabResult row mx-0 my-4">
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-tag-multiple c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4>نتیجه تست ریون</h4></div>
                        </div>
                    </div>
                    <div class="col-12 row mx-0 mt-3 justify-content-center">
                        <svg
                            id="chart-iq"
                            class="col-lg-4 col-md-6 col-12"
                            viewBox="0 0 340 242"
                            xmlns="http://www.w3.org/2000/svg"
                            data-score="{{ $scoreArray['score'] }}"
                        >
                            <path
                                data-value="164"
                                d="M326.694 178.347C332.993 178.607 337.483 184.56 336.002 190.688L326.732 229.046C325.237 235.23 318.423 238.465 312.687 235.713L268.435 214.488C264.18 212.447 261.931 207.71 263.039 203.123L265.602 192.52L267.667 183.976C268.788 179.338 273.03 176.138 277.798 176.334L326.694 178.347Z"
                                fill="#2ABB9C"
                                fill-opacity="0.15"
                            ></path>
                            <path
                                data-value="148"
                                d="M317.702 114.608C323.598 112.375 330.064 116.089 331.106 122.307L337.627 161.227C338.679 167.502 333.68 173.15 327.324 172.87L278.293 170.708C273.578 170.5 269.651 167.024 268.871 162.37L267.068 151.612L265.616 142.943C264.827 138.237 267.474 133.629 271.937 131.939L317.702 114.608Z"
                                fill="#2ABB9C"
                                fill-opacity="0.15"
                            ></path>
                            <path
                                data-value="132"
                                d="M283.911 61.8612C288.407 57.4412 295.821 58.2338 299.281 63.5043L320.938 96.4934C324.429 101.812 322.132 108.996 316.202 111.302L270.459 129.087C266.06 130.797 261.065 129.2 258.475 125.255L252.489 116.136L247.665 108.788C245.046 104.799 245.611 99.5148 249.014 96.1692L283.911 61.8612Z"
                                fill="#2ABB9C"
                                fill-opacity="0.15"
                            ></path>
                            <path
                                data-value="120"
                                d="M232.999 25.7546C235.509 19.9711 242.679 17.9252 247.863 21.5134L280.311 43.9729C285.542 47.5939 286.107 55.1151 281.474 59.4763L245.74 93.1187C242.304 96.3535 237.074 96.746 233.194 94.0601L224.225 87.8523L216.998 82.8495C213.074 80.1335 211.616 75.0234 213.516 70.6458L232.999 25.7546Z"
                                fill="#2ABB9C"
                                fill-opacity="1"
                            ></path>
                            <path
                                data-value="110"
                                d="M172.699 13.1569C172.764 6.8525 178.575 2.18027 184.747 3.47133L223.373 11.5523C229.6 12.8552 233.044 19.5655 230.471 25.3844L210.623 70.2713C208.715 74.5873 204.049 76.9817 199.429 76.0153L188.753 73.7817L180.149 71.9817C175.478 71.0045 172.149 66.863 172.197 62.0911L172.699 13.1569Z"
                                fill="#FFB647"
                                fill-opacity="1"
                            ></path>
                            <path
                                data-value="90"
                                d="M112.223 23.7141C109.815 17.8874 113.335 11.3134 119.519 10.0862L158.226 2.40516C164.467 1.16678 170.262 5.99417 170.172 12.3559L169.475 61.43C169.408 66.1487 166.051 70.1783 161.423 71.0968L150.724 73.2199L142.102 74.9308C137.421 75.8597 132.736 73.3517 130.913 68.9413L112.223 23.7141Z"
                                fill="#FFB647"
                                fill-opacity="1"
                            ></path>
                            <path
                                data-value="68"
                                d="M60.0595 57.5735C55.5879 53.129 56.2947 45.7059 61.5249 42.1853L94.2615 20.1491C99.5395 16.5963 106.749 18.8106 109.123 24.7135L127.436 70.2481C129.197 74.6264 127.657 79.6398 123.743 82.275L114.694 88.3659L107.402 93.2744C103.443 95.9392 98.1531 95.4354 94.7684 92.0714L60.0595 57.5735Z"
                                fill="#FFB647"
                                fill-opacity="1"
                            ></path>
                            <path
                                data-value="52"
                                d="M25.811 107.7C19.9998 105.255 17.8739 98.1078 21.404 92.8841L43.4997 60.1876C47.0621 54.9161 54.5765 54.2677 58.9891 58.8511L93.0286 94.2076C96.3016 97.6073 96.7524 102.832 94.1101 106.742L88.0028 115.78L83.081 123.063C80.409 127.017 75.3155 128.532 70.917 126.681L25.811 107.7Z"
                                fill="#F00073"
                                fill-opacity="1"
                            ></path>
                            <path
                                data-value="36"
                                d="M13.3388 167.523C7.03443 167.464 2.35733 161.656 3.64321 155.484L11.6918 116.851C12.9894 110.622 19.6969 107.173 25.5179 109.741L70.4214 129.551C74.7391 131.456 77.1374 136.12 76.1749 140.74L73.9502 151.418L72.1574 160.024C71.1841 164.695 67.0454 168.029 62.2735 167.984L13.3388 167.523Z"
                                fill="#F00073"
                                fill-opacity="1"
                            ></path>
                            <path
                                data-value="0"
                                d="M25.4295 230.08C19.6768 232.66 13.0011 229.337 11.5909 223.192L2.76404 184.73C1.34092 178.528 5.99412 172.593 12.3557 172.494L61.4289 171.733C66.1475 171.66 70.275 174.896 71.3305 179.495L73.7703 190.127L75.7365 198.694C76.8039 203.345 74.4361 208.103 70.0818 210.055L25.4295 230.08Z"
                                fill="#F00073"
                                fill-opacity="1"
                            ></path>
                            <!-- Display score in the center -->
                            <text
                                x="170"
                                y="120"
                                text-anchor="middle"
                                font-size="24"
                                fill="#000"
                                style="
                transform: translateY(70px);
                font-size: 40px;
                font-family: IRANYekanXFaNum;
                font-weight: 900;
              "
                                id="text"
                            >
                                {{ $scoreArray['score'] }}
                            </text>
                            <text
                                x="170"
                                y="140"
                                text-anchor="middle"
                                font-size="16"
                                fill="#333"
                                style="
                transform: translateY(90px);
                font-size: 18px;
                font-weight: 700;
              "
                            >
                                ضریب هوشی
                            </text>
                        </svg>
                    <p class="mt-3 text-justify">
                        تست هوش ریون یک نمره به بهره هوشی می دهد و نمره ای که به تست تعلق گرفته است {{ $scoreArray['score'] }} می باشد. در ادامه وضعیت طبقه بندی در دست های مختلف هوشی اعلام می شود
                    </p>
                    </div>
                    <div class="row col-12 mx-0 justify-content-center mt-4">
                        <div class="col-6 justify-content-center text-center">
                            <div class="col-12 justify-content-center text-center">
                                <i class="mdi mdi-calendar-check-outline" style="font-size: 40px;color: limegreen"></i>
                            </div>تعداد پاسخ های درست: {{ $scoreArray['correct'] }}
                        </div>
                        <div class="col-6 justify-content-center text-center">
                            <div class="col-12 justify-content-center text-center">
                                <i class="mdi mdi-calendar-remove-outline" style="font-size: 40px;color: darkred"></i>
                            </div>تعداد پاسخ های نادرست: {{ $scoreArray['wrong'] }}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pe-0">
                <div class="boxResult">
                    <ul class="correct">
                        <li><i class="mdi mdi-alpha-e-box"></i>تعداد پاسخ درست به سوالات آسان: {{ $scoreArray['easy'] }}</li>
                        <li><i class="mdi mdi-alpha-m-box"></i>تعداد پاسخ درست به سوالات متوسط: {{ $scoreArray['medium'] }}</li>
                        <li><i class="mdi mdi-alpha-h-box"></i>تعداد پاسخ درست به سوالات سخت: {{ $scoreArray['hard'] }}</li>
                    </ul>
                </div>
                </div>
                <div class="col-12 col-md-6 ps-0">
                <div class="boxResult">
                    <ul class="wrong">
                        <li><i class="mdi mdi-alpha-e-box"></i>تعداد پاسخ نادرست به سوالات آسان: {{ (20-$scoreArray['easy']) }}</li>
                        <li><i class="mdi mdi-alpha-m-box"></i>تعداد پاسخ نادرست به سوالات متوسط: {{ (20-$scoreArray['medium']) }}</li>
                        <li><i class="mdi mdi-alpha-h-box"></i>تعداد پاسخ نادرست به سوالات سخت: {{ (20-$scoreArray['hard']) }}</li>
                    </ul>
                </div>
                </div>
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-brain c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4>طبقه بندی هوش</h4></div>
                        </div>
                        <p class="mt-2">بر اساس طبقه بندی تست هوش ریون، هوش افراد در ۷ وضعیت قرار می گیرد و اکثر افراد در طبقه ۴م قرار می گیرند. همانطور که در جدول مشاهده می کنید، طبقه این تست نیز با رنگ سبز در جدول مشخص شده است</p>
                    </div>
                    <div class="col-12 col-lg-8 col-md-10 my-4 text-center">
                        <table class="table table-kaarasan table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>طبقه هوش</th>
                                <th>درصد جمعیت</th>
                                <th>بهره هوشی</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            if ($scoreArray['score'] > 130) {
                                $same = 2.1;
                                $up = 99.99;
                            } elseif ($scoreArray['score'] >= 121) {
                                $same = 6.4;
                                $up = 100 - (2.1);
                            } elseif ($scoreArray['score'] >= 111) {
                                $same = 15.7;
                                $up = 100 - (6.4+2.1);
                            } elseif ($scoreArray['score'] >= 90) {
                                $same = 51.6;
                                $up = 100 - (15.7+6.4+2.1);
                            } elseif ($scoreArray['score'] >= 80) {
                                $same = 13.7;
                                $up = 100 - (51.6+15.7+6.4+2.1);
                            } elseif ($scoreArray['score'] >= 70) {
                                $same = 6.4;
                                $up = 100 - (13.7+51.6+15.7+6.4+2.1);
                            } else {
                                $same = 4.1;
                                $up = 100 - (6.4+13.7+51.6+15.7+6.4+2.1);
                            }
                            @endphp
                            <tr @if($scoreArray['score'] > 130) class="active" @endif>
                                <th>سرآمد</th>
                                <th>2.1%</th>
                                <th>130 و بالاتر</th>
                            </tr>
                            <tr @if($scoreArray['score'] >= 121 && $scoreArray['score'] <= 130) class="active" @endif>
                                <th>بالا</th>
                                <th>6.4%</th>
                                <th>121 - 130</th>
                            </tr>
                            <tr @if($scoreArray['score'] >= 111 && $scoreArray['score'] <= 120) class="active" @endif>
                                <th>متوسط به بالا</th>
                                <th>15.7%</th>
                                <th>111 - 120</th>
                            </tr>
                            <tr @if($scoreArray['score'] >= 90 && $scoreArray['score'] <= 110) class="active" @endif>
                                <th>متوسط</th>
                                <th>51.6%</th>
                                <th>90 - 110</th>
                            </tr>
                            <tr @if($scoreArray['score'] >= 80 && $scoreArray['score'] <= 89) class="active" @endif>
                                <th>متوسط پایین</th>
                                <th>13.7%</th>
                                <th>80 - 89</th>
                            </tr>
                            <tr @if($scoreArray['score'] >= 70 && $scoreArray['score'] <= 79) class="active" @endif>
                                <th>مرزی</th>
                                <th>6.4%</th>
                                <th>70 - 79</th>
                            </tr>
                            <tr @if($scoreArray['score'] < 70 ) class="active" @endif>
                                <th>بسیار ضعیف</th>
                                <th>4.1%</th>
                                <th>زیر 70</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-chart-bell-curve c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4> هوش شما در نمودار نرمال </h4></div>
                        </div>
                        <p class="mt-3 text-justify">
                            نمودار نرمال در تست هوش معمولاً توسط متخصصین برای تعیین وضعیت هوش
                            افراد مورد استفاده قرار می گیرد. جایگاه شما در این نمودار به
                            روانشناسان کمک می کند تا تشخیص دهند که هوش شما از چند درصد افراد
                            بیشتر و از چند درصد آن ها کمتر است. همچنین با استفاده از این نمودار
                            آن ها می توانند جایگاه یا فاصله نمره شما را از میانگین جامعه مشخص
                            نمایند.
                        </p>
                    </div>
                <div class="col-12 mt-5 justify-content-center text-center">
                    <div class="chart-z mt-4 mb-5 ms-auto me-auto w-75">
                        <div class="back">
                            <img width="100%"
                                src="{{ asset('assets-front/img/tests/chart.png') }}"
                                alt=""
                            />
                            <div class="progress-v" style="width: {{ ceil((($scoreArray['score']-36)*100)/128) }}%"></div>
                        </div>
                        <div class="front">
                            <div
                                class="value"
                                style="bottom: calc(100% - (1.8 * 24%)); left: {{ ceil((($scoreArray['score']-36)*100)/128) }}%"
                            >
                                {{ ceil((($scoreArray['score']-36)*100)/128) }} %
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-earth c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"> <h4> هوش شما در مقایسه با سایر کشور ها </h4></div>
                        </div>
                        <p class="mt-2">در این بخش میانگین بهره هوشی مردم کشور های مختلف بر اساس آمار سال 2021 سازمان گزارش های جمعیت شناختی را آوردیم که می توانید خود را با مردم دیگر کشور ها مقایسه کنید</p>
                    </div>
                    <div class="col-12 col-lg-6 col-md-9 my-4 text-center">
                        <table class="table table-kaarasan table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>نام کشور</th>
                                <th>میانگین هوشی</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>امریکا</th>
                                    <th>97.43</th>
                                </tr>
                                <tr>
                                    <th>استرالیا</th>
                                    <th>99.24</th>
                                </tr>
                                <tr>
                                    <th>ژاپن</th>
                                    <th>106.48</th>
                                </tr>
                                <tr>
                                    <th>چین</th>
                                    <th>104.1</th>
                                </tr>
                                <tr>
                                    <th>آلمان</th>
                                    <th>100.74</th>
                                </tr>
                                <tr>
                                    <th>عربستان</th>
                                    <th>76.36</th>
                                </tr>
                                <tr>
                                    <th>فرانسه</th>
                                    <th>96.69</th>
                                </tr>
                                <tr>
                                    <th>افریقا جنوبی</th>
                                    <th>68.78</th>
                                </tr>
                                <tr>
                                    <th>برزیل</th>
                                    <th>83.38</th>
                                </tr>
                                <tr>
                                    <th>کانادا</th>
                                    <th>99.52</th>
                                </tr>
                                <tr>
                                    <th>هند</th>
                                    <th>76.24</th>
                                </tr>
                                <tr>
                                    <th>ترکیه</th>
                                    <th>86.8</th>
                                </tr>
                                <tr>
                                    <th>مصر</th>
                                    <th>76.32</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-details c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4> برداشت نهایی </h4></div>
                        </div>
                        @if ($scoreArray['score'] > 130) {
                        <p>افرادی که در این دسته قرار می‌گیرند، دارای توانایی‌های تحلیلی، منطقی و خلاقانه بسیار بالایی هستند. آنها معمولاً در حل مسائل پیچیده و درک مفاهیم انتزاعی توانمند هستند. این افراد اغلب در زمینه‌های تحصیلی و حرفه‌ای موفقیت‌های زیادی کسب می‌کنند و می‌توانند به راحتی در مشاغل و زمینه‌های نیازمند تفکر عمیق و خلاقیت رشد کنند.</p>
                        @elseif ($scoreArray['score'] >= 121)
                        <p>افراد با نمرات در این محدوده، هوشی بالاتر از حد متوسط دارند و معمولاً درک مفاهیم و حل مسائل را به خوبی انجام می‌دهند. این افراد در محیط‌های تحصیلی و حرفه‌ای عملکرد بسیار خوبی دارند و می‌توانند به راحتی با چالش‌های فکری روبرو شوند. این دسته از افراد توانایی‌های تحلیلی و منطقی قوی دارند و معمولاً در مشاغل فنی و مدیریتی موفق هستند.</p>
                        @elseif ($scoreArray['score'] >= 111)
                        <p>افرادی که نمراتشان در این محدوده قرار می‌گیرد، هوشی بالاتر از حد متوسط دارند. آنها می‌توانند به خوبی مفاهیم را درک کرده و مسائل را حل کنند. این افراد در محیط‌های تحصیلی و حرفه‌ای عملکرد خوبی دارند و می‌توانند با مشکلات و چالش‌های روزمره به خوبی مقابله کنند. توانایی‌های تحلیلی و منطقی این افراد نیز بالاست و معمولاً در مشاغل فنی و مدیریتی موفق هستند.</p>
                        @elseif ($scoreArray['score'] >= 90)
                        <p>این دسته شامل افرادی است که هوش آنها در حد متوسط است. این افراد توانایی‌های مناسبی در درک مفاهیم و حل مسائل روزمره دارند. آنها می‌توانند به خوبی در محیط‌های تحصیلی و حرفه‌ای عملکرد مناسبی داشته باشند. اگرچه ممکن است نیاز به تلاش بیشتری برای حل مسائل پیچیده داشته باشند، اما می‌توانند با تمرین و آموزش مناسب در زمینه‌های مختلف پیشرفت کنند.</p>
                        @elseif ($scoreArray['score'] >= 80)
                        <p>افرادی که در این دسته قرار می‌گیرند، هوشی کمتر از حد متوسط دارند. آنها ممکن است در درک مفاهیم و حل مسائل روزمره با چالش‌های بیشتری مواجه شوند. این افراد نیاز به پشتیبانی و آموزش بیشتری دارند تا بتوانند مهارت‌های خود را تقویت کنند و در محیط‌های تحصیلی و حرفه‌ای عملکرد بهتری داشته باشند.</p>
                        @elseif ($scoreArray['score'] >= 70)
                        <p>افرادی که نمراتشان در این محدوده است، دارای هوشی در مرز پایین قرار دارند. این افراد ممکن است در درک و حل مسائل روزمره با دشواری‌های زیادی مواجه شوند. آنها نیاز به پشتیبانی و آموزش گسترده‌تری دارند تا بتوانند مهارت‌های خود را تقویت کنند و در فعالیت‌های روزمره موفق باشند.</p>
                        @else
                        <p>افرادی که در این دسته قرار می‌گیرند، هوشی بسیار پایین دارند و در بسیاری از زمینه‌ها نیاز به پشتیبانی و کمک مستمر دارند. آنها ممکن است در مواجهه با مسائل روزمره و فعالیت‌های روزانه به کمک نیاز داشته باشند و نیاز به برنامه‌های آموزشی و حمایتی ویژه‌ای داشته باشند تا بتوانند مهارت‌های خود را تقویت کنند و به استقلال نسبی دست یابند.</p>
                        @endif
                    </div>
                    <div class="col-12 col-md-6 text-center">

                        <div class="chartjs-chart">
                            <canvas id="pie" width="400" height="200"></canvas>
                        </div>
                        <span class="mt-4">شما از چند درصد مردم باهوش تر هستید؟!</span>
                    </div>
                    <div class="col-12 col-md-6 text-center">

                        <div class="chartjs-chart">
                            <canvas id="pie2" width="400" height="200"></canvas>
                        </div>
                        <span class="mt-4">چند درصد مردم هوش نزدیک به شما دارند؟!</span>
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
        const ctx = document.getElementById('pie');
        const data = {
            labels: ['درصد','باقی افراد'],
            datasets: [
                {
                    label: 'Dataset 1',
                    data: [{{ $up }},{{ 100-$up }}],
                    backgroundColor: [
                        '#64a7db','#cfcfcf',
                    ],
                }
            ]
        };
        new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Pie Chart'
                    }
                }
            },
        });
        const ctx2 = document.getElementById('pie2');
        const data2 = {
            labels: ['درصد','باقی افراد'],
            datasets: [
                {
                    label: 'Dataset 1',
                    data: [{{ $same }},{{ 100-$same }}],
                    backgroundColor: [
                        '#64a7db','#cfcfcf',
                    ],
                }
            ]
        };
        new Chart(ctx2, {
            type: 'doughnut',
            data: data2,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Pie Chart'
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

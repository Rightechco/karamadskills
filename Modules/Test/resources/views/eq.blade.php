@extends('home::layouts.master')

@section('title','آزمون هوش هیجانی')
<meta name="description" content="آزمون هوش هیجانی )EQ )به شما کمک می کند تا تواناییهای خود در شناخت
و مدیریت احساسات، برقراری روابط اجتماعی موثر، و مدیریت استرس را ارزیابی
کنید . با انجام این آزمون، نقاط قوت و ضعف خود را در مولفه های مختلف هوش
هیجانی بشناسید و برای بهبود و توسعه مهارتهای شخصی و اجتماعی خود
تالش کنید . ">
<meta name="keywords" content="آزمون هوش هیجانی">
@section('content')
    <div class="container p-0">
        <form id="testForm" action="{{ route('test.eqStore') }}" method="post">
            @csrf
            <div class="row mx-0 justify-content-center justify-content-md-between justify-content-lg-between">
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 col-md-6 col-lg-3">
                        <img class="w-100" src="{{ asset('assets-front/img/tests/rave_pic.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-9">
                        <h1 class="my-3">تست هوش هیجانی</h1>
                        <span class="small c-gray-300">تست هوش هیجانی EQ</span>
                    </div>
                    <div class="col-12 test-content">
                        <p class="my-2">سالهاست  تصور می شد که هوش افراد (IQ) ، موفقیت آنان را در زندگی تعیین می کند. مدارس برای ثبت نام دانش آموزان در برنامه های مختلف و همچنین شرکت ها و کافرمایان برای انتخاب افراد، از آزمون IQ استفاده می کردند . ولی در ده سال اخیر، محققان دریافته اند که IQ تنها شاخص موفقیت افراد نیست. اکنون توجه به سمت هیجانی (EQ)  است که به عنوان شاخص دیگر موفقیت افراد محسوب می شود.
                            هوش هیجانی، نوع دیگر با هوش بودن است وشامل درک احساسات خود برای تصمیم گیری مناسب در زندگی است. EQ توانایی کنترل حالت های اضطراب آور و کنترل واکنشهاست. این به معنی پرانگیزه و امیدوار بودن به کار و رسیدن به اهداف است. به طور کلی EQ ، یک مهارت اجتماعی است و شامل همکاری با سایرمردم، کاربرد احساسات در روابط و توانایی رهبری سایر  افراد می باشد.
                        </p>

                        <p class="my-2">با توجه به اهمیت هوش هیجانی در زندگی ، لزوم دسترسی به ابزار سنجش مناسبی در این زمینه وجود دارد که متناسب با فرهنگ و جامعۀ ایرانی قابل کاربرد باشد. در این زمینه، ضمن جستجو در منابع اطلاعاتی، پرسشنامه هوش هیجانی بار–اُن، به دلیل جامعیت، سادگی، تنوع سؤالات و نابستگی به فرهنگ غیر ایرانی، انتخاب گردید. این پرسشنامه در مورد میزان هوش غیر شناختی (هیجانی، شخصی و اجتماعی ) گزارش می دهد. و در محیط های آموزشی، صنعتی، بالینی و طبی قابل کاربرد است. سازنده معتقد است مقیاس های هوش هیجانی، وقتی با نمرات هوشبهر شناختی بکار رود، شاخص بهتری از هوش عمومی و متعاقباً موفقیت بالقوۀ فرد در زندگی می باشد .</p>
                    </div>
                    @if(!auth()->check())
                        <small class="text-danger">وارد کردن نام و شماره موبایل الزامی می باشد</small>
                        <input type="text" name="name" class="form-control my-2" placeholder="نام خود را وارد کنید">
                        <input type="text" name="mobile" class="form-control my-2" placeholder="شماره خود را وارد کنید">
                    @else
                        <input type="hidden" name="mobile" value="">
                    @endif
                    @if($errors->any())
                        {!! implode('', $errors->all('<small id="sh-text1" class="form-text text-danger mb-1">:message</small>')) !!}
                    @endif
                    <button type="button" class="btn btn-block bg-first-100 next"
                            @if(!auth()->check()) disabled="disabled" @endif onclick="nextPrev(2,this)">شروع آزمون
                    </button>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به نظر من برای غلبه بر مشکلات باید گام به گام پیش رفت.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[1]" id="radio1-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio1-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[1]" id="radio1-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio1-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[1]" id="radio1-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio1-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[1]" id="radio1-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio1-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[1]" id="radio1-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio1-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">لذت بردن از زندگی برایم مشکل است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[2]" id="radio2-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio2-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[2]" id="radio2-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio2-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[2]" id="radio2-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio2-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[2]" id="radio2-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio2-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[2]" id="radio2-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio2-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            شغلی را ترجیح می دهم که حتی الامکان من تصمیم گیرنده باشم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[3]" id="radio3-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio3-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[3]" id="radio3-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio3-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[3]" id="radio3-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio3-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[3]" id="radio3-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio3-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[3]" id="radio3-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio3-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            می توانم بدون تنش زیاد، با مشکلات مقابله کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[4]" id="radio4-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio4-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[4]" id="radio4-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio4-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[4]" id="radio4-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio4-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[4]" id="radio4-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio4-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[4]" id="radio4-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio4-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            می توانم برای معنی دادن به زندگی تا حد امکان تلاش کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[5]" id="radio5-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio5-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[5]" id="radio5-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio5-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[5]" id="radio5-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio5-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[5]" id="radio5-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio5-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[5]" id="radio5-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio5-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">نسبت به هیجاناتم آگاهم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[6]" id="radio6-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio6-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[6]" id="radio6-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio6-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[6]" id="radio6-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio6-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[6]" id="radio6-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio6-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[6]" id="radio6-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio6-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 7 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            سعی می کنم بدون خیال پردازی ، واقعیت امور را در نظر بگیرم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[7]" id="radio7-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio7-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[7]" id="radio7-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio7-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[7]" id="radio7-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio7-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[7]" id="radio7-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio7-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[7]" id="radio7-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio7-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 8 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به راحتی با دیگران دوست می شوم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[8]" id="radio8-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio8-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[8]" id="radio8-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio8-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[8]" id="radio8-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio8-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[8]" id="radio8-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio8-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[8]" id="radio8-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio8-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 9 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            معتقدم توانایی تسلط بر شرایط دشوار را دارم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[9]" id="radio9-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio9-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[9]" id="radio9-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio9-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[9]" id="radio9-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio9-3">تاحدودی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[9]" id="radio9-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio9-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[9]" id="radio9-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio9-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 10 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">بیشتر مواقع به خودم اطمینان دارم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[10]" id="radio10-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio10-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[10]" id="radio10-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio10-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[10]" id="radio10-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio10-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[10]" id="radio10-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio10-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[10]" id="radio10-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio10-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 11 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کنترل خشم برایم مشکل است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[11]" id="radio11-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio11-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[11]" id="radio11-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio11-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[11]" id="radio11-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio11-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[11]" id="radio11-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio11-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[11]" id="radio11-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio11-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 12 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">شروع دوباره ، برایم سخت است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[12]" id="radio12-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio12-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[12]" id="radio12-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio12-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[12]" id="radio12-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio12-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[12]" id="radio12-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio12-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[12]" id="radio12-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio12-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 13 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کمک کردن به دیگران را دوست دارم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[13]" id="radio13-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio13-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[13]" id="radio13-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio13-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[13]" id="radio13-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio13-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[13]" id="radio13-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio13-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[13]" id="radio13-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio13-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 14 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به خوبی می توانم احساسات دیگران را درک کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[14]" id="radio14-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio14-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[14]" id="radio14-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio14-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[14]" id="radio14-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio14-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[14]" id="radio14-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio14-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[14]" id="radio14-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio14-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 15 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگامی که از دیگران خشمگین می شوم ، نمی توانم با آنها در این
                            مورد صحبت کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[15]" id="radio15-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio15-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[15]" id="radio15-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio15-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[15]" id="radio15-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio15-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[15]" id="radio15-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio15-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[15]" id="radio15-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio15-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 16 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام رویارویی با یک موقعیت دشوار، دوست دارم تا حد ممکن در مورد
                            آن اطلاعات جمع آوری کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[16]" id="radio16-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio16-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[16]" id="radio16-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio16-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[16]" id="radio16-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio16-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[16]" id="radio16-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio16-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[16]" id="radio16-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio16-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 17 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">خندیدن برایم سخت است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[17]" id="radio17-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio17-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[17]" id="radio17-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio17-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[17]" id="radio17-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio17-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[17]" id="radio17-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio17-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[17]" id="radio17-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio17-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 18 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام کار کردن با دیگران بیشتر پیرو افکار آنها هستم تا فکر خودم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[18]" id="radio18-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio18-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[18]" id="radio18-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio18-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[18]" id="radio18-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio18-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[18]" id="radio18-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio18-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[18]" id="radio18-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio18-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 19 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            می توانم به خوبی فشارها را تحمل کنم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[19]" id="radio19-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio19-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[19]" id="radio19-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio19-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[19]" id="radio19-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio19-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[19]" id="radio19-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio19-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[19]" id="radio19-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio19-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 20 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            در چند سال گذشته کمتر کاری را به نتیجه رسانده ام
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[20]" id="radio20-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio20-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[20]" id="radio20-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio20-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[20]" id="radio20-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio20-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[20]" id="radio20-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio20-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[20]" id="radio20-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio20-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 21 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به سختی می توانم احساسات عمیقم را با دیگران در میان بگذارم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[21]" id="radio21-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio21-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[21]" id="radio21-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio21-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[21]" id="radio21-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio21-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[21]" id="radio21-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio21-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[21]" id="radio21-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio21-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 22 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            دیگران نمی فهمند که من چه فکری دارم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[22]" id="radio22-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio22-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[22]" id="radio22-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio22-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[22]" id="radio22-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio22-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[22]" id="radio22-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio22-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[22]" id="radio22-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio22-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 23 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به خوبی با دیگران همراهی می کنم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[23]" id="radio23-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio23-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[23]" id="radio23-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio23-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[23]" id="radio23-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio23-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[23]" id="radio23-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio23-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[23]" id="radio23-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio23-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 24 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به اغلب کارهایی که می کنم خوش بین هستم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[24]" id="radio24-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio24-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[24]" id="radio24-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio24-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[24]" id="radio24-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio24-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[24]" id="radio24-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio24-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[24]" id="radio24-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio24-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 25 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">برای خودم احترام قائل هستم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[25]" id="radio25-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio25-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[25]" id="radio25-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio25-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[25]" id="radio25-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio25-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[25]" id="radio25-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio25-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[25]" id="radio25-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio25-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 26 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">عصبی بودنم مشکل ایجاد می کند</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[26]" id="radio26-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio26-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[26]" id="radio26-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio26-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[26]" id="radio26-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio26-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[26]" id="radio26-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio26-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[26]" id="radio26-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio26-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 27 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به سختی می توانم فکرم را در مورد مسائل تغییر دهم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[27]" id="radio27-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio27-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[27]" id="radio27-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio27-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[27]" id="radio27-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio27-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[27]" id="radio27-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio27-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[27]" id="radio27-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio27-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 28 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            کمک به دیگران ، مرا کسل نمی کند، به خصوص اگر شایستگی آن را داشته
                            باشند
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[28]" id="radio28-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio28-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[28]" id="radio28-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio28-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[28]" id="radio28-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio28-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[28]" id="radio28-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio28-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[28]" id="radio28-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio28-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 29 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            دوستانم می توانند مسائل خصوصی خودشان را با من در میان بگذارند
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[29]" id="radio29-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio29-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[29]" id="radio29-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio29-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[29]" id="radio29-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio29-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[29]" id="radio29-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio29-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[29]" id="radio29-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio29-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 30 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            می توانم مخالفتم را با دیگران ابراز نمایم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[30]" id="radio30-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio30-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[30]" id="radio30-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio30-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[30]" id="radio30-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio30-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[30]" id="radio30-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio30-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[30]" id="radio30-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio30-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 31 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام مواجهه با یک مشکل ، اولین کاری که انجام می دهم دست نگه
                            داشتن و فکر کردن است.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[31]" id="radio31-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio31-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[31]" id="radio31-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio31-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[31]" id="radio31-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio31-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[31]" id="radio31-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio31-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[31]" id="radio31-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio31-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 32 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">فرد با نشاطی هستم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[32]" id="radio32-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio32-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[32]" id="radio32-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio32-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[32]" id="radio32-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio32-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[32]" id="radio32-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio32-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[32]" id="radio32-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio32-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 33 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            ترجیح می دهم دیگران برایم تصمیم بگیرند
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[33]" id="radio33-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio33-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[33]" id="radio33-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio33-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[33]" id="radio33-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio33-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[33]" id="radio33-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio33-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[33]" id="radio33-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio33-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 34 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            احساس می کنم کنترل اضطراب برایم مشکل است
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[34]" id="radio34-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio34-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[34]" id="radio34-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio34-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[34]" id="radio34-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio34-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[34]" id="radio34-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio34-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[34]" id="radio34-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio34-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 35 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            از کارهایی که انجام می دهم راضی نیستم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[35]" id="radio35-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio35-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[35]" id="radio35-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio35-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[35]" id="radio35-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio35-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[35]" id="radio35-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio35-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[35]" id="radio35-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio35-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 36 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به سختی می فهمم چه احساسی دارم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[36]" id="radio36-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio36-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[36]" id="radio36-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio36-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[36]" id="radio36-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio36-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[36]" id="radio36-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio36-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[36]" id="radio36-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio36-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 37 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            تمایل دارم با آنچه در اطرافم می گذرد روبرو نشوم و از برخورد با
                            آنها طفره می روم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[37]" id="radio37-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio37-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[37]" id="radio37-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio37-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[37]" id="radio37-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio37-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[37]" id="radio37-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio37-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[37]" id="radio37-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio37-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 38 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            روابط صمیمی با دوستانم برای هر دو طرف مان اهمیت دارد
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[38]" id="radio38-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio38-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[38]" id="radio38-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio38-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[38]" id="radio38-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio38-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[38]" id="radio38-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio38-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[38]" id="radio38-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio38-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 39 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            حتی در موقعیت های دشوار، معمولا برای ادامه کار انگیزه دارم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[39]" id="radio39-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio39-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[39]" id="radio39-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio39-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[39]" id="radio39-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio39-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[39]" id="radio39-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio39-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[39]" id="radio39-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio39-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 40 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            نمی توانم خودم را این طور که هستم بپذیرم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[40]" id="radio40-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio40-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[40]" id="radio40-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio40-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[40]" id="radio40-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio40-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[40]" id="radio40-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio40-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[40]" id="radio40-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio40-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 41 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            دیگران به من می گویند هنگام بحث آرام تر صحبت کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[41]" id="radio41-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio41-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[41]" id="radio41-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio41-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[41]" id="radio41-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio41-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[41]" id="radio41-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio41-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[41]" id="radio41-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio41-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 42 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به آسانی با شرایط جدید سازگار می شوم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[42]" id="radio42-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio42-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[42]" id="radio42-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio42-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[42]" id="radio42-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio42-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[42]" id="radio42-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio42-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[42]" id="radio42-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio42-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 43 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به کودک گمشده فکر می کنم ، حتی اگر همان موقع جای دیگری کار داشته
                            باشم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[43]" id="radio43-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio43-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[43]" id="radio43-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio43-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[43]" id="radio43-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio43-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[43]" id="radio43-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio43-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[43]" id="radio43-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio43-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 44 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به اتفاقی که برای دیگران می افتد توجه دارم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[44]" id="radio44-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio44-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[44]" id="radio44-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio44-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[44]" id="radio44-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio44-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[44]" id="radio44-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio44-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[44]" id="radio44-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio44-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 45 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">نه گفتن برایم مشکل است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[45]" id="radio45-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio45-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[45]" id="radio45-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio45-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[45]" id="radio45-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio45-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[45]" id="radio45-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio45-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[45]" id="radio45-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio45-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 46 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام تلاش برای حل یک مشکل، راه حل های ممکن را در نظر می آورم،
                            سپس بهترین را انتخاب می کنم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[46]" id="radio46-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio46-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[46]" id="radio46-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio46-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[46]" id="radio46-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio46-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[46]" id="radio46-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio46-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[46]" id="radio46-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio46-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 47 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">از زندگی ام راضی ام.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[47]" id="radio47-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio47-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[47]" id="radio47-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio47-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[47]" id="radio47-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio47-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[47]" id="radio47-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio47-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[47]" id="radio47-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio47-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 48 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">تصمیم گیری برایم مشکل است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[48]" id="radio48-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio48-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[48]" id="radio48-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio48-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[48]" id="radio48-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio48-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[48]" id="radio48-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio48-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[48]" id="radio48-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio48-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 49 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            می دانم در شرایط دشوار، چگونه آرامشم را حفظ کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[49]" id="radio49-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio49-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[49]" id="radio49-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio49-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[49]" id="radio49-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio49-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[49]" id="radio49-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio49-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[49]" id="radio49-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio49-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 50 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هیچ چیز در من علاقه ایجاد نمی کند</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[50]" id="radio50-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio50-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[50]" id="radio50-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio50-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[50]" id="radio50-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio50-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[50]" id="radio50-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio50-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[50]" id="radio50-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio50-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 51 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">از احساسی که دارم آگاهم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[51]" id="radio51-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio51-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[51]" id="radio51-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio51-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[51]" id="radio51-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio51-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[51]" id="radio51-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio51-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[51]" id="radio51-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio51-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 52 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            در تصورات و خیال پردازی هایم غرق می شوم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[52]" id="radio52-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio52-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[52]" id="radio52-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio52-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[52]" id="radio52-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio52-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[52]" id="radio52-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio52-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[52]" id="radio52-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio52-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 53 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">با دیگران رابطه خوبی دارم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[53]" id="radio53-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio53-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[53]" id="radio53-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio53-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[53]" id="radio53-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio53-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[53]" id="radio53-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio53-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[53]" id="radio53-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio53-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 54 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            معمولاً انتظار دارم، مشکلات به خوبی ختم شوند، هر چند گاهی این
                            طور نمی شود.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[54]" id="radio54-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio54-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[54]" id="radio54-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio54-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[54]" id="radio54-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio54-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[54]" id="radio54-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio54-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[54]" id="radio54-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio54-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 55 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">از اندام و ظاهر خود راضی هستم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[55]" id="radio55-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio55-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[55]" id="radio55-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio55-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[55]" id="radio55-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio55-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[55]" id="radio55-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio55-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[55]" id="radio55-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio55-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 56 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کم صبر هستم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[56]" id="radio56-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio56-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[56]" id="radio56-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio56-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[56]" id="radio56-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio56-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[56]" id="radio56-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio56-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[56]" id="radio56-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio56-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 57 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            می توانم عادات قبلی ام را تغییر دهم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[57]" id="radio57-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio57-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[57]" id="radio57-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio57-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[57]" id="radio57-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio57-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[57]" id="radio57-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio57-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[57]" id="radio57-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio57-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 58 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            اگر لازم باشد با زیر پا گذاشتن قانون از موقعیتی فرار کنم، این
                            کار را انجام می دهم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[58]" id="radio58-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio58-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[58]" id="radio58-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio58-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[58]" id="radio58-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio58-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[58]" id="radio58-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio58-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[58]" id="radio58-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio58-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 59 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">نسبت به احساسات دیگران حساس هستم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[59]" id="radio59-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio59-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[59]" id="radio59-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio59-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[59]" id="radio59-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio59-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[59]" id="radio59-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio59-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[59]" id="radio59-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio59-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 60 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            می توانم به راحتی افکارم را با دیگران بگویم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[60]" id="radio60-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio60-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[60]" id="radio60-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio60-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[60]" id="radio60-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio60-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[60]" id="radio60-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio60-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[60]" id="radio60-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio60-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 61 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام حل کردن، به سختی می توانم در مورد انتخاب بهترین راه حل
                            تصمیم گیری کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[61]" id="radio61-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio61-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[61]" id="radio61-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio61-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[61]" id="radio61-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio61-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[61]" id="radio61-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio61-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[61]" id="radio61-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio61-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 62 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">اهل شوخی هستم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[62]" id="radio62-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio62-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[62]" id="radio62-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio62-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[62]" id="radio62-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio62-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[62]" id="radio62-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio62-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[62]" id="radio62-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio62-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 63 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            در انجام کارها و امور مختلف به دیگران وابسته ام
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[63]" id="radio63-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio63-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[63]" id="radio63-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio63-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[63]" id="radio63-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio63-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[63]" id="radio63-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio63-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[63]" id="radio63-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio63-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 64 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            رویارویی با مسائل ناخوشایند برایم مشکل است
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[64]" id="radio64-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio64-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[64]" id="radio64-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio64-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[64]" id="radio64-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio64-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[64]" id="radio64-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio64-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[64]" id="radio64-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio64-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 65 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            حتی الامکان کارهایی را به عهده می گیرم که برایم لذت بخش است
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[65]" id="radio65-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio65-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[65]" id="radio65-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio65-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[65]" id="radio65-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio65-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[65]" id="radio65-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio65-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[65]" id="radio65-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio65-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 66 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            حتی هنگام آشفتگی، از آنچه در من اتفاق می افتد آگاهم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[66]" id="radio66-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio66-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[66]" id="radio66-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio66-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[66]" id="radio66-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio66-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[66]" id="radio66-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio66-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[66]" id="radio66-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio66-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 67 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">تمایل به مبالغه گویی دارم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[67]" id="radio67-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio67-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[67]" id="radio67-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio67-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[67]" id="radio67-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio67-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[67]" id="radio67-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio67-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[67]" id="radio67-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio67-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 68 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به نظر دیگران من فردی اجتماعی هستم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[68]" id="radio68-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio68-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[68]" id="radio68-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio68-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[68]" id="radio68-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio68-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[68]" id="radio68-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio68-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[68]" id="radio68-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio68-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 69 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به توانایی ام برای مقابله با دشوارترین مسائل اطمینان دارم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[69]" id="radio69-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio69-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[69]" id="radio69-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio69-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[69]" id="radio69-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio69-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[69]" id="radio69-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio69-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[69]" id="radio69-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio69-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 70 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">از شیوه نگرش و فکرم راضی هستم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[70]" id="radio70-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio70-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[70]" id="radio70-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio70-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[70]" id="radio70-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio70-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[70]" id="radio70-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio70-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[70]" id="radio70-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio70-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 71 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">بد جوری خشمگین می شوم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[71]" id="radio71-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio71-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[71]" id="radio71-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio71-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[71]" id="radio71-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio71-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[71]" id="radio71-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio71-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[71]" id="radio71-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio71-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 72 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            معمولاً تغییر ایجاد کردن در زندگی روزانه برایم سخت است
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[72]" id="radio72-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio72-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[72]" id="radio72-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio72-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[72]" id="radio72-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio72-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[72]" id="radio72-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio72-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[72]" id="radio72-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio72-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 73 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            قادر هستم احترام به دیگران را حفظ کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[73]" id="radio73-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio73-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[73]" id="radio73-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio73-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[73]" id="radio73-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio73-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[73]" id="radio73-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio73-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[73]" id="radio73-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio73-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 74 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">دیدن رنج دیگران برایم سخت است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[74]" id="radio74-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio74-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[74]" id="radio74-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio74-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[74]" id="radio74-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio74-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[74]" id="radio74-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio74-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[74]" id="radio74-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio74-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 75 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به نظر دیگران من نمی توانم احساسات و افکارم را بروز دهم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[75]" id="radio75-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio75-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[75]" id="radio75-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio75-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[75]" id="radio75-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio75-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[75]" id="radio75-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio75-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[75]" id="radio75-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio75-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 76 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام روبرو شدن با شرایط دشوار، سعی می کنم در مورد راه حل های
                            ممکن فکر کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[76]" id="radio76-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio76-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[76]" id="radio76-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio76-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[76]" id="radio76-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio76-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[76]" id="radio76-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio76-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[76]" id="radio76-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio76-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 77 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">افسرده هستم.</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[77]" id="radio77-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio77-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[77]" id="radio77-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio77-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[77]" id="radio77-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio77-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[77]" id="radio77-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio77-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[77]" id="radio77-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio77-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 78 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            فکر می کنم به دیگران بیشتر احتیاج دارم، تا دیگران به من
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[78]" id="radio78-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio78-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[78]" id="radio78-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio78-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[78]" id="radio78-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio78-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[78]" id="radio78-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio78-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[78]" id="radio78-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio78-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 79 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مضطرب هستم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[79]" id="radio79-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio79-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[79]" id="radio79-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio79-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[79]" id="radio79-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio79-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[79]" id="radio79-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio79-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[79]" id="radio79-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio79-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 80 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            در مورد آنچه می خواهم در زندگی انجام دهم فکر مشخص و خوبی ندارم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[80]" id="radio80-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio80-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[80]" id="radio80-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio80-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[80]" id="radio80-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio80-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[80]" id="radio80-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio80-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[80]" id="radio80-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio80-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 81 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به سختی می توانم از امور برداشت صحیحی داشته باشم.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[81]" id="radio81-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio81-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[81]" id="radio81-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio81-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[81]" id="radio81-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio81-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[81]" id="radio81-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio81-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[81]" id="radio81-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio81-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 82 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به سختی می توانم احساساتم را بیان کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[82]" id="radio82-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio82-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[82]" id="radio82-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio82-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[82]" id="radio82-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio82-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[82]" id="radio82-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio82-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[82]" id="radio82-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio82-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 83 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            با دوستانم رابطه صمیمی بر قرار می کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[83]" id="radio83-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio83-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[83]" id="radio83-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio83-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[83]" id="radio83-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio83-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[83]" id="radio83-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio83-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[83]" id="radio83-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio83-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 84 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            قبل از شروع کارهای جدید، معمولاً احساس می کنم شکست خواهم خورد
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[84]" id="radio84-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio84-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[84]" id="radio84-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio84-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[84]" id="radio84-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio84-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[84]" id="radio84-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio84-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[84]" id="radio84-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio84-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 85 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام بررسی نقاط ضعف و قوتم، باز هم احساس خوبی در مورد خودم دارم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[85]" id="radio85-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio85-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[85]" id="radio85-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio85-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[85]" id="radio85-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio85-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[85]" id="radio85-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio85-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[85]" id="radio85-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio85-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 86 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام عصبانیت زود از کوره در می روم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[86]" id="radio86-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio86-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[86]" id="radio86-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio86-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[86]" id="radio86-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio86-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[86]" id="radio86-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio86-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[86]" id="radio86-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio86-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 87 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            اگر مجبور به ترک وطنم باشم، سازگاری برایم دشوار خواهد بود
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[87]" id="radio87-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio87-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[87]" id="radio87-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio87-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[87]" id="radio87-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio87-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[87]" id="radio87-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio87-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[87]" id="radio87-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio87-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 88 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            به نظر من پایبندی یک شهروند به قانون مهم است.
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[88]" id="radio88-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio88-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[88]" id="radio88-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio88-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[88]" id="radio88-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio88-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[88]" id="radio88-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio88-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[88]" id="radio88-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio88-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 89 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            از جریحه دار کردن احساسات دیگران خودداری می کنم
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[89]" id="radio89-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio89-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[89]" id="radio89-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio89-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[89]" id="radio89-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio89-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[89]" id="radio89-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio89-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[89]" id="radio89-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio89-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <!-- 90 -->
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مشکل می توانم از حق خودم دفاع کنم</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[90]" id="radio90-1"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-1"
                        />
                        <label class="custom-control-label" for="radio90-1"
                        >کاملا موافقم</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[90]" id="radio90-2"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-2"
                        />
                        <label class="custom-control-label" for="radio90-2">موافقم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[90]" id="radio90-3"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-3"
                        />
                        <label class="custom-control-label" for="radio90-3"
                        >تاحدودی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[90]" id="radio90-4"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-4"
                        />
                        <label class="custom-control-label" for="radio90-4">مخالفم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio"
                            name="kh[90]" id="radio90-5"
                            class="custom-control-input"
                            onclick="nextPrev(1,this)"
                            value="kh-5"
                        />
                        <label class="custom-control-label" for="radio90-5"
                        >کاملا مخالفم</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1 justify-content-center">
                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-center py-2">
                        <p>سوالات به پایان رسید!</p>
                        <p>هزینه قابل پرداخت: <span class="badge bg-first-200 my-2">@if(config('tests.eq')) {{ number_format(config('tests.eq')) }} تومان@else رایگان @endif</span>
                        </p>
                        <button type="submit" class="btn bg-first-100">پرداخت و مشاهده نتیجه</button>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-2 mx-0">
                    <div class="box">
                        <i class="mdi mdi-chart-bar"></i>
                        <span class="badge bg-first-100">تعداد انجام: {{ $countEq }}</span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-clock-outline"></i>
                        <span class="badge bg-first-100">زمان: <span class="timer">20:00</span></span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-calendar-question"></i>
                        <span class="questionCounter badge bg-first-100">تعداد سوال:
                        <span class="answeredCount">0</span><span class="totalCount">/90</span>
                        </span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-account-check"></i>
                        <span class="badge bg-first-100">نوجوان - جوان</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $('input[type="checkbox"]').click(function () {
            $(this).parent().parent().find(".next").prop("disabled", false);
        });

        $('input[type="radio"]').click(function () {
            $(this).parent().parent().find(".next").prop("disabled", false);
        });

        $('input[name="mobile"]').click(function () {
            $(this).parent().find(".next").prop("disabled", false);
        });

        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "flex";
            if (n != 0) {
                $('.answeredCount').text(n);
                if (n == 1) {
                    var timer2 = "20:00";
                    var interval = setInterval(function () {
                        var timer = timer2.split(':');
                        var minutes = parseInt(timer[0], 10);
                        var seconds = parseInt(timer[1], 10);
                        --seconds;
                        minutes = (seconds < 0) ? --minutes : minutes;
                        if (minutes < 0) clearInterval(interval);
                        seconds = (seconds < 0) ? 59 : seconds;
                        seconds = (seconds < 10) ? '0' + seconds : seconds;
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        $('.timer').html(minutes + ':' + seconds);
                        timer2 = minutes + ':' + seconds;
                    }, 1000);
                    setTimeout(function () {
                        testTimeOut();
                    }, 1200000);
                }
            }
        }

        function nextPrev(n, event) {
            if (n == 1){
                $(event).parent().css({'background-color':'#64a7db'});
            }
            $(event).attr('checked', 'checked');
            setTimeout(function(){
                var x = document.getElementsByClassName("tab");
                x[currentTab].style.display = "none";
                currentTab = currentTab + 1;
                if (currentTab >= x.length) {
                    document.getElementById("testForm").submit();
                    return false;
                }
                showTab(currentTab);
            }, 500);
        }

        function testTimeOut() {
            swal.fire({
                icon: 'warning',
                title: 'زمان آزمون به پایان رسید',
                text: '',
                showCancelButton: true,
                cancelButtonText: 'شروع دوباره',
                confirmButtonText: 'پایان آزمون'
            }).then(function (result) {
                if (result.value) {
                    $('#testForm').submit();
                } else {
                    location.reload();
                }
                console.log(result)
            })
        }
    </script>
@endsection

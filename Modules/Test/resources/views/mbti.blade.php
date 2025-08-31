@extends('home::layouts.master')

@section('title','آزمون شخصیت شناسی MBTI')
<meta name="description" content="MBTiیکی از محبوب ترین آزمون های شخصیت شناسی است که به افراد کمک
می کند تا بدانند چه نوع شخصیتی دارند و چگونه می توانند با دیگران بهتر
همخوشی کنند .">
<meta name="keywords" content="آزمون شخصیت شناسی MBTI">
@section('content')
    <div class="container p-0">
        <form id="testForm" action="{{ route('test.mbtiStore') }}" method="post">
            @csrf
            <div class="row mx-0 justify-content-center justify-content-md-between justify-content-lg-between">
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 col-md-6 col-lg-3">
                        <img class="w-100" src="{{ asset('assets-front/img/tests/rave_pic.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-9">
                        <h1 class="my-3">تست MBTI</h1>
                        <span class="small c-gray-300">تست MBTI (مایرز بریگز)</span>
                    </div>
                    <div class="col-12 test-content">
                        <p class="my-2">آیا تابه حال شنیده‌اید که شخصی خود را به عنوان یک INTJ یا ESTP توصیف کرده باشد و شما معنی آن را ندانید؟ آنچه که این افراد می گویند، نوع شخصیت آن‌ها بر اساس شاخص تست مایرز-بریگز یا به اختصار، تست MBTI است.

                            تست MBTI، یک پرسش‌نامه روان‌سنجی فردی است که برای شناسایی نوع شخصیت، نقاط قوت و اولویت‌های افراد طراحی شده است. این تست توسط ایزابل مایرز (Isabel Myers) و مادرش کاترین بریگز (Katherine Briggs) و بر اساس کارشان بر روی تئوری کارل یونگ (Carl Jung) درمورد انواع شخصیت تهیه شده است.

                            امروزه، تست MBTI به‌عنوان یکی از از پرکاربردترین ابزارهای روان‌شناسی در دنیا شناخته می‌شود.</p>
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
                    <button type="button" class="btn btn-block bg-first-100 next" @if(!auth()->check()) disabled="disabled" @endif onclick="nextPrev(2,this)">شروع آزمون</button>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا شناختن شما؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio1-1" checked="checked"
                            class="custom-control-input"
                            name="radio1"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio1-1"
                        >آسان است؟</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio1-2"
                            class="custom-control-input"
                            name="radio1"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio1-2"
                        >دشوار است؟</label
                        >
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio2-1" checked="checked"
                            class="custom-control-input"
                            name="radio2"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio2-1"
                        >با هر کسی تا حدی که الزام میدانید به راحتی صحبت میکنید؟</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio2-2"
                            class="custom-control-input"
                            name="radio2"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio2-2"
                        >فقط با افراد خاصی آن هم در شرایط خاصی میتوانید زیاد صحبت
                            کنید؟</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">شما معمولا؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio3-1" checked="checked"
                            class="custom-control-input"
                            name="radio3"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio3-1"
                        >زود جوش هستید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio3-2"
                            class="custom-control-input"
                            name="radio3"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio3-2"
                        >آرام و درون گرا هستید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">روابط دوستانه شما</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio4-1" checked="checked"
                            class="custom-control-input"
                            name="radio4"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio4-1">
                            با افرادی معدود ولی عمیق است</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio4-2"
                            class="custom-control-input"
                            name="radio4"
                            value="e0"
                        />
                        <label class="custom-control-label" for="radio4-2">
                            با تعداد بسیاری از افراد ولی سطحی است</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">میتوانید به طور نامحدود</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio5-1" checked="checked"
                            class="custom-control-input"
                            name="radio5"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio5-1"
                        >فقط با کسانی که علاقه مشترکی با شما دارند صحبت کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio5-2"
                            class="custom-control-input"
                            name="radio5"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio5-2">
                            میتوانید تقریبا با هر کسی صحبت کنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">در صحبت کردن با دوستانتان</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio6-1" checked="checked"
                            class="custom-control-input"
                            name="radio6"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio6-1"
                        >گاهی مسائل شخصی را به طور خصوصی به آنان میگویید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio6-2"
                            class="custom-control-input"
                            name="radio6"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio6-2">
                            تقریبا هرگز چیزی را که نمی خواهید بگویید بیان نمیکنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا معمولا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio7-1" checked="checked"
                            class="custom-control-input"
                            name="radio7"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio7-1">
                            آزادانه احساسات خود را نشان میدهید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio7-2"
                            class="custom-control-input"
                            name="radio7"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio7-2">
                            احساسات خود را نشان نمیدهید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">وقتی غریبه ها به شما توجه می کنند</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio8-1" checked="checked"
                            class="custom-control-input"
                            name="radio8"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio8-1"
                        >احساس ناراحتی میکنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio8-2"
                            class="custom-control-input"
                            name="radio8"
                            value="e0"
                        />
                        <label class="custom-control-label" for="radio8-2"
                        >اصلا ناراحت نمیشوید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا عادت دارید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio9-1" checked="checked"
                            class="custom-control-input"
                            name="radio9"
                            value="i0"
                        />
                        <label class="custom-control-label" for="radio9-1">
                            به هیچ کس اعتماد نکنید یا حداکثر به یک نفر اعتماد کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio9-2"
                            class="custom-control-input"
                            name="radio9"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio9-2"
                        >تعدادی دوست دارید که به آنها اعتماد میکنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio10-1" checked="checked"
                            class="custom-control-input"
                            name="radio10"
                            value="e0"
                        />
                        <label class="custom-control-label" for="radio10-1"
                        >فکر میکنید همه ی کسانی را که دوست دارید میدانند که دوستشان
                            دارید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio10-2"
                            class="custom-control-input"
                            name="radio10"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio10-2"
                        >به بعضی افراد علاقه مند هستید بی آنکه بگذارید آنها
                            بدانند</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            وقتی با گروهی از افراد هستید معمولا ترجیح میدهید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio11-1" checked="checked"
                            class="custom-control-input"
                            name="radio11"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio11-1">
                            به صحبت گروهی بپردازید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio11-2"
                            class="custom-control-input"
                            name="radio11"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio11-2"
                        >هر بار فقط با یک فرد صحبت کنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">در بین دوستانتان آیا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio12-1" checked="checked"
                            class="custom-control-input"
                            name="radio12"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio12-1"
                        >یکی از آخرین کسانی هستید که خبرها را میشنوید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio12-2"
                            class="custom-control-input"
                            name="radio12"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio12-2"
                        >همه نوع خبری در مورد هر کسی دارید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">در یک محفل اجتماعی</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio13-1" checked="checked"
                            class="custom-control-input"
                            name="radio13"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio13-1"
                        >سعی میکنید کسی را که دوست دارید با او صحبت کنید و به گوشه ای
                            بکشید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio13-2"
                            class="custom-control-input"
                            name="radio13"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio13-2"
                        >با گروه میجوشید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">در میهمانیها</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio14-1" checked="checked"
                            class="custom-control-input"
                            name="radio14"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio14-1"
                        >گاهی کسل میشوید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio14-2"
                            class="custom-control-input"
                            name="radio14"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio14-2"
                        >همیشه به شما خوش میگذرد</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio15-1" checked="checked"
                            class="custom-control-input"
                            name="radio15"
                            value="e0"
                        />
                        <label class="custom-control-label" for="radio15-1">
                            صحبت کردن</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio15-2"
                            class="custom-control-input"
                            name="radio15"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio15-2"> نوشتن</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio16-1" checked="checked"
                            class="custom-control-input"
                            name="radio16"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio16-1">آرام</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio16-2"
                            class="custom-control-input"
                            name="radio16"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio16-2">
                            سرزنده</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio17-1" checked="checked"
                            class="custom-control-input"
                            name="radio17"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio17-1"> ساکت</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio17-2"
                            class="custom-control-input"
                            name="radio17"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio17-2">
                            پر حرف</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">در یک مهمانی دوست دارید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio18-1" checked="checked"
                            class="custom-control-input"
                            name="radio18"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio18-1">
                            کاری کنید که مراسم به خوبی برگزار شود</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio18-2"
                            class="custom-control-input"
                            name="radio18"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio18-2">
                            میگذارید هر کسی به میل خودش خوش بگذراند</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگامی که با گروهی از دوستان نزدیک خودتان هستید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio19-1" checked="checked"
                            class="custom-control-input"
                            name="radio19"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio19-1"
                        >بیشتر از بقیه صحبت میکنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio19-2"
                            class="custom-control-input"
                            name="radio19"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio19-2"
                        >کمتر از بقیه</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">در یک گروه بزرگ اغلب</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio20-1" checked="checked"
                            class="custom-control-input"
                            name="radio20"
                            value="e2"
                        />
                        <label class="custom-control-label" for="radio20-1">
                            دیگران را معرفی میکنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio20-2"
                            class="custom-control-input"
                            name="radio20"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio20-2">
                            معرفی میشوید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            زمانی که در مورد یک پیشامد فکر میکنید ترجیح میدهید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio21-1" checked="checked"
                            class="custom-control-input"
                            name="radio21"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio21-1">
                            در این مورد با شخصی صحبت کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio21-2"
                            class="custom-control-input"
                            name="radio21"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio21-2"
                        >در مورد آن خوب فکر میکنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            آیا افرادی که تازه با شما آشنا میشوند میتوانند بگویند به چه
                            علاقه دارید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio22-1" checked="checked"
                            class="custom-control-input"
                            name="radio22"
                            value="e0"
                        />
                        <label class="custom-control-label" for="radio22-1"
                        >خیلی سریع</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio22-2"
                            class="custom-control-input"
                            name="radio22"
                            value="i0"
                        />
                        <label class="custom-control-label" for="radio22-2">
                            تنها پس از آنکه شما را خوب شناختند</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا معمولا منظورتان</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio23-1" checked="checked"
                            class="custom-control-input"
                            name="radio23"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio23-1">
                            بیشتر از آنچه میگویید میباشد</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio23-2"
                            class="custom-control-input"
                            name="radio23"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio23-2"
                        >کمتر از آنچه میگویید است</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">وقتی که غریبه ها را ملاقات میکنید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio24-1" checked="checked"
                            class="custom-control-input"
                            name="radio24"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio24-1"
                        >برایتان خوشایند یا دست کم راحت است</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio24-2"
                            class="custom-control-input"
                            name="radio24"
                            value="i2"
                        />
                        <label class="custom-control-label" for="radio24-2">
                            زحمت زیادی برایتان دارد</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            وقتی در جلسه ای راجع به چیزی نظری دارید که باید گفته شود
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio25-1" checked="checked"
                            class="custom-control-input"
                            name="radio25"
                            value="e1"
                        />
                        <label class="custom-control-label" for="radio25-1"
                        >آن را مطرح میکنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio25-2"
                            class="custom-control-input"
                            name="radio25"
                            value="i1"
                        />
                        <label class="custom-control-label" for="radio25-2">
                            در مورد گفتن آن تردید دارید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            ترجیح میدهید در نظر مردم چگونه باشید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio26-1" checked="checked"
                            class="custom-control-input"
                            name="radio26"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio26-1"
                        >فردی اهل عمل</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio26-2"
                            class="custom-control-input"
                            name="radio26"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio26-2">
                            فردی مبتکر و خالق</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هنگام مطالعه با هدف سرگرم شدن آیا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio27-1" checked="checked"
                            class="custom-control-input"
                            name="radio27"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio27-1">
                            از شیوه ی بیان عجیب و ابتکاری مطالب لذت می برید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio27-2"
                            class="custom-control-input"
                            name="radio27"
                            value="s1"
                        />
                        <label class="custom-control-label" for="radio27-2"
                        >نویسندگانی را دوست دارید که به روشنی منظور خود را
                            میرسانید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">اگر معلم بودید ترجیح میدادید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio28-1" checked="checked"
                            class="custom-control-input"
                            name="radio28"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio28-1"
                        >واقعیت ها را تدریس کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio28-2"
                            class="custom-control-input"
                            name="radio28"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio28-2"
                        >نظریه ها را شرح دهید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            معمولا با کدام شخص راحت تر ارتباط برقرار میکنید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio29-1" checked="checked"
                            class="custom-control-input"
                            name="radio29"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio29-1">
                            با فردی تخیلی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio29-2"
                            class="custom-control-input"
                            name="radio29"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio29-2"
                        >با فردی واقع بین</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            در انجام کاری که بسیاری از مردم انجام میدهند ترجیح میدهید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio30-1" checked="checked"
                            class="custom-control-input"
                            name="radio30"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio30-1">
                            آن را به شیوه ی پذیرفته شده انجام دهید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio30-2"
                            class="custom-control-input"
                            name="radio30"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio30-2"
                        >روش خاص خود را برای انجام آن ابداع کنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">درشیوه ی زندگی تان ترجیح می دهید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio31-1" checked="checked"
                            class="custom-control-input"
                            name="radio31"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio31-1"
                        >متفاوت باشید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio31-2"
                            class="custom-control-input"
                            name="radio31"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio31-2"
                        >متعارف عمل کنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio32-1" checked="checked"
                            class="custom-control-input"
                            name="radio32"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio32-1">عبارت</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio32-2"
                            class="custom-control-input"
                            name="radio32"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio32-2"> مفهوم</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio33-1" checked="checked"
                            class="custom-control-input"
                            name="radio33"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio33-1"> ساختن</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio33-2"
                            class="custom-control-input"
                            name="radio33"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio33-2">
                            اختراع کردن</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio34-1" checked="checked"
                            class="custom-control-input"
                            name="radio34"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio34-1"> واقعی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio34-2"
                            class="custom-control-input"
                            name="radio34"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio34-2"
                        >انتزاعی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio35-1" checked="checked"
                            class="custom-control-input"
                            name="radio35"
                            value="s1"
                        />
                        <label class="custom-control-label" for="radio35-1"> حروفی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio35-2"
                            class="custom-control-input"
                            name="radio35"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio35-2">
                            ارقامی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio36-1" checked="checked"
                            class="custom-control-input"
                            name="radio36"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio36-1"> تولید</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio36-2"
                            class="custom-control-input"
                            name="radio36"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio36-2">طراحی</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio37-1" checked="checked"
                            class="custom-control-input"
                            name="radio37"
                            value="s1"
                        />
                        <label class="custom-control-label" for="radio37-1">علامت</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio37-2"
                            class="custom-control-input"
                            name="radio37"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio37-2">نماد</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio38-1" checked="checked"
                            class="custom-control-input"
                            name="radio38"
                            value="s1"
                        />
                        <label class="custom-control-label" for="radio38-1"> پذیرش</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio38-2"
                            class="custom-control-input"
                            name="radio38"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio38-2"> تغییر</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio39-1" checked="checked"
                            class="custom-control-input"
                            name="radio39"
                            value="s0"
                        />
                        <label class="custom-control-label" for="radio39-1"
                        >شناخته شده</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio39-2"
                            class="custom-control-input"
                            name="radio39"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio39-2">
                            ناشناخته</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio40-1" checked="checked"
                            class="custom-control-input"
                            name="radio40"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio40-1"
                        >واقعیت ها</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio40-2"
                            class="custom-control-input"
                            name="radio40"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio40-2"
                        >ایده ها</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio41-1" checked="checked"
                            class="custom-control-input"
                            name="radio41"
                            value="s0"
                        />
                        <label class="custom-control-label" for="radio41-1">
                            زیربنا</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio41-2"
                            class="custom-control-input"
                            name="radio41"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio41-2"> روبنا</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio42-1" checked="checked"
                            class="custom-control-input"
                            name="radio42"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio42-1"> نظریه</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio42-2"
                            class="custom-control-input"
                            name="radio42"
                            value="s0"
                        />
                        <label class="custom-control-label" for="radio42-2"> تجربه</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio43-1" checked="checked"
                            class="custom-control-input"
                            name="radio43"
                            value="n1"
                        />
                        <label class="custom-control-label" for="radio43-1"> مایع</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio43-2"
                            class="custom-control-input"
                            name="radio43"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio43-2"> جامد</label>
                    </div>

                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام یک تمجید بیشتری از یک فرد است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio44-1" checked="checked"
                            class="custom-control-input"
                            name="radio44"
                            value="n2"
                        />
                        <label class="custom-control-label" for="radio44-1">
                            بصیرت دارد</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio44-2"
                            class="custom-control-input"
                            name="radio44"
                            value="s2"
                        />
                        <label class="custom-control-label" for="radio44-2"
                        >عقل سلیم دارد</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            اگر بخواهید در همسایگی خود برای مسائلی مانند کمک به کمیته امداد
                            به جمع آوری اعانه بپردازید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio45-1" checked="checked"
                            class="custom-control-input"
                            name="radio45"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio45-1"
                        >درخواست شما خالصه و تجاری است</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio45-2"
                            class="custom-control-input"
                            name="radio45"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio45-2"
                        >دوستانه و اجتماعی است</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            کدام گزاره تعریف و تمجید بیشتری از شما به شمار میآید؟
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio46-1" checked="checked"
                            class="custom-control-input"
                            name="radio46"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio46-1">
                            شخصی با احساسات واقعی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio46-2"
                            class="custom-control-input"
                            name="radio46"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio46-2">
                            شخصی همیشه منطقی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا در تصمیم گیری، بیشتر</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio47-1" checked="checked"
                            class="custom-control-input"
                            name="radio47"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio47-1">
                            قلبتان بر عقلتان غلبه دارد</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio47-2"
                            class="custom-control-input"
                            name="radio47"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio47-2">
                            عقلتان بر قلبتان</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هنگام گفتگو بیشتر تمایل دارید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio48-1" checked="checked"
                            class="custom-control-input"
                            name="radio48"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio48-1"
                        >تمجید کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio48-2"
                            class="custom-control-input"
                            name="radio48"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio48-2">
                            سرزنش کنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            احساس میکنید که کدام یک عیب بدتری به شمار می آید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio49-1" checked="checked"
                            class="custom-control-input"
                            name="radio49"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio49-1">
                            همدردی نکردن</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio49-2"
                            class="custom-control-input"
                            name="radio49"
                            value="t0"
                        />
                        <label class="custom-control-label" for="radio49-2">
                            استدلال پذیر نبودن</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            اگر بخواهید عمل خاصی را انجام دهید کدام یک از این دو گزاره
                            برایتان جالب تر بنظر می آید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio50-1" checked="checked"
                            class="custom-control-input"
                            name="radio50"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio50-1">
                            این منطقی ترین کاری است که انجام می دهید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio50-2"
                            class="custom-control-input"
                            name="radio50"
                            value="t0"
                        />
                        <label class="custom-control-label" for="radio50-2">
                            مردم خیلی دوست دارند که شما آن را انجام دهید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            فکر میکنید وجود کدام یک در فرد نقص بیشتری است
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio51-1" checked="checked"
                            class="custom-control-input"
                            name="radio51"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio51-1">
                            خیلی احساساتی بودن</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio51-2"
                            class="custom-control-input"
                            name="radio51"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio51-2">
                            به اندازه کافی احساساتی نبودن</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            احساس میکنید کدام یک عیب بدتری به شمار می آید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio52-1" checked="checked"
                            class="custom-control-input"
                            name="radio52"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio52-1"
                        >گرمی زیاد نشان دادن</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio52-2"
                            class="custom-control-input"
                            name="radio52"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio52-2">
                            به اندازه کافی گرم نبودن</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا معمولا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio53-1" checked="checked"
                            class="custom-control-input"
                            name="radio53"
                            value="f2"
                        />
                        <label class="custom-control-label" for="radio53-1"
                        >برای احساس بیشتر از منطق ارزش قائل هستید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio53-2"
                            class="custom-control-input"
                            name="radio53"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio53-2">
                            برای منطق بیشتر از احساس</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio54-1" checked="checked"
                            class="custom-control-input"
                            name="radio54"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio54-1"
                        >متقاعد کردن</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio54-2"
                            class="custom-control-input"
                            name="radio54"
                            value="f2"
                        />
                        <label class="custom-control-label" for="radio54-2"
                        >لمس کردن</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio55-1" checked="checked"
                            class="custom-control-input"
                            name="radio55"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio55-1"
                        >موافقت کردن</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio55-2"
                            class="custom-control-input"
                            name="radio55"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio55-2">پرسیدن</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio56-1" checked="checked"
                            class="custom-control-input"
                            name="radio56"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio56-1">مزایا</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio56-2"
                            class="custom-control-input"
                            name="radio56"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio56-2"> برکت</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio57-1" checked="checked"
                            class="custom-control-input"
                            name="radio57"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio57-1"
                        >تحلیل کردن</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio57-2"
                            class="custom-control-input"
                            name="radio57"
                            value="f2"
                        />
                        <label class="custom-control-label" for="radio57-2">همدردی</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio58-1" checked="checked"
                            class="custom-control-input"
                            name="radio58"
                            value="t0"
                        />
                        <label class="custom-control-label" for="radio58-1"> نرم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio58-2"
                            class="custom-control-input"
                            name="radio58"
                            value="f2"
                        />
                        <label class="custom-control-label" for="radio58-2"> سخت</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio59-1" checked="checked"
                            class="custom-control-input"
                            name="radio59"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio59-1"
                        >پایبند به اندیشه خود</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio59-2"
                            class="custom-control-input"
                            name="radio59"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio59-2">دلگرم</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio60-1" checked="checked"
                            class="custom-control-input"
                            name="radio60"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio60-1">چه کسی</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio60-2"
                            class="custom-control-input"
                            name="radio60"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio60-2">
                            چه چیزی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio61-1" checked="checked"
                            class="custom-control-input"
                            name="radio61"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio61-1">محتاط</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio61-2"
                            class="custom-control-input"
                            name="radio61"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio61-2">
                            خوش خیال</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio62-1" checked="checked"
                            class="custom-control-input"
                            name="radio62"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio62-1"> مایلم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio62-2"
                            class="custom-control-input"
                            name="radio62"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio62-2"> محکم</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio63-1" checked="checked"
                            class="custom-control-input"
                            name="radio63"
                            value="t0"
                        />
                        <label class="custom-control-label" for="radio63-1">عدالت</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio63-2"
                            class="custom-control-input"
                            name="radio63"
                            value="f2"
                        />
                        <label class="custom-control-label" for="radio63-2"
                        >بخشندگی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio64-1" checked="checked"
                            class="custom-control-input"
                            name="radio64"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio64-1">
                            غیر انتقادی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio64-2"
                            class="custom-control-input"
                            name="radio64"
                            value="t1"
                        />
                        <label class="custom-control-label" for="radio64-2">
                            انتقادی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio65-1" checked="checked"
                            class="custom-control-input"
                            name="radio65"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio65-1"> متفکر</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio65-2"
                            class="custom-control-input"
                            name="radio65"
                            value="f2"
                        />
                        <label class="custom-control-label" for="radio65-2">احساسی</label>
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio66-1" checked="checked"
                            class="custom-control-input"
                            name="radio66"
                            value="f1"
                        />
                        <label class="custom-control-label" for="radio66-1">
                            دلسوزی</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio66-2"
                            class="custom-control-input"
                            name="radio66"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio66-2">
                            دوراندیشی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">بیشتر مراقب کدام یک هستید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio67-1" checked="checked"
                            class="custom-control-input"
                            name="radio67"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio67-1">
                            احساسات افراد</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio67-2"
                            class="custom-control-input"
                            name="radio67"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio67-2"
                        >حقوق افراد</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا به طور طبیعی</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio68-1" checked="checked"
                            class="custom-control-input"
                            name="radio68"
                            value="f0"
                        />
                        <label class="custom-control-label" for="radio68-1">
                            به مردم بیشتر از اشیاء علاقه مندید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio68-2"
                            class="custom-control-input"
                            name="radio68"
                            value="t2"
                        />
                        <label class="custom-control-label" for="radio68-2">
                            به اشیاء و نحوه کار آنها بیشتر از روابط انسانها علاقه
                            مندید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">برای انجام یک کار، آیا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio69-1" checked="checked"
                            class="custom-control-input"
                            name="radio69"
                            value="j0"
                        />
                        <label class="custom-control-label" for="radio69-1"
                        >آن را زود شروع میکنید بطوریکه پس از پایان کار وقت اضافی داشته
                            باشید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio69-2"
                            class="custom-control-input"
                            name="radio69"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio69-2">
                            آن را به لحظه آخر واگذار کرده و سعی میکنید هر چه سریعتر انجام
                            دهید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگامی که رخدادی پیش بینی نشده شما را مجبور به کنار گذاشتن
                            برنامه روزانه تان مینماید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio70-1" checked="checked"
                            class="custom-control-input"
                            name="radio70"
                            value="j1"
                        />
                        <label class="custom-control-label" for="radio70-1"
                        >آیا بوجود آمدن وقفه در برنامه تان را مزاحمت تلقی
                            مینمایید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio70-2"
                            class="custom-control-input"
                            name="radio70"
                            value="p1"
                        />
                        <label class="custom-control-label" for="radio70-2"
                        >با تغییر وضعیت بوجود آمده با خوشرویی برخورد میکنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا مطابق برنامه عمل کردن</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio71-1" checked="checked"
                            class="custom-control-input"
                            name="radio71"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio71-1"
                        >مورد رضایت شماست</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio71-2"
                            class="custom-control-input"
                            name="radio71"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio71-2">
                            شما را در تنگنا قرار می دهد</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            هنگام شروع یک پروژه ی بزرگ که تا یک هفته باید انجام شود
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio72-1" checked="checked"
                            class="custom-control-input"
                            name="radio72"
                            value="j1"
                        />
                        <label class="custom-control-label" for="radio72-1"
                        >زمانی را برای تهیه فهرستی از کارهایی که میبایست انجام شوند بر
                            اساس اولویت در نظر میگیرید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio72-2"
                            class="custom-control-input"
                            name="radio72"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio72-2">
                            دل به دریا می زنید و شروع میکنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            اگر قرار باشد که کاری خاص را از پیش در زمانی خاص انجام دهید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio73-1" checked="checked"
                            class="custom-control-input"
                            name="radio73"
                            value="j1"
                        />
                        <label class="custom-control-label" for="radio73-1">
                            طبق برنامه عمل کردن برای شما خوشایند است</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio73-2"
                            class="custom-control-input"
                            name="radio73"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio73-2">
                            از در چهار چوب قرار گرفتن احساس ناخوشایندی میکنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا ترجیح میدهید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio74-1" checked="checked"
                            class="custom-control-input"
                            name="radio74"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio74-1"
                        >قرار ملاقات ها, وعده ها و میهمانی ها را از پیش تعیین
                            کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio74-2"
                            class="custom-control-input"
                            name="radio74"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio74-2">
                            فردی باشید که در لحظه آخر بتوانید آزادانه آنجایی را که تمایل
                            دارید انتخاب کنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio75-1" checked="checked"
                            class="custom-control-input"
                            name="radio75"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio75-1">
                            ترجیح میدهید کارها را در دقیقه آخر انجام دهید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio75-2"
                            class="custom-control-input"
                            name="radio75"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio75-2"
                        >انجام دادن کارها در دقیقه آخر شما را عصبی میکند</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            آیا فکر میکنید که داشتن یک برنامه روزانه
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio76-1" checked="checked"
                            class="custom-control-input"
                            name="radio76"
                            value="j1"
                        />
                        <label class="custom-control-label" for="radio76-1"
                        >راحت ترین روش برای دادن کارهاست</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio76-2"
                            class="custom-control-input"
                            name="radio76"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio76-2"
                        >حتی اگر ضروری باشد رنج آور است</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            وقتی که کار خاصی برای انجام دادن دارید آیا مایلید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio77-1" checked="checked"
                            class="custom-control-input"
                            name="radio77"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio77-1">
                            پیش از آغاز کار، با دقت آن را سازماندهی کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio77-2"
                            class="custom-control-input"
                            name="radio77"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio77-2">
                            آنچه ضروری است را حین انجام کار متوجه شوید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio78-1" checked="checked"
                            class="custom-control-input"
                            name="radio78"
                            value="p1"
                        />
                        <label class="custom-control-label" for="radio78-1">
                            روزمره بودن برایتان ساده تر است</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio78-2"
                            class="custom-control-input"
                            name="radio78"
                            value="p1"
                        />
                        <label class="custom-control-label" for="radio78-2">
                            متنوع بودن</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            در زندگی شخصی وقتی به پایان مسئولیتی میرسید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio79-1" checked="checked"
                            class="custom-control-input"
                            name="radio79"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio79-1">
                            آیا میدانید کار بعدی چیست و آماده درگیر شدن با آن هستید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio79-2"
                            class="custom-control-input"
                            name="radio79"
                            value="p1"
                        />
                        <label class="custom-control-label" for="radio79-2"
                        >تا پیشامد بعدی از آرامش خود خوشنود هستید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio80-1" checked="checked"
                            class="custom-control-input"
                            name="radio80"
                            value="j1"
                        />
                        <label class="custom-control-label" for="radio80-1">
                            وقت شناس</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio80-2"
                            class="custom-control-input"
                            name="radio80"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio80-2">
                            بی دغدغه</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio81-1" checked="checked"
                            class="custom-control-input"
                            name="radio81"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio81-1">منضبط</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio81-2"
                            class="custom-control-input"
                            name="radio81"
                            value="p0"
                        />
                        <label class="custom-control-label" for="radio81-2">
                            آسان گیر</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio82-1" checked="checked"
                            class="custom-control-input"
                            name="radio82"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio82-1"> منظم</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio82-2"
                            class="custom-control-input"
                            name="radio82"
                            value="p1"
                        />
                        <label class="custom-control-label" for="radio82-2"
                        >خودمانی</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">کدام لغت برای شما جالبتر است</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio83-1" checked="checked"
                            class="custom-control-input"
                            name="radio83"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio83-1">
                            برنامه ریز</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio83-2"
                            class="custom-control-input"
                            name="radio83"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio83-2">
                            بی برنامه</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا به طور کلی ترجیح میدهید</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio84-1" checked="checked"
                            class="custom-control-input"
                            name="radio84"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio84-1">
                            برای دیدار کسی از قبل برنامه ریزی کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio84-2"
                            class="custom-control-input"
                            name="radio84"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio84-2">
                            آزاد باشید و لحظه ای عمل کنید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            وقتی برای یک روز جایی میروید، آیا ترجیح میدهید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio85-1" checked="checked"
                            class="custom-control-input"
                            name="radio85"
                            value="j2"
                        />
                        <label class="custom-control-label" for="radio85-1">
                            برای اینکه چه کاری و چه موقع انجام دهید برنامه ریزی کنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio85-2"
                            class="custom-control-input"
                            name="radio85"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio85-2">
                            فقط میروید؟</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">
                            در مورد کارهای روز مره ترجیح میدهید
                        </p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio86-1" checked="checked"
                            class="custom-control-input"
                            name="radio86"
                            value="j1"
                        />
                        <label class="custom-control-label" for="radio86-1">
                            ابتدای صبح همه کارها را انجام دهید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio86-2"
                            class="custom-control-input"
                            name="radio86"
                            value="p1"
                        />
                        <label class="custom-control-label" for="radio86-2">
                            در ضمن فرصت پیش آمده حین انجام کارهای جالب آنها را انجام
                            میدهید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">آیا</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio87-1" checked="checked"
                            class="custom-control-input"
                            name="radio87"
                            value="j1"
                        />
                        <label class="custom-control-label" for="radio87-1"
                        >از اتمام کارها پیش از زمان موعود احساس رضایت میکنید</label
                        >
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            type="radio" onclick="nextPrev(1,this)"
                            id="radio87-2"
                            class="custom-control-input"
                            name="radio87"
                            value="p2"
                        />
                        <label class="custom-control-label" for="radio87-2">
                            از سرعت و  کارآمدی خود در لحظات آخر انجام کار لذت میبرید</label
                        >
                    </div>

                </div>

                <div class="tab col-12 col-md-9 col-lg-10 row mb-1 justify-content-center">
                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-center py-2">
                        <p>سوالات به پایان رسید!</p>
                        <p>هزینه قابل پرداخت: <span class="badge bg-first-200 my-2">@if(config('tests.mbti')) {{ number_format(config('tests.mbti')) }} تومان@else رایگان @endif</span></p>
                        <button type="submit" class="btn bg-first-100">پرداخت و مشاهده نتیجه</button>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-2 mx-0">
                    <div class="box">
                        <i class="mdi mdi-chart-bar"></i>
                        <span class="badge bg-first-100">تعداد انجام: {{ $countMbti }}</span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-clock-outline"></i>
                        <span class="badge bg-first-100">زمان: <span class="timer">20:00</span></span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-calendar-question"></i>
                        <span class="questionCounter badge bg-first-100">تعداد سوال:
                        <span class="answeredCount">0</span><span class="totalCount">/87</span>
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
                    var interval = setInterval(function() {
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
                    setTimeout(function(){
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
            }).then(function(result) {
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

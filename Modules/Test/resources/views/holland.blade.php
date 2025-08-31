@extends('home::layouts.master')

@section('title','آزمون استعدادیابی و رغبت سنجی هالند')
<meta name="description" content="آزمون استعدادیابی و رغبت سنجی هالند ) Test Career s'Holland )
ابزاری کاربردی برای شناخت استعدادها و عالیق شغلی شماست. این آزمون با
ارزیابی شش نوع شخصیت مختلف ) واقع گرایانه، تحقیقاتی، هنری، اجتماعی،
کارآفرینانه، و قراردادی( به شما کمک می کند تا شغلها و مسیرهای شغلی
مناسب خود را پیدا کنید .">
<meta name="keywords" content="آزمون استعدادیابی و رغبت سنجی هالند">
@section('content')
    <div class="container">
        <form id="testForm" action="{{ route('test.hollandStore') }}" method="post">
            @csrf
            <div class="row mx-0 justify-content-center justify-content-md-between justify-content-lg-between">
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 col-md-6 col-lg-3">
                        <img class="w-100" src="{{ asset('assets-front/img/testsholland/holland.png') }}" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-9">
                        <h1 class="my-3">تست هالند</h1>
                        <span class="small c-gray-300">پرسشنامه رغبت سنجی تحصیلی - شغلی هالند</span>
                    </div>
                    <div class="col-12 test-content">
                        <p class="my-2">پرسشنامه حاضر به منظور ارزیابی رغبت شما در زمینه تحصیلی تهیه شده است و به هیچ وجه پیشرفت یا هوش را نمی سنجد. در این پرسشنامه، فهرستی از فعالیت ها، تجربه ها و مشاغل و خودسنجی ها آورده شده است تا رغبت ها و تجربه های شما را مشخص نماید. در هر بخش توضیحات لازم برای پاسخگویی داده شده است. لطفا این توضیحات را با دقت بخوانید و سپس گزینه های خود را انتخاب کنید.</p>
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
                    <button type="button" class="btn btn-block bg-first-100  next" @if(!auth()->check()) disabled="disabled" @endif onclick="nextPrev(1,this)">شروع آزمون</button>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليتهاي زير را كه مايليد انجام دهيد، انتخاب کنید (می توانید چند فعالیت را انتخاب کنید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-1" name="check1[]" value="1">
                        <label class="custom-control-label" for="check1-1">نصب وسایل الکتریکی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-2" name="check1[]" value="2">
                        <label class="custom-control-label" for="check1-2">تعمیر اتومبیل</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-3" name="check1[]" value="3">
                        <label class="custom-control-label" for="check1-3">ساختن اشیا چوبی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-4" name="check1[]" value="4">
                        <label class="custom-control-label" for="check1-4">راندن کامیون و تراکتور</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-5" name="check1[]" value="5">
                        <label class="custom-control-label" for="check1-5">استفاده از ابزار ماشینی یا فلزی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-6" name="check1[]" value="6">
                        <label class="custom-control-label" for="check1-6">تغییر ابتکاری موتور اتومبیل و موتورسیکلت</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-7" name="check1[]" value="7">
                        <label class="custom-control-label" for="check1-7">گذراندن دوره کارگاه</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-8" name="check1[]" value="8">
                        <label class="custom-control-label" for="check1-8">گذراندن دوره طراحی مکانیک</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-9" name="check1[]" value="9">
                        <label class="custom-control-label" for="check1-9">گذراندن دوره درودگری (کار های چوبی)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-10" name="check1[]" value="10">
                        <label class="custom-control-label" for="check1-10">گذراندن دوره خیاطی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1-11" name="check1[]" value="11">
                        <label class="custom-control-label" for="check1-11">کذراندن دوره اتومکانیکی</label>
                    </div>
                    <input type="hidden" name="check1[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليتهاي زير را كه مايليد انجام دهيد، انتخاب کنید (می توانید چند فعالیت را انتخاب کنید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-1" name="check2[]" value="1">
                        <label class="custom-control-label" for="check2-1">نامه نگاری با دوستان</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-2" name="check2[]" value="2">
                        <label class="custom-control-label" for="check2-2">شرکت در برنامه های مذهبی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-3" name="check2[]" value="3">
                        <label class="custom-control-label" for="check2-3">عضویت در انجمن ها و مراکز فرهنگی و اجتماعی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-4" name="check2[]" value="4">
                        <label class="custom-control-label" for="check2-4">کمک به حل مشکلات شخصی دیگران</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-5" name="check2[]" value="5">
                        <label class="custom-control-label" for="check2-5">مراقبت از کودکان</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-6" name="check2[]" value="6">
                        <label class="custom-control-label" for="check2-6">شرکت در میهمانی ها و مراسم جشن و سرور</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-7" name="check2[]" value="7">
                        <label class="custom-control-label" for="check2-7">بیان مطالب شنیدنی و لطیفه در جمع دوستان</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-8" name="check2[]" value="8">
                        <label class="custom-control-label" for="check2-8">مطالعه کتاب های روان شناسی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-9" name="check2[]" value="9">
                        <label class="custom-control-label" for="check2-9">حضور در جلسات و سمینار ها</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-10" name="check2[]" value="10">
                        <label class="custom-control-label" for="check2-10">شرکت در کلاس های ورزشی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2-11" name="check2[]" value="11">
                        <label class="custom-control-label" for="check2-11">پیدا کردن دوستان و افراد جدید</label>
                    </div>
                    <input type="hidden" name="check2[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليتهاي زير را كه مايليد انجام دهيد، انتخاب کنید (می توانید چند فعالیت را انتخاب کنید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-1" name="check3[]" value="1">
                        <label class="custom-control-label" for="check3-1">خواندن کتابها یا مجلات علمی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-2" name="check3[]" value="2">
                        <label class="custom-control-label" for="check3-2">کار در آزمایشگاه </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-3" name="check3[]" value="3">
                        <label class="custom-control-label" for="check3-3">کار بر روی یک پروژۀ علمی </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-4" name="check3[]" value="4">
                        <label class="custom-control-label" for="check3-4">ساخنت مدلهایی از هواپیام (ماکت) </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-5" name="check3[]" value="5">
                        <label class="custom-control-label" for="check3-5">کار با وسایل و مواد شیمیایی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-6" name="check3[]" value="6">
                        <label class="custom-control-label" for="check3-6">مطالعۀ آزاد دربارۀ موضوعات خاص </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-7" name="check3[]" value="7">
                        <label class="custom-control-label" for="check3-7">حل معامهای ریاضی و شطرنج </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-8" name="check3[]" value="8">
                        <label class="custom-control-label" for="check3-8">گذراندن دورۀ فیزیک</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-9" name="check3[]" value="9">
                        <label class="custom-control-label" for="check3-9">گذراندن دورۀ شیمی </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-10" name="check3[]" value="10">
                        <label class="custom-control-label" for="check3-10">گذراندن دورۀ هندسه و مثلثات </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check3-11" name="check3[]" value="11">
                        <label class="custom-control-label" for="check3-11">گذراندن دورۀ زیستشناسی </label>
                    </div>
                    <input type="hidden" name="check3[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليتهاي زير را كه مايليد انجام دهيد، انتخاب کنید (می توانید چند فعالیت را انتخاب کنید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-1" name="check4[]" value="1">
                        <label class="custom-control-label" for="check4-1">تاثیر گذاشتن روی دیگران</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-2" name="check4[]" value="2">
                        <label class="custom-control-label" for="check4-2">فروشندگی اجناس</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-3" name="check4[]" value="3">
                        <label class="custom-control-label" for="check4-3">بحث در مورد مسائل سیاسی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-4" name="check4[]" value="4">
                        <label class="custom-control-label" for="check4-4">کار کردن در مغازه یا فروشگاه شخصی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-5" name="check4[]" value="5">
                        <label class="custom-control-label" for="check4-5">شرکت فعال در سمینار ها</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-6" name="check4[]" value="6">
                        <label class="custom-control-label" for="check4-6">سخنرانی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-7" name="check4[]" value="7">
                        <label class="custom-control-label" for="check4-7">خدمت به عنوان مدیر گروه</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-8" name="check4[]" value="8">
                        <label class="custom-control-label" for="check4-8">سرپرستی و نظارت بر کار دیگران</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-9" name="check4[]" value="9">
                        <label class="custom-control-label" for="check4-9">ملاقات با شخصیت های مهم</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-10" name="check4[]" value="10">
                        <label class="custom-control-label" for="check4-10">رهبری یک گروه برای رسیدن به هدف</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check4-11" name="check4[]" value="11">
                        <label class="custom-control-label" for="check4-11">مشارکت در فعالیت های سیاسی</label>
                    </div>
                    <input type="hidden" name="check4[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليتهاي زير را كه مايليد انجام دهيد، انتخاب کنید (می توانید چند فعالیت را انتخاب کنید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-1" name="check5[]" value="1">
                        <label class="custom-control-label" for="check5-1">طراحی، ترسیم و نقاشی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-2" name="check5[]" value="2">
                        <label class="custom-control-label" for="check5-2">بازیگری تأتر یا سینما</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-3" name="check5[]" value="3">
                        <label class="custom-control-label" for="check5-3">طراحی داخل ساختمان یا دکوراسیون</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-4" name="check5[]" value="4">
                        <label class="custom-control-label" for="check5-4">نوازندگی در گروه موسیقی و سرود</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-5" name="check5[]" value="5">
                        <label class="custom-control-label" for="check5-5">نوازندگی یکی از آلات موسیقی </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-6" name="check5[]" value="6">
                        <label class="custom-control-label" for="check5-6">رفنت به برنامههای اجرای موسیقی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-7" name="check5[]" value="7">
                        <label class="custom-control-label" for="check5-7">خواندن داستانهای معروف</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-8" name="check5[]" value="8">
                        <label class="custom-control-label" for="check5-8">خواندن داستانهای معروف</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-9" name="check5[]" value="9">
                        <label class="custom-control-label" for="check5-9">نقد نمایشنامه </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-10" name="check5[]" value="10">
                        <label class="custom-control-label" for="check5-10">خواندن شعر یا سرودن شعر</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check5-11" name="check5[]" value="11">
                        <label class="custom-control-label" for="check5-11">گذراندن دوره های هنری </label>
                    </div>
                    <input type="hidden" name="check5[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليت هايي كه تجربه كرده ايد و مي توانيد انجام دهيد را انتخاب کنید. (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-1" name="check6[]" value="1">
                        <label class="custom-control-label" for="check6-1">دقت در تیز نگهداشنت کتاب ها و لوازم التحریر خود</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-2" name="check6[]" value="2">
                        <label class="custom-control-label" for="check6-2">ماشین نویسی اوراق یا نامه ها برای خود و دیگران </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-3" name="check6[]" value="3">
                        <label class="custom-control-label" for="check6-3">حسابداری</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-4" name="check6[]" value="4">
                        <label class="custom-control-label" for="check6-4">کار با انواع ماشینهای اداری (حساب، کامپیوتر و غیره) </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-5" name="check6[]" value="5">
                        <label class="custom-control-label" for="check6-5">ثبت و نگهداری اسناد هزینه ها و درآمد</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-6" name="check6[]" value="6">
                        <label class="custom-control-label" for="check6-6">گذراندن دورۀ ماشین نویسی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-7" name="check6[]" value="7">
                        <label class="custom-control-label" for="check6-7">گذراندن دورۀ بازرگانی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-8" name="check6[]" value="8">
                        <label class="custom-control-label" for="check6-8">گذراندن دورۀ دفترداری</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-9" name="check6[]" value="9">
                        <label class="custom-control-label" for="check6-9">گذراندن دورۀ حسابداری مالی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-10" name="check6[]" value="10">
                        <label class="custom-control-label" for="check6-10">بایگانی نامه ها، گزارشها، سوابق و غیره</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check6-11" name="check6[]" value="11">
                        <label class="custom-control-label" for="check6-11">نوشنت نامه های اداری و رسمی </label>
                    </div>
                    <input type="hidden" name="check6[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
{{--                /////////////////////////////////////////////////////////////////////////////////////////               --}}
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليت هايي كه تجربه كرده ايد و مي توانيد انجام دهيد را انتخاب کنید. (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-1" name="check7[]" value="1">
                        <label class="custom-control-label" for="check7-1">از ابزارهای برقی کارگاه نجاری مانند اره، ماشـین تـراش
                            یا ماشین سنباده استفاده کرده ام</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-2" name="check7[]" value="2">
                        <label class="custom-control-label" for="check7-2">کار کردن با ولتمتر را می دانم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-3" name="check7[]" value="3">
                        <label class="custom-control-label" for="check7-3">می توانم کاربراتور را تنظیم کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-4" name="check7[]" value="4">
                        <label class="custom-control-label" for="check7-4">بــا ابزارهــای برقــی ماننــد: متــه، آســیاب، خــردکن و
                            چرخ خیاطی کار کرده ام. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-5" name="check7[]" value="5">
                        <label class="custom-control-label" for="check7-5">کار با جلازن و لکه زدایـی مـبلمان یـا کارهـای چـوبی را
                            می توانم انجام دهم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-6" name="check7[]" value="6">
                        <label class="custom-control-label" for="check7-6">می توانم نقشۀ ساختمان یا طرح ماشین را بخوانم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-7" name="check7[]" value="7">
                        <label class="custom-control-label" for="check7-7">تعمیرات ساده وسایل برقی را می توانم انجام بدهم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-8" name="check7[]" value="8">
                        <label class="custom-control-label" for="check7-8">می تـوانم وسـایل چـوبی (صـندلی، میـز و ...) را تعمیـر کنم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-9" name="check7[]" value="9">
                        <label class="custom-control-label" for="check7-9">رسم های فنی را می توانم بکشم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-10" name="check7[]" value="10">
                        <label class="custom-control-label" for="check7-10">می توانم تعمیرات سادۀ تلویزیون را انجام دهم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check7-11" name="check7[]" value="11">
                        <label class="custom-control-label" for="check7-11">تعمیرات سادۀ لوله کشی را می توانم انجام دهم.</label>
                    </div>
                    <input type="hidden" name="check7[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليت هايي كه تجربه كرده ايد و مي توانيد انجام دهيد را انتخاب کنید. (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-1" name="check8[]" value="1">
                        <label class="custom-control-label" for="check8-1">می توانم به خوبی مطالب را برای دیگران توضیح دهم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-2" name="check8[]" value="2">
                        <label class="custom-control-label" for="check8-2"> در امور خیریه بـا جمـع آوری کمـکهـای مردمـی شرکـت
                            کرده ام. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-3" name="check8[]" value="3">
                        <label class="custom-control-label" for="check8-3">با دیگران به خوبی کار و شراکت می کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-4" name="check8[]" value="4">
                        <label class="custom-control-label" for="check8-4">در سرگرم کردن افراد بزرگتر از خود مهارت دارم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-5" name="check8[]" value="5">
                        <label class="custom-control-label" for="check8-5">می توانم میزبان خوبی باشم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-6" name="check8[]" value="6">
                        <label class="custom-control-label" for="check8-6">به راحتی می توانم به کودکان آموزش دهم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-7" name="check8[]" value="7">
                        <label class="custom-control-label" for="check8-7">می توانم برای سرگرمی دیگران در یک مهمانی برنامه ریزی کنم</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-8" name="check8[]" value="8">
                        <label class="custom-control-label" for="check8-8">به خوبی می تـوانم بـه افـراد مضـطرب یـا دارای مشـکل
                            کمک کنم.
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-9" name="check8[]" value="9">
                        <label class="custom-control-label" for="check8-9">داوطلبانه در بیمارستان، کلینیک یـا مراکـز امدادرسـانی
                            (هلال احمر و ...) کار کرده ام. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-10" name="check8[]" value="10">
                        <label class="custom-control-label" for="check8-10">برای امور خیریه مربوط به مدرسه یا مسجد می تـوانم
                            برنامه ریزی کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check8-11" name="check8[]" value="11">
                        <label class="custom-control-label" for="check8-11">دربارۀ شخصیت افراد به خوبی می توانم قضاوت کنم. </label>
                    </div>
                    <input type="hidden" name="check8[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليت هايي كه تجربه كرده ايد و مي توانيد انجام دهيد را انتخاب کنید. (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-1" name="check9[]" value="1">
                        <label class="custom-control-label" for="check9-1">طرز کار لامپ خلاء (لولۀ خالی از هوا) را می دانم</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-2" name="check9[]" value="2">
                        <label class="custom-control-label" for="check9-2">می توانم سه غـذا را کـه از لحـاظ مـواد پروتئینـی غنـی
                            هستند نام ببرم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-3" name="check9[]" value="3">
                        <label class="custom-control-label" for="check9-3">مفهوم نیمه عمر رادیواکتیو را می دانم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-4" name="check9[]" value="4">
                        <label class="custom-control-label" for="check9-4">می توانم جدول مندلیف را توضیح دهم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-5" name="check9[]" value="5">
                        <label class="custom-control-label" for="check9-5">مـی تـوانم از خـطکـش محاسـبه بـرای ضرب یـا تقسـیم
                            استفاده کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-6" name="check9[]" value="6">
                        <label class="custom-control-label" for="check9-6">از میکروسکوب می توانم استفاده کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-7" name="check9[]" value="7">
                        <label class="custom-control-label" for="check9-7">سه نوع صورت فلکی ستارگان را می توانم شناسایی کنم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-8" name="check9[]" value="8">
                        <label class="custom-control-label" for="check9-8">چگونگی عملکرد گلبولهـای سـفید خـون را مـی تـوانم
                            توضیح دهم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-9" name="check9[]" value="9">
                        <label class="custom-control-label" for="check9-9">فرمولهای سادۀ شیمی را می توانم تفسیر کنم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-10" name="check9[]" value="10">
                        <label class="custom-control-label" for="check9-10">می دانم چرا ماهوراهها به زمین نمی افتند. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check9-11" name="check9[]" value="11">
                        <label class="custom-control-label" for="check9-11">در سمینار یا مسابقه علمی شرکت می کنم.</label>
                    </div>
                    <input type="hidden" name="check9[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليت هايي كه تجربه كرده ايد و مي توانيد انجام دهيد را انتخاب کنید. (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-1" name="check10[]" value="1">
                        <label class="custom-control-label" for="check10-1"> در مدرسه به عنوان نماینده انتخاب شدم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-2" name="check10[]" value="2">
                        <label class="custom-control-label" for="check10-2">می توانم کار دیگران را سرپرستی کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-3" name="check10[]" value="3">
                        <label class="custom-control-label" for="check10-3">اشتیاق و انرژی فوق العادهای در انجام کارها دارم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-4" name="check10[]" value="4">
                        <label class="custom-control-label" for="check10-4">به خوبی می توانم مردم را در انجام کارهای مورد علاقـۀ
                            خودم وادارم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-5" name="check10[]" value="5">
                        <label class="custom-control-label" for="check10-5">در فروشندگی مهارت دارم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-6" name="check10[]" value="6">
                        <label class="custom-control-label" for="check10-6">به عنـوان نماینـدۀ یـک گـروه در ارائـۀ پیشـنهادات و یـا
                            شکایات به مقام بالاتر انجام وظیفه کرده ام. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-7" name="check10[]" value="7">
                        <label class="custom-control-label" for="check10-7">در کار فروشندگی یا رهبری گروه پاداش گرفته ام.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-8" name="check10[]" value="8">
                        <label class="custom-control-label" for="check10-8">باشگاه، گروه یا دسته ای را سازمان داده ام. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-9" name="check10[]" value="9">
                        <label class="custom-control-label" for="check10-9"> اقدام به ایجاد کسب و کار نموده ام. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-10" name="check10[]" value="10">
                        <label class="custom-control-label" for="check10-10">می دانم چگونه سردسته یا نمایندۀ موفقی باشم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check10-11" name="check10[]" value="11">
                        <label class="custom-control-label" for="check10-11">مصاحبه گر خوبی هستم. </label>
                    </div>
                    <input type="hidden" name="check10[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليت هايي كه تجربه كرده ايد و مي توانيد انجام دهيد را انتخاب کنید. (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-1" name="check11[]" value="1">
                        <label class="custom-control-label" for="check11-1">می توانم در نمایشنامه، نقشی بازی کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-2" name="check11[]" value="2">
                        <label class="custom-control-label" for="check11-2">می توانم شعر یا نوشته ای را دکلمه کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-3" name="check11[]" value="3">
                        <label class="custom-control-label" for="check11-3">می توانم در نمایش عروسکی بازی کنم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-4" name="check11[]" value="4">
                        <label class="custom-control-label" for="check11-4">می توانم افراد را طوری نقاشی کنم که قابل شناسایی باشند. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-5" name="check11[]" value="5">
                        <label class="custom-control-label" for="check11-5">می توانم نقاشی یا مجسمه سازی کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-6" name="check11[]" value="6">
                        <label class="custom-control-label" for="check11-6">می توانم سفالگری کنم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-7" name="check11[]" value="7">
                        <label class="custom-control-label" for="check11-7">طراحی لباس، پوستر یا وسایل چوبی را می توانم انجام دهم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-8" name="check11[]" value="8">
                        <label class="custom-control-label" for="check11-8">می توانم به خوبی شعر بگویم یا داستان بنویسم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-9" name="check11[]" value="9">
                        <label class="custom-control-label" for="check11-9">می توانم یک آلت موسیقی بنوازم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-10" name="check11[]" value="10">
                        <label class="custom-control-label" for="check11-10"> در سرودهای ۲ تا ۴ نفره می توانم شرکت کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check11-11" name="check11[]" value="11">
                        <label class="custom-control-label" for="check11-11">می توانم یکی از آلات موسیقی را در یک جمع رسمی بنوازم. </label>
                    </div>
                    <input type="hidden" name="check11[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">هر تعداد از فعاليت هايي كه تجربه كرده ايد و مي توانيد انجام دهيد را انتخاب کنید. (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-1" name="check12[]" value="1">
                        <label class="custom-control-label" for="check12-1">در هر دقیقه می توانم چهل کلمه تایپ کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-2" name="check12[]" value="2">
                        <label class="custom-control-label" for="check12-2">می توانم با دستگاه فتوکپی یا ماشین جمع بنـدی قیمـت
                            کالا کار کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-3" name="check12[]" value="3">
                        <label class="custom-control-label" for="check12-3">می توانم تندنویسی کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-4" name="check12[]" value="4">
                        <label class="custom-control-label" for="check12-4"> می توانم نامه ها و سایر اوراق را بایگانی کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-5" name="check12[]" value="5">
                        <label class="custom-control-label" for="check12-5">در امور اداری کار کرده ام. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-6" name="check12[]" value="6">
                        <label class="custom-control-label" for="check12-6">می توانم زمانبندی مشخصی برای انجام کارهایم داشته
                            باشم.</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-7" name="check12[]" value="7">
                        <label class="custom-control-label" for="check12-7">مــی تــوانم مقــدار زیــادی کارهــای دفــتری را در مــدت
                            کوتاهی انجام دهم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-8" name="check12[]" value="8">
                        <label class="custom-control-label" for="check12-8">از ماشین حساب می توانم استفاده کنم.
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-9" name="check12[]" value="9">
                        <label class="custom-control-label" for="check12-9">می توانم از کامپیوتر استفاده کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-10" name="check12[]" value="10">
                        <label class="custom-control-label" for="check12-10">می توانم بدهی ها و طلب ها (ترازنامـه هـا) را در دفـتر
                            کل وارد کنم. </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check12-11" name="check12[]" value="11">
                        <label class="custom-control-label" for="check12-11">می توانم گزارشهای دقیق پرداخـت هـا و فـروش هـا را
                            نگهداری و تنظیم کنم.
                        </label>
                    </div>
                    <input type="hidden" name="check12[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
{{--                /////////////////////////////////////////////////////////////////////////////////////////               --}}
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مشاغلی که به آن ها علاقه دارید یا برای شما خوشایند است را انتخاب کنید (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-1" name="check13[]" value="1">
                        <label class="custom-control-label" for="check13-1">مکانیک هواپیا</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-2" name="check13[]" value="2">
                        <label class="custom-control-label" for="check13-2">متخصص موجودات وحشی و آبزی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-3" name="check13[]" value="3">
                        <label class="custom-control-label" for="check13-3">مکانیک اتومبیل</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-4" name="check13[]" value="4">
                        <label class="custom-control-label" for="check13-4">نجار</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-5" name="check13[]" value="5">
                        <label class="custom-control-label" for="check13-5">رانندۀ خاک برداری برقی (جرثقیل) </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-6" name="check13[]" value="6">
                        <label class="custom-control-label" for="check13-6">نقشه بردار </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-7" name="check13[]" value="7">
                        <label class="custom-control-label" for="check13-7">بازرس ساختمان </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-8" name="check13[]" value="8">
                        <label class="custom-control-label" for="check13-8">مهندس مخابرات </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-9" name="check13[]" value="9">
                        <label class="custom-control-label" for="check13-9">جوشکار </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-10" name="check13[]" value="10">
                        <label class="custom-control-label" for="check13-10">پرورش دهندۀ گل و گیاهان </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-11" name="check13[]" value="11">
                        <label class="custom-control-label" for="check13-11">رانندۀ تاکسی سرویس (آژانس) </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-12" name="check13[]" value="12">
                        <label class="custom-control-label" for="check13-12">مهندس لوکوموتیو </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-13" name="check13[]" value="13">
                        <label class="custom-control-label" for="check13-13">خیاط</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check13-14" name="check13[]" value="14">
                        <label class="custom-control-label" for="check13-14">برقکار</label>
                    </div>
                    <input type="hidden" name="check13[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مشاغلی که به آن ها علاقه دارید یا برای شما خوشایند است را انتخاب کنید (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-1" name="check14[]" value="1">
                        <label class="custom-control-label" for="check14-1">جامعه شناس</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-2" name="check14[]" value="2">
                        <label class="custom-control-label" for="check14-2">دبیر دبیرستان</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-3" name="check14[]" value="3">
                        <label class="custom-control-label" for="check14-3">متخصص اصلاح و تربیت</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-4" name="check14[]" value="4">
                        <label class="custom-control-label" for="check14-4">گفتار درمانگر</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-5" name="check14[]" value="5">
                        <label class="custom-control-label" for="check14-5">مشاور ازدواج </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-6" name="check14[]" value="6">
                        <label class="custom-control-label" for="check14-6">مدیر مدرسه </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-7" name="check14[]" value="7">
                        <label class="custom-control-label" for="check14-7">سرپرست خوابگاه</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-8" name="check14[]" value="8">
                        <label class="custom-control-label" for="check14-8">روانشناس</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-9" name="check14[]" value="9">
                        <label class="custom-control-label" for="check14-9"> دبیر علوم اجتمائی </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-10" name="check14[]" value="10">
                        <label class="custom-control-label" for="check14-10">مدیر امور خیریه </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-11" name="check14[]" value="11">
                        <label class="custom-control-label" for="check14-11">مربی ورزش</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-12" name="check14[]" value="12">
                        <label class="custom-control-label" for="check14-12">مشاور</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-13" name="check14[]" value="13">
                        <label class="custom-control-label" for="check14-13"> دستیار امور روان پزشکی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check14-14" name="check14[]" value="14">
                        <label class="custom-control-label" for="check14-14">راهنما و مشاور شغلی</label>
                    </div>
                    <input type="hidden" name="check14[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مشاغلی که به آن ها علاقه دارید یا برای شما خوشایند است را انتخاب کنید (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-1" name="check15[]" value="1">
                        <label class="custom-control-label" for="check15-1">متخصص هواشناسی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-2" name="check15[]" value="2">
                        <label class="custom-control-label" for="check15-2">زیست شناس</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-3" name="check15[]" value="3">
                        <label class="custom-control-label" for="check15-3">ستاره شناس (منجم) </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-4" name="check15[]" value="4">
                        <label class="custom-control-label" for="check15-4">تکنیسین آزمایشگاه پزشکی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-5" name="check15[]" value="5">
                        <label class="custom-control-label" for="check15-5">مردم شناس</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-6" name="check15[]" value="6">
                        <label class="custom-control-label" for="check15-6">دامپزشک</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-7" name="check15[]" value="7">
                        <label class="custom-control-label" for="check15-7">شیمی دان</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-8" name="check15[]" value="8">
                        <label class="custom-control-label" for="check15-8">پژوهشگر (محقق)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-9" name="check15[]" value="9">
                        <label class="custom-control-label" for="check15-9">نویسندۀ مقالات علمی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-10" name="check15[]" value="10">
                        <label class="custom-control-label" for="check15-10">سردبیر یک روزنامۀ علمی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-11" name="check15[]" value="11">
                        <label class="custom-control-label" for="check15-11">زمین شناس</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-12" name="check15[]" value="12">
                        <label class="custom-control-label" for="check15-12">گیاه شناس</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-13" name="check15[]" value="13">
                        <label class="custom-control-label" for="check15-13">کارشناس تحقیقات علمی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check15-14" name="check15[]" value="14">
                        <label class="custom-control-label" for="check15-14">فیزیکدان</label>
                    </div>
                    <input type="hidden" name="check15[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مشاغلی که به آن ها علاقه دارید یا برای شما خوشایند است را انتخاب کنید (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-1" name="check16[]" value="1">
                        <label class="custom-control-label" for="check16-1">معاملهگر، واسطهگر امور تجاری</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-2" name="check16[]" value="2">
                        <label class="custom-control-label" for="check16-2">مأمور خرید</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-3" name="check16[]" value="3">
                        <label class="custom-control-label" for="check16-3">مدیر اجرایی آگهی و مسئول تبلیغات</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-4" name="check16[]" value="4">
                        <label class="custom-control-label" for="check16-4">نمایندۀ فروش کارخانۀ تولیدی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-5" name="check16[]" value="5">
                        <label class="custom-control-label" for="check16-5">تولید کنندۀ برنامه های تلویزیونی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-6" name="check16[]" value="6">
                        <label class="custom-control-label" for="check16-6">مدیر هتل </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-7" name="check16[]" value="7">
                        <label class="custom-control-label" for="check16-7">مدیر شرکت های بازرگانی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-8" name="check16[]" value="8">
                        <label class="custom-control-label" for="check16-8">مدیر رستوران</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-9" name="check16[]" value="9">
                        <label class="custom-control-label" for="check16-9">مدیر مراسم و تشریفات</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-10" name="check16[]" value="10">
                        <label class="custom-control-label" for="check16-10">فروشنده</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-11" name="check16[]" value="11">
                        <label class="custom-control-label" for="check16-11">واسطه گر معاملات ملکی یا اتومبیل</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-12" name="check16[]" value="12">
                        <label class="custom-control-label" for="check16-12">مدیر تبلیغات یا مدیر روابط عمومی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-13" name="check16[]" value="13">
                        <label class="custom-control-label" for="check16-13">مؤسس باشگاه ورزشی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check16-14" name="check16[]" value="14">
                        <label class="custom-control-label" for="check16-14">مدیر فروش </label>
                    </div>
                    <input type="hidden" name="check16[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مشاغلی که به آن ها علاقه دارید یا برای شما خوشایند است را انتخاب کنید (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-1" name="check17[]" value="1">
                        <label class="custom-control-label" for="check17-1">شاعر</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-2" name="check17[]" value="2">
                        <label class="custom-control-label" for="check17-2">رهبر ارکستر</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-3" name="check17[]" value="3">
                        <label class="custom-control-label" for="check17-3">موسیقی دان</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-4" name="check17[]" value="4">
                        <label class="custom-control-label" for="check17-4">نویسنده</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-5" name="check17[]" value="5">
                        <label class="custom-control-label" for="check17-5">هرنمند آگهی های تبلیغاتی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-6" name="check17[]" value="6">
                        <label class="custom-control-label" for="check17-6">نویسندۀ ادبیات کودکان</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-7" name="check17[]" value="7">
                        <label class="custom-control-label" for="check17-7">بازیگر سینما یا تأتر</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-8" name="check17[]" value="8">
                        <label class="custom-control-label" for="check17-8">خبرنگار</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-9" name="check17[]" value="9">
                        <label class="custom-control-label" for="check17-9">نقاش</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-10" name="check17[]" value="10">
                        <label class="custom-control-label" for="check17-10">خواننده</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-11" name="check17[]" value="11">
                        <label class="custom-control-label" for="check17-11">آهنگساز</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-12" name="check17[]" value="12">
                        <label class="custom-control-label" for="check17-12">مجسمه ساز</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-13" name="check17[]" value="13">
                        <label class="custom-control-label" for="check17-13">نمایشنامه نویس </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check17-14" name="check17[]" value="14">
                        <label class="custom-control-label" for="check17-14">فیلمساز</label>
                    </div>
                    <input type="hidden" name="check17[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">مشاغلی که به آن ها علاقه دارید یا برای شما خوشایند است را انتخاب کنید (می توانید چندین انتخاب داشته باشید)</p>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-1" name="check18[]" value="1">
                        <label class="custom-control-label" for="check18-1">دفتردار</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-2" name="check18[]" value="2">
                        <label class="custom-control-label" for="check18-2">معلم درس ماشین نویسی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-3" name="check18[]" value="3">
                        <label class="custom-control-label" for="check18-3">مسئول برنامه های بودجه</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-4" name="check18[]" value="4">
                        <label class="custom-control-label" for="check18-4">حسابدار تحصیلکرده</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-5" name="check18[]" value="5">
                        <label class="custom-control-label" for="check18-5">بازرس مالی- اداری</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-6" name="check18[]" value="6">
                        <label class="custom-control-label" for="check18-6">تندنویس دادگاه</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-7" name="check18[]" value="7">
                        <label class="custom-control-label" for="check18-7">تحویلدار بانک</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-8" name="check18[]" value="8">
                        <label class="custom-control-label" for="check18-8">کارشناس مالیات</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-9" name="check18[]" value="9">
                        <label class="custom-control-label" for="check18-9">ناظر صورت برداری از موجودی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-10" name="check18[]" value="10">
                        <label class="custom-control-label" for="check18-10">اپراتور کامپیوتر</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-11" name="check18[]" value="11">
                        <label class="custom-control-label" for="check18-11">ارزیاب هزینه ها</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-12" name="check18[]" value="12">
                        <label class="custom-control-label" for="check18-12">کارشناس امور مالی </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-13" name="check18[]" value="13">
                        <label class="custom-control-label" for="check18-13">کارمند امور مالی</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check18-14" name="check18[]" value="14">
                        <label class="custom-control-label" for="check18-14">بازرس بانک</label>
                    </div>
                    <input type="hidden" name="check18[]" value="0">
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به توانایی مکانیکی خود چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio19-7"  class="custom-control-input" name="check19" value="7">
                        <label class="custom-control-label" for="radio19-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio19-6"  class="custom-control-input" name="check19" value="6">
                        <label class="custom-control-label" for="radio19-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio19-5"  class="custom-control-input" name="check19" value="5">
                        <label class="custom-control-label" for="radio19-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio19-4"  class="custom-control-input" name="check19" value="4">
                        <label class="custom-control-label" for="radio19-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio19-3"  class="custom-control-input" name="check19" value="3">
                        <label class="custom-control-label" for="radio19-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio19-2"  class="custom-control-input" name="check19" value="2">
                        <label class="custom-control-label" for="radio19-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio19-1"  class="custom-control-input" name="check19" value="1">
                        <label class="custom-control-label" for="radio19-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به توانایی علمی خود چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio20-7"  class="custom-control-input" name="check20" value="7">
                        <label class="custom-control-label" for="radio20-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio20-6"  class="custom-control-input" name="check20" value="6">
                        <label class="custom-control-label" for="radio20-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio20-5"  class="custom-control-input" name="check20" value="5">
                        <label class="custom-control-label" for="radio20-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio20-4"  class="custom-control-input" name="check20" value="4">
                        <label class="custom-control-label" for="radio20-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio20-3"  class="custom-control-input" name="check20" value="3">
                        <label class="custom-control-label" for="radio20-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio20-2"  class="custom-control-input" name="check20" value="2">
                        <label class="custom-control-label" for="radio20-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio20-1"  class="custom-control-input" name="check20" value="1">
                        <label class="custom-control-label" for="radio20-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به توانایی هنری خود چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio21-7"  class="custom-control-input" name="check21" value="7">
                        <label class="custom-control-label" for="radio21-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio21-6"  class="custom-control-input" name="check21" value="6">
                        <label class="custom-control-label" for="radio21-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio21-5"  class="custom-control-input" name="check21" value="5">
                        <label class="custom-control-label" for="radio21-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio21-4"  class="custom-control-input" name="check21" value="4">
                        <label class="custom-control-label" for="radio21-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio21-3"  class="custom-control-input" name="check21" value="3">
                        <label class="custom-control-label" for="radio21-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio21-2"  class="custom-control-input" name="check21" value="2">
                        <label class="custom-control-label" for="radio21-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio21-1"  class="custom-control-input" name="check21" value="1">
                        <label class="custom-control-label" for="radio21-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به توانایی تدریس خود چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio22-7"  class="custom-control-input" name="check22" value="7">
                        <label class="custom-control-label" for="radio22-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio22-6"  class="custom-control-input" name="check22" value="6">
                        <label class="custom-control-label" for="radio22-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio22-5"  class="custom-control-input" name="check22" value="5">
                        <label class="custom-control-label" for="radio22-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio22-4"  class="custom-control-input" name="check22" value="4">
                        <label class="custom-control-label" for="radio22-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio22-3"  class="custom-control-input" name="check22" value="3">
                        <label class="custom-control-label" for="radio22-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio22-2"  class="custom-control-input" name="check22" value="2">
                        <label class="custom-control-label" for="radio22-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio22-1"  class="custom-control-input" name="check22" value="1">
                        <label class="custom-control-label" for="radio22-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به توانایی فروشندگی خود چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio23-7"  class="custom-control-input" name="check23" value="7">
                        <label class="custom-control-label" for="radio23-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio23-6"  class="custom-control-input" name="check23" value="6">
                        <label class="custom-control-label" for="radio23-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio23-5"  class="custom-control-input" name="check23" value="5">
                        <label class="custom-control-label" for="radio23-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio23-4"  class="custom-control-input" name="check23" value="4">
                        <label class="custom-control-label" for="radio23-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio23-3"  class="custom-control-input" name="check23" value="3">
                        <label class="custom-control-label" for="radio23-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio23-2"  class="custom-control-input" name="check23" value="2">
                        <label class="custom-control-label" for="radio23-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio23-1"  class="custom-control-input" name="check23" value="1">
                        <label class="custom-control-label" for="radio23-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به توانایی اداری و مالی خود چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio24-7"  class="custom-control-input" name="check24" value="7">
                        <label class="custom-control-label" for="radio24-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio24-6"  class="custom-control-input" name="check24" value="6">
                        <label class="custom-control-label" for="radio24-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio24-5"  class="custom-control-input" name="check24" value="5">
                        <label class="custom-control-label" for="radio24-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio24-4"  class="custom-control-input" name="check24" value="4">
                        <label class="custom-control-label" for="radio24-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio24-3"  class="custom-control-input" name="check24" value="3">
                        <label class="custom-control-label" for="radio24-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio24-2"  class="custom-control-input" name="check24" value="2">
                        <label class="custom-control-label" for="radio24-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio24-1"  class="custom-control-input" name="check24" value="1">
                        <label class="custom-control-label" for="radio24-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به مهارت خود در استفاده از ابزار ها و مهارت های دستی خود چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio25-7"  class="custom-control-input" name="check25" value="7">
                        <label class="custom-control-label" for="radio25-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio25-6"  class="custom-control-input" name="check25" value="6">
                        <label class="custom-control-label" for="radio25-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio25-5"  class="custom-control-input" name="check25" value="5">
                        <label class="custom-control-label" for="radio25-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio25-4"  class="custom-control-input" name="check25" value="4">
                        <label class="custom-control-label" for="radio25-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio25-3"  class="custom-control-input" name="check25" value="3">
                        <label class="custom-control-label" for="radio25-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio25-2"  class="custom-control-input" name="check25" value="2">
                        <label class="custom-control-label" for="radio25-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio25-1"  class="custom-control-input" name="check25" value="1">
                        <label class="custom-control-label" for="radio25-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به مهارت خود در ریاضیات یا علوم تجربی چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio26-7"  class="custom-control-input" name="check26" value="7">
                        <label class="custom-control-label" for="radio26-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio26-6"  class="custom-control-input" name="check26" value="6">
                        <label class="custom-control-label" for="radio26-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio26-5"  class="custom-control-input" name="check26" value="5">
                        <label class="custom-control-label" for="radio26-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio26-4"  class="custom-control-input" name="check26" value="4">
                        <label class="custom-control-label" for="radio26-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio26-3"  class="custom-control-input" name="check26" value="3">
                        <label class="custom-control-label" for="radio26-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio26-2"  class="custom-control-input" name="check26" value="2">
                        <label class="custom-control-label" for="radio26-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio26-1"  class="custom-control-input" name="check26" value="1">
                        <label class="custom-control-label" for="radio26-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به مهارت خود در نقاشی یا خوش نویسی و یا موسیقی چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio27-7"  class="custom-control-input" name="check27" value="7">
                        <label class="custom-control-label" for="radio27-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio27-6"  class="custom-control-input" name="check27" value="6">
                        <label class="custom-control-label" for="radio27-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio27-5"  class="custom-control-input" name="check27" value="5">
                        <label class="custom-control-label" for="radio27-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio27-4"  class="custom-control-input" name="check27" value="4">
                        <label class="custom-control-label" for="radio27-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio27-3"  class="custom-control-input" name="check27" value="3">
                        <label class="custom-control-label" for="radio27-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio27-2"  class="custom-control-input" name="check27" value="2">
                        <label class="custom-control-label" for="radio27-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio27-1"  class="custom-control-input" name="check27" value="1">
                        <label class="custom-control-label" for="radio27-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به مهارت خود در ارتباطات اجتمائی و کار گروهی چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio28-7"  class="custom-control-input" name="check28" value="7">
                        <label class="custom-control-label" for="radio28-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio28-6"  class="custom-control-input" name="check28" value="6">
                        <label class="custom-control-label" for="radio28-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio28-5"  class="custom-control-input" name="check28" value="5">
                        <label class="custom-control-label" for="radio28-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio28-4"  class="custom-control-input" name="check28" value="4">
                        <label class="custom-control-label" for="radio28-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio28-3"  class="custom-control-input" name="check28" value="3">
                        <label class="custom-control-label" for="radio28-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio28-2"  class="custom-control-input" name="check28" value="2">
                        <label class="custom-control-label" for="radio28-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio28-1"  class="custom-control-input" name="check28" value="1">
                        <label class="custom-control-label" for="radio28-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به مهارت خود در مدیریت یک تیم یا گروه چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio29-7"  class="custom-control-input" name="check29" value="7">
                        <label class="custom-control-label" for="radio29-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio29-6"  class="custom-control-input" name="check29" value="6">
                        <label class="custom-control-label" for="radio29-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio29-5"  class="custom-control-input" name="check29" value="5">
                        <label class="custom-control-label" for="radio29-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio29-4"  class="custom-control-input" name="check29" value="4">
                        <label class="custom-control-label" for="radio29-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio29-3"  class="custom-control-input" name="check29" value="3">
                        <label class="custom-control-label" for="radio29-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio29-2"  class="custom-control-input" name="check29" value="2">
                        <label class="custom-control-label" for="radio29-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio29-1"  class="custom-control-input" name="check29" value="1">
                        <label class="custom-control-label" for="radio29-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">به مهارت خود در امور مالی و اداری چه نمره ای می دهید؟</p>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio30-7"  class="custom-control-input" name="check30" value="7">
                        <label class="custom-control-label" for="radio30-7">۷</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio30-6"  class="custom-control-input" name="check30" value="6">
                        <label class="custom-control-label" for="radio30-6">۶</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio30-5"  class="custom-control-input" name="check30" value="5">
                        <label class="custom-control-label" for="radio30-5">۵</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio30-4"  class="custom-control-input" name="check30" value="4">
                        <label class="custom-control-label" for="radio30-4">۴</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio30-3"  class="custom-control-input" name="check30" value="3">
                        <label class="custom-control-label" for="radio30-3">۳</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio30-2"  class="custom-control-input" name="check30" value="2">
                        <label class="custom-control-label" for="radio30-2">۲</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="radio30-1"  class="custom-control-input" name="check30" value="1">
                        <label class="custom-control-label" for="radio30-1">۱</label>
                    </div>
                    <div class="d-flex col-12 justify-content-end">
                        <button type="button" class="btn bg-first-100 col-6 mt-3 ms-1" onclick="prevPrev(1,this)">قبلی</button>
                        <button type="button" class="btn bg-first-100 col-6 mt-3 me-1  next" disabled="disabled" onclick="nextPrev(1,this)">بعدی</button>
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1 justify-content-center">
                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-center py-2">
                        <p>سوالات به پایان رسید!</p>
                        <p>هزینه قابل پرداخت: <span class="badge bg-first-200 my-2">@if(config('tests.holland')) {{ number_format(config('tests.holland')) }} تومان@else رایگان @endif</span></p>
                        <button type="submit" class="btn bg-first-100">پرداخت و مشاهده نتیجه</button>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-2 mx-0">
                    <div class="box">
                        <i class="mdi mdi-chart-bar"></i>
                        <span class="badge bg-first-100">تعداد انجام: {{ $countHolland }}</span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-clock-outline"></i>
                        <span class="badge bg-first-100">زمان: <span class="timer">20:00</span></span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-calendar-question"></i>
                        <span class="questionCounter badge bg-first-100">تعداد سوال:
                        <span class="answeredCount">0</span><span class="totalCount">/30</span>
                        </span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-account-check"></i>
                        <span class="badge bg-first-100">بزرگسال</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $('input[type="checkbox"]').click(function(){
            $(this).parent().parent().find('.next').prop('disabled', false);
        });

        $('input[type="radio"]').click(function(){
            $(this).parent().parent().find('.next').prop('disabled', false);
        });

        $('input[name="mobile"]').click(function(){
            $(this).parent().find('.next').prop('disabled', false);
        })

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

        function prevPrev(n,event) {
            var x = document.getElementsByClassName("tab");
            x[currentTab].style.display = "none";
            currentTab = currentTab - n;
            showTab(currentTab);
        }

        function nextPrev(n,event) {
            var x = document.getElementsByClassName("tab");
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            if (currentTab >= x.length) {
                document.getElementById("testForm").submit();
                return false;
            }
            showTab(currentTab);
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

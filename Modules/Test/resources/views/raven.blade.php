@extends('home::layouts.master')

@section('title','آزمون هوش کاربردی ریون')
<meta name="description" content="آزمون هوش کاربردی ریون یکی از معتبرترین ابزارهای سنجش هوش است. این
آزمون به ارزیابی توانایی های تفکر انتزاعی و حل مسئله افراد می پردازد. آزمون
ریون برای تمامی گروه های سنی مناسب است و به خصوص در محیط های
آموزشی و شغلی به کار می رود.">
<meta name="keywords" content="آزمون هوش کاربردی ریون">
@section('content')
    <div class="container p-0">
        <form id="testForm" action="{{ route('test.ravenStore') }}" method="post">
            @csrf
            <div class="row mx-0 justify-content-center justify-content-md-between justify-content-lg-between">
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 col-md-6 col-lg-3">
                        <img class="w-100" src="{{ asset('assets-front/img/tests/rave_pic.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-md-6 col-lg-9">
                        <h1 class="my-3">تست هوش ریون (IQ)</h1>
                        <span class="small c-gray-300">محبوب ترین تست هوش جهان</span>
                    </div>
                    <div class="col-12 test-content">
                        <p class="my-2">آزمون ماتریس های پیشرونده ریون (که عمدتا آن را ماتریس های ریون می گویند) یا به اختصار RPM، مجموعه تست های غیر-زبانی (verbal) از ابزارهای رایج اندازه‌گیری استدلال قیاسی، توانایی درک مفاهیم انتزاعی و سنجش قوه ادراک است که معمولا در زمینه های آموزشی مورد استفاده قرار می گیرد. این آزمون ۶۰ سوالی، برای سنجش استدلال انتزاعی افراد به عنوان بخشی از هوش عمومی به کار گرفته می شود.</p>
                        <p class="my-2">آزمون بهره هوشی ریون متداول ترین و مشهورترین آزمونی است که برای بازه سنی 5 سال به بالا طراحی شده است. ساختار این آزمون از 60 سوال تشکیل شده که به صورت پاسخ چند گزینه ای (6-8 گزینه) به آن پاسخ داده می شود و ترتیب چیدمان دشواری سوالات از آسان به سخت است. این آزمون هوش استدلالی و هوش عمومی آزمون دهنده را که با عنوان «عامل هوش عمومی اسپیرمن» (Spearsman’s g) شناخته می شود، اندازه گیری می کند.

                            اکثر ما ممکن است آزمون ریون را انجام داده باشیم. این آزمون‌ها معمولا در مدارس و فرایندهای استخدام به‌طور مرتب انجام می‌شوند. در واقع اکنون این تست، بخش مهمی از تست‌های روان‌شناختی در فرایندهای انتخاب مشاغل است.</p>
                        <p class="my-2">با توجه به پیشینه‌ای که از تست هوش (IQ) ریون در ذهنمان داریم، ممکن است با ذهنیت منفی به سراغش برویم. این تست عامل چالش‌برانگیز و تعیین‌کننده در تحصیلات یا زندگی حرفه‌ای ما بوده است؛ با این حال برخی از افراد، ماتریس‌های پیش‌رونده ریون را بسیار جالب می‌دانند و از حل این معماهای کوچک لذت می‌برند. آنها دوست دارند الگوها و مجموعه‌ها را پیدا کنند، استنتاج و نتیجه‌گیری کنند و درمورد چگونگی تصحیح ادراک و انتزاعات تصمیم بگیرند.

                            اندازه‌گیری ضریب هوشی (IQ) هنوز هم موردتوجه بسیاری از افراد و شرکت‌ها است. صرف‌نظر از اینکه تئوری «هوش چندگانه» هاوارد گاردنر (Howard Gardner) را ‌بپذیریم یا نه، با این تست می‌خواهیم توانایی افراد را برای استدلال منطقی، حل مسئله و تفکر انتقادی اندازه‌گیری و اولویت‌بندی کنیم.

                            تست ریون در حقیقت، استدلال انتزاعی و هوش سیال را اندازه‌گیری می‌کند. هوش سیال به ما امکان می‌دهد تا بهتر بتوانیم از پس مشکلات روزمره‌ خود بربیاییم. شاید در آینده و با گسترش نتایج تحقیقات گوناگون، تست‌های روان‌شناختی نیز تغییر کنند.</p>
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
                    <button type="button" class="btn btn-block bg-first-100 next" @if(!auth()->check()) disabled="disabled" @endif onclick="nextPrev(1,this)">شروع آزمون</button>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/1.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven1"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/1a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven1"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/1b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven1"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/1c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven1"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/1d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven1"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/1e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven1"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/1f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/2.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven2"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/2a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven2"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/2b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven2"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/2c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven2"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/2d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven2"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/2e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven2"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/2f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/3.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven3"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/3a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven3"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/3b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven3"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/3c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven3"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/3d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven3"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/3e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven3"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/3f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/4.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven4"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/4a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven4"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/4b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven4"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/4c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven4"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/4d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven4"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/4e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven4"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/4f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/5.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven5"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/5a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven5"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/5b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven5"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/5c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven5"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/5d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven5"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/5e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven5"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/5f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/6.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven6"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/6a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven6"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/6b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven6"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/6c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven6"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/6d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven6"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/6e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven6"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/6f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/7.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven7"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/7a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven7"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/7b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven7"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/7c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven7"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/7d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven7"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/7e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven7"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/7f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/8.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven8"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/8a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven8"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/8b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven8"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/8c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven8"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/8d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven8"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/8e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven8"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/8f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/9.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven9"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/9a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven9"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/9b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven9"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/9c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven9"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/9d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven9"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/9e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven9"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/9f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/10.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven10"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/10a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven10"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/10b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven10"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/10c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven10"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/10d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven10"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/10e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven10"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/10f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/11.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven11"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/11a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven11"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/11b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven11"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/11c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven11"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/11d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven11"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/11e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven11"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/11f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/12.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven12"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/12a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven12"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/12b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven12"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/12c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven12"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/12d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven12"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/12e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven12"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/12f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/13.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven13"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/13a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven13"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/13b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven13"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/13c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven13"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/13d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven13"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/13e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven13"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/13f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/14.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven14"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/14a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven14"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/14b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven14"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/14c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven14"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/14d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven14"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/14e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven14"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/14f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/15.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven15"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/15a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven15"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/15b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven15"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/15c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven15"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/15d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven15"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/15e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven15"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/15f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/16.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven16"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/16a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven16"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/16b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven16"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/16c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven16"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/16d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven16"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/16e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven16"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/16f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/17.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven17"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/17a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven17"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/17b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven17"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/17c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven17"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/17d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven17"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/17e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven17"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/17f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/18.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven18"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/18a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven18"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/18b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven18"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/18c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven18"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/18d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven18"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/18e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven18"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/18f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/19.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven19"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/19a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven19"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/19b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven19"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/19c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven19"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/19d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven19"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/19e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven19"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/19f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/20.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven20"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/20a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven20"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/20b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven20"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/20c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven20"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/20d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven20"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/20e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven20"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/20f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/21.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven21"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/21a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven21"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/21b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven21"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/21c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven21"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/21d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven21"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/21e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven21"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/21f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/22.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven22"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/22a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven22"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/22b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven22"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/22c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven22"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/22d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven22"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/22e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven22"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/22f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/23.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven23"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/23a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven23"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/23b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven23"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/23c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven23"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/23d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven23"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/23e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven23"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/23f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/24.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven24"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/24a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven24"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/24b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven24"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/24c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven24"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/24d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven24"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/24e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven24"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/24f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/25.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven25"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/25h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/26.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven26"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/26h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/27.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven27"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/27h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/28.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven28"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/28h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/29.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven29"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/29h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/30.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven30"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/30h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/31.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven31"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/31h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/32.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven32"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/32h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/33.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven33"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/33h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/34.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven34"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/34h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/35.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven35"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/35h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/36.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven36"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/36h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/37.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven37"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/37h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/38.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven38"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/38h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/39.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven39"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/39h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/40.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven40"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/40h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/41.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven41"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/41h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/42.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven42"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/42h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/43.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven43"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/43h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/44.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven44"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/44h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/45.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven45"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/45h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/46.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven46"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/46h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/47.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven47"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/47h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/48.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven48"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/48h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/49.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven49"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/49h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/50.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven50"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/50h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/51.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven51"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/51h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/52.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven52"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/52h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/53.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven53"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/53h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/54.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven54"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/54h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/55.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven55"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/55h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/56.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven56"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/56h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/57.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven57"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/57h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/58.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven58"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/58h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/59.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven59"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/59h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1">
                    <div class="col-12 title row mx-0 align-items-center">
                        <p class="text-center mb-3">گزینه درست را انتخاب کنید:</p>
                    </div>
                    <div class="col-12 col-lg-7 row mx-0 justify-content-center align-items-center">
                        <img class="questionImg" src="{{ asset('assets-front/img/tests/60.jpg') }}" alt="">
                    </div>
                    <div class="col-12 col-lg-5 row mx-0 justify-content-center align-items-center py-2">
                        <input type="radio" value="1" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60a.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="2" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60b.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="3" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60c.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="4" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60d.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="5" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60e.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60f.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60g.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                        <input type="radio" value="6" name="raven60"><img class="col-6 answerImg" src="{{ asset('assets-front/img/tests/60h.jpg') }}" alt="" onclick="nextPrev(1,this)" style="cursor: pointer">
                    </div>
                </div>
                <div class="tab col-12 col-md-9 col-lg-10 row mb-1 justify-content-center">
                    <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-center py-2">
                        <p>سوالات به پایان رسید!</p>
                        <p>هزینه قابل پرداخت: <span class="badge bg-first-200 my-2">@if(config('tests.raven')) {{ number_format(config('tests.raven')) }} تومان@else رایگان @endif</span></p>
                        <button type="submit" class="btn bg-first-100">پرداخت و مشاهده نتیجه</button>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-2 mx-0">
                    <div class="box">
                        <i class="mdi mdi-chart-bar"></i>
                        <span class="badge bg-first-100">تعداد انجام: {{ $countRaven }}</span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-clock-outline"></i>
                        <span class="badge bg-first-100">زمان: <span class="timer">20:00</span></span>
                    </div>
                    <div class="box">
                        <i class="mdi mdi-calendar-question"></i>
                        <span class="questionCounter badge bg-first-100">تعداد سوال:
                        <span class="answeredCount">0</span><span class="totalCount">/60</span>
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

        function nextPrev(n,event) {
            var x = document.getElementsByClassName("tab");
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            $(event).prev('input').attr('checked', 'checked');
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

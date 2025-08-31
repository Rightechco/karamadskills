@extends('home::layouts.master')

@section('title','نتیجه تست هوش هیجانی')

@section('content')
    <div class="container">
        <div id="testForm">
            <div class="tabResult row mx-0 my-4">
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-tag-multiple c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4>نتایج تست هوش هیجانی</h4></div>
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">حل مسأله </h4>
                            <div class="chart-description">
                                توانایی تشخیص و تعریف مشکلات، و به همان خوبی، توليد و اجراي راه حل های مؤثر و بالقوه.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['resolvent']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['resolvent']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['resolvent']*100)/30) > 80)
                            <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>ﺗﻮﺍﻧﺎﯾﯽ ﻋﺎﻟﯽ ﺩﺭ ﺷﻨﺎﺳﺎﯾﯽ ﻭ ﺣﻞ ﻣﺸﮑﻼﺕ. ﺍﯾﻦ ﻓﺮﺩ ﻣﯽﺗﻮﺍﻧﺪ ﺑﻪ ﺷﮑﻞ ﻣﻮﺛﺮﯼ ﺑﺎ ﭼﺎﻟﺶﻫﺎ ﻣﻮﺍﺟﻪ ﺷﻮﺩ</p>
                            <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: ﻣﻬﻨﺪﺱ، ﻣﺪﯾﺮ ﭘﺮﻭﮊﻩ، ﻣﺸﺎﻭﺭ ﻣﺪﯾﺮﯾﺖ، ﺗﺤﻠﯿﻠﮕﺮ ﺳﯿﺴﺘﻢ</p>
                            @elseif(ceil(($scoreArray['resolvent']*100)/30) > 50)
                            <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>ﺗﻮﺍﻧﺎﯾﯽ ﻣﻨﺎﺳﺒﯽ ﺩﺭ ﺣﻞ ﻣﺴﺌﻠﻪ ﺩﺍﺭﺩ، ﺍﻣﺎ ﻣﻤﮑﻦ ﺍﺳﺖ ﺩﺭ ﺑﺮﺧﯽ ﻣﻮﺍﻗﻊ ﻧﯿﺎﺯ ﺑﻪ ﺗﻘﻮﯾﺖ ﺍﯾﻦ ﻣﻬﺎﺭﺕ ﺩﺍﺷﺘﻪ ﺑﺎﺷﺪ</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: ﻣﻌﻠﻢ، ﻣﺸﺎﻭﺭ ﻣﺎﻟﯽ، ﻣﺪﯾﺮ ﺗﯿﻢ</p>
                            @else
                            <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>ﺩﭼﺎﺭ ﻣﺸﮑﻞ ﺩﺭ ﺷﻨﺎﺳﺎﯾﯽ ﻭ ﺣﻞ ﻣﺸﮑﻼﺕ. ﺍﯾﻦ ﻓﺮﺩ ﻧﯿﺎﺯ ﺑﻪ ﺗﻤﺮﯾﻦ ﻭ ﺗﻮﺳﻌﻪ ﻣﻬﺎﺭﺕﻫﺎﯼ ﺣﻞ ﻣﺴﺌﻠﻪ ﺩﺍﺭﺩ</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: ﮐﺎﺭﻫﺎﯼ ﺭﻭﺗﯿﻦ ﻭ ﺗﮑﺮﺍﺭﯼ، ﮐﺎﺭﻣﻨﺪ ﺍﺩﺍﺭﯼ، ﺩﺳﺘﯿﺎﺭ ﺍﺩﺍﺭﯼ</p>
                                @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">شادمانی</h4>
                            <div class="chart-description">
                                توانایی احساس خوشبختی در زندگی، لذت بردن از خود و دیگران، داشتن احساسات مثبت، صریح، مفرح و شوخ طبعانه.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['happiness']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['happiness']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['happiness']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i></p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مربی، مشاور، کارآفرین، مدیر منابع انسانی</p>
                            @elseif(ceil(($scoreArray['happiness']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i></p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i></p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پژوهشگر، کارهای فنی و تکنیکی، تحلیلگر داده</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">استقلال</h4>
                            <div class="chart-description">
                                توانایی مديريت افکار و اعمال خود، و آزاد بودن از تمایلات هیجانی .
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['freedom']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['freedom']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['freedom']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در تصمیم‌گیری مستقل و آزادانه. این فرد مسئولیت تصمیمات خود را می‌پذیرد و به دیگران وابسته نیست</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارآفرین، مشاور، پژوهشگر مستقل، فریلنسر</p>
                            @elseif(ceil(($scoreArray['freedom']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در تصمیم‌گیری مستقل دارد، اما ممکن است در برخی مواقع نیاز به تقویت استقلال داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مدیر پروژه، معلم، مشاور مالی</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در تصمیم‌گیری مستقل و وابسته به دیگران. این فرد نیاز به تقویت مهارت‌های تصمیم‌گیری و استقلال دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارهای تیمی که نیاز به هماهنگی با دیگران دارند، مانند کارمند بخش پشتیبانی، دستیار اداری</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">تحمل فشار روانی </h4>
                            <div class="chart-description">
                                توانایی مقاومت کردن در برابر موقعیت های فشار آور و هیجانات قوی، بدون جازدن، و رویارویی فعال ومثبت با منبع فشار .
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['tolerance']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['tolerance']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['tolerance']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در تحمل و مدیریت استرس. این فرد می‌تواند در شرایط دشوار آرامش خود را حفظ کند</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پزشک، مدیر بحران، مشاور، کارآفرین</p>
                            @elseif(ceil(($scoreArray['tolerance']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در تحمل استرس دارد، اما ممکن است در برخی مواقع نیاز به تقویت این مهارت داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در تحمل و مدیریت استرس. این فرد نیاز به تمرین و تکنیک‌های آرامش‌بخش دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارهای روتین و تکراری، دستیار اداری، کارمند اداری</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">خود شکوفایی</h4>
                            <div class="chart-description">
                                توانایی درک ظرفیت های بالقوه خود، انجام فعاليت هايي متناسب با توانايي خود، تلاش برای انجام فعاليت و لذت بردن از آن.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['selfFulfillment']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['selfFulfillment']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['selfFulfillment']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در دستیابی به اهداف و توسعه استعدادهای خود. این فرد معمولاً در زندگی شخصی و حرفه‌ای موفق است</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارآفرین، نویسنده، محقق، دانشمند</p>
                            @elseif(ceil(($scoreArray['selfFulfillment']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در دستیابی به اهداف و توسعه استعدادها دارد، اما ممکن است نیاز به برنامه‌ریزی و تلاش بیشتر داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مدیر پروژه، معلم، مشاور</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در دستیابی به اهداف و توسعه استعدادها. این فرد نیاز به راهنمایی و حمایت بیشتری دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مدیر پروژه، معلم، مشاور</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">خود آگاهی هیجانی</h4>
                            <div class="chart-description">
                                توانایی آگاهي، فهم و وقوف بر احساس خود .
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['selfAwareness']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['selfAwareness']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['selfAwareness']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در شناخت و درک احساسات خود. این فرد می‌تواند احساسات خود را به خوبی مدیریت کند و واکنش‌های مناسبی نشان دهد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مشاور، روانشناس، مربی شخصی، مدیر منابع انسانی</p>
                            @elseif(ceil(($scoreArray['selfAwareness']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در شناخت و درک احساسات خود دارد. ممکن است در برخی موارد نیاز به تمرین بیشتر داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، کارمند اجتماعی، مشاور مشتری، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در شناخت و درک احساسات خود. این فرد ممکن است واکنش‌های نادرستی نشان دهد و نیاز به تمرین و راهنمایی بیشتری داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارهای تکنیکی و فنی که نیاز به تعامل کمتری با دیگران دارند، مانند برنامه‌نویسی، تحلیلگر داده</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">واقع گرایی</h4>
                            <div class="chart-description">
                                توانایی سنجش هماهنگی، بین تجربة هیجانی تجربه و واقعيت.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['realism']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['realism']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['realism']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در درک دقیق و صحیح واقعیت‌ها. این فرد معمولاً تصمیمات منطقی می‌گیرد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مهندس، مدیر پروژه، مشاور مالی، تحلیلگر داده</p>
                            @elseif(ceil(($scoreArray['realism']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در درک واقعیت‌ها دارد، اما ممکن است در برخی مواقع نیاز به تقویت این مهارت داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در درک دقیق و صحیح واقعیت‌ها. این فرد نیاز به تمرین و توسعه مهارت‌های واقع‌گرایی دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پژوهشگر، هنرمند، کارهای خلاقانه</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">روابط بین فردی</h4>
                            <div class="chart-description">
                                توانایی ایجاد و حفظ روابط رضایت بخش متقابل که به وسیلۀ نزدیکی عاطفی ، صمیمیت، ابراز محبت و دريافت محبت ايجاد و ادامه می يابد.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['relationships']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['relationships']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['relationships']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در برقراری و حفظ روابط موثر با دیگران. این فرد معمولاً در روابط اجتماعی موفق است</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مشاور، روانشناس، مربی، مدیر منابع انسانی</p>
                            @elseif(ceil(($scoreArray['relationships']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در روابط بین‌فردی دارد، اما ممکن است در برخی مواقع نیاز به تقویت این مهارت داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر پروژه</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در برقراری و حفظ روابط موثر. این فرد نیاز به تمرین و توسعه مهارت‌های ارتباطی دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارهای فنی و تکنیکی، پژوهشگر، تحلیلگر داده</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">خوش بینی</h4>
                            <div class="chart-description">
                                توانایی نگاه زیرکانه و مثبت به زندگی، تقویت نگرش های مثبت، حتی درمواجهه با ناملايمات، بدبختی ها و احساسات منفی .
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['optimism']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['optimism']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['optimism']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دیدگاه مثبت به زندگی و آینده. این فرد معمولاً در مواجهه با مشکلات انگیزه و انرژی مثبت خود را حفظ می‌کند</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مربی، مشاور، کارآفرین، مدیر منابع انسانی</p>
                            @elseif(ceil(($scoreArray['optimism']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دیدگاه مناسبی به زندگی دارد، اما ممکن است در برخی مواقع نیاز به تقویت خوش‌بینی داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در خوش‌بینی و نگرش مثبت به زندگی. این فرد نیاز به تمرین و تقویت نگرش مثبت دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پژوهشگر، کارهای فنی و تکنیکی، تحلیلگر داده</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">عزت نفس</h4>
                            <div class="chart-description">
                                توانایی آگاهي از ادراکات خود، پذیرش خود و احترام به خود.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['selfEsteem']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['selfEsteem']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['selfEsteem']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>اعتماد به نفس بالا و احساس مثبت نسبت به خود. این فرد معمولاً از زندگی خود رضایت دارد و توانایی مقابله با چالش‌ها را دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارآفرین، مدیر اجرایی، مربی شخصی، روانشناس</p>
                            @elseif(ceil(($scoreArray['selfEsteem']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>اعتماد به نفس مناسبی دارد، اما ممکن است در برخی مواقع نیاز به تقویت احساس مثبت نسبت به خود داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مدیر پروژه، معلم، مشاور مالی، مشاور مشتری</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در اعتماد به نفس و ارزش‌گذاری به خود. این فرد ممکن است احساس بی‌ارزشی داشته باشد و نیاز به تقویت اعتماد به نفس دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پژوهشگر، کارهای فنی و تکنیکی، دستیار اداری</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">کنترل تکانش</h4>
                            <div class="chart-description">
                                توانایی مقاومت در برابر عوامل تنيدگي، سایق ها  یا تجارب و کاهش آن ها، و توانایی کنترل هیجانات خود.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['impulsivity']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['impulsivity']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['impulsivity']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در کنترل و مدیریت تکانه‌ها. این فرد می‌تواند واکنش‌های فوری خود را مدیریت کند</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مشاور مالی، وکیل، مدیر پروژه، تحلیلگر سیستم</p>
                            @elseif(ceil(($scoreArray['impulsivity']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در کنترل تکانه دارد، اما ممکن است در برخی مواقع نیاز به تقویت این مهارت داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در کنترل تکانه‌ها. این فرد نیاز به تمرین و توسعه مهارت‌های مدیریت تکانه دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارهای خلاقانه و هنری، نویسنده، پژوهشگر</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">انعطاف پذیری</h4>
                            <div class="chart-description">
                                توانایی سازگار كردن افکار و رفتار با تغییرات محیط وموقعیت ها.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['flexibility']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['flexibility']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['resolvent']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی عالی در سازگاری با شرایط و موقعیت‌های جدید. این فرد می‌تواند به راحتی با تغییرات مواجه شود</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارآفرین، مدیر پروژه، مشاور، متخصص تغییر مدیریت</p>
                            @elseif(ceil(($scoreArray['resolvent']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در سازگاری با شرایط دارد، اما ممکن است در برخی مواقع نیاز به تقویت این مهارت داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مالی، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در سازگاری با شرایط و موقعیت‌های جدید. این فرد نیاز به تمرین و توسعه مهارت‌های انعطاف‌پذیری دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: کارهای روتین و تکراری، دستیار اداری، کارمند اداری</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">مسؤولیت پذیری اجتماعی</h4>
                            <div class="chart-description">
                                توانایی ابراز خود به عنوان یک عضو دارای حس همکاری، مؤثر و سازنده در گروه.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['responsibility']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['responsibility']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['resolvent']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>احساس تعهد به جامعه و دیگران. این فرد معمولاً در فعالیت‌های اجتماعی و خیریه فعال است</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مددکار اجتماعی، مشاور، کارمند خیریه، مربی</p>
                            @elseif(ceil(($scoreArray['resolvent']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>احساس مناسبی از مسئولیت‌پذیری اجتماعی دارد، اما ممکن است در برخی مواقع نیاز به تقویت این حس داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر منابع انسانی</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در احساس تعهد به جامعه و دیگران. این فرد نیاز به تمرین و مشارکت بیشتر در فعالیت‌های اجتماعی دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پژوهشگر، کارهای فنی و تکنیکی، تحلیلگر داده</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">خوش بینی</h4>
                            <div class="chart-description">
                                توانایی نگاه زیرکانه و مثبت به زندگی، تقویت نگرش های مثبت، حتی درمواجهه با ناملايمات، بدبختی ها و احساسات منفی .
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['empathy']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['empathy']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['resolvent']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دیدگاه مثبت به زندگی و آینده. این فرد معمولاً در مواجهه با مشکلات انگیزه و انرژی مثبت خود را حفظ می‌کند</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مربی، مشاور، کارآفرین، مدیر منابع انسانی</p>
                            @elseif(ceil(($scoreArray['resolvent']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دیدگاه مناسبی به زندگی دارد، اما ممکن است در برخی مواقع نیاز به تقویت خوش‌بینی داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: معلم، مشاور مشتری، مدیر تیم</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در خوش‌بینی و نگرش مثبت به زندگی. این فرد نیاز به تمرین و تقویت نگرش مثبت دارد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پژوهشگر، کارهای فنی و تکنیکی، تحلیلگر داده</p>
                            @endif
                        </div>
                        <div class="chart-wrapper col-12 mt-5">
                            <h4 class="chart-title">خود ابرازی </h4>
                            <div class="chart-description">
                                توانایی ابراز احساسات، باورها و افکار صریح، و دفاع از رفتارها و مهارت های سازنده و بر حق خود.
                            </div>
                            <div class="chart" id="chart2">
                                <div class="chart-info-percentage">
                                    <div class="chart-info-percentage__front">
                                        <span class="number">{{ ceil(($scoreArray['selfExpression']*100)/30) }} %</span>
                                    </div>
                                    <div class="chart-info-percentage__back">

                                    </div>
                                </div>
                                <div class="chart-line">
                                    <div class="chart-line__front" style="width: {{ ceil(($scoreArray['selfExpression']*100)/30) }}%"></div>
                                </div>
                            </div>
                            @if(ceil(($scoreArray['resolvent']*100)/30) > 80)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی بیان افکار و احساسات به شکل مستقیم و با اعتماد به نفس. این فرد معمولاً در ارتباطات خود موفق است</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: وکیل، مدیر فروش، سخنران عمومی، مذاکره‌کننده</p>
                            @elseif(ceil(($scoreArray['resolvent']*100)/30) > 50)
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>توانایی مناسبی در بیان افکار و احساسات دارد. ممکن است در برخی مواقع نیاز به افزایش اعتماد به نفس داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: مشاور مالی، معلم، مشاور مشتری، نویسنده</p>
                            @else
                                <p><i class="mdi mdi-hand-pointing-left ms-3" style="font-size: 22px"></i>دچار مشکل در بیان افکار و احساسات خود. این فرد ممکن است در مواجهه با تعارضات و ارتباطات مشکل داشته باشد</p>
                                <p><i class="mdi mdi-worker ms-3" style="font-size: 22px"></i>شغل های مناسب: پژوهشگر، کارهای فنی و تکنیکی که نیاز به تعامل کمتری با دیگران دارند</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="boxResult row mx-0 justify-content-center">
                    <div class="col-12 mt-4">
                        <div class="row title">
                            <div class="col-1"><i class="mdi mdi-tag-multiple c-first-200" style="font-size: 70px"></i></div>
                            <div class="col-9"><h4>توضیحاتی از نتایج</h4></div>
                        </div>
                        @php
                        $up = $middle = $down = 0;
                        foreach ($scoreArray as $sc) {
                            if ($sc >= 20) {
                                $up++;
                            } elseif ($sc <= 10) {
                                $down++;
                            } else {
                                $middle++;
                            }
                        }
                        @endphp
                        @if($up >= 8)
                        <p class="mt-5">افراد با این نمرات دارای هوش هیجانی بسیار بالایی هستند. آنها می‌توانند احساسات خود را به خوبی درک و مدیریت کنند، در روابط بین فردی موفق باشند و با استرس و تغییرات به خوبی کنار بیایند. این افراد معمولاً خوش‌بین و واقع‌گرا هستند.</p>
                        <p class="mt-5">شغل ها و رشته های مرتبط:</p>
                        <div class="mt-4 text-center">
                            <span class="badge bg-info p-4 mt-1">مدیریت</span>
                            <span class="badge bg-info p-4 mt-1">مشاور</span>
                            <span class="badge bg-info p-4 mt-1">مددکار اجتماعی</span>
                            <span class="badge bg-info p-4 mt-1">روانشناسی</span>
                        </div>
                        @elseif($middle >= 8)
                        <p class="mt-5">افراد با این نمرات دارای هوش هیجانی متوسط هستند. آنها می‌توانند احساسات خود را در حد متوسطی درک و مدیریت کنند و در روابط بین فردی به طور معمولی موفق باشند. این افراد در شرایط استرس‌زا و تغییرات ممکن است به کمی کمک و پشتیبانی نیاز داشته باشند.</p>
                        <p class="mt-5">شغل ها و رشته های مرتبط:</p>
                        <div class="mt-4 text-center">
                            <span class="badge bg-info p-4 mt-1">معلم</span>
                            <span class="badge bg-info p-4 mt-1">کارمند اداری</span>
                            <span class="badge bg-info p-4 mt-1">مشاور تحصیلی</span>
                            <span class="badge bg-info p-4 mt-1">مدیریت منابع انسانی</span>
                        </div>
                        @elseif($down >= 8)
                        <p class="mt-5">افراد با این نمرات دارای هوش هیجانی پایینی هستند. آنها ممکن است در درک و مدیریت احساسات خود، برقراری روابط بین فردی و مقابله با استرس و تغییرات دچار مشکلاتی شوند. این افراد نیاز به پشتیبانی و آموزش بیشتری برای بهبود مهارت‌های هیجانی خود دارند.</p>
                        <p class="mt-5">شغل ها و رشته های مرتبط:</p>
                        <div class="mt-4 text-center">
                            <span class="badge bg-info p-4 mt-1">مشاغل فنی</span>
                            <span class="badge bg-info p-4 mt-1">مهندسی</span>
                            <span class="badge bg-info p-4 mt-1">علوم کامپیوتر</span>
                            <span class="badge bg-info p-4 mt-1">فناوری اطلاعات</span>
                        </div>
                        @else
                        <p class="mt-5">افراد با نتایج نامتعادل ممکن است در برخی از جنبه‌های هوش هیجانی قوی باشند و در برخی دیگر ضعیف. این افراد ممکن است در درک احساسات خود و همدلی با دیگران خوب عمل کنند، اما در مدیریت استرس و تنظیم احساسات خود دچار مشکلاتی باشند. برنامه‌های آموزشی و تمرینی متمرکز بر نقاط ضعف می‌تواند به بهبود مهارت‌های آنها کمک کند.</p>
                        <p class="mt-5">شغل ها و رشته های مرتبط:</p>
                        <div class="mt-4 text-center">
                            <span class="badge bg-info p-4 mt-1">مشاور روانشناسی</span>
                            <span class="badge bg-info p-4 mt-1">مدیر پروژه</span>
                            <span class="badge bg-info p-4 mt-1">مربی ورزشی</span>
                        </div>
                        @endif
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

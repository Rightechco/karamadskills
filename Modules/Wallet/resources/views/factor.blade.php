@extends('panel::layouts.master')

@section('title', 'فاکتور')

@section('meta')
    <style>
        #invoice.invoice {
            /*width: 1754px;*/
            /*height: 2480px;*/
            margin: 0 auto;
            width: 100%;
            height: 100%;
            padding: 10mm;
            /* border: 1px solid #000; */
            box-sizing: border-box;
            page-break-after: always;
            padding-inline-start: 5mm;
            background-color: #fff;
            border-radius: var(--radius);
        }

        #invoice .header2 {
            text-align: center;
            margin-bottom: 20px;
        }

        #invoice .header2 h1 {
            margin: 0;
            font-size: 20px;
        }

        #invoice .box {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
            width: 100%;
        }

        #invoice .box h2 {
            margin-top: 0;
            font-size: 16px;
        }

        #invoice table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        #invoice table,
        #invoice th,
        #invoice td {
            border: 1px solid #000;
        }

        #invoice th,
        #invoice td {
            padding: 5px;
            text-align: center;
            font-size: 12px;
        }

        #invoice tfoot td {
            font-weight: bold;
        }

        #invoice .footer2 {
            margin-top: 50px;
        }

        #invoice .footer2 p {
            margin: 5px 0;
            font-size: 12px;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="d-flex justify-content-between">
                            <div class="row justify-content-between mx-0 align-items-center ml-3">
                                <h5>جزئیات فاکتور</h5>
                            </div>
                            <button name="print" class="dt-button buttons-excel buttons-html5" tabindex="0"
                                    onclick="$('#factor').printThis()"
                                    aria-controls="usersTable"><span>پرینت</span></button>
                        </div>
                        <div id="factor" class="row layout-top-spacing">
                            <div class="col-12 layout-spacing">
                                <div class="userProfile-container m-3">
                                    <div class="user-card row">
                                        <div class="invoice" id="invoice" style="">
                                            <div class="header2 row">
                                                <div class="col-4 text-left">
                                                    <img src="{{ asset('assets-front/img/fav.png') }}" alt="تصویر" height="45">
                                                    <h6 class="font-weight-bold">سامانه کاریابی کارآمد</h6>
                                                </div>
                                                <div class="col-4">
                                                    <h1 class="font-weight-bold">فاکتور تراکنش</h1>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <p>شماره تراکنش: {{ $trac->id }}</p>
                                                    <p>تاریخ
                                                        تراکنش: {{ $trac->created_at->toJalali()->format('Y/m/d') }}</p>
                                                </div>
                                            </div>
                                            <div class="box">
                                                <h2>مشخصات صاحب تراکنش</h2>
                                                <p>نام شخص حقوقی/حقیقی: {{ $trac->wallet->user->name ?? '' }}</p>
                                                <p>کد ملی: {{ $trac->wallet->user->nationalCode ?? '' }}</p>
                                                <p>تلفن: {{ $trac->wallet->user->mobile }}</p>
                                            </div>
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th style="background-color: #F2F2F2">شماره</th>
                                                    <th style="background-color: #F2F2F2">نوع</th>
                                                    <th style="background-color: #F2F2F2">مبلغ</th>
                                                    <th style="background-color: #F2F2F2">توضیحات</th>
                                                </tr>
                                                </thead>
                                                <tr>
                                                    <td>{{ $trac->id }}</td>
                                                    <td>{{ __('messages.' . $trac->type) }}</td>
                                                    <td>{{ number_format($trac->amount) }} تومان</td>
                                                    <td>{{ $trac->des }}</td>
                                                </tr>
                                                <tfoot>
                                                <tr>
                                                    <td style="background-color: #F2F2F2" colspan="2">جمع کل (تومان)</td>
                                                    <td style="background-color: #F3F3F3" id="totalPayable">{{ number_format($trac->amount)}} تومان</td>
                                                    <td style="background-color: #F4F4F4"></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <div class="footer2">
                                                <p>توضیحات:</p>
                                                <p>مهر و امضا فروشنده: </p>
                                                <p>مهر و امضا خریدار: </p>
                                                <p>© تمام حقوق اين وب‌سايت برای بارنج محفوظ است.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>

    </script>
@endsection

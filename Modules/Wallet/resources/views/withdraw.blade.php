@extends('panel::layouts.master')

@section('title','برداشت ها')
@section('meta')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/custom_dt_custom.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>برداشت ها</h4>
                            <a href="{{ route('panel.wallet.wallet') }}" style="font-size: 35px"><i class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <form action="{{ route('panel.wallet.withdrawStore') }}" method="post">
                            @csrf
                            <div class="row widget-content widget-content-area br-6k">
                                <div class="row col-12 row justify-content-between mx-0 align-items-center">
                                    <h5>برداشت تومان</h5>
                                    <a href="{{ route('panel.wallet.wallet') }}" style="font-size: 35px"><i
                                            class='bx bx-arrow-back'></i></a>
                                </div>
                                <div class="row mx-auto col-12 col-lg-6 col-md-6 col-sm-12">
                                    <!-- Select Bank Account Section -->
                                    <div class="col-12 mt-3">
                                        <label for="unit">واریز به</label>
                                        <select class="form-control select2" name="card" id="unit"
                                                data-live-search="true">
                                            <option value="">انتخاب</option>
                                            @foreach($cards as $card)
                                                <option @if(old('card') == $card) selected
                                                        @endif value="{{ $card->id }}">
                                                    {{ $card->shaba_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('card')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Withdrawal Limit Warning -->
                                    <div class="col-12 d-flex align-items-center p-2 mt-3" style="background-color: rgba(255, 243, 205, 0.9); border-left: 5px solid #ffa000; border-radius: 8px;">
                                        <i class="iconBold-warning-2 mr-3" style="color: #ffa000; font-size: 22px;"></i>
                                        <p class="mb-0" style="color: #444; font-size: 14px;">
                                            مقدار مجاز برداشت امروز برای این شبا 100,000,000 تومان
                                        </p>
                                    </div>

                                    <div class="col-12 d-flex align-items-center p-2 mt-3" style="background-color: rgba(255, 243, 205, 0.9); border-left: 5px solid #ffa000; border-radius: 8px;">
                                        <i class="iconBold-warning-2 mr-3" style="color: #ffa000; font-size: 22px;"></i>
                                        <p class="mb-0" style="color: #444; font-size: 14px;">
                                           حداقل میزان برداشت 20,000 تومان می باشد
                                        </p>
                                    </div>

                                    <!-- Withdrawal Amount Input -->
                                    <div class="col-12 mt-4">
                                        <label for="amount">مقدار برداشت به تومان</label>
                                            <input required name="amount" type="text" id="amount" class="form-control" placeholder="تومان" value="{{ old('amount') }}">
                                        @error('amount')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Total Balance Information -->
                                    <div class="col-12 d-flex align-items-center p-2 mt-3" style="background-color: rgba(255, 243, 205, 0.9); border-left: 5px solid #ffa000; border-radius: 8px;">
                                        <i class="iconBold-warning-2 mr-3" style="color: #ffa000; font-size: 22px;"></i>
                                        <p class="mb-0" style="color: #444; font-size: 14px;">
                                            کل موجودی شما: {{ number_format($user->wallet->balance) }} تومان
                                        </p>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary col-12 mb-4"
                                                style="font-size: 15px; line-height: 2; border-radius: 8px;">
                                            درخواست برداشت
                                        </button>
                                    </div>
                                </div>
                                <div class="row col-12 col-lg-6 col-md-6 col-sm-12 mx-auto">

                                    <!-- Warning Box -->
                                    <div class="col-12 d-flex align-items-center p-3 mt-3"
                                         style="height: auto; background-color: rgb(255, 246, 204); border-radius: 8px;">
                                        <i class="iconBold-warning-2 mr-3" style="color: #ffa000; font-size: 25px;"></i>
                                        <span style="font-size: 14px;">
                                            از واریز هر گونه وجه به حساب افراد ناشناس که از طریق آگهی‌های درآمدزایی و ... شما را پیدا کرده‌اند خودداری کنید. این شیوه کلاه‌برداری بوده و مسئولیت جرم صورت‌گرفته متوجه شما خواهد بود.
                                        </span>
                                    </div>

                                    <!-- Central Bank Warning -->
                                    <div class="col-12 d-flex align-items-center p-3 mt-3"
                                         style="background-color: rgb(229, 242, 255); border-radius: 8px;">
                                        <i class="iconBold-warning-2 mr-2"
                                           style="color: rgb(0, 122, 255); font-size: 25px;"></i>
                                        <span style="font-size: 14px; color: rgb(37, 37, 37);">
                                            به دستور بانک مرکزی، سقف واریز در هر روز به هر حساب بانکی ۱۰۰ میلیون تومان خواهد بود. برای برداشت مبالغ بیشتر از چند حساب بانکی استفاده کنید و یا در روزهای متوالی درخواست برداشت کنید.
                                        </span>
                                    </div>

                                    <!-- Withdrawal Cycle Information -->
                                    <div class="mt-4">
                                        <p class="lh-lg text-danger mb-2" style="font-size: 14px;">
                                            درخواست‌های برداشت ثبت‌شده، وارد صف سیکل‌های پایا شده و در اولین سیکل یا در
                                            برخی موارد تا ۴۸ ساعت تسویه خواهد شد.
                                        </p>
                                        <p style="font-size: 14px;">
                                            <strong>سیکل‌های پایا (روزهای غیر تعطیل):</strong>
                                            <br>
                                            ثبت پیش از ۱۳ ظهر ----> ساعت ۱۳:۴۵ همان روز
                                            <br>
                                            ثبت‌ پیش از ۱۸:۰۰ عصر ----> ساعت ۱۸:۴۵ همان روز
                                            <br>
                                            ثبت پس از ساعت ۱۸:۰۰ عصر ----> ساعت ۱۳:۴۵ روز کاری بعد
                                            <br><br>
                                            <strong>سیکل‌های پایا (روزهای تعطیل):</strong>
                                            <br>
                                            ساعت ۱۳:۴۵ روز کاری بعد
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12 mt-3">
                    <div class="main-content layout-top-spacing">
                        <div class="layout-px-spacing">
                            <div class="row" id="cancel-row">
                                <div class="col-12 layout-spacing">
                                    <div class="widget-content widget-content-area br-6k">
                                        <div class="row justify-content-between mx-0 align-items-center">
                                            <h5>آخرین برداشت های تومان</h5>
                                        </div>
                                        <div class="table-responsive mb-4 mt-4">
                                            <table id="withdrawTable" class="table table-hover non-hover panel-table"
                                                   style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th id="clickElement">شماره</th>
                                                    <th class="no-sort">شماره شبا</th>
                                                    <th class="no-sort">مقدار</th>
                                                    <th class="no-sort">کد رهگیری</th>
                                                    <th class="no-sort">وضعیت</th>
                                                    <th class="">تاریخ ثبت</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
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

    <script src="{{ asset('assets/libs/datatables/datatables.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/datatables.responsive.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/responsive.dataTables.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables/button-ext/buttons.print.min.js') }}"></script>
    <script>
        $('#withdrawTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('panel.wallet.userWithdraw') }}",
                dataType: "json",
                type: "POST",
                data: {_token: "{{ csrf_token() }}"}
            },
            columns: [
                {"data": "id"},
                {"data": "card"},
                {"data": "amount"},
                {"data": "trans"},
                {"data": "status"},
                {"data": "date"}
            ],
            order: [[0,"desc"]],
            responsive: true,
            columnDefs: [
                {
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    "targets": 'no-sort',
                    "orderable": false
                }
            ],
            dom: 'Blfrtip',
            buttons: [
                { extend: 'excelHtml5', text: 'اکسل' },
                { extend: 'csvHtml5', text: 'csv' },
            ],
            "language": {
                "lengthMenu": "نمایش _MENU_ رکورد اخیر",
                "infoEmpty": "هیچ رکوردی وجود ندارد",
                "infoFiltered": "(جستوجو میان _MAX_ آیتم)",
                "info": "نمایش صفحه _PAGE_ از _PAGES_",
                "next": "صفحه بعد",
                "previous": "Previous",
                "search": "جستجو: ",
                "emptyTable": "هیچ نتیجه ای پبدا نشد.",
                "searchPlaceholder": "جستجو",
                "loadingRecords": "در حال پردازش ...",
                "zeroRecords": "هیچ نتیجه ای پبدا نشد.",
                "paginate": {
                    "next": "صفحه بعد",
                    "previous": "صفحه قبل"
                },
            },
            "lengthMenu": [[10, 25, 50, 100,-1],[10,25,50,100,'All']]
        });
    </script>
@endsection

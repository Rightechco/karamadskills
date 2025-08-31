@extends('panel::layouts.master')

@section('title','کیف پول')
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
                            <h4>کیف پول</h4>
                        </div>
                        <div class="row my-4">
                            <div class="col-12">
                                <div class="col-12 d-flex align-items-center p-2 mb-4"
                                     style="background-color: rgba(255, 243, 205, 0.9); border-left: 5px solid #ffa000; border-radius: 8px;">
                                    <i class="iconBold-warning-2 mb-1 p-2" style="color: #ffa000; font-size: 22px;"></i>
                                    <p class="mb-0" style="color: #444; font-size: 14px;">
                                        توجه! کابر گرامی لطفا پس از اضافه کردن کارت بانکی منتظر تایید واحد پشتیبانی بوده
                                        و سپس پس از
                                        تایید آن را از قسمت <a href="{{ route('panel.card.userCards') }}"
                                                               class="text-primary">مشاهده
                                            کارت ها</a> به عنوان کارت پیش فرض انتخاب کرده تا در قسمت کارت پیش فرض نمایش
                                        داده شود.
                                    </p>
                                </div>
                            </div>
                            <div
                                class="col-xl-4 col-lg-6 col-sm-6 col-12 px-0 d-flex justify-content-center bg-gray-100 p-2 radius">
                                <div class="d-flex flex-column w-100 justify-content-between">
                                    <div
                                        class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                                        <h6 class="mb-2 mb-sm-0 font-weight-bold">موجودی کیف پول من</h6>
                                        <i class="fas fa-wallet" style="font-size: 50px;"></i>
                                    </div>

                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                        <!-- Balance Information -->
                                        <div class="ml-4"> <!-- Adjust spacing with 'me-4' class -->
                                            <div class="row mb-3">
                                                <h1 class="mr-2">{{ number_format(auth()->user()->wallet->balance) }}</h1>
                                                <span class="text-info" style="margin-top: 20px">تومان</span>
                                            </div>
                                        </div>
                                        <!-- Checkbox -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   {{ ($wallet->autoWithdraw == 1) ? 'checked' : '' }} id="autoWithdraw"
                                                   name="autoWithdraw">
                                            <label for="autoWithdraw" class="custom-control-label"
                                                   data-bs-toggle="tooltip" data-bs-placement="top"
                                                   title=" تسویه خودکار! در صورت وجود کارت پیش فرض و موجودی بیشتر از صد هزار تومان تسویه روزانه با شما انجام می شود.">
                                                تسویه خودکار
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row mx-0 justify-content-between">
                                        <a href="{{ route('panel.deposit.deposit') }}" class="btn btn-info " style="width: 180px">
                                            <i class="fas fa-hand-point-down mr-2"></i> <span>واریز</span></a>
                                        <a href="{{ route('panel.wallet.withdraw') }}"
                                           class="btn btn-info " style="width: 180px"> <i
                                                class="fas fa-hand-point-up mr-2"></i> <span>برداشت</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-6 col-12 px-0 d-flex justify-content-center radius">
                                <div
                                    class="cart d-flex flex-column justify-content-between align-items-center widget-content br-6 w-90 align-items-center mt-3 mt-sm-0">
                                    <div class="cart-header p-2 d-flex justify-content-end align-items-center w-100"
                                         style="height: 25%;">
                                        <img class="bankLogo d-none mr-auto" src="" alt=""
                                             style="width: 13%; height:100%">
                                        <img src="{{ asset('assets/img/bank/shetab.png') }}"
                                             style="width: 18%; height:100%">
                                    </div>
                                    <!-- <div style="font-size: 23px; text-align: center; direction: ltr; margin-top: 50px"class="text-white">
                            {{ $card_number }}
                                    </div> -->
                                    <h4 class="mb-0 mt-3 h4-2">
                                        <span class="cart-num1">{{ str_split($card_number, 4)[0] }}</span>
                                        <span class="cart-num2">{{ str_split($card_number, 4)[1] }}</span>
                                        <span>{{ str_split($card_number, 4)[2] }}</span>
                                        <span>{{ str_split($card_number, 4)[3] }}</span>
                                    </h4>
                                    <h5 class="h5-2">IR {{ $card->shaba_number ?? '-' }}</h5>
                                    <div class="cart-footer d-flex justify-content-between align-items-end w-100">
                                        <span class="mb-2 p-1"
                                              style="border-radius: 4px; color: #fff;background-color:#e4e4e44d;box-shadow: 0px 0px 4px 2px #f5f5f5;">پیشفرض</span>
                                        @if(isset($card))
                                            <a class="cart-status p-1">{{ __('messages.'.$card->status) }}</a>
                                        @endif
                                    </div>
                                    <!-- <p class="text-white pt-3">{{ $user->name }}</p> -->
                                </div>
                            </div>
                            <div
                                class="col-xl-4 col-lg-6 col-sm-6 col-12 px-0 d-flex justify-content-center bg-gray-100 p-2 radius">
                                <form class="d-flex flex-column w-100 justify-content-between"
                                      action="{{ route('panel.card.postCard', $user->id) }}" method="post">
                                    @csrf
                                    <div
                                        class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                                        <h6 class="mb-2 mb-sm-0 font-weight-bold">افزودن کارت جدید</h6>
                                        <i class="fas fa-credit-card" style="font-size: 50px;"></i>
                                    </div>

                                    <div class="my-1">
                                        <input type="text" name="shaba_number" class="form-control"
                                               placeholder="شماره شبا">
                                        @error('shaba_number')
                                        <small class="form-text text-danger mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Card Number -->
                                    <div class="my-3 position-relative">
                                        <input type="text" name="card_number" class="form-control cartNum"
                                               placeholder="شماره کارت ۱۶ رقمی">
                                        <img class="position-absolute d-none" id="bankLogo" src="" alt=""
                                             style="width: auto; height:28px; left:5px; top: 1px;">
                                        @error('card_number')
                                        <small class="form-text text-danger mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row mx-0 justify-content-between">
                                        <button type="submit" class="btn btn-info "
                                                style="width: 180px"><span>افزودن کارت</span></button>
                                        <a href="{{ route('panel.card.userCards') }}"
                                           class="btn btn-secondary " style="width: 180px">
                                            <span>مشاهده کارت ها</span></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>لیست تراکنش ها</h4>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="tracsTable" class="table table-hover non-hover panel-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th id="clickElement">شماره</th>
                                        <th class="">تاریخ</th>
                                        <th>مقدار</th>
                                        <th class="">نوع تراکنش</th>
                                        <th class="no-sort">توضیحات</th>
                                        <th class="no-sort">عملیات</th>
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
        $('#tracsTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('panel.wallet.getTrans') }}",
                dataType: "json",
                type: "POST",
                data: {_token: "{{ csrf_token() }}"}
            },
            columns: [
                {"data": "id"},
                {"data": "date"},
                {"data": "amount"},
                {"data": "type"},
                {"data": "des"},
                {"data": "detail"},
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

        var number1 = document.querySelectorAll('.cart-num1');
        number1.forEach(function (element) {
            var num1 = $(element).text();
            var number2 = $(element).siblings('.cart-num2').text();
            var num2 = number2.slice(0, 2);
            var number = num1 + num2;
            if (number === '603799') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/meli.png') }}");
                $(element).parent('h4').parent().addClass('cart-blue');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '589210') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sepah.png') }}");
                $(element).parent('h4').parent().addClass('cart-silver');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '627961') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sanatmadan.png') }}");
                $(element).parent('h4').parent().addClass('cart-silver');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '603770') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/keshavarsi.png') }}");
                $(element).parent('h4').parent().addClass('cart-black');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '628023') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/maskan.png') }}");
                $(element).parent('h4').parent().addClass('cart-cherry');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '627760') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/postbank.png') }}");
                $(element).parent('h4').parent().addClass('cart-gold');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '502908') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/tosee.png') }}");
                $(element).parent('h4').parent().addClass('cart-black');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '627412') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/eghtesad.png') }}");
                $(element).parent('h4').parent().addClass('cart-silver');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '622106') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/parsian.png') }}");
                $(element).parent('h4').parent().addClass('cart-gold');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '502229') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/pasargad.png') }}");
                $(element).parent('h4').parent().addClass('cart-cherry');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '627488') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/karafarin.png') }}");
                $(element).parent('h4').parent().addClass('cart-silver');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '621986') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/saman.png') }}");
                $(element).parent('h4').parent().addClass('cart-cherry');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '639346') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sina.png') }}");
                $(element).parent('h4').parent().addClass('cart-gold');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '639607') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/sarmaye.png') }}");
                $(element).parent('h4').parent().addClass('cart-blue');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '502806' || number === '504706') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/shahr.png') }}");
                $(element).parent('h4').parent().addClass('cart-black');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '502938') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/day.png') }}");
                $(element).parent('h4').parent().addClass('cart-gold');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '603769') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/saderat.png') }}");
                $(element).parent('h4').parent().addClass('cart-green');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '610433') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/mellat.png') }}");
                $(element).parent('h4').parent().addClass('cart-blue');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '627353' || number === '585983') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/tejarat.png') }}");
                $(element).parent('h4').parent().addClass('cart-silver');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '589463') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/refah.png') }}");
                $(element).parent('h4').parent().addClass('cart-blue');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '627381') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/ansar.png') }}");
                $(element).parent('h4').parent().addClass('cart-black');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '639370') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/mehreqtesad.png') }}");
                $(element).parent('h4').parent().addClass('cart-green');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '639599') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/ghavamin.png') }}");
                $(element).parent('h4').parent().addClass('cart-black');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '504172') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/resalat.png') }}");
                $(element).parent('h4').parent().addClass('cart-gold');
                $('img.bankLogo').removeClass('d-none');
            }
            if (number === '636214') {
                $(element).parent('h4').siblings('.cart-header').children('.bankLogo').attr('src', "{{ asset('assets/img/bank/ayandeh.png') }}");
                $(element).parent('h4').parent().addClass('cart-gold');
                $('img.bankLogo').removeClass('d-none');
            }
        });
        $(document).on('input', ".cartNum", function () {
            textNumber = $('.cartNum').val();
            text = textNumber.slice(0, 6);
            if (text === '603799') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/meli.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '589210') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/sepah.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '627961') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/sanatmadan-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '603770') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/keshavarsi.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '628023') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/maskan-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '627760') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/postbank-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '502908') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/tosee-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '627412') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/eghtesad-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '622106') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/parsian-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '502229') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/pasargad-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '627488') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/karafarin-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '621986') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/saman-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '639346') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/sina-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '639607') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/sarmaye-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '502806' || text === '504706') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/shahr-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '502938') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/day-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '603769') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/saderat-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '610433') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/mellat-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '627353' || text === '585983') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/tejarat-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '589463') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/refah-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '627381') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/ansar-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '639370') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/mehreqtesad-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '639599') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/ghavamin-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '504172') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/resalat-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
            if (text === '636214') {
                $('img#bankLogo').attr('src', "{{ asset('assets/img/bank/ayandeh-ico.png') }}");
                $('img#bankLogo').removeClass('d-none');
            } else {
                if (textNumber.length < 6) {
                    $('img#bankLogo').attr('src', "");
                    $('img#bankLogo').addClass('d-none');
                }
            }
        });
        $(document).ready(function () {
            $('#autoWithdraw').change(function () {
                var isChecked = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route("panel.wallet.update.autoWithdraw", $wallet->id) }}', // Adjust route as needed
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token for security
                        autoWithdraw: isChecked
                    },
                    success: function (response) {
                        // Handle success response if needed
                        if (response == 1) {
                            toastr.options.timeOut = 8000;
                            toastr.success("تسویه خودکار برای شما فعال شد");
                        } else {
                            toastr.options.timeOut = 9000;
                            toastr.warning("تسویه خودکار برای شما غیر فعال شد");
                        }
                    },
                    error: function (xhr) {
                        // Handle error response if needed
                        console.log('Error updating checkbox state.');
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    template: '<div class="tooltip tooltip-custom" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
                    sanitize: false // Allows HTML content in tooltip
                });
            });

        });
    </script>
@endsection

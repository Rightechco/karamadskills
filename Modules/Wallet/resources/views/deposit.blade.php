@extends('panel::layouts.master')

@section('title','واریز ها')
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
                            <h4>واریز ها</h4>
                            <a href="{{ route('panel.wallet.wallet') }}" style="font-size: 35px"><i class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <form action="{{ route('panel.deposit.depositStore') }}" method="post">
                            @csrf
                            <div class="row widget-content widget-content-area br-6k">
                                <div class="row mx-auto col-12 col-lg-6 col-md-6 col-sm-12">

                                    <div class="col-12 d-flex align-items-center p-2 mt-3" style="background-color: rgba(255, 243, 205, 0.9); border-left: 5px solid #ffa000; border-radius: 8px;">
                                        <i class="iconBold-warning-2 mr-3" style="color: #ffa000; font-size: 22px;"></i>
                                        <p class="mb-0" style="color: #444; font-size: 14px;">
                                            حداقل میزان واریز 2,000 تومان و حداکثر 100,000,000 تومان می باشد
                                        </p>
                                    </div>

                                    <!-- Withdrawal Amount Input -->
                                    <div class="col-12 mt-4">
                                        <label for="amount">مقدار واریز به تومان</label>
                                        <input required name="amount" type="text" id="amount" class="form-control" placeholder="تومان" value="{{ old('amount') }}">
                                        @error('amount')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary col-12 mb-4"
                                                style="font-size: 15px; line-height: 2; border-radius: 8px;">
                                            واریز
                                        </button>
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
                                            <h5>آخرین واریز ها</h5>
                                        </div>
                                        <div class="table-responsive mb-4 mt-4">
                                            <table id="depositTable" class="table table-hover non-hover panel-table"
                                                   style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th id="clickElement">شماره</th>
                                                    <th class="no-sort">شماره تراکنش</th>
                                                    <th class="no-sort">مبلغ</th>
                                                    <th class="no-sort">شماره رهگیری</th>
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
        $('#depositTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('panel.deposit.getDeposits') }}",
                dataType: "json",
                type: "POST",
                data: {_token: "{{ csrf_token() }}"}
            },
            columns: [
                {"data": "id"},
                {"data": "trac"},
                {"data": "amount"},
                {"data": "ref"},
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

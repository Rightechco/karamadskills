@extends('panel::layouts.master')

@section('title','برداشت های کاربران')
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
                            <h4>برداشت های کاربران</h4>
                            <a href="{{ route('panel.wallet.wallet') }}" style="font-size: 35px"><i class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12 mt-3">
                    <div class="main-content layout-top-spacing">
                        <div class="layout-px-spacing">
                            <div class="row" id="cancel-row">
                                <div class="col-12 layout-spacing">
                                    <div class="widget-content widget-content-area br-6k">
                                        <div class="table-responsive mb-4 mt-4">
                                            <table id="withdrawsTable" class="table table-hover non-hover panel-table" style="width:100%">
                                                <thead>
                                                <tr>
                                                    <th id="clickElement">کد</th>
                                                    <th class="">شماره کاربر</th>
                                                    <th class="">شماره شبا</th>
                                                    <th class="">شماره کارت</th>
                                                    <th>کارت به نام</th>
                                                    <th class="">مقدار</th>
                                                    <th class="">تاریخ درخواست برداشت</th>
                                                    <th>کد رهگیری</th>
                                                    <th class="">وضعیت</th>
                                                    <th class="no-sort">عملیات</th>
                                                </tr>
                                                </thead>
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
        $('#withdrawsTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('panel.withdraw.getWithdraws') }}",
                dataType: "json",
                type: "POST",
                data: {_token: "{{ csrf_token() }}"}
            },
            columns: [
                {"data": "id"},
                {"data": "user_id"},
                {"data": "shaba_number"},
                {"data": "card_number"},
                {"data": "cardName"},
                {"data": "amount"},
                {"data": "date"},
                {"data": "transaction"},
                {"data": "status"},
                {"data": "detail"}
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

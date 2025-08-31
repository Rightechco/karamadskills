@extends('panel::layouts.master')

@section('title','مشوق ها')
@section('meta')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/custom_dt_custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jalali/jalalidatepicker.min.css') }}">
    <link href="{{ asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <style>
        jdp-container {
            z-index: 9999 !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>لیست مشوق ها</h4>
                            @if(auth()->user()->can('IncentivePermission'))
                                <a href="{{ route('panel.incentive.getExcel') }}" class="btn btn-warning "> <i class="mdi mdi-file-document mr-1"></i><span>اکسل مشوق ها</span>
                                </a>
                            @endif
                            <a href="{{ route('panel.incentive.incentiveCreate') }}" class="btn btn-primary "> <i class="   mdi mdi-shield-plus mr-1"></i><span>ثبت مشوق</span>
                            </a>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="companiesTable" class="table table-hover non-hover panel-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th id="clickElement">کد</th>
                                    <th>وضعیت</th>
                                    <th class="no-sort">کاربر</th>
                                    <th class="no-sort">نام دانشگاه</th>
                                    <th >تاریخ ایجاد</th>
                                    <th>امتیاز</th>
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
    <div class="modal fade" id="incentiveModal" tabindex="-1" role="dialog" aria-labelledby="bbbModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" id="incentiveShow">

                </div>
                <div class="modal-footer">
                    <button id="closeModal" type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
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
    <script src="{{ asset('assets/libs/jalali/jalalidatepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        function setIdIncentive(id,e) {
            var url = $(e).attr('lll');
            $('#incentiveShow').html('<td>لطفا صبر کنید ...</td>');
            $.ajax({
                type: 'get',
                url: url,
                success: function (list) {
                    $('#incentiveShow').html(list);
                }
            });
        }

        function confirmItem(e) {
            console.log(e);
            var url = $(e).attr('lll');
            $.ajax({
                type: 'get',
                url: url,
                success: function (data) {
                    toastr.info(data);
                }
            });
            var url = $(e).attr('ll');
            $.ajax({
                type: 'get',
                url: url,
                success: function (list) {
                    $('#incentiveShow').html(list);
                }
            });
        }

        function rejectItem(e) {
            var url = $(e).attr('lll');
            $.ajax({
                type: 'get',
                url: url,
                success: function (data) {
                    toastr.info(data);
                }
            });
            var url = $(e).attr('ll');
            $.ajax({
                type: 'get',
                url: url,
                success: function (list) {
                    $('#incentiveShow').html(list);
                }
            });
        }

        function formInc(event){
            event.preventDefault();
            $.ajax({
                type: $('#formInc').attr('method'),
                url: $('#formInc').attr('action'),
                data: $('#formInc').serialize(),
                success: function (data) {
                    toastr.info(data);
                    $('#closeModal').click();
                    $('#clickElement').click();
                },
                error: function (data) {
                    toastr.error(data.responseJSON.message);
                },
            });
        };

        $('#companiesTable').DataTable( {
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('panel.incentive.getIncentives') }}",
                dataType: "json",
                type: "POST",
                data: { _token: "{{ csrf_token() }}"}
            },
            columns: [
                {"data": "id"},
                {"data": "status"},
                {"data": "name"},
                {"data": "university"},
                {"data": "created_at"},
                {"data": "score"},
                {"data": "detail","width": '20%'}
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
        } );
    </script>
@endsection

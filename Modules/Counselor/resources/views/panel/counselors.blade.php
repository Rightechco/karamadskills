@extends('panel::layouts.master')

@section('title','مشاوره ها')
@section('meta')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jalali/jalalidatepicker.min.css') }}">
    <link href="{{ asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/custom_dt_custom.css') }}">
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
                            <h4>مشاوره ها</h4>
                            </a>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="companiesTable" class="table table-hover non-hover panel-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th id="clickElement">کد</th>
                                    <th>نام</th>
                                    <th class="no-sort">نام مشاور</th>
                                    <th class="no-sort">گیرنده مشاوره</th>
                                    <th>مبلغ پرداخت شده</th>
                                    <th class="no-sort">جلسات</th>
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
    <div class="modal fade" id="createBBB" tabindex="-1" role="dialog" aria-labelledby="createBBBModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('panel.counselor.createMeet') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="meetId">
                        <div class="col-12 my-1">
                            <label for="birthday">تاریخ جلسه</label><span class="text-danger">*</span>
                            <input data-jdp name="date" type="text" id="date"
                                   class="form-control" value="{{ old('date') ?? null }}">
                        </div>
                        <div class="col-12 my-1">
                            <label>زمان جلسه</label>
                            <div class="input-group">
                                <input id="timepicker3" type="text" class="form-control" name="time" style="height: 39.2px">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-clock-outline"></i></span>
                                </div>
                            </div><!-- input-group -->
                        </div>
                        <div class="col-12 my-1">
                            <p class="mb-0 mt-3"><i class="mdi mdi-alert mr-2 text-warning" style="font-size: 20px"></i>جلسه را می توانید در روزی که مشخص کرده اید، آغاز کنید</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ایجاد جلسه</button>
                    </div>
                </form>
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
        jalaliDatepicker.startWatch();
        jQuery("#timepicker3").timepicker({
            minuteStep: 15,
            showMeridian: !1,
            icons: {
                up: "mdi mdi-chevron-up",
                down: "mdi mdi-chevron-down"
            }
        })
        $('#companiesTable').DataTable( {
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('panel.counselor.getCounselors') }}",
                dataType: "json",
                type: "POST",
                data: { _token: "{{ csrf_token() }}"}
            },
            columns: [
                {"data": "id"},
                {"data": "name"},
                {"data": "counselor"},
                {"data": "user"},
                {"data": "price"},
                {"data": "detail","width": '30%'}
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

        function setIdBBB(id){
            $('#meetId').val(id);
        }
    </script>
@endsection

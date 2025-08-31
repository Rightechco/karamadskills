@extends('panel::layouts.master')

@section('title','درخواست های '.$announcement->name)
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
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>لیست درخواست های آگهی {{ $announcement->name }}</h4>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="companiesTable" class="table table-hover non-hover panel-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th id="clickElement">کد</th>
                                    <th class="no-sort">وضعیت</th>
                                    <th class="no-sort">نام کاربر</th>
                                    <th class="no-sort">سن کارجو</th>
                                    <th class="no-sort">وضعیت تأهل</th>
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
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('panel.request.rejectRequests') }}" method="post">
                    @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="requestId">
                    <label for="name">دلیل رد درخواست</label><span class="text-danger">*</span>
                    <input required name="rejectedText" type="text" id="name" class="form-control" placeholder="مثل: عدم کافی بودن سوابق" value="{{ old('name') }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">رد درخواست</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">انصراف</button>
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
    <script>
        $('#companiesTable').DataTable( {
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('panel.request.getAnnouncementRequests',$announcement->id) }}",
                dataType: "json",
                type: "POST",
                data: { _token: "{{ csrf_token() }}" }
            },
            columns: [
                {"data": "id"},
                {"data": "status"},
                {"data": "name"},
                {"data": "age"},
                {"data": "martial"},
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
        } );

        function setId(id){
            $('#requestId').val(id);
        }
    </script>
@endsection

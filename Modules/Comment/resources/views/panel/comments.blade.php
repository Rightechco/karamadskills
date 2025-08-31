@extends('panel::layouts.master')

@section('title','نظرات')
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
                            <h4>نظرات</h4>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="companiesTable" class="table table-hover non-hover panel-table" style="width:100%">
                                <thead>
                                <tr>
                                    <th id="clickElement">کد</th>
                                    <th>وضعیت</th>
                                    <th class="no-sort">نظردهنده</th>
                                    <th class="no-sort">برای</th>
                                    <th class="no-sort">امتیاز</th>
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
    <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-body">
                        <h6>متن نظر</h6>
                        <div id="commentShow" class="border p-3 mt-1"></div>
                        <form action="{{ route('panel.comment.reply') }}" method="post" class="mt-4">
                            @csrf
                        <input type="hidden" name="id" id="commentId">
                        <label for="reply">ثبت پاسخ</label><span class="text-danger">*</span>
                        <textarea required name="reply" type="text" id="reply" class="form-control">{{ old('reply') }}</textarea>
                        <button type="submit" class="btn btn-info mt-3">ثبت</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">انصراف</button>
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
        function setText(id,e) {
            var url = $(e).attr('lll');
            $('#commentShow').html('<td>لطفا صبر کنید ...</td>');
            $.ajax({
                type: 'get',
                url: url,
                success: function (list) {
                    $('#commentShow').html(list);
                    $('#commentId').val(id);
                }
            });
        }

        $('#companiesTable').DataTable( {
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('panel.comment.getComments') }}",
                dataType: "json",
                type: "POST",
                data: { _token: "{{ csrf_token() }}" }
            },
            columns: [
                {"data": "id"},
                {"data": "status"},
                {"data": "name"},
                {"data": "commentable"},
                {"data": "rate"},
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

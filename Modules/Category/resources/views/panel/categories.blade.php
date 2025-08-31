@extends('panel::layouts.master')

@section('title','دسته بندی ها')
@section('meta')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/datatables/custom_dt_custom.css') }}">
@endsection

@section('content')
    <div class="row" id="top_bar">
        <div class="col-12">
            <div class="card-box">
            <div class="col-xl-12 col-lg-12 col-sm-12">
                <div class="widget-content widget-content-area br-6">
                    <div class="row justify-content-between mx-0 align-items-center">
                        <h4>لیست دسته بندی ها</h4>
                    </div>
                    <form id="edit_cat" style="display: none" class="row mx-0" method="post" action="{{ route('panel.category.categoriesUpdate') }}">
                        @csrf
                        <input type="hidden" name="id" id="cat_id_edit">
                        <span class="d-block w-100 text-center mt-2">ویرایش دسته بندی</span>
                        <div class="border mt-1 mb-4 p-2 p-lg-4 col-12" style="border-radius: .25rem">
                            <div class="form-row">
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <label for="cat_name_edit">نام</label>
                                    <input required name="name" type="text" class="form-control" id="cat_name_edit" placeholder="عنوان" value="{{ old('name') }}">
                                    @error('name')
                                    <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <label for="cat_slug_edit">اسلاگ</label>
                                    <input name="slug" type="text" class="form-control" id="cat_slug_edit" placeholder="اسلاگ" value="{{ old('slug') }}">
                                    @error('slug')
                                    <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <label for="parentId_edit">دسته والد</label>
                                    <select class="form-control select2" id="parentId_edit" data-live-search="true" name="parent_id" style="width: 100%">
                                        <option value="">ندارد</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="row col-12 mt-4 mx-0">
                                    <div class="col-12 pl-0 pr-1">
                                        <button type="submit" class="btn btn-block btn-sm btn-success ">ویرایش</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form id="store_cat" class="row mx-0" method="post" action="{{ route('panel.category.categoriesStore') }}" selectUp="{{ route('panel.category.getCategoriesList') }}">
                        @csrf
                        <span class="d-block w-100 text-center mt-2">ایجاد دسته بندی</span>
                        <div class="border mt-1 mb-4 p-2 p-lg-4 col-12" style="border-radius: .25rem">
                            <div class="form-row">
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <label for="name">نام</label>
                                    <input required name="name" type="text" class="form-control" id="name" placeholder="عنوان" value="{{ old('name') }}">
                                    @error('name')
                                    <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <label for="slug">اسلاگ</label>
                                    <input name="slug" type="text" class="form-control" id="slug" placeholder="اسلاگ" value="{{ old('slug') }}">
                                    @error('slug')
                                    <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 mb-2">
                                    <label for="gender">دسته والد</label>
                                    <select class="form-control select2" id="parentId_create" data-live-search="true" name="parent_id" style="width: 100%">
                                        <option value="">ندارد</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="row col-12 mt-4 mx-0">
                                    <div class="col-12 pl-0 pr-1">
                                        <button type="submit" class="btn btn-block btn-sm btn-primary ">ایجاد</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="categoriesTable" class="table table-hover non-hover panel-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th id="clickElement">کد</th>
                                    <th>نام</th>
                                    <th>اسلاگ</th>
                                    <th class="no-sort">والد</th>
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

        var frm = $('#store_cat');
        var frm2 = $('#edit_cat');
        frm.submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                    toastr.info(data);
                    upListAndSelect();
                },
                error: function (data) {
                    toastr.error(data.responseJSON.message);
                },
            });
        });
        frm2.submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: frm2.attr('method'),
                url: frm2.attr('action'),
                data: frm2.serialize(),
                success: function (data) {
                    toastr.info(data);
                    upListAndSelect();
                    hideEditShowCreate();
                },
                error: function (data) {
                    toastr.error(data.responseJSON.message);
                },
            });
        });

        function upListAndSelect () {
            $('#clickElement').click();
            $.ajax({
                type: 'get',
                url: frm.attr('selectUp'),
                success: function (list) {
                    $('#parentId_edit').html(list);
                    $('#parentId_create').html(list);
                }
            });
        }

        function hideEditShowCreate(){
            $('#edit_cat').hide();
            $('#store_cat').show('slow');
        }

        // function openDelete(e){
        //     $(e).siblings('small').show('slow');
        // }

        // function deleteCat(e) {
        //     $.ajax({
        //         type: 'get',
        //         url: $(e).attr('route'),
        //         success: function (list) {
        //             toastr.info(list);
        //             upListAndSelect();
        //         }
        //     });
        // }

        function catEdit(e){
            var clicked = $(e);

            $('#edit_cat').show("slow");
            $('#store_cat').hide();
            $('#cat_name_edit').val(clicked.attr('name'));
            $('#cat_slug_edit').val(clicked.attr('slug'));
            $('#cat_id_edit').val(clicked.attr('catId'));
            var dataClsField = $('select[id="parentId_edit"]');
            dataClsField.find('option[value="'+ clicked.attr('parentId') +'"]').prop('selected', 'selected');
        }

        $('#categoriesTable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: "{{ route('panel.category.getCategories') }}",
                dataType: "json",
                type: "POST",
                data: {_token: "{{ csrf_token() }}"}
            },
            columns: [
                {"data": "id"},
                {"data": "name"},
                {"data": "slug"},
                {"data": "parent"},
                {"data": "detail"}
            ],
            order: [[0, "desc"]],
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
                {extend: 'excelHtml5', text: 'اکسل'},
                {extend: 'csvHtml5', text: 'csv'},
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
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']]
        });
    </script>
@endsection

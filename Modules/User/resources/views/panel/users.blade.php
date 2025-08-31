@extends('panel::layouts.master')

@section('title','کاربران')
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
                            <h4>لیست کاربران</h4>
                            <a href="{{ route('panel.user.usersCreate') }}" class="btn btn-primary "> <i class="fa fa-user-plus mr-1"></i> <span>ایجاد کاربر</span> </a>
                        </div>
                        <span class="d-block w-100 text-center mt-2">گزینه های جدول</span>
                        <form class="row mx-0" method="get" action="">
                            <div class="border mt-1 mb-4 p-2 p-lg-4 col-12" style="border-radius: .25rem">
                                <div class="form-row">
                                    <div class="col-12 col-lg-6">
                                        <label for="statusInput" class="text-left w-100">وضعیت</label>
                                        <select class="form-control select2" name="status" id="statusInput">
                                            @if($filter['status'])
                                                <option value="{{ $filter['status'] }}" selected>{{ __('messages.'.$filter['status']) }}</option>
                                            @else
                                                <option value="" selected>انتخاب</option>
                                            @endif
                                            @foreach(\Modules\User\Models\User::$statuses as $status)
                                                <option value="{{ $status }}">{{ __('messages.'.$status) }}</option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                        <label for="roleInput" class="text-left w-100">نقش</label>
                                        <select class="form-control select2" name="role" id="roleInput">
                                            @if($filter['role'] !== null)
                                                @php
                                                    $oldrole = \Modules\Role\Models\Role::query()->find($filter['role']);
                                                @endphp
                                                <option value="{{ $filter['role'] }}"
                                                        selected>{{ $oldrole->name }}</option>
                                            @else
                                                <option value="">انتخاب</option>
                                            @endif
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row col-12 mt-4 mx-0">
                                        <div class="col-12 col-md-9 col-lg-9 pl-0 pr-1">
                                            <button type="submit" class="btn btn-block btn-sm btn-success ">فیلتر</button>
                                        </div>
                                        <div class="col-12 col-md-3 col-lg-3 pr-0 pl-1">
                                            <a href="{{ route('panel.user.users') }}" class="btn btn-block btn-sm btn-danger ">ریسیت</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-box">
                <div class="table-responsive mb-4 mt-4 overflow-hidden">
                    <table id="usersTable" class="table table-hover non-hover panel-table" style="width:100%">
                        <thead>
                        <tr>
                            <th id="clickElement">کد</th>
                            <th>وضعیت</th>
                            <th>نام</th>
                            <th>شماره</th>
                            <th>کد ملی</th>
                            <th class="no-sort">نقش ها</th>
                            <th>تاریخ عضویت</th>
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
        $("#statusInput").select2()
        $("#roleInput").select2()

            var filter = {!! json_encode($filter) !!}
            $('#usersTable').DataTable( {
                serverSide: true,
                processing: true,
                ajax:{
                    url: "{{ route('panel.user.getUsers') }}",
                    dataType: "json",
                    type: "POST",
                    data: { _token: "{{ csrf_token() }}",
                        'filter': filter}
                },
                columns: [
                    {"data": "id"},
                    {"data": "status"},
                    {"data": "name"},
                    {"data": "mobile"},
                    {"data": "nationalCode"},
                    {"data": "roles"},
                    {"data": "created_at"},
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
                    "previous": "قبلی",
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

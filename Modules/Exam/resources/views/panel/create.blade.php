@extends('panel::layouts.master')

@section('title','ایجاد آزمون')
@section('meta')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>ایجاد آزمون</h4>
                            <a href="{{ route('panel.course.courses') }}" style="font-size: 35px"><i
                                    class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form id="form" action="{{ route('panel.exam.storeExam',$course->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <span class="d-block w-100 text-center">مشخصات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-md-6 col-lg-6 my-1">
                                        <label for="name">نام</label><span class="text-danger">*</span>
                                        <input required name="name" type="text" id="name" class="form-control" placeholder="نام" value="{{ old('name') }}">
                                        @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 my-1">
                                        <label for="slug">اسلاگ</label>
                                        <input name="slug" type="text" class="form-control" id="slug" placeholder="اسلاگ" value="{{ old('slug') }}">
                                        @error('slug')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <span class="d-block w-100 text-center">سوالات</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div id="examDiv" class="col-12 row mx-0 px-0">
                                        <p class="w-100 form-text text-primary text-center">تکمیل کردن تمامی گزینه ها الزامی می باشد</p>
                                        @error('qname')
                                        <small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('qname.*')
                                        <small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('qrate')
                                        <small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('qrate.*')
                                        <small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('qcorrect')
                                        <small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('qcorrect.*')
                                        <small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('qoption')
                                        small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('qoption.*')
                                        <small class="w-100 form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <div id="question" class="col-12 mx-0 px-0">
                                            <div class="col-12 row px-0 mx-0">
                                            <div class="col-12 col-md-10 col-lg-10 my-1">
                                                <label>عنوان سوال</label>
                                                <input name="qname[]" type="text" class="form-control" placeholder="عنوان سوال" value="">
                                            </div>
                                            <div class="col-12 col-md-1 col-lg-1 my-1">
                                                <label>نمره سوال</label>
                                                <input name="qrate[]" type="number" class="form-control" value="">
                                            </div>
                                            <div class="col-12 col-md-1 col-lg-1 my-1">
                                                <label>گزینه درست</label>
                                                <input name="qcorrect[]" type="number" class="form-control" min="1" max="4" value="">
                                            </div>
                                            <div class="col-12 col-md-10 col-lg-10 my-1 row mx-0 px-0" id="options">
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <label class="mt-1">گزینه اول</label>
                                                    <input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value="">
                                                    <label class="mt-1">گزینه دوم</label>
                                                    <input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value="">
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6">
                                                    <label class="mt-1">گزینه سوم</label>
                                                    <input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value="">
                                                    <label class="mt-1">گزینه چهارم</label>
                                                    <input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-2 col-lg-2 my-1">
                                                <div class="row mx-0 px-0 justify-content-between">
                                                    <button class="btn btn-purple" onclick="addquestion(this)" type="button"><i class="mdi mdi-calendar-plus mr-1"></i>افزودن سوال</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block w-100 text-center">جزئیات دوره</span>
                                <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                    <div class="col-12 col-md-6 col-lg-6 my-1">
                                        <label for="time">مدت امتحان</label><span class="text-purple mx-2">به دقیقه</span>
                                        <input name="time" type="text" class="form-control" id="time" placeholder="25" value="{{ old('time') }}">
                                        @error('time')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="checkbox checkbox-pink form-check-inline mt-2">
                                            <input type="checkbox" id="certificate" value="1" name="certificate">
                                            <label for="certificate"> ثبت در گواهینامه </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6 my-1">
                                        <label for="pass">نمره قبولی</label>
                                        <input name="pass" type="text" class="form-control" id="pass" placeholder="12" value="{{ old('pass') }}">
                                        @error('pass')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block mb-4 mr-2">ایجاد</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function addquestion (event) {
            $('#question').append('<div class="col-12 row px-0 mx-0 my-3" style="border-top: 3px dashed pink"><div class="col-12 col-md-10 col-lg-10 my-1"><label>عنوان سوال</label><input name="qname[]" type="text" class="form-control" placeholder="عنوان سوال" value=""></div><div class="col-12 col-md-1 col-lg-1 my-1"><label>نمره سوال</label><input name="qrate[]" type="number" class="form-control" value=""></div><div class="col-12 col-md-1 col-lg-1 my-1"><label>گزینه درست</label><input name="qcorrect[]" type="number" class="form-control" min="1" max="4" value=""></div><div class="col-12 col-md-10 col-lg-10 my-1 row mx-0 px-0" id="options"><div class="col-12 col-md-6 col-lg-6"><label class="mt-1">گزینه اول</label><input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value=""> <label class="mt-1">گزینه دوم</label><input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value=""></div><div class="col-12 col-md-6 col-lg-6"><label class="mt-1">گزینه سوم</label><input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value=""><label class="mt-1">گزینه چهارم</label><input name="qoption[]" type="text" class="form-control" placeholder="گزینه اول" value=""></div></div><div class="col-12 col-md-2 col-lg-2 my-1"><div class="row mx-0 px-0 justify-content-between"><button class="btn btn-purple" onclick="addquestion(this)" type="button"><i class="mdi mdi-calendar-plus mr-1"></i>افزودن سوال</button><button class="btn btn-danger" onclick="removequestion(this)" type="button"><i class="mdi mdi-calendar-remove"></i></button></div></div></div>');
        };

        function removequestion (event) {
            $(event).parent().parent().parent().remove();
        };
    </script>
@endsection

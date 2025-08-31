@extends('panel::layouts.master')

@section('title','نقش ها')
@section('meta')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="col-xl-12 col-lg-12 col-sm-12">
                    <div class="widget-content widget-content-area br-6">
                        <div class="row justify-content-between mx-0 align-items-center">
                            <h4>ویرایش نقش</h4>
                            <a href="{{ route('panel.role.roles') }}" style="font-size: 35px"><i
                                    class=' fas fa-arrow-alt-circle-left text-info'></i></a>
                        </div>
                        <div class="mb-4 mt-4">
                            <form action="{{ route('panel.role.rolesUpdate',$role->id) }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $role->id }}">
                                    <label class="col-12 text-center">مشخصات</label>
                                    <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                        <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="name">نام</label><span class="text-danger">*</span>
                                            <input required name="name" type="text" id="name" class="form-control" placeholder="نام" value="{{ old('name',$role->name) }}">
                                            @error('name')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-ms-6 col-lg-6 my-1">
                                            <label for="slug">اسلاگ</label>
                                            <input name="slug" type="text" class="form-control" id="slug" placeholder="اسلاگ" value="{{ old('slug',$role->slug) }}">
                                            @error('slug')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <span class="d-block w-100 text-center">دسترسی ها</span>
                                    <div class="border row mt-1 mb-4 p-2 p-lg-4" style="border-radius: .25rem">
                                        <div class="col-12 my-1 row">
                                            @foreach($permissions as $permission)
                                                <div class="col-6 p-0 d-flex">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" @if($role->hasPermission($permission)) checked @endif class="custom-control-input" id="permission{{ $permission->id }}" name="permissions[{{ $permission->slug }}]" value="{{ $permission->id }}">
                                                        <label class="custom-control-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @error('permissions')
                                            <small id="sh-text1" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                <button class="btn btn-primary btn-block mb-4 mr-2">ویرایش</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection

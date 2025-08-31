<!doctype html>
<html>
<head>
    @include('panel::layouts.head')
</head>
<body>
@include('panel::layouts.header')
<div class="wrapper">
{{--@include('panel::layouts.sidebar')--}}
            <div class="container-fluid mt-3">
                @yield('content')
            </div>
</div>
{{--@include('panel::layouts.rightbar')--}}
@include('panel::layouts.js')
@include('common::errors.toast')
</body>
</html>

@extends('opt::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('opt.name') !!}</p>
@endsection

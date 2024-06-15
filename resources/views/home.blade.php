@extends('layouts.app')

@section('header_style')
    @php
        $info = \App\Models\app_properties::first();
        $backend_menu = \App\Models\backend_menu::getDataMenu(0);
    @endphp
@endsection

@section('body')
@endsection
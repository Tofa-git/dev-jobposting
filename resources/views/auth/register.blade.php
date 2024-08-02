@extends('layouts.login')

@section('body')

@php
    $data = \App\Models\app_properties::whereRaw('status="0"')
        -> first();
@endphp

{!! NoCaptcha::renderJs() !!}
<div class="container h-100">
    <div class="row justify-content-sm-center align-items-sm-center h-100">
        <div class="col-sm-4 p-4 mh-100 login-card bg-white shadow text-center">
            <div class="d-flex flex-row">
                <img src="{{ \App\Models\data_file::getLogo(@$data->logo) }}" class="img-fluid" style="max-height: 40px; height: auto; display: inline-block; vertical-align: middle;" class="img-fluid" />
                <div class="ps-2 d-flex flex-column align-items-start">
                    <span class="fs-6 lh-sm fw-bold">{{ @$data->icon_text_1 }}</span>
                    <span class="small lh-sm fw-light">{{ @$data->icon_text_2 }}</span>
                </div>
            </div>
            <h3 class="mt-3">Registrasi Akun</h3>
            <form method="POST" action="{{ route('register') }}" onsubmit="return globalFunction.checkSubmission(this)">
                @csrf
                <div class="d-flex mt-4">
                    <div class="position-absolute p-2">
                        <i class="material-icons-outlined text-secondary">people</i>
                    </div>
                    <input type="text" class="rounded-0 bg-white ps-5 form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" autofocus required />
                    <div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary d-flex" style="cursor: pointer" title="Clear username">
                        <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <div class="position-absolute p-2">
                        <i class="material-icons-outlined text-secondary">email</i>
                    </div>
                    <input type="email" class="rounded-0 bg-white ps-5 form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="example@domain.com" value="{{ old('username') }}" required />
                    <div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary d-flex" style="cursor: pointer" title="Clear username">
                        <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                    </div>
                </div>
                <div class="mt-3 bg-transparent w-100 p-0" style="overflow: hidden;">
                </div>
                @if ($errors->has('g-recaptcha-response'))
                    <div class="alert alert-danger p-1 margin-0 mt-1" role="alert">
                        Harap diklick konfirmasi bahwa anda bukan robot.
                    </div>
                @endif
                <div>
                    <button type="submit" class="btn btn-success bg-gradient d-flex justify-content-center w-100 mt-4">
                        <span class="px-2">Register</span>
                        <i class="material-icons-outlined align-self-center">play_circle_outline</i>
                    </button>
                </div>
                <div class="mt-2">atau</div>
                <div class="mt-2"><a href="/login">Login</a> jika sudah punya akun</div>
            </form>
            <div class="mt-4">
                <span class="small text-secondary">{!! @$data->copyright !!}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.login')

@section('body')
{!! NoCaptcha::renderJs() !!}
<div class="container h-100">
    <div class="row justify-content-sm-center align-items-sm-center h-100">
        <div class="col-sm-4 p-4 mh-100 login-card bg-white shadow text-center">
            <div class="d-flex flex-column align-items-center">
                <img src="{{ \App\Models\data_file::getLogo(@$data->logo) }}" class="img-fluid" style="max-height: 60px; height: auto; display: inline-block; vertical-align: middle;" class="img-fluid" />
                <div class="ps-2 d-flex flex-column">
                    <span class="fs-4 lh-sm fw-bold">{{ @$data->icon_text_1 }}</span>
                    <span class="fs-5 lh-sm fw-light">{{ @$data->icon_text_2 }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}" onsubmit="return globalFunction.checkSubmission(this)">
                @csrf
                <div class="d-flex mt-4">
                    <div class="position-absolute p-2">
                        <i class="material-icons text-secondary">people</i>
                    </div>
                    <input placeholder="Email atau NIP" type="text" class="rounded-0 ps-5 form-control input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus />
                    <div class="p-2 bg-secondary d-flex clearValue" style="cursor: pointer" title="Clear username">
                        <i class="material-icons align-self-center text-white fs-5">clear</i>
                    </div>
                </div>
                @error('email')
                    <div class="alert alert-danger p-1 margin-0 mt-1" role="alert">
                        Username yang anda masukkan belum terdaftar!
                    </div>
                @enderror
                <div class="d-flex mt-3">
                    <div class="position-absolute p-2">
                        <i class="material-icons text-secondary">lock</i>
                    </div>
                    <input type="password" id="password" class="rounded-0 ps-5 form-control input-text @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ old('password') }}" required />
                    <div class="p-2 bg-secondary d-flex hideShowPassword" style="cursor: pointer" title="Show or hide password">
                        <i class="material-icons align-self-center text-info fs-5">visibility_off</i>
                    </div>
                </div>
                @error('password')
                    <div class="alert alert-danger p-1 margin-0 mt-1" role="alert">
                        Password yang anda masukkan salah!!
                    </div>
                @enderror
                <div class="mt-3 bg-transparent w-100 p-0" style="overflow: hidden;">
                    {!! NoCaptcha::display() !!}
                </div>
                @if ($errors->has('g-recaptcha-response'))
                    <div class="alert alert-danger p-1 margin-0 mt-1" role="alert">
                        Harap diklick konfirmasi bahwa anda bukan robot.
                    </div>
                @endif
                <div>
                    <button type="submit" class="btn btn-primary bg-gradient d-flex justify-content-center w-100 mt-4">
                        <span class="px-2">Sign In</span>
                        <i class="material-icons align-self-center">play_circle_outline</i>
                    </button>
                </div>
            </form>
                <div class="mt-4">
                    <span class="small">{!! @$data->copyright !!}</span>
                </div>
        </div>
    </div>
</div>
@endsection

@section('footer_style_script')
@endsection
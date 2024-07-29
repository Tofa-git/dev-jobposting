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
            <h3 class="mt-3">Masukan Kode OTP</h3>
            <form method="POST" action="{{ route('otp.check-otp') }}" onsubmit="return globalFunction.checkSubmission(this)">
                @csrf
                <div class="d-flex align-items-sm-center mt-4">
                    <div class="position-absolute p-2">
                        <i class="material-icons-outlined text-secondary">pin</i>
                    </div>
                    <input placeholder="xxxxxx" type="text" class="fs-3 fw-bold border-secondary rounded-0 ps-5 form-control @error('kode') is-invalid @enderror" name="kode" value="{{ old('kode') }}" minlength="6" maxlength="6" required autocomplete="off" autofocus />
                </div>
                @error('kode')
                    <div class="alert alert-danger p-1 margin-0 mt-1" role="alert">
                        OTP yang anda masukkan salah!
                    </div>
                @enderror
                <div>
                    <button type="submit" class="btn btn-primary bg-gradient d-flex justify-content-center w-100 mt-4">
                        <span class="px-2">Sign In</span>
                        <i class="material-icons-outlined align-self-center">play_circle_outline</i>
                    </button>
                </div>
            </form>
            <div class="mt-4">
                <span class="small text-secondary">{!! @$data->copyright !!}</span>
            </div>
        </div>
    </div>
</div>
@endsection
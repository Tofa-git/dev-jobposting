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
            <h3 class="mt-3">Expired</h3>
            <p>Halamann ini sudah expired! Silahkan klick tombol di bawah untuk pergi ke halaman login.</p>
            <a href="/login" class="btn btn-primary bg-gradient d-flex justify-content-center w-100 mt-4" role="button">
                <span class="px-2">Ke halaman login</span>
                <i class="material-icons-outlined align-self-center">play_circle_outline</i>
            </a>
            <div class="mt-4">
                <span class="small text-secondary">{!! @$data->copyright !!}</span>
            </div>
        </div>
    </div>
</div>
@endsection
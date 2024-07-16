@php
    $image_slider = \App\Models\image_slider::whereRaw('status="0" And published_by > 0')
        -> orderByRaw('sequence')
        -> get();
@endphp

<div id="carouselExampleIndicators" class="carousel slide bg-midnightBlue" data-bs-ride="carousel">
    <div class="carousel-indicators m-0 me-2 p-0 d-none d-md-block w-auto" style="text-align: center; height: 25px;">
        @php $_i = 0; $_is_active = 'active'; $_current = true; @endphp
        @foreach($image_slider as $_image_slider)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $_i }}" class="bg-success bg-gradient {{ $_is_active }}" @if($_current) aria-current="true" @endif style="height: 10px" aria-label="Slide {{ $_i + 1 }}"></button>
            @php $_i++; $_is_active = ''; $_current = false; @endphp
        @endforeach
    </div>
    <div class="carousel-inner pb-5 h-100" id="sliderId">
        @php $_is_active = 'active'; @endphp
        @forelse($image_slider as $_image_slider)
            <div class="h-100 carousel-item {{ $_is_active }}">
                <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-md-6 text-light order-2 order-md-1">
                        {!! $_image_slider->content !!}
                    </div>
                    <div class="col-md-6 order-1 order-md-2 bg-gradient">
                        <img class="img-fluid" src="{{ \App\Models\data_file::getImage($_image_slider->file_background) }}" />
                    </div>
                </div>
                </div>
            </div>
            @php $_is_active = ''; @endphp
        @empty
            <div class="h-100 carousel-item active">
                <div class="h-100 d-flex align-items-center justify-content-center">
                    <h1 class="text-light" style="opacity: 0.25">Image Slider Not Found!</h1>
                </div>
            </div>
        @endforelse
    </div>
</div>
<div class="bg-midnightBlue" style="height: 250px; margin-top: -1px;"></div>
<div class="sliderCurva bg-light"></div>

<style type="text/css">
      .sliderCurva{
            position: relative;
            height: 60px;
            width: 120%;
            margin-left: -10%;
            margin-right: 10%;
            z-index: 10;
            margin-top: -60px;
            -webkit-border-radius: 200vh 200vh 0 0/20vh 20vh 0 0;
      }
</style>
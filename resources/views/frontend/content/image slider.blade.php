<div id="carouselExampleIndicators" class="carousel slide carousel-fade bg-midnightBlue shadow" data-bs-ride="carousel" style="margin-top: 60px;">
    <div class="carousel-indicators m-0 me-2 p-0 d-block w-auto" style="text-align: right;">
        @php $_i = 0; $_is_active = 'active'; $_current = true; @endphp
        @foreach($image_slider as $_image_slider)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $_i }}" class="bg-success bg-gradient {{ $_is_active }}" @if($_current) aria-current="true" @endif style="height: 10px" aria-label="Slide {{ $_i + 1 }}"></button>
            @php $_i++; $_is_active = ''; $_current = false; @endphp
        @endforeach
    </div>
    <div class="carousel-inner" id="sliderId" style="height: 400px;">
        @php $_is_active = 'active'; @endphp
        @forelse($image_slider as $_image_slider)
            <div class="h-100 carousel-item {{ $_is_active }}">
                <div class="h-100 bg-secondary overflow-hidden">
                    @if(is_null($_image_slider->file_background))
                        <div class="d-flex">
                    @else
                        <div class="h-100 d-flex" style="background-repeat: no-repeat; background-position: top center; background-size: cover; background-image: linear-gradient(rgba(0,0,0, 0.5), rgba(0, 0, 0, 1)), url('{{ \App\Models\data_file::getImage($_image_slider->file_background) }}');">
                    @endif
                    @if($_image_slider->source > 0)
                            <div class="d-flex flex-fill flex-column align-self-end p-4 bg-secondary bg-opacity-75">
                                <span class="fs-5 fw-bold text-light">{!! \App\Helpers\general::potongKalimat(strtoupper($_image_slider->content), 90) !!}</span>
                                <div class="mt-2 d-flex align-items-center small" style="color: #dddddd">
                                    <i class="material-icons fs-6 me-2">today</i>
                                    {{ \App\Helpers\general::yyyymmddToShort($_image_slider->created_at) }}
                                    <span class="px-3">|</span>
                                    <i class="material-icons fs-6 me-2">person</i>
                                    <span>Penulis : {{ \App\Models\User::getFieldValue($_image_slider->created_by, 'name') }}</span>
                                </div>
                            </div>
                    @endif
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
    <div class="bg-midnightBlue" style="height: 250px;"></div>
</div>
<div class="sliderCurva"></div>

<style type="text/css">
      .sliderCurva{
            background-color: #eeeeee;
            position: relative;
            height: 100px;
            width: 120%;
            margin-left: -10%;
            margin-right: 10%;
            z-index: 10;
            margin-top: -40px;
            -webkit-border-radius: 200vh 200vh 0 0/20vh 20vh 0 0;
      }
</style>

<script type="module">
      $(document).ready(function(){
            let _height = window.innerHeight;
            document.getElementById("sliderId").style.height = (_height - 350)+'px';
      });
      $(window).resize(function(){
            let _height = window.innerHeight;
            document.getElementById("sliderId").style.height = (_height - 350)+'px';
      });
</script>
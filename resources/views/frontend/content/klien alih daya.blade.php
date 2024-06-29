<div class="bg-white">
<div class="container">
<div class="pb-4 pt-4">
	<div class="row mt-3 mb-3">
		<div class="col-sm-3 d-flex flex-column justify-content-center align-items-center">
			<h3 class="fw-bold text-center">Klien <span class="text-primary" style="font-family: 'Caveat', cursive; font-size: 22pt; font-weight: bold">Alih Daya</span></h3>
			<h3 class="mt-2 text-feminim text-center fw-lighter">"Menangani SDM dengan Profesional, Akuntable dan Berteknologi"</h3>
			<div class="d-sm-flex d-none btn-prev flex-row justify-content-center gap-3 mt-2">
				<div class="btn-kembali p-0 btn btn-primary d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border-radius: 50%; transform: rotate(180deg);">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none"><path d="M20.7806 13.0306L14.0306 19.7806C13.8899 19.9213 13.699 20.0003 13.5 20.0003C13.301 20.0003 13.1101 19.9213 12.9694 19.7806C12.8286 19.6398 12.7496 19.449 12.7496 19.2499C12.7496 19.0509 12.8286 18.86 12.9694 18.7193L18.4397 13.2499H3.75C3.55109 13.2499 3.36032 13.1709 3.21967 13.0303C3.07902 12.8896 3 12.6988 3 12.4999C3 12.301 3.07902 12.1103 3.21967 11.9696C3.36032 11.8289 3.55109 11.7499 3.75 11.7499H18.4397L12.9694 6.28055C12.8286 6.13982 12.7496 5.94895 12.7496 5.74993C12.7496 5.55091 12.8286 5.36003 12.9694 5.2193C13.1101 5.07857 13.301 4.99951 13.5 4.99951C13.699 4.99951 13.8899 5.07857 14.0306 5.2193L20.7806 11.9693C20.8504 12.039 20.9057 12.1217 20.9434 12.2127C20.9812 12.3038 21.0006 12.4014 21.0006 12.4999C21.0006 12.5985 20.9812 12.6961 20.9434 12.7871C20.9057 12.8782 20.8504 12.9609 20.7806 13.0306Z" fill="white"></path></svg>
				</div>
				<div class="btn-berikut btn btn-primary p-0 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border-radius: 50%">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none"><path d="M20.7806 13.0306L14.0306 19.7806C13.8899 19.9213 13.699 20.0003 13.5 20.0003C13.301 20.0003 13.1101 19.9213 12.9694 19.7806C12.8286 19.6398 12.7496 19.449 12.7496 19.2499C12.7496 19.0509 12.8286 18.86 12.9694 18.7193L18.4397 13.2499H3.75C3.55109 13.2499 3.36032 13.1709 3.21967 13.0303C3.07902 12.8896 3 12.6988 3 12.4999C3 12.301 3.07902 12.1103 3.21967 11.9696C3.36032 11.8289 3.55109 11.7499 3.75 11.7499H18.4397L12.9694 6.28055C12.8286 6.13982 12.7496 5.94895 12.7496 5.74993C12.7496 5.55091 12.8286 5.36003 12.9694 5.2193C13.1101 5.07857 13.301 4.99951 13.5 4.99951C13.699 4.99951 13.8899 5.07857 14.0306 5.2193L20.7806 11.9693C20.8504 12.039 20.9057 12.1217 20.9434 12.2127C20.9812 12.3038 21.0006 12.4014 21.0006 12.4999C21.0006 12.5985 20.9812 12.6961 20.9434 12.7871C20.9057 12.8782 20.8504 12.9609 20.7806 13.0306Z" fill="white"></path></svg>
				</div>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="w-100 text-nowrap container-kampanye d-flex flex-row">
				@php $kampanye=[]; @endphp
				@forelse($kampanye as $_kampanye)
					<div id="data_{{ $_kampanye->id }}" class="d-flex align-items-end mx-2 rounded-3 overflow-hidden bg-customGray" style="min-width: 250px; max-width: 250px; height: 350px; border: 2px solid #aaaaaa; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url('{{ \App\Models\data_file::getThumbnailImage($_kampanye->foto_utama) }}'); opacity: 0.75">
						<a href="/kampanye-tahunan/{{ \App\Helpers\general::createSlug($_kampanye->title) }}" class="text-decoration-none w-100 text-wrap lh-sm fs-6 text-feminim p-2 px-3 bg-dark">
							<span class="text-light">{!! \App\Helpers\general::potongKalimat($_kampanye->title, 50) !!}</span>
						</a>
					</div>
				@empty
					<div id="data" class="d-inline-flex mx-2 border rounded-3 bg-customGray" style="width: 250px; height: 350px; opacity: 0.75">
						<div class="fs-5 flex-fill text-light text-wrap p-2 bg-dark opacity-50">
							<span>Data Tidak Ditemukan</span>
						</div>
					</div>
				@endforelse
			</div>
		</div>
		<div class="col-sm-12 pt-3 d-md-none d-flex justify-content-center gap-3">
			<div class="btn-kembali p-0 btn btn-primary d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border-radius: 50%; transform: rotate(180deg);">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none"><path d="M20.7806 13.0306L14.0306 19.7806C13.8899 19.9213 13.699 20.0003 13.5 20.0003C13.301 20.0003 13.1101 19.9213 12.9694 19.7806C12.8286 19.6398 12.7496 19.449 12.7496 19.2499C12.7496 19.0509 12.8286 18.86 12.9694 18.7193L18.4397 13.2499H3.75C3.55109 13.2499 3.36032 13.1709 3.21967 13.0303C3.07902 12.8896 3 12.6988 3 12.4999C3 12.301 3.07902 12.1103 3.21967 11.9696C3.36032 11.8289 3.55109 11.7499 3.75 11.7499H18.4397L12.9694 6.28055C12.8286 6.13982 12.7496 5.94895 12.7496 5.74993C12.7496 5.55091 12.8286 5.36003 12.9694 5.2193C13.1101 5.07857 13.301 4.99951 13.5 4.99951C13.699 4.99951 13.8899 5.07857 14.0306 5.2193L20.7806 11.9693C20.8504 12.039 20.9057 12.1217 20.9434 12.2127C20.9812 12.3038 21.0006 12.4014 21.0006 12.4999C21.0006 12.5985 20.9812 12.6961 20.9434 12.7871C20.9057 12.8782 20.8504 12.9609 20.7806 13.0306Z" fill="white"></path></svg>
			</div>
			<div class="btn-berikut btn btn-primary p-0 d-flex justify-content-center align-items-center" style="width: 40px; height: 40px; border-radius: 50%">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none"><path d="M20.7806 13.0306L14.0306 19.7806C13.8899 19.9213 13.699 20.0003 13.5 20.0003C13.301 20.0003 13.1101 19.9213 12.9694 19.7806C12.8286 19.6398 12.7496 19.449 12.7496 19.2499C12.7496 19.0509 12.8286 18.86 12.9694 18.7193L18.4397 13.2499H3.75C3.55109 13.2499 3.36032 13.1709 3.21967 13.0303C3.07902 12.8896 3 12.6988 3 12.4999C3 12.301 3.07902 12.1103 3.21967 11.9696C3.36032 11.8289 3.55109 11.7499 3.75 11.7499H18.4397L12.9694 6.28055C12.8286 6.13982 12.7496 5.94895 12.7496 5.74993C12.7496 5.55091 12.8286 5.36003 12.9694 5.2193C13.1101 5.07857 13.301 4.99951 13.5 4.99951C13.699 4.99951 13.8899 5.07857 14.0306 5.2193L20.7806 11.9693C20.8504 12.039 20.9057 12.1217 20.9434 12.2127C20.9812 12.3038 21.0006 12.4014 21.0006 12.4999C21.0006 12.5985 20.9812 12.6961 20.9434 12.7871C20.9057 12.8782 20.8504 12.9609 20.7806 13.0306Z" fill="white"></path></svg>
			</div>
		</div>
	</div>
</div>
</div>
</div>

<style type="text/css">
	.container-kampanye{
		overflow-y: auto;
		scrollbar-width: none;
		-ms-overflow-style: none;
	}
	.container-kampanye::-webkit-scrollbar {
		width: 0px!important;
		height: 0px!important;
	}

	.container-kampanye > div:hover{
		opacity: 1!important;
		transition: all ease .5s;
	}
</style>

<script type="module">
	$(".btn-kembali").click(function (e){
		e.preventDefault();
		$('.container-kampanye').animate({
			scrollLeft: "-=265px"
		}, "slow");
	});

	$(".btn-berikut").click(function (e){
		e.preventDefault();
		$('.container-kampanye').animate({
			scrollLeft: "+=265px"
		}, "slow");
	});
</script>
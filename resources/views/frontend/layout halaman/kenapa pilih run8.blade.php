@include('frontend.partials.header')
<div class="position-relative" style="z-index: -1; margin-top: 70px; height: 250px; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url({{ \App\Models\data_file::getImage($content->gambar_utama) }});">
	<div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; background-color: rgba(0,0,0,0.85)"></div>
	<div class="container position-relative" style="z-index: 1">
		<div class="d-flex align-items-center pt-5 pb-3">
			<a href="/" class="text-decoration-none text-info fs-6">Beranda</a>
			<i class="material-icons-outlined text-secondary px-2 small text-info">chevron_right</i>
			<span class="text-white fs-6">{{ $content->layout->description }}</span>
		</div>
		<div class="fs-3 text-warning">{{ $content->title }}</div>
		<div class="mt-2 small text-light">Alasan Memilih RUN8 Sebagai Mitra Bisnis</div>
	</div>
</div>
<div class="container">
	<div class="bg-white p-4 mb-4 shadow border rounded-4" style="margin-top: -50px">
		<div class="row">
			<div class="d-block d-md-none">
				<label>{{ \App\Helpers\general::waktuPosting($content->published_at) }}</label>
			</div>
			<div class="col-sm-1 d-flex flex-sm-column flex-row gap-3 gap-sm-0">
				<div class="p-2 lh-sm text-center bg-feminim text-light rounded-2 d-md-block d-none">
					<div class="fs-2 fw-bold">{{ \App\Helpers\general::formatTanggal($content->published_at, 'D') }}</div>
					<div style="font-size: 9pt">{{ \App\Helpers\general::formatTanggal($content->published_at, 'MMM-Y') }}</div>
				</div>
				<div class="mt-sm-4 mt-2 d-flex flex-row flex-sm-column align-items-center">
					<svg class="text-success" width="16" height="16" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
						<path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
					</svg>
					<span class="fs-5 ms-2 ms-sm-0">{{ \App\Helpers\general::convertAngkaToMininal($content->dibaca) }}</span>
				</div>
				<div class="mt-sm-4 mt-2 d-flex flex-row flex-sm-column align-items-center">
					<svg class="text-dark" width="16" height="16" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-2v3l-4-3H8m4-13H2a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h2v3l4-3h4a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
					</svg>
					<span class="fs-5 ms-2 ms-sm-0">0</span>
				</div>
			</div>
			<div class="col-sm-8">
				{!! $content->content !!}
			</div>
			<div class="col-sm-3 d-none d-md-block">
				<div class="border-start rounded-3 p-3">
					<h5 class="pb-2" style="border-bottom: 3px solid orange">Kenapa Pilih RUN8</h5>
					<ul class="list-group">
						@foreach($side_menu as $_side_menu)
							<a href="{{ route('halaman.index', [substr($_side_menu->layout->shortname,1), substr($_side_menu->url, 1)]) }}" class="d-flex align-items-center list-group-item list-group-item-action @if($active_page === substr($_side_menu->url, 1)) text-darkOrange fw-bold @endif">
								<i class="material-icons-outlined text-secondary me-2 fs-6">chevron_right</i>
								<span>{{ $_side_menu->title }}</span>
							</a>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@include('frontend.partials.footer')
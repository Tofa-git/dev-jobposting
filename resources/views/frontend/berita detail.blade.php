<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

<style>
	div#social-links {
		margin: 0 auto;
		max-width: 100%;
		list-style: none;
		text-align: center;
	}

	div#social-links ul li {
		display: inline-block;
	}

	div#social-links ul li a {
		padding: 10px;
		border: 1px solid #ccc;
		margin: 3px;
		font-size: 18pt;
		color: #222;
		background-color: #ccc;
	}
</style>

<div class="bg-white p-0">
	<div class="row">
		<div class="col-sm-12 dark bg-gradient">
			<div class="d-flex" style="background-repeat: no-repeat; background-position: center; background-size: cover; background-image: url('{{ \App\Models\data_file::getImage($data->foto_utama) }}');">
				<div class="p-3 px-4 d-flex flex-column w-100 bg-dark" style="opacity: 0.8">
					<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/" class="text-decoration-none text-info">Beranda</a></li>
							<li class="breadcrumb-item" aria-current="page"><a href="/berita" class="text-decoration-none text-info">Berita</a></li>
						</ol>
					</nav>
					<span class="mt-1 fw-bold fs-3" style="color: #ffffff; text-shadow: 2px 2px 5px black;">{{ $data->title }}</span>
					<div class="d-flex mt-3 text-light">
						<div class="d-flex align-items-center lh-sm" style="font-size: 9pt; color: #dddddd">
							<i class="material-icons fs-6">today</i>
							<span class="ms-2">{{ \App\Helpers\general::waktuPosting($data->published_at) }}</span>
							<span class="mx-2">|</span>
							<span>{{ $data->kategoriBerita->description }}</span>
						</div>
					</div>
					<div class="d-flex text-light mt-2">
						<div class="d-flex align-items-center lh-sm" style="font-size: 9pt; color: #dddddd">
							<svg width="16" height="12" fill="currentColor" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M136.6 138.8c-20.37 5.749-36.62 21.25-43.37 41.37L0 460l14.75 14.75l149.1-150.1c-2.1-6.249-4.749-13.25-4.749-20.62c0-26.5 21.5-47.99 47.99-47.99s47.99 21.5 47.99 47.99s-21.5 47.99-47.99 47.99c-7.374 0-14.37-1.75-20.62-4.749l-150.1 149.1L51.99 512l279.8-93.24c20.12-6.749 35.62-22.1 41.37-43.37l42.75-151.4l-127.1-127.1L136.6 138.8zM497.9 74.19l-60.13-60.13c-18.75-18.75-49.24-18.74-67.98 .0065l-56.49 56.61l127.1 127.1l56.61-56.49C516.7 123.4 516.7 92.94 497.9 74.19z"/></svg>
							<span class="ms-2">Penulis</span>
							<span class="mx-2">|</span>
							<span>{{ \App\Models\User::getFieldValue($data->created_by, 'name') }}</span>
						</div>
					</div>
					<div class="mt-4 d-flex text-light">
						<div class="d-flex align-items-center lh-sm" style="font-size: 9pt; color: #dddddd">
							<i class="material-icons fs-6">visibility</i>
							<span class="ms-2 fs-4 text-light">{{ \App\Helpers\general::convertAngkaToMininal($data->dibaca) }} Kali</span>
						</div>
						<div class="ms-4 d-flex align-items-center lh-sm" style="font-size: 9pt; color: #dddddd">
							<i class="material-icons fs-6">share</i>
							<span class="ms-2 fs-4 text-light">0 Kali</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8 fs-5 p-3">
			<img class="img-fluid w-100" src="{{ \App\Models\data_file::getImage($data->foto_utama) }}" />
			<label class="text-muted lh-sm" style="color: #aaaaaa; font-size: 9pt; ">{{ $data->keterangan_foto }}</label> 
			<div class="mt-4">
				{!! $data->content !!}
			</div>
			<hr />
			<div class="mt-4 position-relative">
				{!! $shareComponent !!}
			</div>
		</div>
		<div class="col-sm-4 pt-4">
			<div class="fw-bold pb-2" style="border-bottom: 2px solid midnightBlue">Berita Lainnya</div>
			@forelse($berita as $_berita)
				<div class="col-12 mt-2">
					<a href="/berita/{{ \App\Helpers\general::createSlug($_berita->title) }}" class="btn-berita text-decoration-none d-flex border rounded-2 p-1" style="height: 80px">
						<div class="border" style="min-width: 125px; max-width: 125px; background-repeat: no-repeat; background-position: center; background-size: cover; background-image: url('{{ \App\Models\data_file::getThumbnailImage($_berita->foto_utama) }}');"></div>
						<div class="d-flex flex-column flex-grow-1 ps-2 overflow-hidden">
							<div class="d-flex align-items-center" style="font-size: 9pt;">
								<i class="material-icons text-secondary small">today</i>
								<span class="text-secondary ms-2">{{ \App\Helpers\general::waktuPosting($_berita->published_at) }}</span>
								<span class="mx-2 text-muted">|</span>
								<span class="text-muted">{{ $_berita->kategoriBerita->description }}</span>
							</div>
							<span class="fw-bold text-dark small lh-sm mt-1">{{ \App\Helpers\general::potongKalimat($_berita->title, 60) }}</span>
						</div>
					</a>
				</div>
			@empty
				<div class="p-3 text-center">Data berita tidak ditemukan</div>
			@endforelse
			<h2 class="mt-2 flex-shrink-1 d-flex flex-column flex-sm-row align-items-center">
				<div class="flex-fill pe-4">
					<div style="opacity: 0.25; border-top: 1px solid #853266; height: 1px;"></div>
				</div>
				<div class="flex-shrink-1">
					<a href="/berita" role="button" class="btn btn-sm btn-outline-primary p-2 px-3">
						<span class="me-2">Lihat Berita Lainnya</span>
						<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="jds-icon__svg" style="width: 16px; height: 16px; transform: rotate(0deg); fill: currentcolor;"><path d="M15.3333 16.2222H4.66667C4.17778 16.2222 3.77778 15.8222 3.77778 15.3333V4.66667C3.77778 4.17778 4.17778 3.77778 4.66667 3.77778H9.11111C9.6 3.77778 10 3.37778 10 2.88889C10 2.4 9.6 2 9.11111 2H3.77778C3.30628 2 2.8541 2.1873 2.5207 2.5207C2.1873 2.8541 2 3.30628 2 3.77778V16.2222C2 17.2 2.8 18 3.77778 18H16.2222C17.2 18 18 17.2 18 16.2222V10.8889C18 10.4 17.6 10 17.1111 10C16.6222 10 16.2222 10.4 16.2222 10.8889V15.3333C16.2222 15.8222 15.8222 16.2222 15.3333 16.2222ZM11.7778 2.88889C11.7778 3.37778 12.1778 3.77778 12.6667 3.77778H14.9689L6.85333 11.8933C6.68713 12.0595 6.59376 12.285 6.59376 12.52C6.59376 12.755 6.68713 12.9805 6.85333 13.1467C7.01954 13.3129 7.24495 13.4062 7.48 13.4062C7.71505 13.4062 7.94046 13.3129 8.10667 13.1467L16.2222 5.03111V7.33333C16.2222 7.82222 16.6222 8.22222 17.1111 8.22222C17.6 8.22222 18 7.82222 18 7.33333V2.88889C18 2.4 17.6 2 17.1111 2H12.6667C12.1778 2 11.7778 2.4 11.7778 2.88889Z"></path></svg>
					</a>
				</div>
			</h2>
			<div class="fw-bold pb-2" style="border-bottom: 2px solid midnightBlue">Kegiatan Relawan</div>
			@forelse($kegiatan_relawan as $_kegiatan_relawan)
				<div class="col-12 mt-2">
					<a href="/kegiatan-relawan/{{ \App\Helpers\general::createSlug($_kegiatan_relawan->title) }}" class="btn-berita text-decoration-none d-flex border rounded-2 p-1" style="height: 80px">
						<div class="border" style="min-width: 125px; max-width: 125px; background-repeat: no-repeat; background-position: center; background-size: cover; background-image: url('{{ \App\Models\data_file::getThumbnailImage($_kegiatan_relawan->foto_utama) }}');"></div>
						<div class="d-flex flex-column flex-grow-1 ps-2 overflow-hidden">
							<div class="d-flex align-items-center" style="font-size: 9pt;">
								<i class="material-icons text-secondary small">today</i>
								<span class="text-secondary ms-2">{{ \App\Helpers\general::waktuPosting($data->published_at) }}</span>
								<span class="mx-2 text-muted">|</span>
								<span class="text-muted">{{ $_kegiatan_relawan->kategoriBerita->description }}</span>
							</div>
							<span class="fw-bold text-dark small lh-sm mt-1">{{ \App\Helpers\general::potongKalimat($_kegiatan_relawan->title, 60) }}</span>
						</div>
					</a>
				</div>
			@empty
				<div class="p-3 text-center">Data Kegiatan tidak ditemukan</div>
			@endforelse
			<h2 class="mt-2 flex-shrink-1 d-flex flex-column flex-sm-row align-items-center">
				<div class="flex-fill pe-4">
					<div style="opacity: 0.25; border-top: 1px solid #853266; height: 1px;"></div>
				</div>
				<div class="flex-shrink-1">
					<a href="/berita" role="button" class="btn btn-sm btn-outline-primary p-2 px-3">
						<span class="me-2">Lihat Kegiatan Lainnya</span>
						<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="jds-icon__svg" style="width: 16px; height: 16px; transform: rotate(0deg); fill: currentcolor;"><path d="M15.3333 16.2222H4.66667C4.17778 16.2222 3.77778 15.8222 3.77778 15.3333V4.66667C3.77778 4.17778 4.17778 3.77778 4.66667 3.77778H9.11111C9.6 3.77778 10 3.37778 10 2.88889C10 2.4 9.6 2 9.11111 2H3.77778C3.30628 2 2.8541 2.1873 2.5207 2.5207C2.1873 2.8541 2 3.30628 2 3.77778V16.2222C2 17.2 2.8 18 3.77778 18H16.2222C17.2 18 18 17.2 18 16.2222V10.8889C18 10.4 17.6 10 17.1111 10C16.6222 10 16.2222 10.4 16.2222 10.8889V15.3333C16.2222 15.8222 15.8222 16.2222 15.3333 16.2222ZM11.7778 2.88889C11.7778 3.37778 12.1778 3.77778 12.6667 3.77778H14.9689L6.85333 11.8933C6.68713 12.0595 6.59376 12.285 6.59376 12.52C6.59376 12.755 6.68713 12.9805 6.85333 13.1467C7.01954 13.3129 7.24495 13.4062 7.48 13.4062C7.71505 13.4062 7.94046 13.3129 8.10667 13.1467L16.2222 5.03111V7.33333C16.2222 7.82222 16.6222 8.22222 17.1111 8.22222C17.6 8.22222 18 7.82222 18 7.33333V2.88889C18 2.4 17.6 2 17.1111 2H12.6667C12.1778 2 11.7778 2.4 11.7778 2.88889Z"></path></svg>
					</a>
				</div>
			</h2>
		</div>
	</div>
	<div class="row mt-4 text-light text-center p-0">
		@include('frontend.partials.footer')
	</div>
</div>

<style type="text/css">
      .btn-berita:hover{
            background-color: #eeeeee;
            border: 1px solid #aaaaaa;
            transition: 0.5s all;
      }
</style>
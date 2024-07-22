@php
	$alasan_pilih = \App\Models\halaman_website::select('id', 'id_layout', 'title', 'url', 'gambar_utama', 'content')
		-> with('layout')
		-> where('status', '0')
		-> where('id_layout', 43)
		-> where('published_by', '>', 0)
		-> get();
@endphp

<div class="bg-white">
	<div class="container">
		<div class="mt-4 pb-4 pt-4">
			<div class="mt-3 d-flex justify-content-start justify-content-sm-center text-nowrap">
				<h4 class="d-flex align-items-center">
					<div class="d-none d-sm-block" style="width: 50px">
						<div style="border-top: 1px solid #cccccc; height: 1px;"></div>
					</div>
					<span class="px-2">
						Kenapa Pilih <span class="text-primary" style="font-family: 'Caveat', cursive; font-size: 22pt; font-weight: bold">RUN8</span>
					</span>
					<div style="width: 50px">
						<div style="border-top: 1px solid #cccccc; height: 1px;"></div>
					</div>
				</h4>
			</div>
			<div class="text-lighter text-center text-secondary">
				Kami Membantu Bisnis dan Pekerjaan Menjadi Lebih Mudah
			</div>
			<div class="mt-4 row justify-content-center">
				@php $_i=1; @endphp
				@forelse($alasan_pilih as $_alasan_pilih)
					<div class="col-md-4 p-3">
						<div class="card bg-grey border">
							<div class="card-body">
								<h5 class="card-title">{{ $_i.'. '.$_alasan_pilih->title }}</h5>
								<p class="card-text small text-secondary">{{ \App\Helpers\general::potongKalimat(strip_tags($_alasan_pilih->content), 80) }}</p>
								<a href="{{ route('content.content', [$_alasan_pilih->layout->shortname, $_alasan_pilih->url]) }}" class="text-decoration-none rounded-0 p-0 m-0 d-flex align-items-center">
									<span>Selengkapnya</span>
									<i class="material-icons-outlined ms-2">arrow_forward</i>
								</a>
							</div>
						</div>
					</div>
					@php $_i++; @endphp
				@empty
					<h3 class="text-secondary fw-bold">Data tidak ditemukan!</h3>
				@endforelse
			</div>
			<div class="row mt-3">
				<div class="col-12">
					<h2 class="flex-shrink-1 d-flex flex-column flex-sm-row align-items-center">
						<div class="flex-fill pe-4">
							<div style="opacity: 0.25; border-top: 1px solid #853266; height: 1px;"></div>
						</div>
						<div class="flex-shrink-1">
							<a href="#" role="button" class="btn btn-sm btn-outline-primary p-2 px-3">
								<span class="me-2">Lihat Alasan Lainnya</span>
								<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="jds-icon__svg" style="width: 16px; height: 16px; transform: rotate(0deg); fill: currentcolor;"><path d="M15.3333 16.2222H4.66667C4.17778 16.2222 3.77778 15.8222 3.77778 15.3333V4.66667C3.77778 4.17778 4.17778 3.77778 4.66667 3.77778H9.11111C9.6 3.77778 10 3.37778 10 2.88889C10 2.4 9.6 2 9.11111 2H3.77778C3.30628 2 2.8541 2.1873 2.5207 2.5207C2.1873 2.8541 2 3.30628 2 3.77778V16.2222C2 17.2 2.8 18 3.77778 18H16.2222C17.2 18 18 17.2 18 16.2222V10.8889C18 10.4 17.6 10 17.1111 10C16.6222 10 16.2222 10.4 16.2222 10.8889V15.3333C16.2222 15.8222 15.8222 16.2222 15.3333 16.2222ZM11.7778 2.88889C11.7778 3.37778 12.1778 3.77778 12.6667 3.77778H14.9689L6.85333 11.8933C6.68713 12.0595 6.59376 12.285 6.59376 12.52C6.59376 12.755 6.68713 12.9805 6.85333 13.1467C7.01954 13.3129 7.24495 13.4062 7.48 13.4062C7.71505 13.4062 7.94046 13.3129 8.10667 13.1467L16.2222 5.03111V7.33333C16.2222 7.82222 16.6222 8.22222 17.1111 8.22222C17.6 8.22222 18 7.82222 18 7.33333V2.88889C18 2.4 17.6 2 17.1111 2H12.6667C12.1778 2 11.7778 2.4 11.7778 2.88889Z"></path></svg>
							</a>
						</div>
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.card:hover{
		background-color: white!important;
		border: 1px solid #cccccc!important;
		box-shadow: 0px 0px 10px #dddddd;
		transition: all 0.5s;
	}
</style>
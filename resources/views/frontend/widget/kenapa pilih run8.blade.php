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
								<a href="{{ route('content.sub-content', [substr($_alasan_pilih->layout->shortname, 1), substr($_alasan_pilih->url, 1)]) }}" class="text-decoration-none rounded-0 p-0 m-0 d-flex align-items-center">
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
<div class="bg-white p-0">
	<div class="row">
		<div class="col-sm-12 bg-primary bg-gradient p-3 text-center">
			<h3 class="text-light fw-bold" style="text-shadow: 2px 2px 5px black;">{{ $active }}</h3>
		</div>
		<div class="col-sm-8">
			@forelse($data as $_berita)
				<a href="/berita/{{ \App\Helpers\general::createSlug($_berita->title) }}" class="text-decoration-none d-flex flex-column flex-md-row bg-teal-hover border rounded-2 p-1 mt-3">
					<div class="border overflow-hidden" style="min-width: 300px; max-width: 350px; height: 200px; background-size: cover; background-repeat: no-repeat; background-position: center; background-image: url('{{ \App\Models\data_file::getThumbnailImage($_berita->foto_utama) }}');">
					</div>
					<div class="d-flex flex-column flex-grow-1 ps-3 overflow-hidden">
						<div class="d-flex align-items-center" style="font-size: 9pt;">
							<i class="material-icons text-secondary" style="font-size: 9pt">today</i>
							<span class="text-secondary ms-2">{{ \App\Helpers\general::yyyymmddToShort($_berita->published_at) }}</span>
							<span class="mx-2 text-muted">|</span>
							<span class="text-muted">{{ $_berita->kategoriBerita->description }}</span>
						</div>
						<span class="fw-bold text-dark small lh-sm fs-4 mt-1">{{ \App\Helpers\general::potongKalimat($_berita->title, 80) }}</span>
						<span class="text-muted small lh-sm fs-6 mt-1">{{ \App\Helpers\general::potongKalimat($_berita->content, 200) }}</span>
					</div>
				</a>
			@empty
				<h4>Berita dan Informasi tidak ditemukan</h4>
			@endforelse
			<div class="mt-3 p-2 px-3 d-flex flex-row flex-fill border-top bg-light">
				<div class="d-md-inline d-none small flex-grow-1">Menampilkan {{ (int)$data->firstItem().' sampai '.(int)$data->lastItem() }} dari {{ $data->total().' berita' }}</div>
				<div>{!! str_replace('pagination', 'pagination pagination-sm no-gap mb-0 place-right', $data->onEachSide(1)->render('pagination::bootstrap-4')) !!}</div>
			</div>
		</div>
		<div class="col-sm-4 pt-3">
			<img class="img-fluid w-100" src="{{ asset('assets/images/icon/coblos no 1.jpg') }}" />
		</div>
	</div>
	<div class="row mt-4 text-light text-center p-0">
		@include('frontend.partials.footer')
	</div>
</div>
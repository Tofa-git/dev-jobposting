<div class="bg-white p-0">
	<div class="row">
		<div class="col-sm-12 bg-primary bg-gradient p-3 text-center order-1">
			<h3 class="text-light fw-bold" style="text-shadow: 2px 2px 5px black;">{{ $content->title }}</h3>
		</div>
		<div class="col-sm-8 p-3 pt-4 fs-5 order-3 order-sm-2">
			{!! $content->content !!}
		</div>
		<div class="col-sm-4 p-3 text-center order-2 order-sm-3">
			<img src="{{ \App\Models\data_file::getImage($content->gambar_utama) }}" class="img-fluid" style="width: 250px;" />
			{!! $judul_gambar !!}
		</div>
	</div>
	<div class="row mt-4 text-light text-center p-0">
		@include('frontend.partials.footer')
	</div>
</div>
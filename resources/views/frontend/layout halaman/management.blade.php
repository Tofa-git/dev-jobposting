@php
	$_side_menu = \App\Models\frontend_menu::where('status', '0')
		-> where('published_by', '>', 0)
		-> where('refid', 3)
		-> get();
@endphp
<div class="position-relative" style="z-index: -1; margin-top: 70px; height: 250px; background-size: cover; background-position: center; background-repeat: no-repeat; background-image: url({{ \App\Models\data_file::getImage($content->gambar_utama) }});">
	<div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; background-color: rgba(0,0,0,0.85)"></div>
	<div class="container position-relative">
		<div class="d-flex align-items-center pt-5 pb-3">
			<a href="/" class="text-decoration-none text-info fs-6">Beranda</a>
			<i class="material-icons text-secondary px-2 small text-info">chevron_right</i>
			<span class="text-white fs-6">{{ $title }}</span>
		</div>
		<div class="fs-3 text-warning">{{ $title }}</div>
		<div class="mt-2 small text-light">Kenali lebih jauh tentang RUM8 Management</div>
	</div>
</div>
<div class="container">
	<div class="bg-white p-4 mb-4 shadow border rounded-4" style="margin-top: -50px">
		<div class="row">
			<div class="col-sm-9">
				{!! $content->content !!}
			</div>
			<div class="col-sm-3 d-none d-md-block">
				<div class="border-start rounded-3 p-3">
					<h5 class="pb-2" style="border-bottom: 3px solid orange">Management RUN8</h5>
					<ul class="list-group">
						@foreach($_side_menu as $side_menu)
							<a href="{{ route('halaman.index', [str_replace('/halaman/','',$side_menu->target_url), substr($side_menu->target_slug, 1)]) }}" class="d-flex align-items-center list-group-item list-group-item-action @if($active === substr($side_menu->target_slug, 1)) text-darkOrange fw-bold @endif">
								<i class="material-icons text-secondary me-2 fs-6">chevron_right</i>
								<span>{{ $side_menu->caption }}</span>
							</a>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@include('frontend.partials.footer')
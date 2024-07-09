<div class="bg-dark p-0" style="margin-top: 70px; height: 250px;">
	<div class="container">
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
		{!! $content->content !!}
	</div>
</div>
@include('frontend.partials.footer')

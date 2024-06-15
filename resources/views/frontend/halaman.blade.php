<div class="bg-white p-0">
	<div class="row">
		<div class="col-sm-12 bg-primary bg-gradient p-3 text-center">
			<h3 class="text-light fw-bold" style="text-shadow: 2px 2px 5px black;">{{ $content->title }}</h3>
		</div>
		<div class="col-sm-8 p-3 pt-4 fs-5">
			{!! $content->content !!}
		</div>
		<div class="col-sm-4 pt-4">
			<form method="post" action="{{ route('frontend.download-visi-misi') }}" class="d-flex justify-content-center">
				@csrf()
				<button type="submit" class="btn btn-sm btn-outline-primary p-2 px-2 d-flex text-nowrap align-self-center">
					<i class="material-icons p-1 d-flex fs-6">picture_as_pdf</i>
					<span class="text-center ms-2">Download Visi dan Misi</span>
				</button>
			</form>
		</div>
	</div>
	<div class="row mt-4 text-light text-center p-0">
		@include('frontend.partials.footer')
	</div>
</div>
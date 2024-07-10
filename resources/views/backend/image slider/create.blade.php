<script src="https://cdn.tiny.cloud/1/1vczo5m4ukbkojaszcn9l0alulcxmby2hfp9gx83hm8qgq3y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-auto ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<form action="{{ route('halaman-website.store') }}" method="post" enctype="multipart/form-data" class="d-flex flex-fill bg-white">
		<div class="p-3 d-flex flex-fill flex-column align-items-stretch">
			@csrf()
			<div class="d-flex flex-fill flex-column">
				<div class="row mt-2 flex-shrink-1">
					<div class="col-sm-6">
						<label for="no_urut" class="small fw-bold">No. Urut *)</label>
						<input type="number" name="no_urut" id="no_urut" class="form-control bg-white @error('no_urut') is-invalid @enderror" required autofocus value="{{ old('no_urut') ?? 1 }}" />
					</div>
					<div class="col-sm-6">
						<label for="judul" class="small fw-bold">Judul Slider *)</label>
						<div class="input-group">
							<input type="text" name="judul" id="judul" title="Judul Slider" placeholder="Judul Slider" class="form-control bg-white @error('judul') is-invalid @enderror" required maxlength="255" value="{{ old('judul') }}" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2 flex-shrink-1">
					<div class="col-sm-6">
						<label for="file_gambar">File Gambar <small>(Max. 2 MB)</small></label>
						<input type="file" class="form-control bg-white @error('file_gambar') is-invalid @enderror" id="file_gambar" name="file_gambar" accept=".jpeg, .jpg, .png" />
					</div>
					<div class="col-sm-6">
						<label for="alt_key" class="small">Alt Description</label>
						<div class="input-group">
							<input type="text" name="alt_key" id="alt_key" title="Alt description" placeholder="Alt description" class="form-control bg-white @error('alt_key') is-invalid @enderror" required maxlength="255" value="{{ old('alt_key') }}" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex flex-fill flex-column align-items-stretch">
					<label for="alt_key" class="small mt-2">Slider Content</label>
					<textarea name="bodyEditor" id="bodyEditor">{!! old('bodyEditor') !!}</textarea>
				</div>
			</div>
			<hr class="flex-shrink-1 m-0 mt-2 mb-2" />
			<div class="d-flex flex-shrink-1 px-3 justify-content-end">
				<button type="submit" onclick="globalFunction.prosesButton(this); this.form.submit()" class="d-flex btn btn-primary bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 text-nowrap align-self-center">Simpan</span>
				</button>
				<a href="{{ route('image-slider.index') }}" role="button" class="btn btn-danger bg-gradient">Kembali</a>
			</div>
		</div>
	</form>
</div>

<script type="module">
	tinymce.init({
		selector: '#bodyEditor',
		menubar: false,
		statusbar: false,
		height: '100%',
		plugins: 'anchor autolink charmap code emoticons image link lists media searchreplace table visualblocks wordcount',
		toolbar: 'code | undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
	});
</script>

<style type="text/css">
	#wrapper, .mce-tinymce,.mce-stack-layout, .mce-edit-area{
		display: flex!important;
		flex-direction: column;
		flex: 1;
		align-items:stretch;
	}
	.mce-tinymce iframe{
		flex: 1;
	}
</style>
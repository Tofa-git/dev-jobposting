<script src="https://cdn.tiny.cloud/1/1vczo5m4ukbkojaszcn9l0alulcxmby2hfp9gx83hm8qgq3y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-auto ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<form action="{{ route('halaman-website.update', $data->id) }}" method="post" enctype="multipart/form-data" class="d-flex flex-fill bg-white">
		<div class="p-3 d-flex flex-fill flex-column align-items-stretch">
			@csrf()
			@method('put')
			<div class="d-flex flex-fill flex-column">
				<div class="row flex-shrink-1">
					<div class="col-sm-6">
						<label for="layout" class="small fw-bold">Layout Halaman *)</label>
						<select class="form-select bg-white @error('layout') is-invalid @enderror" id="layout" name="layout" required>
							@foreach($layout as $_layout)
								<option value="{{ $_layout->id }}" @if((int)$data->id_layout === $_layout->id) selected @endif>{{ $_layout->description }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-6">
						<label for="url_halaman" class="small fw-bold">URL *)</label>
						<input type="text" class="form-control text-secondary bg-light @error('url_halaman') is-invalid @enderror" name="url_halaman" id="url_halaman" value="{{ $data->url }}" required />
					</div>
				</div>
				<div class="row mt-2 flex-shrink-1">
					<div class="col-sm-6">
						<label for="judul" class="small fw-bold">Judul Halaman *)</label>
						<div class="input-group">
							<input type="text" name="judul" id="judul" title="Judul Halaman" placeholder="Judul Halaman" class="auto_focus form-control bg-white @error('judul') is-invalid @enderror" required autofocus maxlength="255" value="{{ $data->title }}" onkeyup="globalFunction.updateJudul(this, '#url_halaman')" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="gambar_utama">Gambar Utama <small>(Max. 2 MB)</small></label>
						<input type="file" class="form-control bg-white @error('gambar_utama') is-invalid @enderror" id="gambar_utama" name="gambar_utama" accept=".jpeg, .jpg, .png" />
						@if(!is_null($data->gambar_utama))
							<a href="#" target="_blank">Lihat gambar utama</a>
						@endif
					</div>
				</div>
				<div class="d-flex flex-fill flex-column align-items-stretch mt-2">
					<nav class="flex-shrink-1">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<button class="nav-link active" id="nav-halaman-tab" data-bs-toggle="tab" data-bs-target="#nav-halaman" type="button" role="tab" aria-controls="nav-halaman" aria-selected="true">Konten Halaman</button>
							<button class="nav-link" id="nav-meta-tab" data-bs-toggle="tab" data-bs-target="#nav-meta" type="button" role="tab" aria-controls="nav-meta" aria-selected="false">Meta Description</button>
						</div>
					</nav>
					<div class="tab-content flex-fill" id="nav-tabContent">
						<div class="tab-pane fade show active p-2 border-start border-end border-bottom h-100 w-100" id="nav-halaman" role="tabpanel" aria-labelledby="nav-halaman-tab" tabindex="0">
							<textarea name="bodyEditor" id="bodyEditor">{!! $data->content !!}</textarea>
						</div>
						<div class="tab-pane fade show border-start border-end border-bottom p-2" id="nav-meta" role="tabpanel" aria-labelledby="nav-meta-tab" tabindex="0">
							<div class="mt-1">
								<label for="meta_title">Meta Title</label>
								<div class="input-group">
									<input type="text" name="meta_title" id="meta_title" title="Meta Title" placeholder="Meta Title" class="form-control bg-white border-grey @error('meta_title') is-invalid @enderror" maxlength="255" value="{{ $data->meta_title }}" />
									<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
										<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
									</div>
								</div>
							</div>
							<div class="mt-2">
								<label for="meta_description">Meta Deskripsi</label>
								<textarea class="form-control border bg-white @error('meta_description') is-invalid @enderror" rows="10" maxlength="255" placeholder="Maksimum 150 karakter" name="meta_description" id="meta_description" rows="3">{!! $data->meta_description !!}</textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr class="flex-shrink-1 m-0 mt-2 mb-2" />
			<div class="d-flex flex-shrink-1 px-3 justify-content-end">
				<button type="submit" onclick="globalFunction.prosesButton(this); this.form.submit()" class="d-flex btn btn-primary bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Update</span>
				</button>
				<a href="{{ route('halaman-website.index') }}" role="button" class="btn btn-danger bg-gradient">Kembali</a>
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
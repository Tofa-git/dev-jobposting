<script src="https://cdn.tiny.cloud/1/1vczo5m4ukbkojaszcn9l0alulcxmby2hfp9gx83hm8qgq3y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-auto ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<form action="{{ route('posting-berita.store') }}" method="post" enctype="multipart/form-data" class="d-flex flex-fill bg-white">
		<div class="p-3 d-flex flex-fill flex-column align-items-stretch">
			@csrf()
			<div class="d-flex flex-fill flex-column">
				<div class="row flex-shrink-1">
					<div class="col-sm-6">
						<label for="jenis" class="small fw-bold">Jenis Berita *)</label>
						<select class="form-select bg-white @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
							@foreach($jenis_berita as $_jenis_berita)
								<option value="{{ $_jenis_berita->id }}">{{ $_jenis_berita->description }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-sm-6">
						<label for="kategori" class="small fw-bold">Kategori Berita *)</label>
						<select class="form-select bg-white @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
							@foreach($kategori_berita as $_kategori_berita)
								<option value="{{ $_kategori_berita->id }}">{{ $_kategori_berita->description }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row mt-2 flex-shrink-1">
					<div class="col-sm-6">
						<label for="url_slug" class="small fw-bold">URL Slug *)</label>
						<input type="text" class="form-control text-secondary bg-light @error('url_slug') is-invalid @enderror" name="url_slug" id="url_slug" value="{{ old('url_slug') ?? '/' }}" required />
					</div>
					<div class="col-sm-6">
						<label for="foto_utama">Foto Utama <small>(Max. 2 MB)</small></label>
						<input type="file" class="form-control bg-white @error('foto_utama') is-invalid @enderror" id="foto_utama" name="foto_utama" accept=".jpeg, .jpg, .png" />
					</div>
				</div>
				<div class="row mt-2 flex-shrink-1">
					<div class="col-sm-6">
						<label for="judul" class="small fw-bold">Judul Berita *)</label>
						<div class="input-group">
							<input type="text" name="judul" id="judul" title="Judul Berita" placeholder="Judul Berita" class="auto_focus form-control bg-white @error('judul') is-invalid @enderror" required autofocus maxlength="255" value="{{ old('judul') }}" onkeyup="globalFunction.updateJudul(this, '#url_slug')" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<label for="keterangan_foto" class="small">Keterangan Foto Utama</label>
						<div class="input-group">
							<input type="text" name="keterangan_foto" id="keterangan_foto" title="Keterangan Foto Utama" placeholder="Keterangan Foto Utama" class="form-control bg-white @error('keterangan_foto') is-invalid @enderror" maxlength="255" value="{{ old('keterangan_foto') }}" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex flex-fill flex-column align-items-stretch mt-2">
					<nav class="flex-shrink-1">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<button class="nav-link active" id="nav-halaman-tab" data-bs-toggle="tab" data-bs-target="#nav-halaman" type="button" role="tab" aria-controls="nav-halaman" aria-selected="true">Konten Berita</button>
							<button class="nav-link" id="nav-meta-tab" data-bs-toggle="tab" data-bs-target="#nav-meta" type="button" role="tab" aria-controls="nav-meta" aria-selected="false">Meta Description</button>
						</div>
					</nav>
					<div class="tab-content flex-fill" id="nav-tabContent">
						<div class="tab-pane fade show active p-2 border-start border-end border-bottom h-100 w-100" id="nav-halaman" role="tabpanel" aria-labelledby="nav-halaman-tab" tabindex="0">
							<textarea name="bodyEditor" id="bodyEditor">{!! old('bodyEditor') !!}</textarea>
						</div>
						<div class="tab-pane fade show border-start border-end border-bottom p-2" id="nav-meta" role="tabpanel" aria-labelledby="nav-meta-tab" tabindex="0">
							<div class="mt-1">
								<label for="meta_title">Meta Title</label>
								<div class="d-flex">
									<input type="text" name="meta_title" id="meta_title" title="Meta Title" placeholder="Meta Title" class="w-100 form-control input-text @error('meta_title') is-invalid @enderror" maxlength="255" />
									<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
										<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
									</div>
								</div>
							</div>
							<div class="mt-2">
								<label for="meta_description">Meta Deskripsi</label>
								<textarea class="form-control border bg-white @error('meta_description') is-invalid @enderror" rows="10" maxlength="255" placeholder="Maksimum 150 karakter" name="meta_description" id="meta_description" rows="3"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr class="flex-shrink-1 m-0 mt-2 mb-2" />
			<div class="d-flex flex-shrink-1 px-3 justify-content-end">
				<button type="submit" onclick="globalFunction.prosesButton(this); this.form.submit()" class="d-flex btn btn-primary bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 text-nowrap align-self-center">Simpan</span>
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
<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('mitra-dan-klien.store') }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" enctype="multipart/form-data" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			<div class="px-3">
				<div class="row">
					<div class="col-sm-3">
						<label class="small fw-bold" for="jenis_client">Jenis Klien *)</label>
					</div>
					<div class="col-sm-9">
						<select class="form-select bg-white" name="jenis_client" id="jenis_client">
							@foreach($jenis_client as $_jenis_client)
								<option value="{{ $_jenis_client->id }}">{{ $_jenis_client->description }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="jenis_kerjasama">Jenis Kerjasama *)</label>
					</div>
					<div class="col-sm-9">
						<select class="form-select bg-white" name="jenis_kerjasama" id="jenis_kerjasama">
							@foreach($jenis_kerjasama as $_jenis_kerjasama)
								<option value="{{ $_jenis_kerjasama->id }}">{{ $_jenis_kerjasama->description }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="type_perusahaan">Tipe Perusahaan *)</label>
					</div>
					<div class="col-sm-9">
						<select class="form-select bg-white" name="type_perusahaan" id="type_perusahaan">
							@foreach($type_perusahaan as $_type_perusahaan)
								<option value="{{ $_type_perusahaan->id }}">{{ $_type_perusahaan->description }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small" for="shortname">Shortname</label>
					</div>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="shortname" id="shortname" title="Shortname master data" placeholder="Shortname Master Data" class="form-control border-grey bg-white @error('shortname') is-invalid @enderror" maxlength="32" />
							<div class="p-2 bg-secondary d-flex rounded-end-2" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="description">Description *)</label>
					</div>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="description" id="description" title="Deskripsi master data detail" placeholder="Deskripsi Master Data Detail" class="auto_focus form-control bg-white border-grey @error('description') is-invalid @enderror" required autofocus maxlength="255" />
							<div class="p-2 bg-secondary d-flex rounded-end-2" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr />
			<div class="d-flex px-3 justify-content-end">
				<button type="submit" class="d-flex btn btn-primary bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Simpan</span>
				</button>
				<a href="#" role="button" class="btn btn-danger bg-gradient" data-bs-dismiss="modal" aria-label="Close">Close</a>
			</div>
		</div>
	</form>
</div>
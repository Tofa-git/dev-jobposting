<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('wilayah-administrasi.update', $data->id) }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			@method('put')
			<div class="px-3">
				@foreach($parent as $_parent)
					<div class="row mt-1">
						<div class="col-sm-4">
							<label class="small">{{ $_parent['jenis'] }}</label>
						</div>
						<div class="col-sm-8">
							<input type="text" class="form-control bg-light border-grey disabled" value="{{ $_parent['nama'] }}" disabled />
						</div>
					</div>
				@endforeach
				<div class="row mt-1">
					<div class="col-sm-4">
						<label class="small fw-bold" for="kode_wilayah">Kode {{ \App\Models\wilayah_administrasi::getName($data->kode) }} *)</label>
					</div>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" name="kode_wilayah" id="kode_wilayah" title="Kode Wilayah" placeholder="Kode Wilayah" class="auto_focus form-control bg-white @error('kode_wilayah') is-invalid @enderror" value="{{ $data->kode }}" required maxlength="16" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-4">
						<label class="small fw-bold" for="nama">Nama {{ \App\Models\wilayah_administrasi::getName($data->kode) }} *)</label>
					</div>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" name="nama" id="nama" title="Nama Wilayah Administrasi" placeholder="Nama Wilayah Administrasi" class="form-control bg-white @error('nama') is-invalid @enderror" value="{{ $data->nama }}" required maxlength="64" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
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
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Update</span>
				</button>
				<a href="#" role="button" class="btn btn-danger bg-gradient" data-bs-dismiss="modal" aria-label="Close">Close</a>
			</div>
		</div>
	</form>
</div>
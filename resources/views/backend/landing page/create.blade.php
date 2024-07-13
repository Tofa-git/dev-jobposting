<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('landing-page.store') }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			<div class="px-3">
				<div class="row">
					<div class="col-sm-3">
						<label class="small fw-bold" for="sequence">Sequence *)</label>
					</div>
					<div class="col-sm-4">
						<input type="number" class="auto_focus form-control bg-white w-100" id="sequence" name="sequence" value="{{ $seq }}" />
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="nama">Nama *)</label>
					</div>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="nama" id="nama" title="Nama Widget" placeholder="Nama Widget" class="form-control bg-white border-grey @error('nama') is-invalid @enderror" required autofocus maxlength="255" />
							<div class="p-2 bg-secondary d-flex rounded-end-2" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="target">Target *)</label>
					</div>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="target" id="target" title="Target Widget" placeholder="Target Widget" class="form-control bg-white border-grey @error('target') is-invalid @enderror" required autofocus maxlength="255" />
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
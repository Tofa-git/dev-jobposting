<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('user-management.store') }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			<div class="px-3">
				<div class="row">
					<div class="col-sm-3 mt-2">
						<label class="small fw-bold" for="nama">Nama Lengkap *)</label>
					</div>
					<div class="col-sm-9 mt-2">
						<div class="input-group">
							<input placeholder="Nama Lengkap" type="text" class="auto_focus form-control bg-white @error('nama') is-invalid @enderror" name="nama" id="nama" maxlength="32" required />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 mt-2">
						<label class="small fw-bold" for="email">Username *)</label>
					</div>
					<div class="col-sm-9 mt-2">
						<div class="input-group">
							<input placeholder="Username" type="text" class="form-control bg-white @error('email') is-invalid @enderror" name="email" id="email" maxlength="64" required autocomplete="email" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 mt-2">
						<label class="small fw-bold" for="jenis_account">Jenis Akun *)</label>
					</div>
					<div class="col-sm-9 mt-2">
						<select class="form-select bg-white border-grey @error('jenis_account') is-invalid @enderror" name="jenis_account" id="jenis_account">
							<option value="0" selected disabled>Pilih Jenis Account</option>
							@foreach($jenis_account as $_jenis_account)
								<option value="{{ $_jenis_account->id }}">{{ $_jenis_account->description }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 mt-2">
						<lable class="text-nowrap small fw-bold" for="password">Password *)</lable>
					</div>
					<div class="col-sm-9 mt-2">
						<div class="input-group">
							<input placeholder="Password" type="password" class="form-control bg-white @error('password') is-invalid @enderror" name="password" id="password" maxlength="32" required />
							<div onclick="globalFunction.togglePassword(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Show or hide password">
								<i class="material-icons-outlined align-self-center text-info fs-5">visibility_off</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 mt-2">
						<lable class="text-nowrap small fw-bold" for="password_confirmation">Password Confirm *)</lable>
					</div>
					<div class="col-sm-9 mt-2">
						<div class="input-group">
							<input placeholder="Password Confirmation" type="password" class="form-control bg-white @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" maxlength="32" required />
							<div onclick="globalFunction.togglePassword(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Show or hide password">
								<i class="material-icons-outlined align-self-center text-info fs-5">visibility_off</i>
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
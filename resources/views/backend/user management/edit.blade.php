<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('user-management.update', $data->id) }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			@method('put')
			<div class="px-3">
				<div class="row">
					<div class="col-sm-3 mt-2">
						<label class="small fw-bold" for="nama">Nama Lengkap *)</label>
					</div>
					<div class="col-sm-9 mt-2">
						<div class="d-flex">
							<input placeholder="Nama Lengkap" type="text" class="auto_focus form-control bg-white rounded-0" value="{{ $data->name }}" name="nama" id="nama" required />
							<div class="p-2 bg-secondary d-flex clearValue" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 mt-2">
						<label class="small" for="email">Username</label>
					</div>
					<div class="col-sm-9 mt-2">
						<input placeholder="Username" name="email" id="email" type="text" class="form-control rounded-0" value="{{ $data->email }}" readonly autocomplete="off" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3 mt-2">
						<label class="small fw-bold" for="jenis_account">Jenis Akun *)</label>
					</div>
					<div class="col-sm-9 mt-2">
						<select class="form-select bg-white rounded-0" name="jenis_account" id="jenis_account">
							<option value="0" selected disabled>Pilih Jenis Account</option>
							@foreach($jenis_account as $_jenis_account)
								<option value="{{ $_jenis_account->id }}" @if((int)$_jenis_account->id === (int)$data->role) selected @endif>{{ $_jenis_account->description }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<hr />
			<div class="d-flex px-3 justify-content-end">
				<button type="submit" class="d-flex btn btn-primary bg-gradient rounded-0 me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Update</span>
				</button>
				<a href="#" role="button" class="btn btn-danger bg-gradient rounded-0" data-bs-dismiss="modal" aria-label="Close">Close</a>
			</div>
		</div>
	</form>
</div>
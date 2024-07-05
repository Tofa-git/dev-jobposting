<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('group-roles.update', $data->id) }}" method="post" class="d-flex flex-column flex-grow-1 bg-white" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="px-3 flex-grow-1 align-items-stretch">
			@csrf()
			@method('put')
			<div class="row">
				<div class="col-sm-3 mt-2">
					<label for="description">Nama Group</label>
				</div>
				<div class="col-sm-9 mt-2">
					<div class="input-group">
						<input type="text" name="description" id="description" title="Nama Group" placeholder="Nama Group" class="auto_focus form-control bg-white @error('description') is-invalid @enderror" value="{{ $data->description }}" required autofocus maxlength="255" />
						<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
							<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
						</div>
					</div>
				</div>
			</div>
			<hr />
			<div class="d-flex px-3 pb-3 justify-content-end">
				<button type="submit" class="d-flex btn btn-primary bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 d-flex text-nowrap align-self-center">Update</span>
				</button>
				<a data-bs-dismiss="modal" role="button" class="btn btn-danger bg-gradient">Close</a>
			</div>
		</div>
	</form>
</div>
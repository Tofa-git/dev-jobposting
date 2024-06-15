<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('master-data.update', $data->id) }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			@method('put')
			<div class="px-3">
				<div class="row">
					<div class="col-sm-3">
						<label class="small fw-bold" for="description">Description *)</label>
					</div>
					<div class="col-sm-9">
						<div class="d-flex">
							<input type="text" name="description" id="description" title="Deskripsi master data" placeholder="Deskripsi Master Data" class="auto_focus w-100 form-control input-text @error('description') is-invalid @enderror" value="{{ $data->description }}" required autofocus maxlength="255" />
							<div class="p-2 bg-secondary d-flex clearValue" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
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
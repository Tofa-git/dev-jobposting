<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('file-management.store') }}" method="post" enctype="multipart/form-data" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			<div class="px-3">
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="file_name">File (Max 2MB) *)</label>
					</div>
					<div class="col-sm-9">
						<div class="d-flex">
							<input type="file" class="form-control rounded-0 bg-white" name="file_name" id="file_name" accept="image/png, image/jpeg, application/pdf,  application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.openxmlformats-officedocument.presentationml.slideshow" />
						</div>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="description">Description *)</label>
					</div>
					<div class="col-sm-9">
						<textarea class="auto_focus form-control bg-white rounded-0 @error('description') is-invalid @enderror" rows="4" name="description" id="description"></textarea>
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
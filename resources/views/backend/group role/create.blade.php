<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('group-roles.store') }}" method="post" class="d-flex flex-column flex-grow-1 bg-white" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="px-3 flex-grow-1 align-items-stretch">
			@csrf()
			<div class="row">
				<div class="col-sm-3 mt-2">
					<label for="description">Nama Group</label>
				</div>
				<div class="col-sm-9 mt-2">
                    <div class="d-flex">
                        <input placeholder="Deskripsi Master Data" type="text" class="auto_focus rounded-0 form-control input-text @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" required />
                        <div class="p-2 bg-secondary d-flex clearValue" style="cursor: pointer" title="Clear">
                            <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                        </div>
                    </div>
				</div>
			</div>
			<hr />
			<div class="d-flex px-3 pb-3 justify-content-end">
				<button type="submit" class="d-flex btn btn-primary rounded-0 bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 d-flex text-nowrap align-self-center">Simpan</span>
				</button>
				<a data-bs-dismiss="modal" role="button" class="btn btn-danger rounded-0 bg-gradient">Close</a>
			</div>
		</div>
	</form>
</div>
<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('file-management.update', $data->id) }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			@method('put')
			<div class="px-3">
				<div class="row mt">
					<div class="col-sm-3">
						@if($data->type === 'pictures')
							<img class="img-fluid" src="{{ asset('assets/images/icons/image.png') }}" style="height: 50px;" />
						@elseif($data->extension === 'PDF')
							<img class="img-fluid" src="{{ asset('assets/images/icons/pdf.png') }}" style="height: 50px;" />
						@endif
					</div>
					<div class="col-sm-9">
						<div class="small text-muted">Real Name:</div>
						<span class="small">{{ $data->filename }}</span>
						<div class="mt-2 small text-muted">File Descriptions:</div>
						<textarea class="auto_focus form-control bg-white rounded-0 p-0 @error('description') is-invalid @enderror" rows="4" name="description" id="description">{!! $data->description !!}</textarea>
						@if($data->type === 'pictures')
							<div class="mt-2 small text-muted">Alternative Key:</div>
							<input type="text" class="form-control bg-white rounded-0 @error('alt_key') is-invalid @enderror" name="alt_key" id="alt_key" value="{{ $data->alt_key }}" />
						@endif
					</div>
				</div>
				<hr />
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small text-muted">Type</label>
					</div>
					<div class="col-sm-9">
						<span class="small">{{ ucfirst($data->type).' Files (.'.strtolower($data->extension).')' }}</span>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small text-muted">Size</label>
					</div>
					<div class="col-sm-9">
						<span class="small">{{ \App\Helpers\general::convertFileSize($data->size).' ('.number_format($data->size).' bytes)' }}</span>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small text-muted">Created</label>
					</div>
					<div class="col-sm-9">
						<span class="small">{{ $data->created_at }}</span>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small text-muted">Last Modified</label>
					</div>
					<div class="col-sm-9">
						<span class="small">{{ $data->updated_at }}</span>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-sm-3">
						<label class="small text-muted">Owner</label>
					</div>
					<div class="col-sm-9">
						<span class="small">{{ $data->user->name.' ('.$data->user->email.')' }}</span>
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
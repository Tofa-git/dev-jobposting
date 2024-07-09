<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('website-menu.update', $data->id) }}" method="post" class="d-flex flex-column flex-grow-1 bg-white rounded-3" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 flex-grow-1 align-items-stretch">
			@csrf()
			@method('put')
			<div class="px-3">
				<div class="row">
					<div class="col-sm-4">
						<label for="refid" class="small">Parent Menu</label>
					</div>
					<div class="col-sm-8">
						<select class="form-select bg-white" name="refid" id="refid">
							<option value="0" @if((int)$data->refid === 0) selected @endif>Pilih Parent Menu</option>
							@foreach($parent as $_parent)
								<option value="{{ $_parent->id }}" @if((int)$data->refid === (int)$_parent->id) selected @endif>{{ $_parent->caption }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-4">
						<label for="sequence" class="small">Sequence</label>
					</div>
					<div class="col-sm-8">
						<input type="number" class="form-control auto_focus bg-white" name="sequence" id="sequence" value="{{ $data->sequence }}" required />
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-4">
						<label for="icon" class="small">Icon Menu</label>
					</div>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-text" style="min-width: 50px; max-width: 50px">
								<i class="material-icons-outlined align-middle align-self-center" id="showIcon">{{ $data->icon }}</i>
							</span>
							<input type="text" class="form-control bg-white" value="{{ $data->icon }}" name="icon" id="icon" onkeyup="globalFunction.change_icon(this.value)" />
						</div>
					</div>
				</div>
				<div class="row mt-2 internal_el">
					<div class="col-sm-4">
						<label class="small">Target Halaman</label>
					</div>
					<div class="col-sm-8">
						<select class="form-select bg-white" name="url_halaman" id="url_halaman">
							<option value="#" data-slug="" @if($data->target_url === '#') selected @endif>#</option>
							<option value="/" data-slug="" @if($data->target_url === '/') selected @endif>/</option>
							@foreach($halaman as $_halaman)
								<option value="{{ $_halaman->layout->shortname }}" data-slug="{{ $_halaman->url }}" data-attr="{{ $_halaman->title }}" @if(($_halaman->layout->shortname.$_halaman->url) === ($data->target_url.$data->target_slug)) selected @endif>{{ $_halaman->url }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-4">
						<label for="target_url" class="small">Target URL</label>
					</div>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" name="target_url" id="target_url" title="Target URL" placeholder="Target URL" class="form-control bg-white @error('target_url') is-invalid @enderror" maxlength="64" value="{{ $data->target_url }}" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-4">
						<label for="target_slug" class="small">Target Slug</label>
					</div>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" name="target_slug" id="target_slug" title="Target Slug" placeholder="Target Slug" class="form-control bg-white @error('target_slug') is-invalid @enderror" maxlength="255" value="{{ $data->target_slug }}" />
							<div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-4">
						<label for="caption" class="small">Caption</label>
					</div>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" name="caption" id="caption" title="Menu Caption" placeholder="Menu Caption" class="form-control bg-white @error('caption') is-invalid @enderror" value="{{ $data->caption }}" required maxlength="255" />
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
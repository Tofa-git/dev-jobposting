<script src="https://cdn.tiny.cloud/1/1vczo5m4ukbkojaszcn9l0alulcxmby2hfp9gx83hm8qgq3y/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-auto ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<form action="{{ route('landing-page.update-widget', $data->id) }}" method="post" class="d-flex flex-fill bg-white" onsubmit="return globalFunction.checkSubmission(this)">
		<div class="p-3 d-flex flex-fill flex-column align-items-stretch">
			@csrf()
			@method('put')
			<div class="d-flex flex-fill flex-column">
				<div class="row flex-shrink-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="sequence">Sequence *)</label>
					</div>
					<div class="col-sm-4">
						<input type="number" class="auto_focus form-control bg-white w-100" id="sequence" name="sequence" value="{{ $data->sequence }}" />
					</div>
				</div>
				<div class="row mt-2 flex-shrink-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="judul">Judul *)</label>
					</div>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="text" name="judul" id="judul" title="Judul Widget" placeholder="Judul Widget" class="form-control bg-white border-grey @error('judul') is-invalid @enderror" required autofocus maxlength="64" value="{{ $data->judul }}" />
							<div class="p-2 bg-secondary d-flex rounded-end-2" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
								<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2 flex-shrink-1">
					<div class="col-sm-3">
						<label class="small fw-bold" for="target">Target Widget*)</label>
					</div>
					<div class="col-sm-9">
						<div class="input-group">
							<select id="target" name="target" class="form-select">
								<option value="0" selected>Pilih Target Widget</option>
								@foreach($target_widget as $_target_widget)
									<option value="{{ $_target_widget->id }}" @if((int)$_target_widget->id === (int)$data->id_widget) selected @endif>{{ $_target_widget->target }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="d-flex flex-fill flex-column align-items-stretch mt-1">
					<div class="col-sm-12 flex-fill">
						<label class="small fw-bold" for="halaman">Custom Halaman Widget</label>
						<textarea name="bodyEditor" id="bodyEditor">{!! $data->content !!}</textarea>
					</div>
				</div>
			</div>
			<hr />
			<div class="d-flex px-3 justify-content-end">
				<button type="submit" class="d-flex btn btn-primary bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Update</span>
				</button>
				<a href="{{ url()->previous() }}" role="button" class="btn btn-danger bg-gradient">Kembali</a>
			</div>
		</div>
	</form>
</div>

<script type="module">
	tinymce.init({
		selector: '#bodyEditor',
		menubar: false,
		statusbar: false,
		height: '95%',
		plugins: 'anchor autolink charmap code emoticons image link lists media searchreplace table visualblocks wordcount',
		toolbar: 'code | undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
	});
</script>
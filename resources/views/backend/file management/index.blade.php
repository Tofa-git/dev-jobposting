<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-auto ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<div class="flex-shrink-1">
		<div class="d-flex border-bottom">
			<div class="d-flex flex-grow-1 p-2">
				<form class="d-flex flex-grow-1">
					<input type="hidden" name="refid" value="{{ @$_REQUEST['refid'] }}" />
					<select name="total" class="form-select small bg-white border-grey" style="width: 125px">
						<option value="15" @if((int)$total === 15) selected @endif>15 Baris</option>
						<option value="25" @if((int)$total === 25) selected @endif>25 Baris</option>
						<option value="50" @if((int)$total === 50) selected @endif>50 Baris</option>
					</select>
					<div class="flex-grow-1 input-group ms-2 d-none d-sm-flex">
						<input name="q" type="text" class="form-control bg-white border-grey" value="{{ @$_REQUEST['q'] }}" placeholder="Descriptions">
						<button class="btn btn-outline-primary border-grey" type="submit" title="Go Search" style="padding: 2px 5px"><i class="material-icons-outlined fs-5 px-1" style="vertical-align: middle;">search</i></button>
						<a class="btn btn-outline-secondary border-grey d-flex align-items-center" id="filter_button" role="button" title="Search options" style="padding: 2px 5px" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample"><i class="material-icons-outlined fs-5 px-1" style="vertical-align: middle;">filter_alt</i></a>
					</div>
				</form>
			</div>
			<div class="p-2 d-flex">
				<button onclick="event.preventDefault(); globalFunction.loadMediumContent(this)" data-attr="{{ route('file-management.create', ['refid'=>@$_REQUEST['refid']]) }}" class="p-1 px-2 d-flex align-items-center btn btn-warning bg-gradient p-0">
					<i class="material-icons-outlined align-middle align-self-center">add</i>
					<div class="spinner-border spinner-border-sm visually-hidden m-spinner-small m-1" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Tambah</span>
				</button>
			</div>
		</div>
	</div>
	<div class="d-flex flex-fill flex-column p-0 px-3" style="overflow-x: auto!important;">
		<table class="table table-striped table-hover w-100" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="text-nowrap">
					<th width="30px">No</th>
					<th width="150px">Thumbnail</th>
					<th>File Description</th>
					<th width="30px">Date Modified</th>
					<th width="200px">Type</th>
					<th width="50px">Size</th>
					<th width="50px">Status</th>
					<th width="50px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if($data->isEmpty())
					<tr>
						<td align="center">*</td>
						<td colspan="7">Tidak ada data</td>
					</tr>
				@else
					@php $_i=$data->firstItem(); @endphp
					@foreach($data as $_data)
						<tr @if($_i % 2===0) class="bg-light" @else class="bg-white" @endif valign="top">
							<td align="center">{{ $_i }}</td>
							<td align="center">
								@if($_data->type==='pictures')
									<img class="img-fluid" src="{{ \App\Models\data_file::getThumbnailImage($_data->filename) }}" style="width: 150px; height: auto" />
								@else
									@if($_data->extension === 'PDF')
										<img class="img-fluid" src="{{ asset('assets/images/icons/pdf.png') }}" style="width: 50px; height: auto" />
									@elseif($_data->extension === 'DOCX' || $_data->extension === 'DOC')
										<img class="img-fluid" src="{{ asset('assets/images/icons/word.png') }}" style="width: 50px; height: auto" />
									@elseif($_data->extension === 'XLSX' || $_data->extension === 'XLS')
										<img class="img-fluid" src="{{ asset('assets/images/icons/excel.png') }}" style="width: 50px; height: auto" />
									@endif
								@endif
							</td>
							<td style="min-width: 250px">
								{{ $_data->description }}
							</td>
							<td class="text-nowrap">{{ $_data->updated_at }}</td>
							<td class="text-nowrap">{{ $_data->extension.' Files' }}</td>
							<td class="text-nowrap" align="right">{{ \App\Helpers\general::convertFileSize($_data->size) }}</td>
							<td>
								@if(\Auth::user()->hasPermission('File Management', 'suspend'))
									@if($_data->status==='0')
										<a href="{{ route('file-management.status', $_data->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">ACTIVE</a>
									@elseif($_data->status==='1')
										<a href="{{ route('file-management.status', $_data->id) }}" role="button" class="btn btn-sm btn-warning m-0 p-0 ps-2 pe-2" title="Click for activate">SUSPEND</a>
									@elseif($_data->status==='3')
										<a href="{{ route('file-management.status', $_data->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
									@endif
								@endif
							</td>
							<td class="text-nowrap">
								<button id="btnCopyUrlImage" title="Copy image URL" data-copy="{{ \App\Models\data_file::createPublicParam($_data->filename) }}" class="btn btn-outline-primary btn-sm p-0 px-2"><i class="material-icons-outlined p-1 d-flex fs-6">perm_media</i></button>
								@if(is_null($_data->deleted_at))
									@if(\Auth::user()->hasPermission('File Management', 'update'))
										<a onclick="event.preventDefault(); globalFunction.loadSmallContent(this)" data-attr="{{ route('file-management.edit', $_data->id) }}" class="btn btn-outline-primary btn-sm p-0 px-2 ms-1" title="Edit" role="button"><i class="material-icons-outlined p-1 d-flex fs-6">create</i></a>
									@endif
									@if(\Auth::user()->hasPermission('File Management', 'delete'))
										<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('file-management.destroy', $_data) }}" class="d-inline">
											@csrf()
											@method('delete')
											<button type="submit" class="btn btn-outline-danger btn-sm ms-1 p-0 px-2" title="Delete" role="button">
												<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
											</button>
										</form>
									@endif
								@else
									<a onclick="return confirm('Are you sure want to restore this record?')" href="{{ route('file-management.restore', $_data) }}" class="btn btn-outline-outline-danger btn-sm p-0 px-2" title="Restore" role="button"><i class="material-icons-outlined p-1 d-flex fs-6">restore_page</i></a>
								@endif
							</td>
						</tr>
						@php $_i++; @endphp
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
	<div class="flex-shrink-1">
		<div class="p-2 px-3 d-flex flex-row flex-fill border-top bg-light">
			<div class="d-md-inline d-none small flex-grow-1">Menampilkan {{ (int)$data->firstItem().' sampai '.(int)$data->lastItem() }} dari {{ $data->total().' baris' }}</div>
			<div>{!! str_replace('pagination', 'pagination pagination-sm no-gap mb-0 place-right', $data->onEachSide(1)->render('pagination::bootstrap-4')) !!}</div>
		</div>
	</div>
</div>

<input type="hidden" id="textCopy" value="" style="height: 0px!important; border: none; outline: none; box-shadow: none;" />

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="offcanvasExampleLabel">Search Options</h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<form>
			<div class="row">
				<div class="col-sm-4 small">Tampilkan</div>
				<div class="col-sm-8">
					<select class="form-select bg-white" name="total">
						<option value="25" @if((int)$total === 25) selected @endif>25</option>
						<option value="50" @if((int)$total === 50) selected @endif>50</option>
						<option value="100" @if((int)$total === 100) selected @endif>100</option>
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Extension</div>
				<div class="col-sm-8">
					<select class="form-select bg-white" name="extension">
						<option value="All Files" selected>All Files</option>
						@foreach($extension as $_extension)
							<option value="{{ $_extension->extension }}" @if((int)@$_REQUEST['ext']===(int)$_extension->extension) selected @endif>{{ $_extension->extension }} Files</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Deskripsi</div>
				<div class="col-sm-8"><input type="text" class="form-control bg-white" name="q" placeholder="Deskripsi data" value="{{ @$_REQUEST['q'] }}" /></div>
			</div>
			<hr />
			<button class="btn btn-outline-primary">Lakukan Pencarian</button>
		</form>
	</div>
</div>

@include('backend.partials.form', [
	'modal_type'	=> 'modal-md',
	'title'			=> 'File Management'
])

<script type="module">
	$(document).on('click', '#btnCopyUrlImage', function(e){
		e.preventDefault();
		const _url = window.location.origin + '/file-manager/link-url?ref='+$(this).attr('data-copy');
		$.ajax({
			url: _url,
			success: function(result) {
				navigator.clipboard.writeText(result);
				toastr.success("URL Image berhasil dicopy");
			},
			error: function(jqXHR, testStatus, error) {
				alert(error);
			}
		});
	});
</script>

@if(session()->has('modal'))

@section('footer_style_script')
<script type="module">
	$(document).ready(function(){
		$('#alt_key').val("{{ old('alt_key') }}");
		$('#description').val("{{ old('description') }}");
	});
</script>
@endsection

@endif
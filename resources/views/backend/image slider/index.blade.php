<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-hidden ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<div class="flex-shrink-1 bg-light">
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
						<input name="q" type="text" class="form-control bg-white border-grey" value="{{ @$_REQUEST['q'] }}" placeholder="Judul Slider">
						<button class="btn btn-outline-primary border-grey" type="submit" title="Go Search" style="padding: 2px 5px"><i class="material-icons-outlined fs-5 px-1" style="vertical-align: middle;">search</i></button>
						<a class="btn btn-outline-secondary border-grey d-flex align-items-center" id="filter_button" role="button" title="Search options" style="padding: 2px 5px" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample"><i class="material-icons-outlined fs-5 px-1" style="vertical-align: middle;">filter_alt</i></a>
					</div>
				</form>
			</div>
			<div class="p-2 d-flex">
				<a href="{{ route('image-slider.create') }}" class="p-1 px-2 d-flex align-items-center btn btn-warning bg-gradient p-0" role="button">
					<i class="material-icons-outlined align-middle align-self-center">add</i>
					<div class="spinner-border spinner-border-sm d-none m-spinner-small m-1" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
					<span class="px-2 text-nowrap">Tambah</span>
				</a>
			</div>
		</div>
	</div>
	<div class="d-flex flex-fill flex-column p-0 px-3" style="overflow: auto!important;">
		<table class="table table-striped table-hover w-100" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="text-nowrap">
					<th width="30px">No</th>
					<th width="250px">Judul</th>
					<th>Halaman Slider</th>
					<th width="50px">Tanggal Publish</th>
					<th width="50px">Publikasi</th>
					<th width="50px">Status</th>
					<th width="50px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if($data->isEmpty())
					<tr>
						<td align="center">*</td>
						<td colspan="6">Tidak ada data</td>
					</tr>
				@else
					@php $_i=$data->firstItem(); @endphp
					@foreach($data as $_data)
						<tr @if($_i % 2===0) class="bg-light" @else class="bg-white" @endif valign="top">
							<td align="center">{{ $_i }}</td>
							<td class="text-nowrap">{{ $_data->title }}</td>
							<td>
								<div class="content-container d-flex align-items-center bg-midnightBlue p-3" style="width: 400px; height: 150px;">
									<div class="flex-grow-1 text-light d-flex flex-column">{!! $_data->content !!}</div>
									<div class="p-2">
										<img src="{{ \App\Models\data_file::getThumbnailImage($_data->file_background) }}" alt="{{ $_data->title }}" style="width: 150px" />
									</div>
								</div>
							</td>
							<td>{{ $_data->published_at }}</td>
							<td>
								@if(\Auth::user()->hasPermission('Halaman Website', 'suspend'))
									@if((int)$_data->published_by > 0)
										<a href="{{ route('image-slider.publish', $_data->id) }}" role="button" class="btn btn-sm btn-primary bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">PUBLISH</a>
									@else
										<a href="{{ route('image-slider.publish', $_data->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
									@endif
								@endif
							</td>
							<td>
								@if(\Auth::user()->hasPermission('Halaman Website', 'suspend'))
									@if($_data->status==='0')
										<a href="{{ route('image-slider.status', $_data->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">ACTIVE</a>
									@elseif($_data->status==='1')
										<a href="{{ route('image-slider.status', $_data->id) }}" role="button" class="btn btn-sm btn-warning m-0 p-0 ps-2 pe-2" title="Click for activate">SUSPEND</a>
									@elseif($_data->status==='3')
										<a href="{{ route('image-slider.status', $_data->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
									@endif
								@endif
							</td>
							<td class="text-nowrap">
								@if(is_null($_data->deleted_at))
									@if(\Auth::user()->hasPermission('Halaman Website', 'update'))
										<a href="{{ route('image-slider.edit', $_data) }}" class="btn btn-outline-primary btn-sm p-0 px-2" title="Edit" role="button"><i class="material-icons-outlined p-1 d-flex fs-6">create</i></a>
									@endif
									@if(\Auth::user()->hasPermission('Halaman Website', 'delete'))
										<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('image-slider.destroy', $_data) }}" class="d-inline">
											@csrf()
											@method('delete')
											<button type="submit" class="btn btn-outline-danger btn-sm ms-1 p-0 px-2" title="Delete" role="button">
												<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
											</button>
										</form>
									@endif
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
						<option value="15" @if((int)$total === 15) selected @endif>15</option>
						<option value="25" @if((int)$total === 25) selected @endif>25</option>
						<option value="50" @if((int)$total === 50) selected @endif>50</option>
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Judul Slider</div>
				<div class="col-sm-8"><input type="text" class="form-control bg-white" name="q" placeholder="Judul Slider" value="{{ @$_REQUEST['q'] }}" /></div>
			</div>
			<hr />
			<button class="btn btn-primary bg-gradient">Lakukan Pencarian</button>
		</form>
	</div>
</div>

<style type="text/css">
	.content-container > div > h1{
		font-size: 0.8em!important;
	}
	.content-container > div > p{
		font-size: 0.4em!important;
	}
</style>
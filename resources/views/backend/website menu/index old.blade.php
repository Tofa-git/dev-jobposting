<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-hidden ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<div class="flex-shrink-1 bg-light">
		<div class="d-flex border-bottom">
			<div class="d-flex flex-grow-1 p-2">
				<form class="d-flex flex-grow-1">
					<select name="total" class="form-select small bg-white border-grey" style="width: 125px">
						<option value="15" @if((int)$total === 15) selected @endif>15 Baris</option>
						<option value="25" @if((int)$total === 25) selected @endif>25 Baris</option>
						<option value="50" @if((int)$total === 50) selected @endif>50 Baris</option>
					</select>
					<div class="flex-grow-1 input-group ms-2 d-none d-sm-flex">
						<input name="q" type="text" class="form-control bg-white border-grey" value="{{ @$_REQUEST['q'] }}" placeholder="Descriptions">
						<button class="btn btn-outline-primary border-grey bg-gradient d-flex align-items-center" type="submit" title="Go Search" style="padding: 2px 5px"><i class="material-icons-outlined fs-5 px-1">search</i></button>
					</div>
				</form>
			</div>
			<div class="p-2 d-flex">
				<button onclick="event.preventDefault(); globalFunction.loadContent(this)" data-attr="{{ route('website-menu.create') }}" class="p-1 px-2 d-flex align-items-center btn btn-warning bg-gradient p-0">
					<i class="material-icons-outlined align-middle align-self-center">add</i>
					<div class="spinner-border spinner-border-sm visually-hidden m-spinner-small m-1" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Tambah</span>
				</button>
			</div>
		</div>
	</div>
	<div class="flex-fill flex-column p-0 px-3" style="overflow-x: auto!important; border: 3px solid black;">
		<table class="table table-striped table-hover w-100" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="text-nowrap">
					<th width="50px">No</th>
					<th width="125px">Parent</th>
					<th width="50px">Icon</th>
					<th width="175px">Caption</th>
					<th>Target</th>
					<th width="50px">Published At</th>
					<th width="50px">Publish</th>
					<th width="50px">Status</th>
					<th width="50px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if($data->isEmpty())
					<tr>
						<td align="center">*</td>
						<td colspan="8">Tidak ada data</td>
					</tr>
				@else
					@php $_i=1; @endphp
					@foreach($data as $_data)
						<tr @if($_i % 2===0) class="bg-light" @else class="bg-white" @endif valign="top">
							<td align="center">{{ $_i }}</td>
							<td>{{ \App\Models\frontend_menu::parentCaption($_data->refid) ?? '-' }}</td>
							<td align="center">{{ $_data->icon ?? '-' }}</td>
							<td>{{ $_data->caption ?? '-' }}</td>
							<td>{{ $_data->target_url.$_data->target_slug }}</td>
							<td class="text-nowrap">{{ $_data->published_at ?? '-' }}</td>
							<td>
								@if(\Auth::user()->hasPermission('Website Menu', 'suspend'))
									@if($_data->published_by > 0)
										<a href="{{ route('website-menu.publish', $_data->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">PUBLISHED</a>
									@else
										<a href="{{ route('website-menu.publish', $_data->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
									@endif
								@endif
							</td>
							<td>
								@if(\Auth::user()->hasPermission('Website Menu', 'suspend'))
									@if($_data->status==='0')
										<a href="{{ route('website-menu.status', $_data->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">ACTIVE</a>
									@elseif($_data->status==='1')
										<a href="{{ route('website-menu.status', $_data->id) }}" role="button" class="btn btn-sm btn-warning m-0 p-0 ps-2 pe-2" title="Click for activate">SUSPEND</a>
									@elseif($_data->status==='3')
										<a href="{{ route('website-menu.status', $_data->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
									@endif
								@endif
							</td>
							<td class="text-nowrap">
								@if(is_null($_data->deleted_at))
									@if(\Auth::user()->hasPermission('Website Menu', 'update'))
										<button onclick="event.preventDefault(); globalFunction.loadContent(this)" data-attr="{{ route('website-menu.edit', $_data) }}" class="btn btn-sm btn-outline-primary p-0 px-2 d-inline-flex align-items-center" title="Edit">
											<i class="material-icons-outlined p-1 d-flex fs-6">create</i>
											<div class="spinner-border spinner-border-sm visually-hidden m-spinner-small m-1" role="status">
												<span class="visually-hidden">Loading...</span>
											</div>
										</button>
									@endif
									@if(\Auth::user()->hasPermission('Website Menu', 'delete'))
										<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('website-menu.destroy', $_data) }}" class="d-inline">
											@csrf()
											@method('delete')
											<button type="submit" class="btn btn-outline-danger btn-sm ms-1 p-0 px-2" title="Delete" role="button">
												<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
											</button>
										</form>
									@endif
								@else
									<a onclick="return confirm('Are you sure want to restore this record?')" href="{{ route('website-menu.restore', $_data) }}" class="btn btn-outline-outline-danger btn-sm p-0 px-2" title="Restore" role="button"><i class="material-icons-outlined p-1 d-flex fs-6">restore_page</i></a>
								@endif
							</td>
						</tr>
						@php $_i++; @endphp
						@if($_data->jml_sub > 0)
@php
	$sub_menu = \App\Models\frontend_menu::getMenu($_data->id);
@endphp
							@foreach($sub_menu as $_sub_menu)
								<tr @if($_i % 2===0) class="bg-light" @else class="bg-white" @endif valign="top">
									<td align="center">{{ $_i }}</td>
									<td>{{ \App\Models\frontend_menu::parentCaption($_sub_menu->refid) ?? '-' }}</td>
									<td align="center">{{ $_sub_menu->icon ?? '-' }}</td>
									<td>{{ $_sub_menu->caption ?? '-' }}</td>
									<td>{{ $_sub_menu->target_url.$_sub_menu->target_slug }}</td>
									<td class="text-nowrap">{{ $_sub_menu->published_at ?? '-' }}</td>
									<td>
										@if(\Auth::user()->hasPermission('Website Menu', 'suspend'))
											@if($_sub_menu->published_by > 0)
												<a href="{{ route('website-menu.publish', $_sub_menu->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">PUBLISHED</a>
											@else
												<a href="{{ route('website-menu.publish', $_sub_menu->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
											@endif
										@endif
									</td>
									<td>
										@if(\Auth::user()->hasPermission('Website Menu', 'suspend'))
											@if($_sub_menu->status==='0')
												<a href="{{ route('website-menu.status', $_sub_menu->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">ACTIVE</a>
											@elseif($_sub_menu->status==='1')
												<a href="{{ route('website-menu.status', $_sub_menu->id) }}" role="button" class="btn btn-sm btn-warning m-0 p-0 ps-2 pe-2" title="Click for activate">SUSPEND</a>
											@elseif($_sub_menu->status==='3')
												<a href="{{ route('website-menu.status', $_sub_menu->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
											@endif
										@endif
									</td>
									<td class="text-nowrap">
										@if(is_null($_sub_menu->deleted_at))
											@if(\Auth::user()->hasPermission('Website Menu', 'update'))
												<button onclick="event.preventDefault(); globalFunction.loadContent(this)" data-attr="{{ route('website-menu.edit', $_sub_menu) }}" class="btn btn-sm btn-outline-primary p-0 px-2 d-inline-flex align-items-center" title="Edit">
													<i class="material-icons-outlined p-1 d-flex fs-6">create</i>
													<div class="spinner-border spinner-border-sm visually-hidden m-spinner-small m-1" role="status">
														<span class="visually-hidden">Loading...</span>
													</div>
												</button>
											@endif
											@if(\Auth::user()->hasPermission('Website Menu', 'delete'))
												<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('website-menu.destroy', $_sub_menu) }}" class="d-inline">
													@csrf()
													@method('delete')
													<button type="submit" class="btn btn-outline-danger btn-sm ms-1 p-0 px-2" title="Delete" role="button">
														<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
													</button>
												</form>
											@endif
										@else
											<a onclick="return confirm('Are you sure want to restore this record?')" href="{{ route('website-menu.restore', $_sub_menu) }}" class="btn btn-outline-outline-danger btn-sm p-0 px-2" title="Restore" role="button"><i class="material-icons-outlined p-1 d-flex fs-6">restore_page</i></a>
										@endif
									</td>
								</tr>
							@php $_i++; @endphp
							@endforeach
						@endif
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
	<div class="flex-shrink-1">
		<div class="p-2 px-3 d-flex flex-row flex-fill border-top bg-light">
			<div class="d-md-inline d-none small flex-grow-1">Menampilkan 1 sampai {{ (int)$data->count() }} dari {{ $data->count() }} baris</div>
		</div>
	</div>
</div>

@include('backend.partials.form', [
	'modal_type'	=> 'modal-lg',
	'title'			=> $title
])

<script type="module">
	$(document).on('change', '#url_halaman', function(){
		$('#target_url').val($(this).find(':selected').val());
		$('#target_slug').val($(this).find(':selected').attr('data-slug'));
		$('#caption').val($(this).find(':selected').attr('data-attr'));
	});
</script>

@if(session()->has('modal'))

@section('footer_style_script')
<script type="module">
	$(document).ready(function(){
		$('#refid').val("{{ old('refid') }}");
		$('#sequence').val("{{ old('sequence') }}");
		$('#icon').val("{{ old('icon') }}");
		$('#url_halaman').val("{{ old('url_halaman') }}");
		$('#caption').val("{{ old('caption') }}");
	});
</script>
@endsection

@endif
<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-auto ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<div class="flex-shrink-1 bg-light p-2 pt-3">
		<div class="border position-relative rounded-3 p-2">
			<div class="bg-light position-absolute" style="margin-top: -20px"><span class="lh-sm small px-2"> Preview Menu</span></div>
			<div class="d-flex flex-column bg-midnightBlue rounded-3 mt-2">
				<nav class="navbar navbar-expand-xl navbar-dark m-0 p-0 shadow-sm">
					<div class="container">
						<a href="/" class="navbar-brand bg-teal-hover d-flex align-self-center px-2">
							<img src="@if(!is_null($info->icon_logo)) {{ asset('assets/upload/pictures/320x480/'.$info->icon_logo) }} @else {{ asset('assets/images/logo.png') }} @endif" style="width: 40px; height: auto" />
							<div class="d-flex flex-column align-self-center text-light">
								<span class="fs-5 ms-1">{{ @$info->icon_text_2 ?? config('app.name', 'Laravel') }}</span>
							</div>
						</a>
						<button class="btn btn-sm d-xl-none d-block" data-bs-toggle="offcanvas" data-bs-target="#prevMobileMenu" aria-controls="prevMobileMenu">
							<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
						</button>
						<div class="offcanvas offcanvas-end" tabindex="-1" id="prevMobileMenu" aria-labelledby="offcanvasNavbarLabel">
						</div>
						

						<div class="collapse navbar-collapse" id="menu-website">
							<ul class="navbar-nav ms-auto text-nowrap">
								@foreach($data as $_data)
									@if($_data->published_by > 0)
										@if($_data->jml_sub > 0)
@php
	$_sub_menu = \App\Models\frontend_menu::whereRaw('status="0" And refid='.$_data->id.' And published_by > 0 And Not IsNull(published_at)')
		-> groupByRaw('id')
		-> get();
@endphp
											<li class="nav-item dropdown bg-darken-hover">
												<a class="nav-link dropdown-toggle text-nowrap mx-2" href="#" role="button" data-bs-toggle="dropdown">{{ $_data->caption }}</a>
												<ul class="dropdown-menu shadow-sm rounded-0">
													@foreach($_sub_menu as $sub_menu)
														<li class="bg-teal-hover"><a class="dropdown-item" href="#">{{ $sub_menu->caption }}</a></li>
													@endforeach
												</ul>
											</li>
										@else
											<li class="nav-item bg-darken-hover">
												<a class="nav-link text-nowrap mx-2" href="#">{{ $_data->caption }}</a>
											</li>
										@endif
									@endif
								@endforeach
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
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
					<div class="spinner-border spinner-border-sm d-none m-spinner-small m-1" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Tambah</span>
				</button>
			</div>
		</div>
	</div>
	<div class="flex-fill flex-column p-0 px-3" style="overflow-x: auto!important;">
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
										<button onclick="event.preventDefault(); globalFunction.loadContent(this)" data-attr="{{ route('website-menu.edit', $_data) }}" class="d-inline-flex btn btn-outline-primary btn-sm p-0 px-2" title="Edit">
											<i class="material-icons-outlined p-1 d-flex fs-6">create</i>
											<div class="spinner-border spinner-border-sm m-spinner-small m-1 d-none" role="status">
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
													<div class="spinner-border spinner-border-sm d-none m-spinner-small m-1" role="status">
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
<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-auto ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<div class="flex-shrink-1">
		<div class="d-flex border-bottom">
			<div class="d-flex flex-grow-1 p-2">
				<form class="d-flex flex-row flex-fill pe-2">
					<input type="hidden" name="method" value="{{ @$_REQUEST['method'] }}" />
					<input type="hidden" name="platform" value="{{ @$_REQUEST['platform'] }}" />
					<input type="hidden" name="browser" value="{{ @$_REQUEST['browser'] }}" />
					<select name="total" class="form-select small bg-white rounded-0" style="width: 125px">
						<option value="15" @if((int)$total === 15) selected @endif>15 Baris</option>
						<option value="25" @if((int)$total === 25) selected @endif>25 Baris</option>
						<option value="50" @if((int)$total === 50) selected @endif>50 Baris</option>
					</select>
					<div class="flex-grow-1 input-group ms-2 d-flex">
						<input name="q" type="text" class="form-control bg-white rounded-0" value="{{ @$_REQUEST['q'] }}" placeholder="Descriptions">
						<div class="input-group-append">
							<div class="btn-group h-100">
								<button class="btn btn-outline-primary rounded-0" type="submit" title="Go Search" style="padding: 2px 5px"><i class="material-icons-outlined" style="vertical-align: middle;">search</i></button>
								<a class="btn btn-outline-secondary rounded-0 d-flex align-items-center" id="filter_button" role="button" title="Search options" style="padding: 2px 5px" data-bs-toggle="offcanvas" href="#offcanvasExample" aria-controls="offcanvasExample"><i class="material-icons-outlined" style="vertical-align: middle;">filter_alt</i></a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="d-flex flex-fill flex-column p-0 px-3" style="overflow-x: auto!important;">
		<table class="table table-striped table-hover w-100" cellpadding="0" cellspacing="0">
			<thead>
				<tr class="text-nowrap">
					<th width="30px">No</th>
					<th width="30px">Datetime</th>
					<th width="30px">User Account</th>
					<th>Descriptions</th>
					<th width="30px">Method</th>
					<th width="30px">IP</th>
					<th width="30px">Platform</th>
					<th width="30px">Browser</th>
					<th width="30px">Action</th>
				</tr>
			</thead>
			<tbody>
				@if($data->isEmpty())
					<tr class="bg-white">
						<td align="center">*</td>
						<td colspan="8">Data tidak ditemukan</td>
					</tr>
				@else
					@php $_i=$data->firstItem(); @endphp
					@foreach($data as $_data)
						<tr valign="top" @if($_i % 2===0) class="bg-light" @else class="bg-white" @endif>
							<td align="center">{{ $_i }}.</td>
							<td align="center" class="text-nowrap">{{ $_data->created_at }}</td>
							<td class="text-nowrap">{{ $_data->userAccount->email ?? '[ANONYMOUS]' }}</td>
							<td style="min-width: 200px; white-space: normal;">
								{{ $_data->title }}
								<div class="text-primary">{{ $_data->description }}</div>
							</td>
							<td>{{ $_data->method }}</td>
							<td align="center">{{ $_data->ip4 }}</td>
							<td>{{ $_data->platform }}</td>
							<td class="text-nowrap">{{ $_data->browser.' '.$_data->browser_version }}</td>
							<td align="center">
								@if(\Auth::user()->hasPermission('Halaman Website', 'delete'))
									<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('log-activities.destroy', $_data) }}" class="d-inline">
										@csrf()
										@method('delete')
										<button type="submit" class="btn btn-outline-danger btn-sm ms-1 p-0 px-2" title="Delete" role="button">
											<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
										</button>
									</form>
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
					<select class="form-select rounded-0 bg-white" name="total" id="total">
						<option value="25" @if((int)$total === 25) selected @endif>25</option>
						<option value="50" @if((int)$total === 50) selected @endif>50</option>
						<option value="100" @if((int)$total === 100) selected @endif>100</option>
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Platform</div>
				<div class="col-sm-8">
					<select class="rounded-0 bg-white form-select" name="platform" id="platform">
						<option selected disabled>Seluruh Platform</option>
						@foreach($platform as $_platform)
							<option value="{{ $_platform->platform }}" @if(@$_REQUEST['platform'] === $_platform->platform) selected @endif>{{ strtoupper($_platform->platform) }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Browser</div>
				<div class="col-sm-8">
					<select class="rounded-0 bg-white form-select" name="browser" id="browser">
						<option selected disabled>Seluruh Browser</option>
						@foreach($browser as $_browser)
							<option value="{{ $_browser->browser }}" @if(@$_REQUEST['browser'] === $_browser->browser) selected @endif>{{ strtoupper($_browser->browser) }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Method</div>
				<div class="col-sm-8">
					<select class="rounded-0 bg-white form-select" name="method" id="method">
						<option selected disabled>Seluruh Method</option>
						@foreach($method as $_method)
							<option value="{{ $_method->method }}" @if(@$_REQUEST['method'] === $_method->method) selected @endif>{{ strtoupper($_method->method) }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Deskripsi</div>
				<div class="col-sm-8"><input type="text" class="form-control rounded-0 bg-white" name="q" placeholder="Deskripsi data" value="{{ @$_REQUEST['q'] }}" /></div>
			</div>
			<hr />
			<button type="submit" class="btn btn-outline-primary rounded-0">Lakukan Pencarian</button>
		</form>
	</div>
</div>
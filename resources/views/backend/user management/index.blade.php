<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column ms-2 mt-1 shadow-sm bg-white" style="border-bottom-left-radius: 10px; border-top-left-radius: 10px; overflow-y: hidden; overflow-x: auto; border: 1px solid #dddddd">
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
						<input name="q" type="text" class="form-control bg-white border-grey" value="{{ @$_REQUEST['q'] }}" placeholder="Username atau Nama Lengkap">
						<button class="btn btn-outline-primary border-grey bg-gradient d-flex align-items-center" type="submit" title="Go Search" style="padding: 2px 5px"><i class="material-icons-outlined fs-5 px-1">search</i></button>
					</div>
				</form>
			</div>
			<div class="p-2 d-flex">
				<button onclick="event.preventDefault(); globalFunction.loadMediumContent(this)" data-attr="{{ route('user-management.create') }}" class="p-1 px-2 d-flex align-items-center btn btn-warning bg-gradient p-0">
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
				<tr>
					<th width="30px">No</th>
					<th width="30px">Username</th>
					<th>Nama Lengkap</th>
					<th width="30px" class="text-nowrap">Jenis Account</th>
					<th width="30px">Verifikasi</th>
					<th width="30px">Status</th>
					<th width="30px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if($data->isEmpty())
					<tr class="bg-white">
						<td align="center">*</td>
						<td colspan="6">Data is empty</td>
					</tr>
				@else
					@php $_i=$data->firstItem(); @endphp
					@foreach($data as $_data)
						<tr @if($_i % 2===0) class="bg-light" @else class="bg-white" @endif>
							<td align="center">{{ $_i }}</td>
							<td class="text-nowrap">{{ $_data->email }}</td>
							<td>{{ $_data->name }}</td>
							<td>{{ $_data->userRole->description }}</td>
							<td>
								@if(\Auth::user()->hasPermission('User Management', 'suspend'))
									@if(is_null($_data->email_verified_at))
										<a href="{{ route('user-management.verify', $_data->id) }}" onclick="return confirm('Are you sure want to verify this account?')" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2">WAITING</a>
									@else
										<a href="#" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Activated at {{ $_data->email_verified_at }}">ACTIVATED</a>
									@endif
								@endif
							</td>
							<td align="center">
								@if(\Auth::user()->hasPermission('User Management', 'suspend'))
									@if(!is_null($_data->deleted_at))
										<a href="{{ route('user-management.status', $_data->id) }}" role="button" class="btn btn-sm btn-danger bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">DELETED</a>
									@else
										@if($_data->status==='0')
											<a href="{{ route('user-management.status', $_data->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">ACTIVE</a>
										@elseif($_data->status==='1')
											<a href="{{ route('user-management.status', $_data->id) }}" role="button" class="btn btn-sm btn-warning m-0 p-0 ps-2 pe-2" title="Click for activate">SUSPEND</a>
										@elseif($_data->status==='3')
											<a href="{{ route('user-management.status', $_data->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
										@endif
									@endif
								@endif
							</td>
							<td align="center text-nowrap" style="white-space: nowrap;">
								@if(\Auth::user()->hasPermission('User Management', 'update'))
									<button onclick="event.preventDefault(); globalFunction.loadLargeContent(this)" data-attr="{{ route('user-role.edit', $_data->id) }}" class="btn btn-sm btn-outline-primary ms-1 p-0 px-2 d-inline-flex align-items-center" title="Edit">
										<i class="material-icons-outlined p-1 d-flex fs-6">menu</i>
										<div class="spinner-border spinner-border-sm visually-hidden m-spinner-small m-1" role="status">
											<span class="visually-hidden">Loading...</span>
										</div>
									</button>
									<form method="post" class="d-inline-block" action="{{route('user-management.reset-password', $_data->id)}}" onsubmit="return confirm('Anda yakin ingin mereset password user?')">
										@csrf
										@method('put')
										<button type="submit" class="btn btn-sm btn-outline-danger p-0 px-2 ms-1" title="Reset password">
											<i class="fs-6 p-1 d-flex material-icons-outlined">lock_open</i>
										</button>
									</form>
									<button onclick="event.preventDefault(); globalFunction.loadMediumContent(this)" data-attr="{{ route('user-management.edit', $_data) }}" class="btn btn-sm btn-outline-primary ms-1 p-0 px-2 d-inline-flex align-items-center" title="Edit">
										<i class="material-icons-outlined p-1 d-flex fs-6">create</i>
										<div class="spinner-border spinner-border-sm visually-hidden m-spinner-small m-1" role="status">
											<span class="visually-hidden">Loading...</span>
										</div>
									</button>
								@endif
								@if(\Auth::user()->hasPermission('User Management', 'delete'))
									<form method="post" class="d-inline-block" action="{{route('user-management.destroy', $_data->id)}}" onsubmit="return confirm('Anda yakin ingin menghapus user account?')">
										@method('delete')
										@csrf
										<button type="submit" class="btn btn-sm btn-outline-danger p-0 px-2 ms-1" title="Hapus">
											<i class="fs-6 p-1 d-flex material-icons-outlined">clear</i>
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
					<select class="form-select rounded-0 bg-white" name="total">
						<option value="25" @if((int)$total === 25) selected @endif>25</option>
						<option value="50" @if((int)$total === 50) selected @endif>50</option>
						<option value="100" @if((int)$total === 100) selected @endif>100</option>
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Role Account</div>
				<div class="col-sm-8">
					<select class="form-select rounded-0 bg-white" name="role_account">
						<option value="0" @if((int)@$_REQUEST['role_account'] === 0) selected @endif>Seluruh Role Account</option>
						@foreach($role_account as $_role_account)
							<option value="{{ $_role_account->id }}" @if((int)@$_REQUEST['role_account'] === (int)$_role_account->id) selected @endif>{{ $_role_account->description }}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row mt-1">
				<div class="col-sm-4 small">Nama / Username</div>
				<div class="col-sm-8"><input type="text" class="form-control rounded-0 bg-white" name="q" placeholder="Nama atau Username" value="{{ @$_REQUEST['q'] }}" /></div>
			</div>
			<hr />
			<button class="btn btn-outline-primary rounded-0">Lakukan Pencarian</button>
		</form>
	</div>
</div>

@include('backend.partials.form', [
	'modal_type'	=> 'modal-lg',
	'title'			=> $title,
])

@if(session()->has('modal'))

@section('footer_style_script')
<script type="module">
	$(document).ready(function(){
		$('#nama').val("{{ old('nama') }}");
		$('#email').val("{{ old('email') }}");
		$('#jenis_account').val("{{ old('jenis_account') }}");
	});
</script>
@endsection

@endif
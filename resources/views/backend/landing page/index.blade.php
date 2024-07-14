<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
	<span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-row bg-white shadow-sm overflow-hidden ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<div class="flex-shrink-1 m-2 me-1 overflow-auto" style="min-width: 350px">
		<div class="list-group shadow-sm border">
			<div class="list-group-item list-group-item-action active bg-midnightBlue bg-gradient" aria-current="true">
				<strong>AVAILABLE WIDGET</strong>
			</div>
			<div class="p-2 d-flex">
				<button onclick="event.preventDefault(); globalFunction.loadSmallContent(this)" data-attr="{{ route('landing-page.create', ['refid'=>@$_REQUEST['refid']]) }}" class="p-1 px-2 d-flex align-items-center btn btn-warning bg-gradient p-0">
					<i class="material-icons-outlined align-middle align-self-center">add</i>
					<div class="spinner-border spinner-border-sm d-none m-spinner-small m-1" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
					<span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Tambah</span>
				</button>
			</div>
			@php $_i=1; @endphp
			@foreach($data as $_data)
				@if(str_contains($_data->target, 'partials.'))
					<div class="d-flex flex-fill list-group-item list-group-item-action list-group-item-light">
						<div style="width: 30px;">{{ $_data->sequence }}</div>
						<label class="flex-grow-1 form-check-label">{{ $_data->description }}</label>
						@if(\Auth::user()->hasPermission('Landing Page', 'suspend'))
							@if($_data->status==='0')
								<a href="{{ route('landing-page.status', $_data->id) }}" role="button" class="flex-shrink-1 btn btn-sm btn-outline-primary bg-gradient m-0 p-0 ps-2 pe-2" title="Sudah dimasukkan"><i class="material-icons-outlined p-1 d-flex fs-6">check</i></a>
							@elseif($_data->status==='1')
								<a href="{{ route('landing-page.status', $_data->id) }}" role="button" class="flex-shrink-1 btn btn-sm btn-outline-warning bg-gradient m-0 p-0 ps-2 pe-2" title="Pending"><i class="material-icons-outlined p-1 d-flex fs-6">warning</i></a>
							@elseif($_data->status==='3')
								<a href="{{ route('landing-page.status', $_data->id) }}" role="button" class="flex-shrink-1 btn btn-sm btn-outline-secondary bg-gradient m-0 p-0 ps-2 pe-2"><i class="material-icons-outlined p-1 d-flex fs-6" title="Belum dimasukkan">block</i></a>
							@endif
						@endif
						@if(\Auth::user()->hasPermission('Landing Page', 'update'))
							<button onclick="event.preventDefault(); globalFunction.loadContent(this)" data-attr="{{ route('landing-page.edit', $_data) }}" class="flex-shrink-1 btn btn-sm btn-outline-primary bg-gradient m-0 p-0 ps-2 pe-2 ms-1" title="Edit">
								<i class="material-icons-outlined p-1 d-flex fs-6">create</i>
								<div class="spinner-border spinner-border-sm d-none m-spinner-small m-1" role="status">
									<span class="visually-hidden">Loading...</span>
								</div>
							</button>
						@endif
						@if(\Auth::user()->hasPermission('Landing Page', 'delete'))
							<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('landing-page.destroy', $_data) }}" class="d-inline">
								@csrf()
								@method('delete')
								<button type="submit" class="flex-shrink-1 btn btn-sm btn-outline-danger bg-gradient m-0 p-0 ps-2 pe-2 ms-1" title="Delete" role="button">
									<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
								</button>
							</form>
						@endif
					</div>
				@else
				<div class="d-flex flex-fill list-group-item list-group-item-action list-group-item-light">
					<div style="width: 30px;">{{ $_data->sequence }}</div>
					<label class="flex-grow-1 form-check-label">{{ $_data->description }}</label>
					@if(\Auth::user()->hasPermission('Landing Page', 'suspend'))
						@if($_data->status==='0')
							<a href="{{ route('landing-page.status', $_data->id) }}" role="button" class="flex-shrink-1 btn btn-sm btn-outline-primary bg-gradient m-0 p-0 ps-2 pe-2" title="Sudah dimasukkan"><i class="material-icons-outlined p-1 d-flex fs-6">check</i></a>
						@elseif($_data->status==='1')
							<a href="{{ route('landing-page.status', $_data->id) }}" role="button" class="flex-shrink-1 btn btn-sm btn-outline-warning bg-gradient m-0 p-0 ps-2 pe-2" title="Pending"><i class="material-icons-outlined p-1 d-flex fs-6">warning</i></a>
						@elseif($_data->status==='3')
							<a href="{{ route('landing-page.status', $_data->id) }}" role="button" class="flex-shrink-1 btn btn-sm btn-outline-secondary bg-gradient m-0 p-0 ps-2 pe-2"><i class="material-icons-outlined p-1 d-flex fs-6" title="Belum dimasukkan">block</i></a>
						@endif
					@endif
					@if(\Auth::user()->hasPermission('Landing Page', 'update'))
						<button onclick="event.preventDefault(); globalFunction.loadContent(this)" data-attr="{{ route('landing-page.edit', $_data) }}" class="flex-shrink-1 btn btn-sm btn-outline-primary bg-gradient m-0 p-0 ps-2 pe-2 ms-1" title="Edit">
							<i class="material-icons-outlined p-1 d-flex fs-6">create</i>
							<div class="spinner-border spinner-border-sm d-none m-spinner-small m-1" role="status">
								<span class="visually-hidden">Loading...</span>
							</div>
						</button>
					@endif
					@if(\Auth::user()->hasPermission('Landing Page', 'delete'))
						<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('landing-page.destroy', $_data) }}" class="d-inline">
							@csrf()
							@method('delete')
							<button type="submit" class="flex-shrink-1 btn btn-sm btn-outline-danger bg-gradient m-0 p-0 ps-2 pe-2 ms-1" title="Delete" role="button">
								<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
							</button>
						</form>
					@endif
				</div>
				@endif
				@php $_i++; @endphp
			@endforeach
		</div>
	</div>
	<div class="flex-fill flex-column m-2 ms-1 border overflow-auto">
		<div class="w-100 h-100 p-2">
			@foreach($tampilan as $_tampilan)
				<div class="border p-1 mt-1">
					<div class="d-flex flex-fill align-items-center m-1">
						<label class="flex-grow-1 fw-bold">{{ $_tampilan->judul }}</label>
						<div class="flex-shrink-1">
							@if(\Auth::user()->hasPermission('Landing Page', 'suspend'))
								@if((int)$_tampilan->published_by > 0)
									<a href="{{ route('landing-page.publish', $_tampilan->id) }}" role="button" class="btn btn-sm btn-primary bg-gradient m-0 p-0 ps-2 pe-2" title="Click for suspend">PUBLISH</a>
								@else
									<a href="{{ route('landing-page.publish', $_tampilan->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2" title="Click for activate">DRAFT</a>
								@endif
							@endif

							@if(\Auth::user()->hasPermission('Landing Page', 'suspend'))
								@if($_tampilan->status==='0')
									<a href="{{ route('landing-page.status-widget', $_tampilan->id) }}" role="button" class="btn btn-sm btn-info bg-gradient m-0 p-0 ps-2 pe-2 ms-1" title="Click for suspend">ACTIVE</a>
								@elseif($_tampilan->status==='1')
									<a href="{{ route('landing-page.status-widget', $_tampilan->id) }}" role="button" class="btn btn-sm btn-warning m-0 p-0 ps-2 pe-2 ms-1" title="Click for activate">SUSPEND</a>
								@elseif($_tampilan->status==='3')
									<a href="{{ route('landing-page.status-widget', $_tampilan->id) }}" role="button" class="btn btn-sm btn-secondary m-0 p-0 ps-2 pe-2 ms-1" title="Click for activate">DRAFT</a>
								@endif
							@endif

							@if(\Auth::user()->hasPermission('Landing Page', 'update'))
								<button onclick="event.preventDefault(); globalFunction.loadContent(this)" data-attr="{{ route('landing-page.edit', $_data) }}" class="flex-shrink-1 btn btn-sm btn-primary bg-gradient m-0 p-0 ps-2 pe-2 ms-1" title="Edit">
									<i class="material-icons-outlined p-1 d-flex fs-6">create</i>
									<div class="spinner-border spinner-border-sm d-none m-spinner-small m-1" role="status">
									<span class="visually-hidden">Loading...</span>
									</div>
								</button>
							@endif
							@if(\Auth::user()->hasPermission('Landing Page', 'delete'))
								<form method="post" onsubmit="return confirm('Are you sure want to delete this record?')" action="{{ route('landing-page.destroy', $_data) }}" class="d-inline">
									@csrf()
									@method('delete')
									<button type="submit" class="flex-shrink-1 btn btn-sm btn-danger bg-gradient m-0 p-0 ps-2 pe-2 ms-1" title="Delete" role="button">
										<i class="material-icons-outlined p-1 d-flex fs-6">clear</i>
									</button>
								</form>
							@endif
						</div>
					</div>
					<div class="border">
						Data Widget
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>

@include('backend.partials.form', [
	'modal_type'	=> 'modal-md',
	'title'			=> $title
])

@if(session()->has('modal'))

@section('footer_style_script')
<script type="module">
	$(document).ready(function(){
		$('#sequence').val("{{ old('sequence') }}");
		$('#nama').val("{{ old('nama') }}");
		$('#target').val("{{ old('target') }}");
	});
</script>
@endsection

@endif
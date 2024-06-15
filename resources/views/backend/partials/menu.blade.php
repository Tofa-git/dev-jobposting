@php
    $_photo = null;
@endphp
<div class="d-none bg-white d-lg-flex flex-fill flex-column" style="min-width: 300px">
	<div class="p-0 flex-shrink-1" style="background-repeat: no-repeat; background-size: cover; background-position: center; background-image: url({{ asset('assets/images/background.jpg') }});">
			<div class="d-flex align-items-center p-3" style="background-color: rgba(0,0,128,0.75)">
				<div class="avatar" style=" background-image: url({{ \App\Models\data_file::getAvatar(\Auth::user()->picture) }});">
				</div>
				<div class="ps-3" style="overflow: hidden;">
					<div class="fs-6 text-light lh-sm"><strong>{{ \Auth::user()->name }}</strong></div>
					<div class="small text-light lh-sm">{{ \Auth::user()->email }}</div>
				</div>
			</div>
	</div>
	<div class="d-flex flex-fill flex-column overflow-auto">
		<div class="flex-grow-1 p-0">
			@if(\Auth::user()->status === '0')
				{!! \App\Models\backend_menu::renderMenu($activeMenu) !!}
			@endif
		</div>
	</div>
</div>
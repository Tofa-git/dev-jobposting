<div class="offcanvas offcanvas-start d-lg-none d-inline-block d-flex" tabindex="-1" id="mobileAppMenu" aria-labelledby="mobileAppMenuLabel">
	<div class="offcanvas-header flex-shrink-1">
		<a href="/dashboard" class="navbar-brand m-0 px-2 bg-teal-hover d-flex align-self-center">
			<div class="d-flex align-items-center">
				<img src="{{ \App\Models\data_file::getLogo(@$info->logo) }}" class="img-fluid" style="max-height: 40px; height: auto; display: inline-block; vertical-align: middle;" class="img-fluid">
				<div class="ps-2 d-inline-block d-md-none">
					<span style="display: block; font-size: 10pt; line-height: 20px; font-weight: bold;">{{ $info->icon_text_1 }}</span>
					<span style="display: block; font-size: 10pt; color: black; line-height: 16px;">{{ $info->icon_text_2 }}</span>
				</div>
			</div>
		</a>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body d-flex flex-fill p-0">
		<div class="accordion accordion-dark bg-transparent accordion-flush text-light d-flex flex-fill" id="accordionFlushExample">
			<div class="d-flex flex-fill flex-column overflow-hidden">
				<div class="flex-grow-1 p-0 overflow-auto">
					@if(\Auth::user()->status === '0')
						{!! \App\Models\backend_menu::renderMenu($activeMenu) !!}
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
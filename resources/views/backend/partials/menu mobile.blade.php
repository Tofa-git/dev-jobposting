<div class="offcanvas offcanvas-start d-lg-none d-inline-block" tabindex="-1" id="mobileAppMenu" aria-labelledby="mobileAppMenuLabel">
	<div class="offcanvas-header">
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
	<div class="offcanvas-body">
		<div class="accordion accordion-dark bg-transparent accordion-flush text-light" id="accordionFlushExample">
			@foreach($backend_menu as $_backend_menu)
				<div class="accordion-item bg-transparent" style="border: none!important; box-shadow: none;">
					@if($_backend_menu->menu_type===4)
						<li class="nav-item bg-teal-hover">
							<a class="nav-link text-nowrap mx-3" href="{{ $_backend_menu->action }}">{{ $_backend_menu->caption }}</a>
						</li>
					@elseif($_backend_menu->menu_type===5)
					@elseif($_backend_menu->menu_type===6)
						<li class="nav-item">
							<div class="border-top"></div>
						</li>
					@endif
				@endforeach
			</ul>
		</div>
	</div>
</div>
<div class="offcanvas offcanvas-end w-100 bg-midnightBlue text-light" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
	<div class="offcanvas-header m-0 pt-1 ps-3">
		<div class="offcanvas-title d-flex align-self-center" id="mobileMenuLabel">
			<img src="@if(!is_null($info->icon_logo)) {{ asset('assets/upload/pictures/320x480/'.$info->icon_logo) }} @else {{ asset('assets/images/logo.png') }} @endif" class="img-fluid" style="height: 60px" />
			<div class="d-flex flex-column lh-sm align-self-center text-light ms-2">
				<span class="title fw-bold fs-5">{{ @$info->icon_text_2 ?? config('app.name', 'Laravel') }}</span>
			</div>
		</div>
		<button type="button" class="btn btn-sm" data-bs-dismiss="offcanvas">
			<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="32" height="32" viewBox="0,0,256,256">
				<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M9.15625,6.3125l-2.84375,2.84375l15.84375,15.84375l-15.9375,15.96875l2.8125,2.8125l15.96875,-15.9375l15.9375,15.9375l2.84375,-2.84375l-15.9375,-15.9375l15.84375,-15.84375l-2.84375,-2.84375l-15.84375,15.84375z"></path></g></g>
			</svg>
		</button>
	</div>
	<div class="offcanvas-body">
		<div class="accordion accordion-dark bg-transparent accordion-flush text-light" id="accordionFlushExample">
			@foreach($menu as $_menu)
				<div class="accordion-item bg-transparent" style="border: none!important; box-shadow: none;">
				@if($_menu->jml_sub > 0)
					@php
						$_sub_menu = \App\Models\frontend_menu::whereRaw('status="0" And refid='.$_menu->id.' And published_by > 0 And Not IsNull(published_at)')
							-> groupByRaw('id')
							-> get();
					@endphp
					<h5 class="accordion-header bg-transparent" id="flush-heading-{{ $_menu->id }}">
						<button class="fs-5 fw-lighter text-light ps-0 pt-2 pb-2 bg-transparent accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $_menu->id }}" aria-expanded="false" aria-controls="collapse-{{ $_menu->id }}" style="box-shadow: none">
							{{ $_menu->caption }}
						</button>
						<div id="collapse-{{ $_menu->id }}" class="accordion-collapse collapse px-1" aria-labelledby="flush-heading-{{ $_menu->id }}" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body" style="border-left: 1px solid white">
								@foreach($_sub_menu as $sub_menu)
									<a href="{{ $sub_menu->target_slug.$sub_menu->action }}" class="pt-2 pb-2 d-flex small fw-lighter text-decoration-none" style="color: lightBlue">{{ $sub_menu->caption }}</a>
								@endforeach
							</div>
						</div>
					</h5>
				@else
					<div class="pt-2 pb-2 accordion-header bg-transparent">
						<a class="fs-5 d-flex text-decoration-none fw-lighter text-light bg-transparent" role="button" href="{{ $_menu->target_slug.$_menu->action }}">
							{{ $_menu->caption }}
						</a>
					</div>
				@endif
				</div>
			@endforeach
		</div>
	</div>
</div>

<style type="text/css">
	.accordion-button:after {
		background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'><path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/></svg>") !important;
	}
	.accordion-header > a:active, .accordion-header > .accordion-button:active, .accordion-body > a:active{
		color: white!important;
		font-weight: bold!important;
	}
</style>
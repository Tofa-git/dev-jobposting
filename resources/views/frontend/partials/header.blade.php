<nav class="navbar fixed-top navbar-expand-lg navbar-dark m-0 p-0 bg-midnightBlue shadow-sm">
	<div class="container">
		<a href="/" class="navbar-brand bg-teal-hover d-flex align-self-center px-2">
			<img src="@if(!is_null($info->icon_logo)) {{ asset('assets/upload/pictures/320x480/'.$info->icon_logo) }} @else {{ asset('assets/images/logo.png') }} @endif" />
			<div class="d-flex flex-column align-self-center text-light">
				<span class="title">{{ @$info->icon_text_2 ?? config('app.name', 'Laravel') }}</span>
			</div>
		</a>
		<button class="btn btn-sm d-lg-none d-block" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
			<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
		</button>
		<div class="collapse navbar-collapse" id="menu-website">
			<ul class="navbar-nav ms-auto text-nowrap">
				@foreach($menu as $_menu)
					@if($_menu->jml_sub > 0)
						@php
							$_sub_menu = \App\Models\frontend_menu::whereRaw('status="0" And refid='.$_menu->id.' And published_by > 0 And Not IsNull(published_at)')
								-> groupByRaw('id')
								-> get();
						@endphp
						<li class="nav-item dropdown bg-teal-hover">
							<a class="nav-link dropdown-toggle text-nowrap mx-2" href="{{ $_menu->target_url.$_menu->target_slug }}" role="button" data-bs-toggle="dropdown">{{ $_menu->caption }}</a>
							<ul class="dropdown-menu shadow-sm rounded-0">
								@foreach($_sub_menu as $sub_menu)
									<li><a class="dropdown-item" href="{{ $sub_menu->target_url.$sub_menu->target_slug }}">{{ $sub_menu->caption }}</a></li>
								@endforeach
							</ul>
						</li>
					@else
						<li class="nav-item bg-teal-hover">
							<a class="nav-link text-nowrap @if($active===str_replace(' ', '-', strtolower($_menu->caption))) active @endif mx-2" href="{{ $_menu->target_url.$_menu->target_slug }}">{{ $_menu->caption }}</a>
						</li>
					@endif
				@endforeach
			</ul>
		</div>
	</div>
</nav>
@php
	$_photo = null;
@endphp
<div class="flex-shrink-1 bg-midnightBlue">
	<nav class="navbar navbar-expand-md navbar-light m-0">
		<div class="d-flex flex-grow-1 m-0">
			<a class="d-lg-none d-inline-block navbar-brand m-0 px-2 mx-1 bg-teal-hover d-flex text-light" href="#" data-bs-toggle="offcanvas" data-bs-target="#mobileAppMenu" aria-controls="mobileAppMenu">
				<i class="material-icons-outlined align-middle align-self-center">apps</i>
			</a>
			<div class="flex-grow-1 m-0 px-2 d-flex align-self-center">
				<a href="/dashboard" class="navbar-brand m-0 px-2 bg-teal-hover d-flex align-self-center">
					<div class="d-flex align-items-center">
						<img src="{{ \App\Models\data_file::getLogo(@$info->logo) }}" class="img-fluid" style="max-height: 35px; height: auto; display: inline-block; vertical-align: middle;" class="img-fluid">
						<div class="px-2 d-none d-md-block text-light">
							<span style="display: block; font-size: 10pt; line-height: 20px; font-weight: bold;">{{ $info->icon_text_1 }}</span>
							<span style="display: block; font-size: 10pt; line-height: 16px;">{{ $info->icon_text_2 }}</span>
						</div>
					</div>
				</a>
			</div>
			<div class="d-flex flex-grow-1 text-light"></div>
			<div class="d-flex justify-content-end">
				<div class="dropdown h-100 d-flex">
					<a class="navbar-brand m-0 px-2 d-flex align-items-center mx-1 text-light bg-teal-hover" id="dropdownMenu1" data-bs-toggle="dropdown" href="#" aria-expanded="false" role="button">
						<i class="material-icons-outlined align-middle align-self-center">notifications</i>
						<span class="badge bg-teal">0</span>
					</a>
					<div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="dropdownMenu1">
						<h1>Testing</h1>
					</div>
				</div>
				<div class="dropdown h-100 d-flex">
					<a class="navbar-brand m-0 px-2 mx-2 d-flex align-items-center text-light bg-danger-hover" id="dropdownMenu2" data-bs-toggle="dropdown" href="#" aria-expanded="false" role="button">
						<i class="material-icons-outlined align-middle align-self-center">menu</i>
					</a>
					<div class="dropdown-menu dropdown-menu-end rounded-0 shadow p-0" aria-labelledby="dropdownMenu2" style="border: 1px solid #aaaaaa; border-top: 5px solid darkSalmon; border-bottom: 5px solid darkSalmon">
						<div class="d-flex p-2 m-0" style="min-width: 300px">
							<div style="width: 50px; height: 50px; border-radius: 50%; background-color: white; border: 1px solid #dddddd; background-size: cover; background-repeat: no-repeat; background-image: url('{{ \App\Models\data_file::getAvatar(\Auth::user()->picture) }}')"></div>
							<div class="ps-2" style="overflow: hidden;">
								<div style="white-space: nowrap;"><strong>{{ \Auth::user()->name }}</strong></div>
								<div>{{ \Auth::user()->email }}</div>
								<a href="#" class=" mt-2 d-block">Update my profile</a>
								<a href="#" class="d-block">Change password</a>
							</div>
						</div>
						<div class="border-top border-1 p-2">
							<a href="{{ route('logout') }}" role="button" class="btn btn-danger rounded-0" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
</div>
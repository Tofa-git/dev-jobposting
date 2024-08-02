<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RUN8 Management</title>
	<link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Caveat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="{{ asset('assets/css/public.css') }}" rel="stylesheet">
    <style type="text/css">
    	.card-text{
    		font-size: 14pt;
    	}
    </style>
</head>
<body>
	<div class="flex-shrink-1 bg-midnightBlue" style="box-shadow: 0px 3px 5px #aaaaaa; z-index: 5">
		<div class="container">
			<nav class="navbar navbar-expand-md navbar-light m-0">
				<div class="d-flex flex-grow-1 m-0">
					<a class="d-lg-none d-inline-block navbar-brand m-0 px-2 mx-1 bg-light-hover d-flex text-light" href="#" data-bs-toggle="offcanvas" data-bs-target="#mobileAppMenu" aria-controls="mobileAppMenu">
						<i class="material-icons-outlined align-middle align-self-center">apps</i>
					</a>
					<div class="flex-grow-1 m-0 px-2 d-flex align-self-center">
						<a href="/dashboard" class="navbar-brand m-0 px-2 bg-darken-hover d-flex align-self-center">
							<div class="d-flex align-items-center">
								<img src="{{ \App\Models\data_file::getLogo(@$info->logo) }}" class="img-fluid" style="max-height: 35px; height: auto; display: inline-block; vertical-align: middle;" class="img-fluid">
								<div class="px-2 text-light">
									<span style="display: block; font-size: 10pt; line-height: 20px; font-weight: bold;">{{ $info->icon_text_1 }}</span>
									<span style="display: block; font-size: 10pt; line-height: 16px;">{{ $info->icon_text_2 }}</span>
								</div>
							</div>
						</a>
					</div>
					<div class="d-flex flex-grow-1 text-light"></div>
				</div>
			</nav>
		</div>
	</div>
	<main>
		<div class="container">
			<div class="card">
				<div class="card-header">
					Registrasi dan Aktivasi Akun
				</div>
				<div class="card-body">
					<h5 class="card-title">Selamat datang <strong>{{ $check->name }}</strong>,</h5>
					<p class="card-text">Anda telah melakukan registrasi di RUN8 Management dengan username : <strong>{{ $check->email }}</strong> pada <strong>{{ $check->created_at }}</strong>. Silahkan lengkapi data-data di bawah ini untuk menyelesaikan proses.</p>
					<a href="#" class="btn btn-primary">Go somewhere</a>
				</div>
			</div>
		</div>
	</main>
	<div class="mt-5"></div>
	@include('frontend.partials.footer')
</body>
</html>
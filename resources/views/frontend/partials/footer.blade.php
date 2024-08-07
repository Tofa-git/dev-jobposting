<div class="bg-midnightBlue bg-gradient">
	<div class="container">

	<div class="pt-3 pb-3">
		<div class="row p-2">
			<div class="col-sm-4 small lh-sm mt-3">
				<div class="d-flex text-light">
					<i class="material-icons-outlined align-self-start fs-6 p-1" style="max-width: 30px; min-width: 30px">location_on</i>
					<div class="ms-2 flex-grow-1">{{ $info->address }}</div>
				</div>
				<div class="d-flex text-light mt-3">
					<i class="material-icons-outlined fs-6 align-self-start p-1" style="max-width: 30px; min-width: 30px">call</i>
					<div class="ms-2 flex-grow-1 fw-bold">Nomor Telpon/Fax</div>
				</div>
				<div class="d-flex text-light">
					<div style="max-width: 30px; min-width: 30px"></div>
					<div class="ms-2 flex-grow-1">{{ $info->phone ?? '-' }}</div>
				</div>
				<div class="d-flex text-light">
					<div style="max-width: 30px; min-width: 30px"></div>
					<div class="ms-2 flex-grow-1">{{ $info->fax ?? '-' }} (Fax)</div>
				</div>
				<div class="d-flex text-light mt-3">
					<i class="material-icons-outlined fs-6 align-self-start p-1" style="max-width: 30px; min-width: 30px">mail</i>
					<div class="ms-2 flex-grow-1 fw-bold">Surat Elektronik</div>
				</div>
				<div class="d-flex text-light">
					<div style="max-width: 30px; min-width: 30px"></div>
					<div class="ms-2 flex-grow-1"><a href="mailto:{{ $info->email }}" class="text-light text-decoration-none text-hover-underline">{{ $info->email }}</a></div>
				</div>
			</div>
			<div class="col-sm-5 text-light mt-3" style="border-left: 1px solid rgba(255,255,255,0.25)">
				<div class="row">
					<div class="col-12">
						<div class="d-flex text-light">
							<i class="material-icons-outlined fs-6 align-self-start p-1" style="max-width: 30px; min-width: 30px">lan</i>
							<div class="ms-2 flex-grow-1 fw-bold">Sitemap</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="d-flex text-light">
							<div style="max-width: 30px; min-width: 30px"></div>
							<div class="d-flex flex-column ms-2 flex-grow-1">
								<ul class="small">
									<li><a href="/" class="text-light text-decoration-none text-hover-underline">Home</a></li>
									<li><a href="/berita-dan-informasi" class="text-light text-decoration-none text-hover-underline">Berita dan Informasi</a></li>
									<li><a href="/pengumuman" class="text-light text-decoration-none text-hover-underline">Pengumuman</a></li>
									<li><a href="/statistik-diklat" class="text-light text-decoration-none text-hover-underline">Statistik Diklat</a></li>
									<li><a href="/hubungi-bpsdm" class="text-light text-decoration-none text-hover-underline">Hubungi BPSDM</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 text-light mt-3" style="border-left: 1px solid rgba(255,255,255,0.25)">
				<div class="row">
					<div class="col-12">
						<div class="d-flex text-light">
							<i class="material-icons-outlined fs-6 align-self-start p-1" style="max-width: 30px; min-width: 30px">public</i>
							<div class="ms-2 flex-grow-1 fw-bold">Ikuti Kami</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="d-flex text-light">
					<div style="max-width: 30px; min-width: 30px"></div>
					<div class="ms-2 flex-grow-1 d-flex flex-row">
						<a href="#" class="text-decoration-none">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0,0,256,256">
								<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M25,3c-12.13844,0 -22,9.86156 -22,22c0,11.01913 8.12753,20.13835 18.71289,21.72852l1.14844,0.17383v-17.33594h-5.19727v-3.51953h5.19727v-4.67383c0,-2.87808 0.69065,-4.77363 1.83398,-5.96289c1.14334,-1.18926 2.83269,-1.78906 5.18359,-1.78906c1.87981,0 2.61112,0.1139 3.30664,0.19922v2.88086h-2.44727c-1.38858,0 -2.52783,0.77473 -3.11914,1.80664c-0.59131,1.03191 -0.77539,2.264 -0.77539,3.51953v4.01758h6.12305l-0.54492,3.51953h-5.57812v17.36523l1.13477,-0.1543c10.73582,-1.45602 19.02148,-10.64855 19.02148,-21.77539c0,-12.13844 -9.86156,-22 -22,-22zM25,5c11.05756,0 20,8.94244 20,20c0,9.72979 -6.9642,17.7318 -16.15625,19.5332v-12.96875h5.29297l1.16211,-7.51953h-6.45508v-2.01758c0,-1.03747 0.18982,-1.96705 0.50977,-2.52539c0.31994,-0.55834 0.62835,-0.80078 1.38477,-0.80078h4.44727v-6.69141l-0.86719,-0.11719c-0.59979,-0.08116 -1.96916,-0.27148 -4.43945,-0.27148c-2.7031,0 -5.02334,0.73635 -6.625,2.40234c-1.60166,1.66599 -2.39258,4.14669 -2.39258,7.34961v2.67383h-5.19727v7.51953h5.19727v12.9043c-9.04433,-1.91589 -15.86133,-9.84626 -15.86133,-19.4707c0,-11.05756 8.94244,-20 20,-20z"></path></g></g>
							</svg>
						</a>
						<a href="#" class="text-decoration-none ms-3">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0,0,256,256">
								<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M16,3c-7.16752,0 -13,5.83248 -13,13v18c0,7.16752 5.83248,13 13,13h18c7.16752,0 13,-5.83248 13,-13v-18c0,-7.16752 -5.83248,-13 -13,-13zM16,5h18c6.08648,0 11,4.91352 11,11v18c0,6.08648 -4.91352,11 -11,11h-18c-6.08648,0 -11,-4.91352 -11,-11v-18c0,-6.08648 4.91352,-11 11,-11zM37,11c-1.10457,0 -2,0.89543 -2,2c0,1.10457 0.89543,2 2,2c1.10457,0 2,-0.89543 2,-2c0,-1.10457 -0.89543,-2 -2,-2zM25,14c-6.06329,0 -11,4.93671 -11,11c0,6.06329 4.93671,11 11,11c6.06329,0 11,-4.93671 11,-11c0,-6.06329 -4.93671,-11 -11,-11zM25,16c4.98241,0 9,4.01759 9,9c0,4.98241 -4.01759,9 -9,9c-4.98241,0 -9,-4.01759 -9,-9c0,-4.98241 4.01759,-9 9,-9z"></path></g></g>
							</svg>
						</a>
						<a href="#" class="text-decoration-none ms-3">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0,0,256,256">
								<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M5.91992,6l14.66211,21.375l-14.35156,16.625h3.17969l12.57617,-14.57812l10,14.57813h12.01367l-15.31836,-22.33008l13.51758,-15.66992h-3.16992l-11.75391,13.61719l-9.3418,-13.61719zM9.7168,8h7.16406l23.32227,34h-7.16406z"></path></g></g>
							</svg>
						</a>
						<a href="#" class="text-decoration-none ms-3">
							<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0,0,256,256">
								<g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M24.40234,9c-6.60156,0 -12.80078,0.5 -16.10156,1.19922c-2.19922,0.5 -4.10156,2 -4.5,4.30078c-0.39844,2.39844 -0.80078,6 -0.80078,10.5c0,4.5 0.39844,8 0.89844,10.5c0.40234,2.19922 2.30078,3.80078 4.5,4.30078c3.50391,0.69922 9.5,1.19922 16.10156,1.19922c6.60156,0 12.59766,-0.5 16.09766,-1.19922c2.20313,-0.5 4.10156,-2 4.5,-4.30078c0.40234,-2.5 0.90234,-6.09766 1,-10.59766c0,-4.5 -0.5,-8.10156 -1,-10.60156c-0.39844,-2.19922 -2.29687,-3.80078 -4.5,-4.30078c-3.5,-0.5 -9.59766,-1 -16.19531,-1zM24.40234,11c7.19922,0 12.99609,0.59766 15.79688,1.09766c1.5,0.40234 2.69922,1.40234 2.89844,2.70313c0.60156,3.19922 1,6.60156 1,10.10156c-0.09766,4.29688 -0.59766,7.79688 -1,10.29688c-0.29687,1.89844 -2.29687,2.5 -2.89844,2.70313c-3.60156,0.69922 -9.60156,1.19531 -15.60156,1.19531c-6,0 -12.09766,-0.39844 -15.59766,-1.19531c-1.5,-0.40234 -2.69922,-1.40234 -2.89844,-2.70312c-0.80078,-2.80078 -1.10156,-6.5 -1.10156,-10.19922c0,-4.60156 0.40234,-8 0.80078,-10.09766c0.30078,-1.90234 2.39844,-2.50391 2.89844,-2.70312c3.30078,-0.69922 9.40234,-1.19922 15.70313,-1.19922zM19,17v16l14,-8zM21,20.40234l8,4.59766l-8,4.59766z"></path></g></g>
							</svg>
						</a>
					</div>
				</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>
	<div class="bg-dark bg-opacity-50 p-1 text-center">
		<span class="text-light small">{!! $info->copyright !!}</span>
	</div>
</div>
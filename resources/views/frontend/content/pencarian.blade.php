<div class="pb-4" style="margin-top: -300px">
	<div class="row">
		<div class="col-sm-12 text-center d-flex flex-md-row flex-column justify-content-center">
			<a href="#" class="d-flex align-items-center btn btn-lg btn-primary bg-gradient p-0 rounded-3 shadow-sm mx-4 mt-2 border border-1 border-light overflow-hidden" role="button">
				<div class="bg-midnightBlue bg-gradient p-2">
					<svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#ffffff"><path d="M186.67-226.67q58-55 132.43-88.16Q393.53-348 479.93-348t160.9 33.17q74.5 33.16 132.5 88.16v-546.66H186.67v546.66Zm294.66-200.66q58 0 98.34-40.34Q620-508 620-566t-40.33-98.33q-40.34-40.34-98.34-40.34T383-664.33Q342.67-624 342.67-566T383-467.67q40.33 40.34 98.33 40.34ZM186.67-120q-27 0-46.84-19.83Q120-159.67 120-186.67v-586.66q0-27 19.83-46.84Q159.67-840 186.67-840h586.66q27 0 46.84 19.83Q840-800.33 840-773.33v586.66q0 27-19.83 46.84Q800.33-120 773.33-120H186.67ZM250-186.67h460V-196q-50-42.33-108.33-63.83-58.34-21.5-121.67-21.5t-121.67 21.5Q300-238.33 250-196V-186.67ZM481.33-494q-30 0-51-21t-21-51q0-30 21-51t51-21q30 0 51 21t21 51q0 30-21 51t-51 21Zm-1.33-6.33Z"/></svg>
				</div>
				<span class="fs-5 mx-3">Cari Karyawan</span>
			</a>
			<a href="#" class="d-flex align-items-center btn btn-lg btn-primary bg-gradient p-0 rounded3 shadow-sm mx-4 mt-2 border border-1 border-light overflow-hidden" role="button">
				<div class="bg-midnightBlue bg-gradient p-2">
					<svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#ffffff"><path d="M319.33-246.67h321.34v-66.66H319.33v66.66Zm0-166.66h321.34V-480H319.33v66.67ZM226.67-80q-27 0-46.84-19.83Q160-119.67 160-146.67v-666.66q0-27 19.83-46.84Q199.67-880 226.67-880H574l226 226v507.33q0 27-19.83 46.84Q760.33-80 733.33-80H226.67Zm314-542.67v-190.66h-314v666.66h506.66v-476H540.67Zm-314-190.66v190.66-190.66 666.66-666.66Z"/></svg>
				</div>
				<span class="fs-5 mx-3">
					Pasang Loker
				</span>
			</a>
		</div>
	</div>
	<div class="bg-white rounded-4 p-3 px-4 mt-4 border shadow">
		<div class="row">
			<div class="col-md-5 px-3">
				<div class="d-block d-md-none">
					<h1 class="fw-bold">Ayo kamu pasti bisa!</h1>
					<h3>Temukan pekerjaan impian kamu <span class="text-primary fw-bold fs-2" style="font-family: 'Caveat', cursive; font-size: 22pt; font-weight: bold">di sini</span></h3>
				</div>
				<img class="img-fluid w-100" src="{{ asset('assets/images/ayotemukan.png') }}" />
			</div>
			<div class="col-md-7">
					<div class="d-flex flex-column h-100 justify-content-center">
						<div class="d-none d-md-block">
							<h1 class="fw-bold">Ayo kamu pasti bisa!</h1>
							<h3>Temukan pekerjaan impian kamu <span class="text-primary fw-bold fs-2" style="font-family: 'Caveat', cursive; font-size: 22pt; font-weight: bold">di sini</span></h3>
						</div>
						<div class="border border-1 border-secondary bg-light rounded-2 mt-4 p-3">
							<form>
								<div class="row">
									<div class="col-md-4">
										<label for="lokasi">Lokasi Penempatan</label>
									</div>
									<div class="col-md-8">
										<select class="form-select rounded-0 bg-white" name="lokasi" id="lokasi">
											<option value="0" selected>Pilih Lokasi Penempatan</option>
										</select>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-4">
										<label for="bidang">Bidang Pekerjaan</label>
									</div>
									<div class="col-md-8">
										<select class="form-select rounded-0 bg-white" name="bidang" id="bidang">
											<option value="0" selected>Pilih Bidang Pekerjaan</option>
										</select>
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-md-4">
										<label for="level">Level Jabatan</label>
									</div>
									<div class="col-md-8">
										<select class="form-select rounded-0 bg-white" name="level" id="level">
											<option value="0" selected>Pilih Level Jabatan</option>
										</select>
									</div>
								</div>
								<hr />
								<div class="row mt-2">
									<div class="col-md-4">
									</div>
									<div class="col-md-8">
										<button type="submit" class="d-flex float-end align-items-center btn btn-lg btn-primary bg-gradient border border-1 border-light p-0 rounded-3 overflow-hidden shadow">
											<span class="px-3">Cari Pekerjaan</span>
											<div class="bg-midnightBlue bg-gradient p-2">
												<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
											</div>
										</button>
									</div>
								</div>
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.list-berita:hover{
		color: #853266;
		background-color: #eeeeee;
		transition: all 0.5s;
	}
</style>
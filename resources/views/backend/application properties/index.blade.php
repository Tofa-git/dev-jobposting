<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
    <span class="fs-4 fw-lighter">{{ $title }}</span>
</div>

<div class="d-flex flex-fill h-100 shadow-sm overflow-hidden flex-column ms-2 mt-1">
	<div class="d-flex flex-fill flex-column" style="height: calc(100% - 100px);">
        <ul class="nav nav-tabs mt-1" id="myTab" role="tablist" style="z-index: 2">
            <li class="nav-item" role="presentation">
                <button class="nav-link @if(Session::get('tab')===null || Session::get('tab')==='' || Session::get('tab')==='umum') active @endif" id="umum-tab" data-bs-toggle="tab" data-bs-target="#umum" type="button" role="tab" aria-controls="umum" aria-selected="true">Umum</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link @if(Session::get('tab')==='sosmed') active @endif" id="sosmed-tab" data-bs-toggle="tab" data-bs-target="#sosmed" type="button" role="tab" aria-controls="sosmed" aria-selected="false">Media Sosial</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link @if(Session::get('tab')==='setting') active @endif" id="setting-tab" data-bs-toggle="tab" data-bs-target="#setting" type="button" role="tab" aria-controls="setting" aria-selected="false">Setting</button>
            </li>
        </ul>
        <div class="tab-content d-flex flex-fill flex-column shadow-sm bg-white overflow-auto" id="myTabContent" style="border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">

            <div class="tab-pane @if(Session::get('tab')===null || Session::get('tab')==='' || Session::get('tab')==='umum') fade show active @endif h-100 p-3" id="umum" role="tabpanel" aria-labelledby="umum-tab" style="overflow-y: auto;">
                <form method="post" action="{{ route('application-properties.update', $data->id) }}" enctype="multipart/form-data" id="formUmum" onsubmit="return globalFunction.checkSubmission(this)">
                    @csrf()
                    <input type="hidden" name="_method" value="put" />
                    <input type="hidden" name="tab" value="umum" />
                    <div class="row w-100 m-0 p-0">
                        <div class="col-sm-8">
                            <h5 class="fw-bold">Application Logo</h5>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="logo" class="small" style="white-space: normal;">Logo File (Max. 2MB)</label></div>
                                <div class="col-sm-9">
                                    <input type="file" class="w-100 form-control input-text bg-white @error('logo') is-invalid @enderror" name="logo" id="logo" accept=".jpg,.jpeg,.png,.bmp" />
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="title_1" class="small" style="white-space: normal;">Logo Title</label></div>
                                <div class="col-sm-9">
	    							<div class="input-group">
		    							<input type="text" placeholder="Logo Title" name="title_1" id="title_1" maxlength="64" class="auto_focus form-control bg-white @error('description') is-invalid @enderror" value="{{ $data->icon_text_1 }}"  min="1" autofocus />
                                        <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                            <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                        </div>
						    		</div>
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="title_2" class="small" style="white-space: normal;">Logo Descriptions</label></div>
                                <div class="col-sm-9">
				    				<div class="input-group">
					    				<input type="text" name="title_2" id="title_2" placeholder="Logo Description" class="form-control bg-white @error('title_2') is-invalid @enderror" value="{{ $data->icon_text_2 }}" maxlength="64" />
                                        <div onclick="globalFunction.clearValue(event)" class="p-2 bg-secondary rounded-end-2 d-flex" style="cursor: pointer" title="Hapus">
                                            <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                        </div>
    								</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="m-0 p-0 mt-4 ml-3 mr-3">
                                <label class="small">Logo Preview</label>
                                <div class="d-flex align-items-center border p-2">
                                    <img src="{{ \App\Models\data_file::getLogo(@$data->logo) }}" class="img-fluid" style="max-height: 50px; width: auto; display: inline-block; vertical-align: middle;">
                                    <div class="ps-2">
                                        <label style="display: block; font-size: 12pt; line-height: 20px; font-weight: bold;">{{ $data->icon_text_1 }}</label>
                                        <label style="display: block; font-size: 12pt; color: black; line-height: 16px;">{{ $data->icon_text_2 }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 m-0 p-0 mt-4">
                        <div class="col-sm-8">
                            <h5 class="fw-bold">Company Profiles</h5>
                            <div class="row w-100 m-0 p-0">
                                <div class="col-sm-3"><label for="name" class="small fw-bold" style="white-space: normal;">Nama Perusahaan *)</label></div>
                                <div class="col-sm-9">
								    <div class="input-group">
									    <input type="text" name="name" id="name" placeholder="Nama Perusahaan" class="form-control bg-white @error('name') is-invalid @enderror" value="{{ $data->name }}" required maxlength="32" />
    									<div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
	    									<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
		    							</div>
			    					</div>
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="address" class="small" style="white-space: normal;">Address</label></div>
                                <div class="col-sm-9 m-0">
                                    <textarea name="address" id="address" class="form-control bg-white rounded-2" style="height: 100px;">{!! $data->address !!}</textarea>
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="phone" class="small" style="white-space: normal;">No. Telp</label></div>
                                <div class="col-sm-6">
							    	<div class="input-group">
								    	<input type="text" name="phone" id="phone" placeholder="+62-xxx-xxxxxx" class="form-control bg-white @error('phone') is-invalid @enderror" value="{{ $data->phone }}" maxlength="32" />
    									<div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
	    									<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
		    							</div>
			    					</div>
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="mobile" class="small" style="white-space: normal;">Mobile/Whatsapp</label></div>
                                <div class="col-sm-6">
	    							<div class="input-group">
		    							<input type="text" name="mobile" id="mobile" placeholder="+62-xxxx-xxxxxx" class="form-control bg-white @error('mobile') is-invalid @enderror" value="{{ $data->mobile }}" maxlength="32" />
			    						<div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
				    						<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
					    				</div>
						    		</div>
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="fax" class="small" style="white-space: normal;">Fax</label></div>
                                <div class="col-sm-6">
				    				<div class="input-group">
					    				<input type="text" name="fax" id="fax" placeholder="+62-xxx-xxxxxx" class="form-control bg-white @error('fax') is-invalid @enderror" value="{{ $data->fax }}" maxlength="64" />
						    			<div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
							    			<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
								    	</div>
    								</div>
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="email" class="small" style="white-space: normal;">Email</label></div>
                                <div class="col-sm-9">
						    		<div class="input-group">
							    		<input type="email" name="email" id="email" placeholder="alamat@email.com" class="form-control bg-white @error('email') is-invalid @enderror" value="{{ $data->email }}" maxlength="32" title="example@mail.com" autocomplete="email" />
								    	<div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
									    	<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
    									</div>
	    							</div>
                                </div>
                            </div>
                            <div class="row w-100 m-0 p-0 mt-2">
                                <div class="col-sm-3"><label for="website" class="small" style="white-space: normal;">Website</label></div>
                                <div class="col-sm-9">
							    	<div class="input-group">
								    	<input type="text" name="website" id="website" placeholder="https://xxxxxx.xxx" class="form-control bg-white @error('website') is-invalid @enderror" value="{{ $data->website }}" maxlength="64" title="https://mywebsite.com" />
    									<div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
	    									<i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
		    							</div>
			    					</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr class="m-0 p-0 mt-3 mb-3" />
                        <button type="submit" class="d-flex btn btn-primary bg-gradient me-2">
                            <i class="material-icons-outlined align-middle align-self-center">save</i>
                            <span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Update</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="tab-pane @if(Session::get('tab')==='sosmed') fade show active @endif h-100 p-3" id="sosmed" role="tabpanel" aria-labelledby="sosmed-tab" style="overflow-y: auto;">
                <form method="post" action="{{ route('application-properties.update', $data->id) }}" id="formMedsos" onsubmit="return globalFunction.checkSubmission(this)">
                    @csrf()
                    <input type="hidden" name="tab" value="medsos" />
                    <input type="hidden" name="_method" value="put" />
                    <div class="row w-100 m-0 p-0">
                        <div class="col-sm">
                            <h5 class="fw-bold">Media Sosial</h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3">
                        <div class="col-sm-2"><label for="instagram" class="small" style="white-space: normal;">Instagram</label></div>
                        <div class="col-sm-6">
							<div class="input-group">
                                <input type="text" name="instagram" id="instagram" placeholder="Alamat Instagram" class="form-control bg-white @error('instagram') is-invalid @enderror" value="{{ old('instagram') ?? $data->instagram }}" maxlength="255" autofocus />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="facebook" class="small" style="white-space: normal;">Facebook</label></div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" name="facebook" id="facebook" placeholder="Alamat Facebook" class="form-control bg-white @error('facebook') is-invalid @enderror" value="{{ old('facebook') ?? $data->facebook }}" maxlength="255" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="twitter" class="small" style="white-space: normal;">Twitter</label></div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" name="twitter" id="twitter" placeholder="Alamat Twitter" class="form-control bg-white @error('twitter') is-invalid @enderror" value="{{ old('twitter') ?? $data->twitter }}" maxlength="255" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="linkedin" class="small" style="white-space: normal;">Linkedin</label></div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" name="linkedin" id="linkedin" placeholder="Alamat Linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin') ?? $data->linkedin }}" maxlength="255" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="youtube" class="small" style="white-space: normal;">Youtube</label></div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" name="youtube" id="youtube" placeholder="Alamat Youtube" class="form-control bg-white @error('youtube') is-invalid @enderror" value="{{ old('youtube') ?? $data->youtube }}" maxlength="255" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr class="m-0 p-0 mt-3 mb-3" />
                        <button type="submit" class="d-flex btn btn-primary bg-gradient me-2">
                            <i class="material-icons-outlined align-middle align-self-center">save</i>
                            <span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Update</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="tab-pane @if(Session::get('tab')==='setting') fade show active @endif h-100 p-3" id="setting" role="tabpanel" aria-labelledby="setting-tab" style="overflow-y: auto;" onsubmit="return globalFunction.checkSubmission(this)">
                <form method="post" action="{{ route('application-properties.update', $data->id) }}" id="formSetting">
                    @csrf()
                    <input type="hidden" name="tab" value="setting" />
                    <input type="hidden" name="_method" value="put" />
                    <div class="row w-100 m-0 p-0">
                        <div class="col-sm">
                            <h5 class="fw-bold">Email Setting</h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3">
                        <div class="col-sm-2"><label for="mail_driver" class="small" style="white-space: normal;">Mail Driver</label></div>
                        <div class="col-sm-6">
							<div class="input-group">
                                <input type="text" name="mail_driver" id="mail_driver" placeholder="Mail Driver" class="form-control bg-white @error('mail_driver') is-invalid @enderror" value="{{ old('mail_driver') ?? $data->mail_driver }}" maxlength="64" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="mail_host" class="small" style="white-space: normal;">Mail Host</label></div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" name="mail_host" id="mail_host" placeholder="Mail Host" class="form-control bg-white @error('mail_host') is-invalid @enderror" value="{{ old('mail_host') ?? $data->mail_host }}" maxlength="64" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="port" class="small" style="white-space: normal;">Port</label></div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="number" name="port" id="port" placeholder="xxxx" class="form-control bg-white @error('port') is-invalid @enderror" value="{{ old('mail_port') ?? $data->mail_port }}" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="username" class="small" style="white-space: normal;">Username</label></div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="email" name="username" id="username" placeholder="Mail Username" class="form-control bg-white @error('username') is-invalid @enderror" value="{{ old('mail_username') ?? $data->mail_username }}" maxlength="128" autocomplete="username" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="password" class="small" style="white-space: normal;">Password</label></div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control bg-white @error('password') is-invalid @enderror" value="{{ base64_decode($data->mail_password) }}" maxlength="64" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex hideShowPassword" style="cursor: pointer" title="Show or hide password">
                                    <i class="material-icons-outlined align-self-center text-info fs-5">visibility_off</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3 mt-2">
                        <div class="col-sm-2"><label for="encryption" class="small" style="white-space: normal;">Encryption</label></div>
                        <div class="col-sm-6">
                            <select class="form-select bg-white" name="encryption" id="encryption">
                                <option value="" selected>Pilih Email Encryption</option> 
                                <option value="SSL" @if($data->mail_encryption === 'SSL') selected @endif>SSL</option> 
                                <option value="TLS" @if($data->mail_encryption === 'TLS') selected @endif>TLS</option> 
                            </select>
                        </div>
                    </div>
                    <div class="row w-100 m-0 p-0 mt-4">
                        <div class="col-sm">
                            <h5 class="fw-bold">Copyright</h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3">
                        <div class="col-sm-2"><label for="copyright" class="small" style="white-space: normal;">Copyright</label></div>
                        <div class="col-sm-6">
							<div class="input-group">
                                <input type="text" name="copyright" id="copyright" placeholder="Copyright" class="form-control bg-white @error('copyright') is-invalid @enderror" value="{!! $data->copyright !!}" maxlength="64" />
                                <div class="p-2 bg-secondary rounded-end-2 d-flex" onclick="globalFunction.clearValue(event)" style="cursor: pointer" title="Hapus">
                                    <i class="material-icons-outlined align-self-center text-white fs-5">clear</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-100 m-0 p-0 mt-4">
                        <div class="col-sm">
                            <h5 class="fw-bold">Other Settings</h5>
                        </div>
                    </div>
                    <div class="row m-0 p-0 px-3">
                        <div class="col-sm-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="have_website" id="have_website" @if((int)@$data->frontend_website === 1) checked @endif>
                                <label class="form-check-label" for="have_website">Have frontend website</label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <hr class="m-0 p-0 mt-3 mb-3" />
                        <button type="submit" class="d-flex btn btn-primary bg-gradient me-2">
                            <i class="material-icons-outlined align-middle align-self-center">save</i>
                            <span class="px-2 d-none d-sm-flex text-nowrap align-self-center">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
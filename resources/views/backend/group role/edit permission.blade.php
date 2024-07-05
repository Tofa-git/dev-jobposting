<div class="d-flex align-items-stretch flex-grow-1">
	<form action="{{ route('group-roles.update-role', $data->id) }}" method="post" onsubmit="return globalFunction.checkSubmission(this, 0)" class="d-flex flex-column align-items-stretch h-100 m-0 p-0">
		<div class="px-3 flex-grow-1 align-items-stretch">
			@csrf()
			@method('PUT')
			<div class="d-flex flex-fill flex-column" style="overflow: auto!important;">
				<table class="table table-striped table-hover w-100" cellpadding="0" cellspacing="0">
					<thead>
						<tr class="text-nowrap" style="border: none;">
							<th width="30px">No</th>
							<th width="30px">Icon</th>
							<th width="30px">Caption</th>
							<th>Action</th>
							<th>
								<div class="text-nowrap d-flex">
									<span class="flex-fill">Permission</span>
									<div class="flex-shrink-1 form-check ml-2">
										<input class="form-check-input" type="checkbox" id="check_all" name="check_all">
										<label class="form-check-label" for="check_all">Check All</label>
									</div>
								</div>
							</th>
						</tr>
					</thead>
					<tbody>
						@if(is_null($list_menu))
							<tr class="bg-gray">
								<td colspan="6">Data is empty</td>
							</tr>
						@else
							@php $_i=1; @endphp
							@foreach($list_menu as $_list_menu)
								<tr @if($_i % 2===1) class="bg-light" @else class="bg-white" @endif>
									<td align="center">{{ $_i }}.</td>
									<td align="center">
										@if((int)$_list_menu->menu_type===2)
											<i class="material-icons-outlined" style="font-size: 11pt; vertical-align: middle;">{{ $_list_menu->icon }}</i>
										@endif
									</td>
									<td style="min-width: 200px; white-space: normal;">
										@if((int)$_list_menu->menu_type===4)
											<span class="fw-bold text-nowrap">{{ $_list_menu->caption }}</span>
										@elseif((int)$_list_menu->menu_type===5)
											<span class="text-primary text-nowrap">
												<i class="material-icons-outlined me-1" style="font-size: 11pt; vertical-align: middle;">{{ $_list_menu->icon }}</i>
												{{ $_list_menu->caption }}
											</span>
										@elseif((int)$_list_menu->menu_type===6)
											<span class="text-primary">SEPARATOR</span>
										@endif
									</td>
									<td style="min-width: 200px; white-space: normal;">
										{{ $_list_menu->action }}
									</td>
									<td class="text-nowrap">
										<div style="display: inline-block;" class="form-check">
											<input class="form-check-input" type="checkbox" @if($_list_menu->showMenu==='0') checked @endif id="showMenu{{ $_list_menu->id }}" name="showMenu{{ $_list_menu->id }}">
											<label class="form-check-label" for="showMenu{{ $_list_menu->id }}">Show Menu</label>
										</div>
										<div style="display: inline-block;" class="form-check ms-4">
											<input class="form-check-input" type="checkbox" @if($_list_menu->show==='0') checked @endif id="show{{ $_list_menu->id }}" name="show{{ $_list_menu->id }}">
											<label class="form-check-label" for="show{{ $_list_menu->id }}">Index</label>
										</div>
										<div style="display: inline-block;" class="form-check ms-4">
											<input class="form-check-input" type="checkbox" @if($_list_menu->create==='0') checked @endif id="create{{ $_list_menu->id }}" name="create{{ $_list_menu->id }}">
											<label class="form-check-label" for="create{{ $_list_menu->id }}">Create</label>
										</div>
										<div style="display: inline-block;" class="form-check ms-4">
											<input class="form-check-input" type="checkbox" @if($_list_menu->update==='0') checked @endif id="update{{ $_list_menu->id }}" name="update{{ $_list_menu->id }}">
											<label class="form-check-label" for="update{{ $_list_menu->id }}">Update</label>
										</div>
										<div style="display: inline-block;" class="form-check ms-4">
											<input class="form-check-input" type="checkbox" @if($_list_menu->suspend==='0') checked @endif id="suspend{{ $_list_menu->id }}" name="suspend{{ $_list_menu->id }}">
											<label class="form-check-label" for="suspend{{ $_list_menu->id }}">Suspend</label>
										</div>
										<div style="display: inline-block;" class="form-check ms-4">
											<input class="form-check-input" type="checkbox" @if($_list_menu->delete==='0') checked @endif id="delete{{ $_list_menu->id }}" name="delete{{ $_list_menu->id }}">
											<label class="form-check-label" for="delete{{ $_list_menu->id }}">Delete</label>
										</div>
									</td>
								</tr>
								@php $_i++; @endphp
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<hr />
			<div class="d-flex px-3 pb-3 justify-content-end">
				<button type="submit" class="d-flex btn btn-primary bg-gradient me-2">
					<i class="material-icons-outlined align-middle align-self-center">save</i>
					<span class="px-2 d-flex text-nowrap align-self-center">Simpan</span>
				</button>
				<a data-bs-dismiss="modal" role="button" class="btn btn-danger bg-gradient">Close</a>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).on('click', '#check_all', function(e){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
</script>
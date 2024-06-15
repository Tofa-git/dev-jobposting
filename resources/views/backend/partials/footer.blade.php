<div class="flex-shrink-1 w-100 m-0 p-1 px-3 d-flex bg-white ms-2 mt-1 border" style="border-top-left-radius: 10px">
	<div class="flex-grow-1 small">
		{!! @$info->copyright ?? 'Footer Informations' !!}
	</div>
	<div class="small">
		{{ \App\Helpers\general::formatTanggal(now(), 'DD MMM YYYY') }}
	</div>
</div>
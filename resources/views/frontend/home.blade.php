<div style="height: 70px"></div> 
@foreach($landing_page as $_landing_page)
	@if((int)$_landing_page->id_widget > 0)
		@include('frontend.'.$_landing_page->widget->target)
	@else
		{!! $_landing_page->content !!}
	@endif
@endforeach
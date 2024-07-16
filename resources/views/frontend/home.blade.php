<div style="height: 70px">test</div> 
@foreach($landing_page as $_landing_page)
	@include('frontend.'.$_landing_page->widget->target)
@endforeach
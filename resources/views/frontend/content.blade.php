@include('frontend.partials.header')
<div style="height: 70px"></div> 
<div class="container">
	<div class="bg-white p-3 shadow">
		{!! $data->content !!}
	</div>
</div>
@include('frontend.partials.footer')
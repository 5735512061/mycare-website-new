@extends("/frontend/layouts/template/template-bg")
<style>
.product-content {
	height: auto !important;
	margin-top: 10px !important;
	margin-bottom: 10px !important; 
	box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; 
	border: none !important;
	padding: 0px !important;
}
</style>
@section("content")

@include("/frontend/layouts/header/alliance/header-index")
<!-- Start about-video Area -->

<div class="container">
	<div class="row" style="margin-top:-90px !important;">
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/store')}}">
			<div class="product-content product-wrap clearfix">
				<img src="{{url('img/mycare/store/button/carefood.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/lifestyle')}}">
			<div class="product-content product-wrap clearfix">
				<img src="{{url('img/mycare/store/button/carelifestyle.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/hotel')}}">
			<div class="product-content product-wrap clearfix">
				<img src="{{url('img/mycare/store/button/carehotel.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/car-service')}}">
			<div class="product-content product-wrap clearfix">
				<img src="{{url('img/mycare/store/button/carecarservice.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	</div>
</div>

@endsection
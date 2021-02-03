@extends("/frontend/layouts/template/template")
<style>
.product-content {
	height: auto !important;
	margin-top: 10px !important;
	margin-bottom: 0px !important;
}
.carousel-item {
  height: 60vh;
  min-height: 350px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
@media (max-width: 991px) {
    .sizeCarousel {
		height: 150px !important;
	}
	.carousel-item {
		height: 22vh;
		min-height: 0px;
		background: no-repeat center center scroll;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
}
</style>
@section("content")
@include("/frontend/layouts/header/index/header")
<br>
<div class="container" style="margin-top: 100px;">
 	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	</ol>
	<div class="carousel-inner sizeCarousel" role="listbox">
	<!-- Slide One - Set the background image for this slide in the line below -->
		<div class="carousel-item active" style="background-image: url('img/mycare/banner/home.jpg')"></div>
		<!-- Slide Two - Set the background image for this slide in the line below -->
		<div class="carousel-item" style="background-image: url('img/mycare/banner/store.jpg')"></div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

<br><br>
<!-- Start feature Area -->
<div class="container">
<center><h2 style="font-size:2rem; color:#092895 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> ส่วนลดเพื่อนแท้</h2></center><br>
	<div class="row">
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/store')}}">
			<div class="product-content product-wrap clearfix" style="margin-bottom: 10px !important; box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; border: none !important;
			padding: 0px !important;">
				<img src="{{url('img/mycare/store/button/carefood.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/lifestyle')}}">
			<div class="product-content product-wrap clearfix" style="margin-bottom: 10px !important; box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; border: none !important;
			padding: 0px !important;">
				<img src="{{url('img/mycare/store/button/carelifestyle.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/hotel')}}">
			<div class="product-content product-wrap clearfix" style="margin-bottom: 10px !important; box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; border: none !important;
			padding: 0px !important;">
				<img src="{{url('img/mycare/store/button/carehotel.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-6 bootstrap snippets">
		<a href="{{url('/alliance/car-service')}}">
			<div class="product-content product-wrap clearfix" style="margin-bottom: 10px !important; box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; border: none !important;
			padding: 0px !important;">
				<img src="{{url('img/mycare/store/button/carecarservice.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	</div>
</div>
<br><br>
<div class="container">
	{{-- <h2 class="h1-color" style="font-size:3.4rem;"><i class="fas fa-caret-right"></i><i class="fas fa-caret-left" style="font-size:32px;"></i> ร้านอาหาร</h2> --}}
	
	<center><h2 style="font-size:2rem; color:#092895 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> เพื่อนแท้แนะนำร้านอาหาร</h2></center><br>
	<div class="row">
	  @foreach($stores as $store => $value)
		<div class="col-md-4">
			<a href="{{url('alliance/detail/')}}/{{$value->id}}">
				<div class="thecard">
				<div class="card-img">
					<img src="{{url('images/store')}}/{{$value->image}}" class="img-responsive" width="100%">
				</div>
				<div class="card-caption">
					{{-- <h1>{{$value->name}}</h1> --}}
					{{-- <p>{{$value->promotion}}</p> --}}
					<h1 style="text-align:left; margin-top:10px; font-size:20px;">{{$value->promotion}}</h1>
					<p>{{$value->name}}</p>
					{{-- <p style="color:#092895;">รับคะแนนสะสม {{$value->point}} คะแนน</p> --}}
					<h4>โปรโมชั่น {{$value->date}} - {{$value->expire}}</h4>
						<img id="like-btn" src="{{url('images/logo')}}/{{$value->logo}}" width="25%;">
				</div>
				<div class="card-outmore">
					<h5>รายละเอียดเพิ่มเติม</h5>
					<i id="outmore-icon" class="fa fa-angle-right"></i>
				</div>
				</div>
			</a>
		</div>
	@endforeach
  </div>
</div>
<center><p style="font-size:20px;"><a href="{{url('/alliance/store')}}" style="color:#000; border-bottom: 5px solid blue;">ดูทั้งหมด</a></p></center>
<br><br>
{{-- <div class="container">
	<center><h2 style="font-size:2rem; color:#092895 !important; font-weight: normal !important;"><i class="fa fa-gift"></i> MY CARE REWARD</h2></center><br>
	<div class="row">
	  <div class="col-xs-12 col-md-4 bootstrap snippets">
		<a href="{{url('/privilege/reward-food')}}">
			<div class="product-content product-wrap clearfix" style="margin-bottom: 10px !important; box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; border: none !important;
			padding: 0px !important;">
				<img src="{{url('img/mycare/store/button/carefood.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-4 bootstrap snippets">
		<a href="{{url('/privilege/reward-gadget')}}">
			<div class="product-content product-wrap clearfix" style="margin-bottom: 10px !important; box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; border: none !important;
			padding: 0px !important;">
				<img src="{{url('img/mycare/store/button/carelifestyle.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	  <div class="col-xs-12 col-md-4 bootstrap snippets">
		<a href="{{url('/privilege/reward-other')}}">
			<div class="product-content product-wrap clearfix" style="margin-bottom: 10px !important; box-shadow: 8px 11px 16px 0 rgba(0, 0, 0, 0.28) !important; border: none !important;
			padding: 0px !important;">
				<img src="{{url('img/mycare/store/button/carehotel.jpg')}}" width="100%">
			</div>
		</a>
	  </div>
	</div>
</div> --}}
{{-- <center><p style="font-size:20px;"><a href="{{url('/privilege/reward-points')}}" style="color:#000; border-bottom: 5px solid blue;">ดูทั้งหมด</a></p></center> --}}
<br><br>

@endsection



@extends("/frontend/layouts/template/template")
<link rel="stylesheet" href="{{asset('jquery.Thailand.js/dist/jquery.Thailand.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@section("content")
<style>
.shape{    
    border-style: solid; border-width: 0 40px 40px 0; float:right; height: 0px; width: 0px;
    -webkit-transform: rotate(360deg);  
    -moz-transform: rotate(360deg);  
    -o-transform: rotate(360deg);  
    transform: rotate(360deg); 
}
.shape-text{
    color:#fff; font-size:12px; font-weight:bold; position:relative; right:-22px; top:-3px; white-space: nowrap;
	-ms-transform:rotate(30deg); /* IE 9 */
	-o-transform: rotate(360deg);  /* Opera 10.5 */
	-webkit-transform:rotate(46deg); /* Safari and Chrome */
	transform:rotate(46deg);
}
.offer{
	background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
}
.shape {
	border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-radius{
	border-radius:7px;
}
.offer-primary {	border-color: #203ca0 ; }
.offer-primary .shape{
	border-color: transparent #203ca0  transparent transparent;
}

.offer-content{
	padding:0 20px 10px;
}
@media (min-width: 487px) {
  .container {
    max-width: 750px;
  }
  .col-sm-6 {
    width: 50%;
  }
}
@media (min-width: 900px) {
  .container {
    max-width: 970px;
  }
  .col-md-4 {
    width: 33.33333333333333%;
  }
}

@media (min-width: 1200px) {
  .container {
    max-width: 1170px;
  }
  .col-lg-3 {
    width: 25%;
  }
  }
}
</style>
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;">ข้อมูลรถยนต์</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<!-- End banner Area -->

<div class="container"> 
    <div class="row">
        @foreach($cars as $car => $value)
        <div class="col-lg-3">
            <a href="{{url('/member/sales/service-history/')}}/{{$value->id}}">
                <div class="offer offer-radius offer-primary">
                    <div class="shape"></div>
                    <div class="offer-content"><br>
                        <p class="mbr-fonts-style text1 mbr-text display-6">
                            {{$value->brand}} {{$value->model}} สี{{$value->color}}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection


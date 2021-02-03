@extends("/frontend/layouts/template/template-bg2")
<style>
@media only screen and (max-width: 768px) {
    #mobile {
      display: inline !important;
      padding: 5px;
    }
    #desktop {
      display: none;
    }
    #like-btn {
        top: -70px !important;
    }
}

/* Image on the left side */
.thumbnail {
	float: left;
	position: relative;
	left: 30px;
	top: -90px;
	height: 320px;
	width: 530px;
	-webkit-box-shadow: 10px 10px 10px 0px #9c9c9c;
	-moz-box-shadow: 10px 10px 10px 0px #9c9c9c;
	box-shadow: 10px 10px 10px 0px #9c9c9c;
	overflow: hidden;
}
.right {
	margin-left: 590px;
	margin-right: 20px;
	margin-top: -280px;
  height: 300px;
}

.right h1 {
  margin-top: 2px;
}

.right h4 {
  text-align: center;
}

.card {
	 position: absolute;
	 background: white;
	 margin: 0 auto;
	 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
	 transition: all 0.3s;
}
 .card:hover {
	 box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

</style>
@section("content")

<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 class="" style="font-size:2rem; color:#000085 !important; font-weight: normal !important;">{{$alliance->name}}</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<div class="container" id="desktop">
  <div class="card">
    <div class="thumbnail">
      <img src="{{url('images/store')}}/{{$alliance->image}}" class="img-responsive" width="100%">
    </div>
    <div class="right">
	  <h1>{{$alliance->promotion}}</h1><br>
	  {{-- <center><p style="color:#092895;">และรับคะแนนสะสม {{$alliance->point}} คะแนน</p></center> --}}
      <h4>ระยะเวลาโปรโมชั่น {{$alliance->date}}-{{$alliance->expire}}</h4><hr>
      <p style="font-family:'Prompt'; font-size:20px;">เงื่อนไขในการรับสิทธิ์</p>
      <div style="font-family:'Prompt'; color: blue; font-size:16px;">
          <li>สแกน QR Code ณ ร้านค้าที่ใช้บริการ</li>
          <li>แสดงบัตรสมาชิก พร้อมรหัสรับสิทธิ์ เพื่อยืนยันการรับสิทธิ์</li>
          <li>บัตรสมาชิก 1 ใบ ต่อการรับสิทธิ์ 1 สิทธิ์ / 1 วัน / 1 ร้านค้าพันธมิตร</li>
          <br>
      </div>    
    </div>
  </div>
</div>
<br>
<div class="container" id="desktop">
	<div class="row">
		<div class="col-md-12">
			<div class="thecard" style="margin-top: 10px; box-shadow:0 1px 9px rgba(0,0,0,.4);">
				<div class="card-caption">
					<p style="font-family:'Prompt'; font-size:16px; color:blue;"><i class="fa fa-map-marker"></i> <a href="{{$alliance->location}}">{{$alliance->location}}</a></p>
					<p style="font-family:'Prompt'; font-size:16px; color:blue;">{{$alliance->comment}}</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container" id="mobile" style="display: none;">
	<div class="row" style="margin-right:0px !important; margin-left:0px !important; margin-top:-90px !important;">
		<div class="col-md-12">
			<a href="#">
				<div class="thecard">
				<div class="card-img">
					<img src="{{url('images/store')}}/{{$alliance->image}}" class="img-responsive" width="100%">
				</div>
				<div class="card-caption">
					<h1 style="margin-top:10px; text-align:left; font-size:20px;">{{$alliance->promotion}}</h1>
					<p>{{$alliance->name}}</p>
					{{-- <p style="color:#092895;">รับคะแนนสะสม {{$alliance->point}} คะแนน</p> --}}
         			<img id="like-btn" src="{{url('images/logo')}}/{{$alliance->logo}}" width="25%;">
				</div>
				<div class="card-outmore">
					<h5>ระยะเวลา {{$alliance->date}}-{{$alliance->expire}} </h5>
				</div>
				</div>
			</a>
		</div>

		<div class="col-md-12">
			<a href="#">
				<div class="thecard">
					<div class="card-caption">
						<p style="font-family:'Prompt'; font-size:20px;">เงื่อนไขในการรับสิทธิ์</p>
						<div style="font-family:'Prompt'; color: blue; font-size:16px;">
							<li>สแกน QR Code ณ ร้านค้าที่ใช้บริการ</li>
							<li>แสดงบัตรสมาชิก พร้อมรหัสรับสิทธิ์ เพื่อยืนยันการรับสิทธิ์</li>
							<li>บัตรสมาชิก 1 ใบ ต่อการรับสิทธิ์ 1 ครั้ง / 1 วัน</li>
							<br>
						</div>    
					</div>
				</div>
			</a>
		</div>

		<div class="col-md-12">
			<div class="thecard" style="margin-top: 10px; box-shadow:0 1px 9px rgba(0,0,0,.4);">
				<div class="card-caption">
					<p style="font-family:'Prompt'; font-size:16px; color:blue;"><i class="fa fa-map-marker"></i> <a href="{{$alliance->location}}">{{$alliance->location}}</a></p>
					<p style="font-family:'Prompt'; font-size:16px; color:blue;">{{$alliance->comment}}</p>
				</div>
			</div>
		</div>
		
  </div>
</div>

@endsection
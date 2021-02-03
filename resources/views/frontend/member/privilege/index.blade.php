@extends("/frontend/layouts/template/template-store")
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
        top: -50px !important;
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
<?php 
$store_name = $store_name;
?>
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 200px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				{{-- <center><h2 class="" style="font-size:2rem; color:#000085 !important; font-weight: normal !important;">{{$store->name}}</h2></center> --}}
				{{-- <hr style="border: 1px solid blue;"> --}}
			</div>
		</div>
    </div>
</section>
<div class="container" id="desktop">
  <div class="card">
    <div class="thumbnail" style="height:735px !important;">
      <img src="{{url('images/scan')}}/{{$store->scan}}" class="img-responsive" width="100%">
    </div>
    <div class="right" style="margin-top: -580px !important; height:520px !important;">
      <h1>{{$store->promotion}}</h1><br>
      <h4>ระยะเวลาโปรโมชั่น {{$store->date}}-{{$store->expire}}</h4><hr>
      <p style="font-family:'Prompt'; font-size:20px;">เงื่อนไขในการรับสิทธิ์</p>
      <div style="font-family:'Prompt'; color: blue; font-size:16px;">
            <li>คลิ๊กปุ่ม กดที่นี่เพื่อกรอกรหัสรับสิทธิ์</li>
            <li>กรอกหมายเลขบัตร 16 หลัก</li>
            <li>คลิ๊กปุ่ม กดรับสิทธิ์</li>
            <li>แสดงบัตรสมาชิก พร้อมรหัสรับสิทธิ์</li>
            <li>บัตรสมาชิก 1 ใบ ต่อการรับสิทธิ์ 1 สิทธิ์</li>
          <br>
      </div>  
      <a href="{{url('privilege')}}/{{$store_name}}/index" target="_blank"><button class="genric-btn info radius btn_sub" style="background-color: #0517c4 !important;">กดเพื่อรับสิทธิ์</button></a><br>
    </div>
  </div>
</div>
<br>
<div class="container" id="mobile" style="display: none;">
	<div class="row" style="margin-right:0px !important; margin-left:0px !important; margin-top:-200px !important;">
		<div class="col-md-12">
			<a href="#">
				<div class="thecard">
				<div class="card-img" style="height:580px !important;">
					<img src="{{url('images/scan')}}/{{$store->scan}}" class="img-responsive" width="100%">
				</div>
				{{-- <div class="card-caption">
					<p style="font-family:'Prompt'; font-size:20px;">เงื่อนไขในการรับสิทธิ์</p>
                    <div style="font-family:'Prompt'; color: blue; font-size:16px;">
                        <li>คลิ๊กปุ่ม กดที่นี่เพื่อกรอกรหัสรับสิทธิ์</li>
                        <li>กรอกหมายเลขบัตร 16 หลัก</li>
                        <li>คลิ๊กปุ่ม กดรับสิทธิ์</li>
                        <li>แสดงบัตรสมาชิก พร้อมรหัสรับสิทธิ์</li>
                        <li>บัตรสมาชิก 1 ใบ ต่อการรับสิทธิ์ 1 สิทธิ์</li>
                        <br>
                    </div>    
                    <img id="like-btn" src="{{url('images/logo')}}/{{$store->logo}}" width="25%;">
                </div> --}}
                <center><a href="{{url('privilege')}}/{{$store_name}}/index" target="_blank"><button style="background-color: #0517c4 !important;" class="genric-btn info radius btn_sub">กดเพื่อรับสิทธิ์</button></a></center><br>
        </div>
                
			</a>
		</div>
  </div>
</div>

@endsection
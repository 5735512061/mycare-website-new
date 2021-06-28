@extends("/frontend/layouts/template/template-bg2")
<style>
@media only screen and (max-width: 768px) {
    #mobile {
      display: inline !important;
    }
    #desktop {
      display: none;
    }
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
 .card nav {
	 width: 100%;
	 color: #727272;
	 padding: 20px;
	 border-bottom: 2px solid #efefef;
	 font-size: 12px;
}
 .card nav svg.heart {
	 height: 24px;
	 width: 24px;
	 float: right;
	 margin-top: -3px;
	 transition: all 0.3s ease;
	 cursor: pointer;
}
 .card nav svg.heart:hover {
	 fill: red;
}
 .card nav svg.arrow {
	 float: left;
	 height: 15px;
	 width: 15px;
	 margin-right: 10px;
}
  .card .photo {
	 padding: 30px;
	 width: 30%;
	 text-align: center;
	 float: left;
}
  .card .photo img {
	 max-height: 240px;
}
  .card .description {
	 padding: 30px;
	 float: left;
	 width: 55%;
	 border-left: 2px solid #efefef;
}
  .card .description h1 {
	 color: #515151;
	 font-weight: 300;
	 padding-top: 15px;
	 margin: 0;
	 font-size: 30px;
     font-weight: 300;
     text-align: left !important;
}
  .card .description h2 {
	 color: #515151;
	 margin: 0;
	 text-transform: uppercase;
	 font-weight: 500;
}
  .card .description h4 {
	 margin: 0;
	 color: #727272;
	 text-transform: uppercase;
	 font-weight: 500;
	 font-size: 12px;
}

    .card .description h3 {
	 margin: 0;
	 color: #727272;
	 font-weight: 500;
	 font-size: 18px;
}

  .card .description p {
	 font-size: 12px;
	 line-height: 20px;
	 color: #727272;
	 padding: 20px 0;
	 margin: 0;
}
 
</style>
@section("content")

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
                <center><h2 class="" style="font-size:2rem; color:#000085 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> รายละเอียดของรางวัล</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<!-- End banner Area -->

<div class="container" id="desktop">
    <div class="row">
        <div class="card">
            <div class="md-12">
                <nav><h2 style="color:#092895 !important; font-weight:normal;">{{$reward->reward_name}}</h2></nav>
                <div class="photo">
                    <center><img src="{{url('/images/reward')}}/{{$reward->image}}" class="img-responsive" width="100%"></center>
                </div>
                <div class="description">
                    <h3>รายละเอียด : {{$reward->detail}}</h3>
                    <h1>ใช้คะแนนสะสม {{$reward->point}} คะแนน</h1>
                    <h1 style="font-size:20px;">เงื่อนไขการรับสิทธิ์</h1>
                    <div style="font-family: 'Prompt';">
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%">กดแลกพอยท์ทางเว็บไซต์เพื่อรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%">ทางบริษัทฯ จะติดต่อกลับเพื่อให้ท่านยืนยันการรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%">กรณีทำการแลกพอยท์แล้ว จะไม่สามารถยกเลิกได้ทุกกรณี<br><br>
                    </div>
					<a href="{{url('/member/reward-redem')}}/{{$reward->id}}"><button class="genric-btn blue radius btn_sub" style="width: 70%;">กดแลกคะแนนสะสม</button></a>
                </div>
            </div>
		</div>
    </div>
</div>

<div class="container" id="mobile" style="display: none;">
	<div class="row" style="margin-top:-90px !important;">
		<div class="card" style="margin:3rem !important; border: 2px solid rgba(0, 0, 0, .125) !important; margin-top:0px !important; margin-bottom:0.5rem !important; width: 22rem;">
		  <nav><h2 style="color:#092895 !important; font-weight:normal; text-align:center;">{{$reward->reward_name}}</h2></nav>
		  <div class="card-body" style="padding: 1rem !important;">
			<p><a href="#" style="border-bottom: 3px solid blue;">รายละเอียด</a></p><p>{{$reward->detail}}</p>
			<h3 class="card-title" style="color:#34488d; font-size:22px; font-weight:normal;">ใช้คะแนน {{$reward->point}} Point</h3>
			<center><img src="{{url('/images/reward')}}/{{$reward->image}}" class="img-responsive" width="80%"></center>
			<h1 style="font-size:20px; margin-top:0px !important;">เงื่อนไขการรับสิทธิ์</h1>
                    <div style="font-family: 'Prompt';">
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="7%">กดแลกคะแนนสะสมเพื่อรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="7%">ทางบริษัทฯ จะติดต่อกลับเพื่อให้ท่านยืนยันการรับสิทธิ์<br>
                        <img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="7%">กรณีทำการแลกพอยท์แล้ว จะไม่สามารถยกเลิกได้ทุกกรณี<br><br>
                    </div>
			<center><a href="{{url('member/reward-redem/')}}/{{$reward->id}}" class="genric-btn blue radius btn_sub" style="text-align: right;">กดแลกคะแนนสะสม</a></center>
		  </div>
		</div>
	</div>
</div>


@endsection
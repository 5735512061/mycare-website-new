<link rel="stylesheet" type="text/css" href="{{ asset('css/mycare/style/index.css')}}">
<style>	
.about-video-right {
    /* background: url(img/mycare/banner/home.jpg) no-repeat center !important; */
    background-size: cover !important;
}

@media only screen and (max-width: 768px) {
	#mobile {
	display: inline !important;
	}
	#desktop {
	display: none;
	}
}
</style>
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row fullscreen d-flex align-items-center justify-content-between">
			<div class="home-banner-content col-lg-12 col-md-12">
				{{-- <h1 class="azonix" style="text-align:center;">MY CARE</h1> --}}
				<center><img src="{{ asset('/img/mycare/logo-mycare.png')}}" class="img-responsive" width="15%" id="desktop"></center>
				<center><img src="{{ asset('/img/mycare/logo-mycare.png')}}" class="img-responsive" width="40%" id="mobile" style="display: none;"></center>
				<hr style="border: 1px solid blue; margin-top:0rem; margin-bottom:0rem;">
				@auth('member')
					<h2 style="margin-top: 1rem; text-align:center; font-size:2rem; color:#000842 !important; font-weight: normal !important;">สวัสดี{{$hour}}<br>คุณ{{Auth::guard('member')->user()->name}} {{Auth::guard('member')->user()->surname}}</h2>
				@endauth
				@auth('sales_members')
					<h2 style="margin-top: 1rem; text-align:center; font-size:2rem; color:#000842 !important; font-weight: normal !important;">สวัสดี{{$hour}}<br>คุณ{{Auth::guard('sales_members')->user()->name}} {{Auth::guard('sales_members')->user()->surname}}</h2>
				@endauth
				<!-- End fact Area -->
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<style>
.mx-background-top-linear {
    background: -webkit-linear-gradient(45deg, #154e9b 48%, #1b1e21 48%);
    background: -webkit-linear-gradient(left, #154e9b 48%, #1b1e21 48%);
    background: linear-gradient(45deg, #154e9b 48%, #1b1e21 48%);
}
</style>	
	<br><br>
	{{-- <img src="{{ asset('/img/mycare/symbol/logo.png')}}" width="25%"> --}}
	<div style="background-color: #e3faff; height:70px;">
		<h1 style="padding-top: 10px !important;">เพื่อนแท้พร้อมดูแลคุณ<br>ติดต่อ 082-628-2244</h1>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear"></nav>
	<!-- Start Footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 single-footer-widget">
					<ul>
						<li><a href="{{url('/about')}}">เกี่ยวกับบัตรสมาชิก</a></li>
						<li><a href="{{url('/about/howto-regis')}}">วิธีการสมัครบัตร</a></li>
						<li><a href="{{url('/about/condition')}}">ข้อกำหนดและเงื่อนไข</a></li>
						<li><a href="{{url('/about/faqs')}}">คำถามที่พบบ่อย</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6 single-footer-widget">
					<ul>
						{{-- <li><a href="{{url('/privilege/point')}}">คะแนนสะสม</a></li> --}}
						{{-- <li><a href="{{url('/privilege/reward-points')}}">แลกคะแนนสะสม</a></li> --}}
						<li><a href="{{url('/alliance/index')}}">ส่วนลดเพื่อนแท้</a></li>
						<li><a href="{{url('/promotion')}}">ติดตามข่าวสาร</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-6 single-footer-widget">
					<ul>
						<li><a href="{{url('/about/sitemap')}}">แผนผังเว็บไซต์</a></li>
						<li><a href="{{url('/about/contact')}}">ติดต่อเรา</a></li>
						@if(Auth::guard('member')->user() == NULL && Auth::guard('sales_members')->user() == NULL)
							<li><a href="{{url('/member/login')}}">เข้าสู่ระบบ</a></li>
						@endif
					</ul>
				</div>
				<div class="col-lg-3 col-md-6 single-footer-widget">
					<ul>
						<li><a href="{{url('/alliance/store')}}">เพื่อนแท้ อิ่มอร่อย</a></li>
						<li><a href="{{url('/alliance/lifestyle')}}">เพื่อนแท้ ไลฟ์สไตล์</a></li>
						<li><a href="{{url('/alliance/hotel')}}">เพื่อนแท้ ชวนฝัน</a></li>
						<li><a href="{{url('/alliance/car-service')}}">เพื่อนแท้ ดูแลรถยนต์</a></li>
					</ul>
				</div>
			</div>
			<div class="footer-bottom row align-items-center">
				<p class="footer-text m-0 col-lg-6 col-md-12" style="font-size: 10px;">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					{{-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Colorlib --}}
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					<script type="text/javascript" src="https://www.counters-free.net/count/5uhf"></script>
				</p>
			</div>
		</div>
	</footer>
	<!-- End Footer Area -->

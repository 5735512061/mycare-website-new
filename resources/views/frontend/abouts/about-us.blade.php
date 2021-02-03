@extends("/frontend/layouts/template/template")

@section("content")

@include("/frontend/layouts/header/about/header-aboutus")

<!-- Start feature Area -->
<section class="feature-area">
    <div class="row d-flex justify-content-center" style="margin-top:-90px !important;">
        <div class="col-lg-6">
            <div class="section-title">
				<center><img src="{{ asset('img/mycare/logo-card.png')}}" width="50%" style="-webkit-filter: drop-shadow(7px 7px 7px #222); filter: drop-shadow(7px 7px 7px #222);"/></center>
				<div style="background-color:#FFF;">
					<h2 class=" text-center" style="margin-top:20px; color:#646464;">MY CARE Smart Choice เพื่อนแท้ ดูแลกัน</h2>
					<p>
						บริการหลังการขายจากศูนย์บริการยางรถยนต์เอกการยาง ที่มอบสิทธิพิเศษให้กับคุณลูกค้า นอกเหนือจากการให้บริการเรื่องยาง 
						แต่เป็นการดูแลคุณ ไม่ว่าจะเรื่องอาหาร ที่พัก และไลฟ์สไตล์ต่างๆของคุณ เปรียบเสมือน “เพื่อนแท้ดูแลกัน”
						คุณลูกค้าจะได้รับสิทธิพิเศษต่างๆ ส่วนลด จากร้านค้าพันธมิตรในเครือของ MY CARE ที่ทางเอกการยาง มอบให้เป็นบริการหลังการขายแก่คุณลูกค้า
						เช่น ร้านอาหาร เครื่องดื่ม โรงแรม โรงภาพยนต์ เป็นต้น ซึ่งกำหนดไว้ในแต่ละช่วงระยะเวลานั้นๆ 
						อีกทั้งยังสามารถนำคะแนนสะสมมาใช้เพื่อแลกของรางวัลพรีเมี่ยม ส่วนลดและสิทธิพิเศษต่างๆ
					</p>
				</div>
            </div>
        </div>
    </div>
    {{-- <div class="row d-flex">
        <div class="col-lg-6">
            <div class="section-title">
                
            </div>
        </div>
    </div> --}}
	<div class="container">
		<center><h2 class="" style="font-size:2rem; color:#000085 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> เอกสิทธิ์สำหรับสมาชิกบัตร MY CARE</h2></center>
				<hr style="border: 1px solid blue;">
		<br>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="single-feature">
					<a href="#" class="title">
                        <i class="fas fa-parking" style="font-size: 4rem;"></i>
						<h4 style="margin-top:30px; font-size:20px;">รับคะแนนสะสม</h4>
					</a>
					<p style="font-size:16px;">
						รับคะแนนสะสม ได้จากการใช้บริการร้านค้าพันธมิตรที่เข้าร่วมโครงการกับทางบัตรสมาชิก
					</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single-feature">
					<a href="#" class="title">
						<i class="fas fa-gift" style="font-size: 4rem;"></i>
						<h4 style="margin-top:30px; font-size:20px;">สิทธิพิเศษสำหรับสมาชิก</h4>
					</a>
					<p style="font-size:16px;">
						ได้รับส่วนลดต่างๆ และสิทธิพิเศษอีกมากมาย จากร้านค้าพันธมิตรที่ร่วมโครงการ
					</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single-feature">
					<a href="#" class="title">
                        <i class="fas fa-info-circle" style="font-size: 4rem;"></i>
						<h4 style="margin-top:30px; font-size:20px; line-weight: 1.4em;">ตรวจสอบสิทธิพิเศษต่างๆ</h4>
					</a>
					<p style="font-size:16px;">
						สมาชิกสามารถตรวจสอบสิทธิประโยชน์ และร้านค้าพันธมิตรที่ร่วมโครงการ ได้ผ่านทางเว็บไซต์
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<br>
<!-- End feature Area -->
<div class="row d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="section-title text-center">
            <p>
                * ทางบริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลง หรือยกเลิกโดยไม่ต้องแจ้งให้ทราบล่วงหน้า
            </p>
        </div>
    </div>
</div>
@endsection
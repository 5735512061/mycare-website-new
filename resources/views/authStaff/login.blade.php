@extends("/backend/layouts/template/template-staff")
<link rel="stylesheet" type="text/css" href="{{ asset('css/mycare/style/index.css')}}">
<style>
@media (max-width: 991px) {
    .margin-design {
      margin-top: 0px !important;
   }
   .a-white {
       color:#fff;
   }
   .hide {
       display: none;
   }

}

@media (min-width: 1024px) {
    .hide2 {
        display: none;
    }
}
</style>
@section("content")

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row">
            <div class="col-md-2"></div>
			<div class="col-md-4 margin-design" style="margin-top:5rem; background-color:#fff;">
				<form method="POST" action="{{ route('staff.login.submit') }}" autocomplete="off">@csrf
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
    
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                          @endif
                        @endforeach
                    </div>
                    <h1 style="text-align:center;">เข้าสู่ระบบพนักงาน</h1><hr style="border: 1px solid blue;">
                    <div class="row">
                        <div class="mt-10 col-md-12">
                            <input type="text" class="single-input" style="font-family:Prompt;" placeholder="ชื่อเข้าใช้งาน" onfocus="this.placeholder = 'ชื่อเข้าใช้งาน'" name="staff_name" value="{{ old('staff_name') }}" required>
                        </div>
                        <div class="mt-10 col-md-12">
                            <input id="password" type="password" type="text" class="single-input" style="font-family:Prompt;" placeholder="รหัสผ่าน" onfocus="this.placeholder = 'รหัสผ่าน'" name="password">
                        </div>
                    </div><br>
                    <button class="genric-btn info radius">เข้าสู่ระบบ</button>
                    <br><br>
                </form>
            </div>
            <div class="col-md-2"></div>
		</div>
    </div>
</section>
<!-- End banner Area -->
@include("/backend/layouts/footer")
@endsection

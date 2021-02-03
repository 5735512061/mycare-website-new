@extends("/frontend/layouts/template/template-bg")
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
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> เข้าสู่ระบบ</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<div class="container">
    <div class="row" style="margin-top:-90px !important;">
        <div class="home-banner-content col-lg-5 col-md-6">
            <p class="hide"><span style="color:red;">* สำหรับสมาชิกบัตร MY CARE กรณีเข้าสู่ระบบครั้งแรก<br> กรุณา</span><a class="a-white" href="{{url('/member/register-card')}}" style="color: #0038ff;"> ลงทะเบียนบัตรใหม่</a><br>
                {{-- <span style="color:red;">* ไม่มีบัตรสมาชิก MY CARE</span><a class="a-white" href="{{url('/member/register')}}" style="color: #0038ff;"> คลิกสมัครสมาชิกใหม่</a><br> --}}
                ลืมรหัสผ่าน<a href="{{route('password.forget')}}" style="color: #0038ff;"> คลิกที่นี่</a></p>
        </div>
        <div class="col-lg-4 col-md-6 margin-design" style="background-color:#fff;">
            <form method="POST" action="{{ route('member.login.submit') }}">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))

                      <p style="font-size: 16px;" class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                @if ($errors->has('tel'))
                    <span class="text-danger" style="font-size: 16px;">({{ $errors->first('tel') }})</span>
                @endif
                <div class="row">
                    <div class="mt-10 col-md-12">
                        <input type="text" class="phone_format single-input" style="font-family:Prompt;" placeholder="เบอร์โทรศัพท์" onfocus="this.placeholder = 'เบอร์โทรศัพท์'" name="tel" value="{{ old('tel') }}" required >
                    </div>
                    <div class="mt-10 col-md-12">
                        <input style="font-family:Prompt;" type="password" name="password" placeholder="รหัสผ่าน" onfocus="this.placeholder = 'รหัสผ่าน'" class="single-input">
                    </div>
                </div><br>
                <button class="genric-btn info radius">เข้าสู่ระบบ</button>
                <br><br>
            </form>
        </div>
        <div class="home-banner-content col-lg-5 col-md-6 hide2">
            <p style="font-size: 16px !important;">
                <span style="color:red;">* สำหรับสมาชิกบัตร MY CARE กรณีเข้าสู่ระบบครั้งแรก กรุณา</span><a href="{{url('/member/register-card')}}" style="color: #0038ff;"> ลงทะเบียนบัตรใหม่</a><br>
                {{-- <span style="color:red;">* ไม่มีบัตรสมาชิก MY CARE</span><a href="{{url('/member/register')}}" style="color: #0038ff;"> คลิกสมัครสมาชิกใหม่</a><br> --}}
                ลืมรหัสผ่าน<a href="{{route('password.forget')}}" style="color: #0038ff;"> คลิกที่นี่</a>
            </p>
        </div>
    </div>
</div>
<!-- start banner Area -->
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script>
    // number phone
    function phoneFormatter() {
        $('input.phone_format').on('input', function() {
            var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) { number = number.replace(/(\d{3})(\d{2})/, "$1-$2"); } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3"); 
                }
            $(this).val(number)
            $('input.phone_format').attr({ maxLength : 12 });    
        });
    };
    $(phoneFormatter);
</script>

@endsection
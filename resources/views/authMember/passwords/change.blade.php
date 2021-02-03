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
}
</style>
@section("content")
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> เปลี่ยนรหัสผ่าน</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<div class="container">
    <div class="row" style="margin-top:-90px !important;">
        <div class="col-md-4"></div>
        <div class="col-md-4 margin-design" style="background-color:#fff;">
            <form method="POST" action="{{ route('password.update') }}">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))

                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="mt-10 col-md-12">
                        <input id="oldpassword" type="password" class="single-input{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" style="font-family:Prompt;" placeholder="รหัสผ่านเก่า" onfocus="this.placeholder = 'รหัสผ่านเก่า'" name="oldpassword" required autofocus>
                    </div>
                    <div class="mt-10 col-md-12">
                        <input id="password" style="font-family:Prompt;" type="password" name="password" placeholder="รหัสผ่านใหม่" onfocus="this.placeholder = 'รหัสผ่านใหม่'" class="single-input{{ $errors->has('password') ? ' is-invalid' : '' }}" required autofocus>
                    </div>
                    <div class="mt-10 col-md-12">
                        <input id="password-confirm" style="font-family:Prompt;" type="password" name="password_confirmation" placeholder="ยืนยันรหัสผ่าน" onfocus="this.placeholder = 'ยืนยันรหัสผ่าน'" class="single-input{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" required autofocus>
                    </div>
                </div><br>
                <button class="genric-btn info radius">เปลี่ยนรหัสผ่าน</button>
                <br><br>
            </form>
        </div>
        <div class="col-md-4"></div>
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
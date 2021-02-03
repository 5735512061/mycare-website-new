@extends("/frontend/layouts/template/template-store")
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
				<form method="POST" action="{{ route('store.login.submit') }}" autocomplete="off">@csrf
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
    
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                          @endif
                        @endforeach
                    </div>
                    <h1 style="text-align:center;">เข้าสู่ระบบพันธมิตร</h1><hr style="border: 1px solid blue;">
                    <div class="row">
                        <div class="mt-10 col-md-12">
                            <input style="font-family:Prompt;" type="text" class="phone_format form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" placeholder="หมายเลขพันธมิตร" name="tel" maxlength="12" minlength="12">

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


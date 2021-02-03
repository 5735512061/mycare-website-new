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

.alertdesign {
    text-align: center;
    border-style: solid;
    font-size: 16px;
}
</style>
@section("content")
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> ลงทะเบียนบัตรครั้งแรก</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-lg-4 col-md-4 margin-design" style="background-color:#fff;">
            <form method="POST" action="{{ route('register-card.submit') }}">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                    @endforeach
                </div>
                
                <div class="row">
                    <div class="mt-10 col-md-12">   
                        <input type="text" id="ssn" maxlength="19" minlength="19" class="single-input" style="font-family:Prompt;" placeholder="ยืนยันหมายเลขบัตรสมาชิก" onfocus="this.placeholder = 'ยืนยันหมายเลขบัตรสมาชิก'" name="serialnumber" value="{{ old('serialnumber') }}" required >
                    </div>
                </div><br>
                <button class="genric-btn info radius">ยืนยันหมายเลขบัตรสมาชิก</button>
                <br><br>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script>
    // serial number
    $('#ssn').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        var newVal = '';
        while (val.length > 4) {
          newVal += val.substr(0, 4) + '-';
          val = val.substr(4);
        }
        newVal += val;
        this.value = newVal;
    });
</script>
@endsection
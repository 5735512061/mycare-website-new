@extends("/frontend/layouts/template/template")
<link rel="stylesheet" href="{{asset('jquery.Thailand.js/dist/jquery.Thailand.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@section("content")
<style>
    input[type="file"] {
    display: none;
    }
    .custom-file-upload {
    border: 2px solid #4aa1ff;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    font-family: 'Prompt';
    border-radius: 10px;
    /* background: #ececfc; */
    padding: 5px 20px;
    }
</style>
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;">แก้ไขเบอร์โทรศัพท์</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<!-- End banner Area -->

<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4">
            <form action="{{url('/member/tel-update')}}" enctype="multipart/form-data" method="post">@csrf
                <div style="margin-top:-90px !important;">
                    <input type="text" name="tel" placeholder="เบอร์โทรติดต่อ" onfocus="this.placeholder = 'เบอร์โทรติดต่อ'" class="phone_format single-input" value="{{$member->tel}}">
                    <input type="hidden" name="id" value="{{$member->id}}">
                    <br>
                    <button class="genric-btn info radius">ยืนยันเบอร์โทรศัพท์</button>
                </div><br>
            </form>
        </div>
    </div>
    <div class="col-lg-4 col-md-4"></div>
</div>
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
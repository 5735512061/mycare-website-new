@extends("/backend/layouts/template/template")
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
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home- banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">เพิ่มของรางวัล</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <form action="{{url('/admin/create-reward')}}" enctype="multipart/form-data" method="post">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))

                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="reward_name" placeholder="ของรางวัล" onfocus="this.placeholder = 'ของรางวัล'" class="single-input" value="{{ old('reward_name') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="point" placeholder="จำนวนพอยท์" onfocus="this.placeholder = 'จำนวนพอยท์'" class="single-input" value="{{ old('point') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="expire" placeholder="วันที่หมดเขต" onfocus="this.placeholder = 'วันที่หมดเขต'" class="single-input" value="{{ old('expire') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="comment" placeholder="หมายเหตุ" onfocus="this.placeholder = 'หมายเหตุ'" class="single-input" value="{{ old('comment') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <label for="file-upload" class="custom-file-upload" style=" padding-right:254px;">
                            <i class="fa fa-cloud-upload"></i> รูปภาพ
                        </label>
                        <input id="file-upload" name="image" type="file" class="form-control"/>
                    </div>
                    <div class="mt-10 col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="containerRadio">
                                    <p>food</p> 
                                    <input name="reward_type" type="radio" value="food" {{(old('reward_type') == 'food') ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="containerRadio">
                                    <p>gadget</p> 
                                    <input name="reward_type" type="radio" value="gadget" {{(old('reward_type') == 'gadget') ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="col-md-4">
                                <label class="containerRadio">
                                    <p>other</p> 
                                    <input name="reward_type" type="radio" value="other" {{(old('reward_type') == 'other') ? 'checked' : ''}}>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div><br>
                <h2>รายละเอียด <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <textarea name="detail" class="single-textarea" value="ไม่มีรายละเอียด" required>ไม่มีรายละเอียด</textarea>
                <br>
                <button class="genric-btn info radius">เพิ่มของรางวัล</button>
                <br><br>
            </form>
        </div>
    </div>
    <div class="col-lg-2 col-md-2"></div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

  
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

    // date
        $('#datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());

    $('#expirepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
    $('#expirepicker').datepicker("setDate", '+2m');

</script>
@endsection

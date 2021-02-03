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
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">แก้ไขข้อมูลพันธมิตร</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <form action="{{url('/admin/alliance-update')}}" enctype="multipart/form-data" method="post">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))

                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                <h2>ข้อมูลพันธมิตร <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="name" placeholder="ชื่อ" onfocus="this.placeholder = 'ชื่อ'" class="single-input" value="{{$alliance->name}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="store_name" placeholder="username" onfocus="this.placeholder = 'username'" class="single-input" value="{{$alliance->store_name}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="type" placeholder="ประเภทพันธมิตร" onfocus="this.placeholder = 'ประเภทพันธมิตร'" class="single-input" value="{{$alliance->type}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="tel" placeholder="เบอร์โทรศัพท์" onfocus="this.placeholder = 'เบอร์โทรศัพท์'" class="phone_format single-input" value="{{$alliance->tel}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" data-date-format="dd/mm/yyyy" name="date" placeholder="วันที่เริ่มใช้โปรโมชั่น" onfocus="this.placeholder = 'วันที่เริ่มใช้โปรโมชั่น'" class="single-input" value="{{$alliance->date}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" data-date-format="dd/mm/yyyy" name="expire" placeholder="วันหมดอายุโปรโมชั่น" onfocus="this.placeholder = 'วันหมดอายุโปรโมชั่น'" class="single-input" value="{{$alliance->expire}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="comment" placeholder="หมายเหตุ" onfocus="this.placeholder = 'หมายเหตุ'" class="single-input" value="{{$alliance->comment}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <label for="image" style="font-family: 'Prompt' !important;"><i class="fa fa-cloud-upload"></i> อัพโหลดรูปภาพ</label>
                        <input type="file" id="image" name="image" class="form-control" value="{{$alliance->image}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <label for="lg" style="font-family: 'Prompt' !important;"><i class="fa fa-cloud-upload"></i> อัพโหลดโลโก้</label>
                        <input type="file" id="lg" name="logo" class="form-control" value="{{$alliance->logo}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <label for="scan" style="font-family: 'Prompt' !important;"><i class="fa fa-cloud-upload"></i> อัพโหลดรูปสแกน</label>
                        <input type="file" id="scan" name="scan" class="form-control" value="{{$alliance->scan}}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <h3>คะแนนสะสม <i class="fa fa-caret-right" style="color:#777777;"></i></h3><br>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>5</p> 
                            <input name="point" type="radio" name="radio" value="5" {{ $alliance->point == '5' ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>10</p> 
                            <input name="point" type="radio" name="radio" value="10" {{ $alliance->point == '10' ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>15</p> 
                            <input name="point" type="radio" name="radio" value="15"  {{ $alliance->point == '15' ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-12">
                        <input type="text" name="location" placeholder="สถานที่" onfocus="this.placeholder = 'สถานที่'" class="single-input" value="{{$alliance->location}}">
                    </div>
                </div><br>
                <h2>สิทธิพิเศษ <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <textarea name="promotion" class="single-textarea" required>{{$alliance->promotion}}</textarea>
                <br>
                <input type="hidden" name="id" value="{{$alliance->id}}">
                <button class="genric-btn info radius">แก้ไขข้อมูลพันธมิตร</button>
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

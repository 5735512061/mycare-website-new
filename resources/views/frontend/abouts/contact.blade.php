@extends("/frontend/layouts/template/template-bg")

@section("content")

@include("/frontend/layouts/header/about/header-contact")

<div class="container">
    <div class="row">
        <div class="col-md-2 col-12"></div>
        <div class="col-md-8 col-12">
            <h2 class="h2-design"><i class="fa fa-phone-square" aria-hidden="true"></i> โทร : 082-628-2244</h2>
        </div>
        <div class="col-md-2 col-12"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))

                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
            </div>
            <form action="{{url('/about/contact')}}" enctype="multipart/form-data" method="post">@csrf
                <div class="mt-10">
                    <input id="ssn" maxlength="19" minlength="19" type="text" name="serialnumber" placeholder="หมายเลขสมาชิก (สำหรับสมาชิก MY CARE)" onblur="this.placeholder = 'หมายเลขสมาชิก (สำหรับสมาชิก MY CARE)'"
                     required class="single-input">
                </div>
                <div class="mt-10">
                    <input type="text" name="name" placeholder="ชื่อ-นามสกุล" onblur="this.placeholder = 'ชื่อ-นามสกุล'"
                     required class="single-input">
                </div>
                <div class="mt-10">
                    <input type="text" name="tel" placeholder="เบอร์โทรศัพท์" onblur="this.placeholder = 'เบอร์โทรศัพท์'"
                     required class="phone_format single-input">
                </div>

                <div class="mt-10">
                    <textarea name="message" class="single-textarea" placeholder="ข้อความที่ต้องการส่ง" onblur="this.placeholder = 'ข้อความที่ต้องการส่ง'"
                     required></textarea>
                </div>
                <br>
                <button class="genric-btn info radius">ส่งข้อความ</button>
                <br><br>
            </form>
        </div>
    </div>
    <div class="col-lg-2 col-md-2"></div>
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
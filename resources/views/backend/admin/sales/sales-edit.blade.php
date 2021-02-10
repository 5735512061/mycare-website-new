@extends("/backend/layouts/template/template")
<link rel="stylesheet" href="{{asset('jquery.Thailand.js/dist/jquery.Thailand.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/mycare/style/member-register.css')}}">
@section("content")
<style>
    .alertdesign {
        text-align: center;
        border-style: solid;
        font-size: 20px;
    }
</style>

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 class="" style="font-size:2rem; color:#000085 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> แก้ไขข้อมูลสมาชิก</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>

<!-- End banner Area -->

<div class="container" style="background-color: #fff;">
    <div class="row" style="margin-top:-90px !important;">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <form action="{{url('/admin/sales-update')}}" enctype="multipart/form-data" method="post">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                      <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                <h3 style="font-weight: normal !important;">ข้อมูลผู้สมัครสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="mt-12 col-md-12">
                        @if ($errors->has('serialnumber'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('serialnumber') }})</span>
                        @endif
                        <input type="text" id="ssn" maxlength="19" minlength="19" name="serialnumber" class="single-input" value="{{$member->serialnumber}}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="mt-12 col-md-12">
                        @if ($errors->has('card_id'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('card_id') }})</span>
                        @endif
                        <input type="text" onkeyup="autoTab(this)" id="txtID" name="card_id" placeholder="* กรอกหมายเลขบัตรประชาชน 13 หลัก" onfocus="this.placeholder = '* กรอกหมายเลขบัตรประชาชน 13 หลัก'" class="single-input" value="{{$member->card_id}}">
                    </div>
                </div><br>
                @if ($errors->has('title'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('title') }})</span>
                @endif
                <div class="row">
                    <div class="col-md-3 col-12">
                        <h3 style="font-weight: normal !important;">คำนำหน้า <i class="fa fa-caret-right" style="color:#777777;"></i></h3><br>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นาย</p> 
                            <input name="title" type="radio" name="radio" value="นาย" {{ $member->title == 'นาย' ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นาง</p> 
                            <input name="title" type="radio" name="radio" value="นาง" {{ $member->title == 'นาง' ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นางสาว</p> 
                            <input name="title" type="radio" name="radio" value="นางสาว" {{ $member->title == 'นางสาว' ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('name'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                        @endif
                        <input type="text" name="name" placeholder="* ชื่อ ตามบัตรประชาชน" onfocus="this.placeholder = '* ชื่อ ตามบัตรประชาชน'" class="single-input" value="{{ $member->name }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('surname'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                        @endif
                        <input type="text" name="surname" placeholder="* นามสกุล ตามบัตรประชาชน" onfocus="this.placeholder = '* นามสกุล ตามบัตรประชาชน'" class="single-input" value="{{ $member->surname }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('bday'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('bday') }})</span>
                        @endif
                        <input type="text" name="bday" placeholder="* วัน/เดือน/ปี ค.ศ เกิด" onfocus="this.placeholder = '* วัน/เดือน/ปี ค.ศ เกิด'" class="single-input" value="{{ $member->bday }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('tel'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('tel') }})</span>
                        @endif
                        <input type="text" name="tel" placeholder="* เบอร์โทรติดต่อ" onfocus="this.placeholder = '* เบอร์โทรติดต่อ'" class="phone_format single-input" value="{{ $member->tel }}">
                    </div>
                    <div class="row">
                        <div class="large-7 small-12 column">
                            <input data-date-format="dd/mm/yyyy" id="datepicker" name="date" type="hidden" value="{{ $member->date }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-7 small-12 column">
                            <input data-date-format="dd/mm/yyyy" id="expirepicker" name="expire" type="hidden" value="{{ $member->expire }}">
                        </div>
                    </div>
                </div><br>
                <h3 style="font-weight: normal !important;">ที่อยู่สำหรับจัดส่งเอกสาร <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('address'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                        @endif
                        <input type="text" name="address" placeholder="* บ้านเลขที่" onfocus="this.placeholder = '* บ้านเลขที่'" class="single-input" value="{{ $member->address }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('moo'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('moo') }})</span>
                        @endif
                        <input type="text" name="moo" placeholder="หมู่" onfocus="this.placeholder = 'หมู่'" class="single-input" value="{{ $member->moo }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('village'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('village') }})</span>
                        @endif
                        <input type="text" name="village" placeholder="ชื่ออาคาร/หมู่บ้าน" onfocus="this.placeholder = 'ชื่ออาคาร/หมู่บ้าน'" class="single-input" value="{{ $member->village }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('road'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('road') }})</span>
                        @endif
                        <input type="text" name="road" placeholder="ซอย/ถนน" onfocus="this.placeholder = 'ซอย/ถนน'" class="single-input" value="{{ $member->road }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('district'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('district') }})</span>
                        @endif
                        <input type="text" name="district" placeholder="* ตำบล" onfocus="this.placeholder = '* ตำบล'" class="single-input" value="{{ $member->district }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('amphoe'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amphoe') }})</span>
                        @endif
                        <input type="text" name="amphoe" placeholder="* อำเภอ" onfocus="this.placeholder = '* อำเภอ'" class="single-input" value="{{ $member->amphoe }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('province'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                        @endif
                        <input type="text" name="province" placeholder="* จังหวัด" onfocus="this.placeholder = '* จังหวัด'" class="single-input" value="{{ $member->province }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('zipcode'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('zipcode') }})</span>
                        @endif
                        <input type="text" name="zipcode" placeholder="* รหัสไปรษณีย์" onfocus="this.placeholder = '* รหัสไปรษณีย์'" class="single-input" value="{{ $member->zipcode }}">
                    </div>
                </div><br>
                <h3 style="font-weight: normal !important;">หลักฐานการใช้บริการ <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('file'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('file') }})</span>
                        @endif
                        <label for="file-upload" class="custom-file-upload" style="padding-right:64px; padding-left:60px;">
                            <i class="fa fa-cloud-upload"></i> อัพโหลดหลักฐานการใช้บริการ
                        </label>
                        <input id="file-upload" name="file" type="file" class="form-control" value="{{$member->file}}"/>
                    </div>
                </div>
                <br>
                <input type="hidden" name="id" value="{{$member->id}}">
                <button class="genric-btn info radius">อัพเดตข้อมูลสมาชิกเซลล์</button>
                <br><br>
            </form>
        </div>
    </div>
    <div class="col-lg-2 col-md-2"></div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  
<script>
    //bday
    $('#bdaypicker').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
    $('#bdaypicker').datepicker("setDate", new Date());
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
    $('#expirepicker').datepicker("setDate", '+90d');

</script>
<script language="javascript">
    //เมื่อมีการคลิกฟังก์ชัน
    $(function (){
     $('.btn_sub').click(function (){
       if($('#txtID').val().trim()==''){
        $('#msg').text('กรุณากรอกเลขประจำตัว');
        $('#txtID').focus();
       }else{
        //checkID($('#txtID').val() จะไปเรียกฟังก์ชัน  checkID(id)
        if(!checkID($('#txtID').val().trim())){
         alert('รหัสประชาชนไม่ถูกต้อง');
         return false;
        }
       }
     });
    });
    
    //ตรวจสอบเลข ปปช ว่ามีจริงหรือไม่
    function checkID(id)
    {
    
    //ตัดข้อความ - ออก
    var zid = id;
    var zids = zid.split("-");
    for(var i=0;i<zids.length;i++){
     zids[i];
    }
    var id_val = zids[0]+zids[1]+zids[2]+zids[3]+zids[4];
    
    if(id_val.length != 13) return false;
    for(i=0, sum=0; i < 12; i++)
    sum += parseFloat(id_val.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id_val.charAt(12)))
    return false; return true;
    }
    
    //ฟังก์ชัน รูปแบบ
    function autoTab(obj){
     /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
     หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
     4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
     รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
     หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
     ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
     */
      var pattern=new String("_-____-_____-_-__"); // กำหนดรูปแบบในนี้
      var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
      var returnText=new String("");
      var obj_l=obj.value.length;
      var obj_l2=obj_l-1;
      for(i=0;i<pattern.length;i++){   
       if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){
        returnText+=obj.value+pattern_ex;
        obj.value=returnText;
       }
      }
      if(obj_l>=pattern.length){
       obj.value=obj.value.substr(0,pattern.length);   
      }
    }  
</script>
<script>
    var checker = document.getElementById('checkme');
    var sendbtn = document.getElementById('sendNewSms');
    // when unchecked or checked, run the function
    checker.onchange = function(){
    if(this.checked){
    sendbtn.disabled = false;   
    } else {
    sendbtn.disabled = true;
    }

}
</script>
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
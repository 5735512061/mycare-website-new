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
				<h2 style="text-align:center; color:#092895;">เพิ่มป้ายทะเบียน</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-md-2 col-12"></div>
        <div class="col-md-8 col-12">
            <div style="text-align:left; font-size:70px;">
                <i class="fa fa-caret-right" style="color:#d4d3d3;"></i><i class="fa fa-caret-left"></i>
            </div>
        </div>
        <div class="col-md-2 col-12"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <form action="{{url('/admin/member/create-member')}}" enctype="multipart/form-data" method="post">@csrf
                <h2>ข้อมูลผู้สมัครสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <div class="row">
                    <div class="mt-12 col-md-12">
                        <input type="text" id="ssn" maxlength="19" minlength="19" name="serialnumber" placeholder="กรอกหมายเลขบัตรสมาชิก 16 หลัก" onfocus="this.placeholder = 'กรอกหมายเลขบัตรสมาชิก 16 หลัก'" class="single-input" value="{{$member->serialnumber}}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="mt-12 col-md-12">
                        <input type="text" onkeyup="autoTab(this)" id="txtID" name="card_id" placeholder="กรอกหมายเลขบัตรประชาชน 13 หลัก" onfocus="this.placeholder = 'กรอกหมายเลขบัตรประชาชน 13 หลัก'" class="single-input" value="{{$member->card_id}}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <h3>คำนำหน้า <i class="fa fa-caret-right" style="color:#777777;"></i></h3><br>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นาย</p> 
                            <input name="title" type="radio" name="radio" value="นาย" {{ $member->title == 'นาย' ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นาง</p> 
                            <input name="title" type="radio" name="radio" value="นาง" {{ $member->title == 'นาง' ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นางสาว</p> 
                            <input name="title" type="radio" name="radio" value="นางสาว" {{ $member->title == 'นางสาว' ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="name" placeholder="ชื่อ" onfocus="this.placeholder = 'ชื่อ'" class="single-input" value="{{$member->name}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="surname" placeholder="นามสกุล" onfocus="this.placeholder = 'นามสกุล'" class="single-input" value="{{$member->surname}}">
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="bday" placeholder="วัน/เดือน/ปี ค.ศ เกิด" onfocus="this.placeholder = 'วัน/เดือน/ปี ค.ศ เกิด'" class="single-input" value="{{$member->bday}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="tel" placeholder="เบอร์โทรติดต่อ" onfocus="this.placeholder = 'เบอร์โทรติดต่อ'" class="phone_format single-input" value="{{$member->tel}}">
                    </div>
                    <div class="row">
                        <div class="large-7 small-12 column">
                            <input data-date-format="dd/mm/yyyy" id="datepicker" name="date" type="hidden" value="{{$member->date}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-7 small-12 column">
                            <input data-date-format="dd/mm/yyyy" id="expirepicker" name="expire" type="hidden" value="{{$member->expire}}">
                        </div>
                    </div>
                </div><br>

                <input type="hidden" name="address" value="{{$member->address}}">
                <input type="hidden" name="moo" value="{{$member->moo}}">
                <input type="hidden" name="district" value="{{$member->district}}">
                <input type="hidden" name="amphoe" value="{{$member->amphoe}}">
                <input type="hidden" name="province" value="{{$member->province}}">
                <input type="hidden" name="education" value="{{$member->education}}">
                <input name="career" type="hidden" value="{{$member->career}}">
                <input name="salary" type="hidden" value="{{$member->salary}}">

                <div class="mt-10 col-md-6">
                    <input type="hidden" name="zipcode" class="single-input" value="{{$member->zipcode}}">
                </div>
                <h2>เพิ่มข้อมูลรถ <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <div class="row">
                    <div class="mt-12 col-md-6">
                        <input type="text" name="carnumber" placeholder="ทะเบียนรถ" onfocus="this.placeholder = 'ทะเบียนรถ'" class="single-input">
                    </div>
                    <div class="mt-12 col-md-6">
                        <input type="text" name="carprovince" placeholder="จังหวัด" onfocus="this.placeholder = 'จังหวัด'" class="single-input">
                    </div>
                    
                </div><br>
                <div class="row">
                    <div class="mt-12 col-md-4">
                        <input type="text" name="miles" placeholder="เลขไมล์" onfocus="this.placeholder = 'เลขไมล์'" class="single-input">
                    </div>
                    <div class="mt-12 col-md-4">
                        <input type="text" name="brand" placeholder="ยี่ห้อรถ" onfocus="this.placeholder = 'ยี่ห้อรถ'" class="single-input">
                    </div>
                    <div class="mt-12 col-md-4">
                        <input type="text" name="model" placeholder="รุ่นรถ" onfocus="this.placeholder = 'รุ่นรถ'" class="single-input">
                    </div>
                </div><br>
                <div class="row">
                    <div class="mt-12 col-md-4">
                        <input type="text" name="color" placeholder="สีรถ" onfocus="this.placeholder = 'สีรถ'" class="single-input">
                    </div>
                    <div class="mt-12 col-md-4">
                        <input type="text" name="comment" placeholder="หมายเหตุ" onfocus="this.placeholder = 'หมายเหตุ'" class="single-input">
                    </div>
                </div><br>
                <input type="hidden" name="status" value="online">
                <input type="hidden" name="membertype" value="{{$member->membertype}}">
                <input type="hidden" name="id" value="{{$member->id}}">
                <button class="genric-btn info radius">เพิ่มป้ายทะเบียน</button>
                <br><br>
            </form>
        </div>
    </div>
    <div class="col-lg-2 col-md-2"></div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>
<script type="text/javascript" src="{{asset('jquery.Thailand.js/dependencies/zip.js/zip.js')}}"></script>
<script type="text/javascript" src="{{asset('jquery.Thailand.js/dependencies/JQL.min.js')}}"></script>
<script type="text/javascript" src="{{asset('jquery.Thailand.js/dependencies/typeahead.bundle.js')}}"></script>
<script type="text/javascript" src="{{asset('jquery.Thailand.js/dist/jquery.Thailand.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
         m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-33058582-1', 'auto', {
          'name': 'Main'
        });
        ga('Main.send', 'event', 'jquery.Thailand.js', 'GitHub', 'Visit');
  </script>
  
  <script type="text/javascript">
    $.Thailand({
      database: '{{asset('jquery.Thailand.js/database/db.json')}}',
      $district: $('#demo1 [name="district"]'),
      $amphoe: $('#demo1 [name="amphoe"]'),
      $province: $('#demo1 [name="province"]'),
      $zipcode: $('#demo1 [name="zipcode"]'),
        onDataFill: function(data){
          console.info('Data Filled', data);
        },
        onLoad: function(){
          console.info('Autocomplete is ready!');
          $('#loader, .demo').toggle();
        }
    });
  
    $('#demo1 [name="district"]').change(function(){
      console.log('ตำบล', this.value);
    });
    $('#demo1 [name="amphoe"]').change(function(){
      console.log('อำเภอ', this.value);
    });
    $('#demo1 [name="province"]').change(function(){
      console.log('จังหวัด', this.value);
    });
    $('#demo1 [name="zipcode"]').change(function(){
      console.log('รหัสไปรษณีย์', this.value);
    });
  </script>
  
<script>
    $(document).ready(function(){
      $("#condition").click(function(){
        $("#condition2").slideToggle();
      });
    });
    //bday
    $('#bdaypicker').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
    $('#bdaypicker').datepicker("setDate", new Date());

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
    $('#expirepicker').datepicker("setDate", '+12m');

</script>

<script language="javascript">
    //เมื่อมีการคลิกฟังก์ชัน
    $(function (){
     $('#btn_sub').click(function (){
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
@endsection
@extends("/frontend/layouts/template/template-bg")
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
		<div class="row fullscreen d-flex align-items-center justify-content-between" style="height:450px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
                <center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;">แก้ไขข้อมูลส่วนตัว</h2></center>
                <hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<div class="container">
    <div class="row" style="margin-top:-90px !important;">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <form action="{{url('/member/profile-update')}}" enctype="multipart/form-data" method="post">@csrf
                <h2>ข้อมูลส่วนตัวสมาชิก <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="name" class="single-input" value="{{$member->name}}" readonly>
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="surname" class="single-input" value="{{$member->surname}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="bday" class="single-input" value="{{$member->bday}}" readonly>
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="tel" placeholder="เบอร์โทรติดต่อ" onfocus="this.placeholder = 'เบอร์โทรติดต่อ'" class="phone_format single-input" value="{{$member->tel}}">
                    </div>
                </div><br>
                <h2>ที่อยู่ปัจจุบัน <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="address" placeholder="ที่อยู่" onfocus="this.placeholder = 'ที่อยู่'" class="single-input" value="{{$member->address}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="moo" placeholder="หมู่ที่" onfocus="this.placeholder = 'หมู่ที่'" class="single-input" value="{{$member->moo}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="district" placeholder="ตำบล" onfocus="this.placeholder = 'ตำบล'" class="single-input" value="{{$member->district}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="amphoe" placeholder="อำเภอ" onfocus="this.placeholder = 'อำเภอ'" class="single-input" value="{{$member->amphoe}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="province" placeholder="จังหวัด" onfocus="this.placeholder = 'จังหวัด'" class="single-input" value="{{$member->province}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="zipcode" placeholder="รหัสไปรษณีย์" onfocus="this.placeholder = 'รหัสไปรษณีย์'" class="single-input" value="{{$member->zipcode}}">
                    </div>
                </div><br>
                <input type="hidden" name="id" value="{{$member->id}}">
                <button class="genric-btn info radius">อัพเดตข้อมูลส่วนตัว</button>
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
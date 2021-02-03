@extends("/backend/layouts/template/template-staff")
<link rel="stylesheet" href="{{asset('jquery.Thailand.js/dist/jquery.Thailand.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@section("content")
<style>
    .alertdesign {
        text-align: center;
        border-style: solid;
        font-size: 20px;
    }
</style>
@include("/frontend/layouts/header/member/header-register")
<div class="container" style="background-color: #fff;">
    <div class="row" style="margin-top:-90px !important;">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <form action="{{url('/member/register')}}" enctype="multipart/form-data" method="post">@csrf
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
                        @if ($errors->has('card_id'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('card_id') }})</span>
                        @endif
                        <input type="text" onkeyup="autoTab(this)" id="txtID" name="card_id" placeholder="* กรอกหมายเลขบัตรประชาชน 13 หลัก" onfocus="this.placeholder = '* กรอกหมายเลขบัตรประชาชน 13 หลัก'" class="single-input" value="{{ old('card_id') }}">
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
                            <input name="title" type="radio" name="radio" value="นาย" {{(old('title') == 'นาย') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นาง</p> 
                            <input name="title" type="radio" name="radio" value="นาง" {{(old('title') == 'นาง') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-3 col-4">
                        <label class="containerRadio">
                            <p>นางสาว</p> 
                            <input name="title" type="radio" name="radio" value="นางสาว" {{(old('title') == 'นางสาว') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('name'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('name') }})</span>
                        @endif
                        <input type="text" name="name" placeholder="* ชื่อ ตามบัตรประชาชน" onfocus="this.placeholder = '* ชื่อ ตามบัตรประชาชน'" class="single-input" value="{{ old('name') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('surname'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('surname') }})</span>
                        @endif
                        <input type="text" name="surname" placeholder="* นามสกุล ตามบัตรประชาชน" onfocus="this.placeholder = '* นามสกุล ตามบัตรประชาชน'" class="single-input" value="{{ old('surname') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('bday'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('bday') }})</span>
                        @endif
                        <input type="text" name="bday" placeholder="* วัน/เดือน/ปี ค.ศ เกิด" onfocus="this.placeholder = '* วัน/เดือน/ปี ค.ศ เกิด'" class="single-input" value="{{ old('bday') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('tel'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('tel') }})</span>
                        @endif
                        <input type="text" name="tel" placeholder="* เบอร์โทรติดต่อ" onfocus="this.placeholder = '* เบอร์โทรติดต่อ'" class="phone_format single-input" value="{{ old('tel') }}">
                    </div>
                    <div class="row">
                        <div class="large-7 small-12 column">
                            <input data-date-format="dd/mm/yyyy" id="datepicker" name="date" type="hidden" value="{{ old('date') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-7 small-12 column">
                            <input data-date-format="dd/mm/yyyy" id="expirepicker" name="expire" type="hidden" value="{{ old('expire') }}">
                        </div>
                    </div>
                </div><br>
                <h3 style="font-weight: normal !important;">ที่อยู่สำหรับจัดส่งเอกสาร <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('address'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('address') }})</span>
                        @endif
                        <input type="text" name="address" placeholder="* บ้านเลขที่" onfocus="this.placeholder = '* บ้านเลขที่'" class="single-input" value="{{ old('address') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('moo'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('moo') }})</span>
                        @endif
                        <input type="text" name="moo" placeholder="หมู่" onfocus="this.placeholder = 'หมู่'" class="single-input" value="{{ old('moo') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('village'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('village') }})</span>
                        @endif
                        <input type="text" name="village" placeholder="ชื่ออาคาร/หมู่บ้าน" onfocus="this.placeholder = 'ชื่ออาคาร/หมู่บ้าน'" class="single-input" value="{{ old('village') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('road'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('road') }})</span>
                        @endif
                        <input type="text" name="road" placeholder="ซอย/ถนน" onfocus="this.placeholder = 'ซอย/ถนน'" class="single-input" value="{{ old('road') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('district'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('district') }})</span>
                        @endif
                        <input type="text" name="district" placeholder="* ตำบล" onfocus="this.placeholder = '* ตำบล'" class="single-input" value="{{ old('district') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('amphoe'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amphoe') }})</span>
                        @endif
                        <input type="text" name="amphoe" placeholder="* อำเภอ" onfocus="this.placeholder = '* อำเภอ'" class="single-input" value="{{ old('amphoe') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('province'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('province') }})</span>
                        @endif
                        <input type="text" name="province" placeholder="* จังหวัด" onfocus="this.placeholder = '* จังหวัด'" class="single-input" value="{{ old('province') }}">
                    </div>
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('zipcode'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('zipcode') }})</span>
                        @endif
                        <input type="text" name="zipcode" placeholder="* รหัสไปรษณีย์" onfocus="this.placeholder = '* รหัสไปรษณีย์'" class="single-input" value="{{ old('zipcode') }}">
                    </div>
                </div><br>
                @if ($errors->has('education'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('education') }})</span>
                @endif
                <h3 style="font-weight: normal !important;">การศึกษา <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>ต่ำกว่ามัธยม</p> 
                            <input name="education" type="radio" name="radio" value="ต่ำกว่ามัธยม" {{(old('education') == 'ต่ำกว่ามัธยม') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>มัธยมศึกษา</p> 
                            <input name="education" type="radio" name="radio" value="มัธยมศึกษา" {{(old('education') == 'มัธยมศึกษา') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>ปวช./ปวส.</p> 
                            <input name="education" type="radio" name="radio" value="ปวช./ปวส." {{(old('education') == 'ปวช./ปวส.') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>ปริญญาตรี</p> 
                            <input name="education" type="radio" name="radio" value="ปริญญาตรี" {{(old('education') == 'ปริญญาตรี') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>ปริญญาโท</p> 
                            <input name="education" type="radio" name="radio" value="ปริญญาโท" {{(old('education') == 'ปริญญาโท') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>ปริญญาเอก</p> 
                            <input name="education" type="radio" name="radio" value="ปริญญาเอก" {{(old('education') == 'ปริญญาเอก') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div><br>
                @if ($errors->has('career'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('career') }})</span>
                @endif
                <h3 style="font-weight: normal !important;">ปัจจุบันประกอบอาชีพ <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>นักเรียน/นักศึกษา</p> 
                            <input name="career" type="radio" name="radio" value="นักเรียน/นักศึกษา" {{(old('career') == 'นักเรียน/นักศึกษา') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>พนักงานบริษัท</p> 
                            <input name="career" type="radio" name="radio" value="พนักงานบริษัท" {{(old('career') == 'พนักงานบริษัท') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>ราชการ/รัฐวิสาหกิจ</p> 
                            <input name="career" type="radio" name="radio" value="ราชการ/รัฐวิสาหกิจ" {{(old('career') == 'ราชการ/รัฐวิสาหกิจ') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>ธุรกิจส่วนตัว</p> 
                            <input name="career" type="radio" name="radio" value="ธุรกิจส่วนตัว" {{(old('career') == 'ธุรกิจส่วนตัว') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4 col-6">
                        <label class="containerRadio">
                            <p>อื่นๆ</p> 
                            <input name="career" type="radio" name="radio" value="อื่นๆ" {{(old('career') == 'อื่นๆ') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div><br>
                @if ($errors->has('salary'))
                    <span class="text-danger" style="font-size: 17px;">({{ $errors->first('salary') }})</span>
                @endif
                <h3 style="font-weight: normal !important;">รายได้บุคคลต่อเดือน <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="col-md-4">
                        <label class="containerRadio">
                            <p>น้อยกว่า 15,000</p> 
                            <input name="salary" type="radio" name="radio" value="น้อยกว่า 15,000" {{(old('salary') == 'น้อยกว่า 15,000') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="containerRadio">
                            <p>15,000 - 29,999</p> 
                            <input name="salary" type="radio" name="radio" value="15,000-29,999" {{(old('salary') == '15,000-29,999') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="containerRadio">
                            <p>30,000 - 49,999</p> 
                            <input name="salary" type="radio" name="radio" value="30,000-49,999" {{(old('salary') == '30,000-49,999') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="containerRadio">
                            <p>50,000 - 69,999</p> 
                            <input name="salary" type="radio" name="radio" value="50,000-69,999" {{(old('salary') == '50,000-69,999') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="containerRadio">
                            <p>70,000 - 99,999</p> 
                            <input name="salary" type="radio" name="radio" value="70,000-99,999" {{(old('salary') == '70,000-99,999') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="containerRadio">
                            <p>มากกว่า 100,000</p> 
                            <input name="salary" type="radio" name="radio" value="มากกว่า 100,000" {{(old('salary') == 'มากกว่า 100,000') ? 'checked' : ''}}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <input type="hidden" name="status" value="online">
                    <input type="hidden" name="membertype" value="สมัครผ่านเว็บไซต์">
                </div><br>
                <h3 style="font-weight: normal !important;">หลักฐานการใช้บริการ <i class="fa fa-caret-down" style="color:#777777;"></i></h3><br>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        @if ($errors->has('slip'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('slip') }})</span>
                        @endif
                        <label for="file-upload" class="custom-file-upload" style="padding-right:64px; padding-left:60px;">
                            <i class="fa fa-cloud-upload"></i> อัพโหลดหลักฐานการใช้บริการ
                        </label>
                        <input id="file-upload" name="slip" type="file" class="form-control" value="{{old('slip')}}"/>
                    </div>
                    {{-- <div class="mt-10 col-md-6">
                        <div class="default-select" id="default-select">
                            <select name="bank" style="padding-right:20px; padding-left:20px;">
                                <option value="KBank">ธนาคารกสิกรไทย (482-2-19423-6)</option>
                            </select>
                        </div>
                    </div> --}}
                    {{-- <div class="mt-10 col-md-4">
                        <input type="text" name="money" placeholder="จำนวนเงินที่ชำระ 799.-" onfocus="this.placeholder = 'จำนวนเงินที่ชำระ 799.-'" class="single-input" value="{{ old('money') }}" readonly>
                    </div>
                    <div class="mt-10 col-md-4">
                        @if ($errors->has('payday'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('payday') }})</span>
                        @endif
                        <input type="text" name="payday" placeholder="* วัน/เดือน/ปี ที่ชำระเงิน" onfocus="this.placeholder = '* ตัวอย่าง 01/01/2563'" class="single-input" value="{{ old('payday') }}">
                    </div>
                    <div class="mt-10 col-md-4">
                        @if ($errors->has('time'))
                            <span class="text-danger" style="font-size: 17px;">({{ $errors->first('time') }})</span>
                        @endif
                        <input type="text" name="time" placeholder="* เวลาที่ชำระเงิน" onfocus="this.placeholder = '* ตัวอย่าง 13.25น.'" class="single-input" value="{{ old('time') }}">
                    </div> --}}
                </div>
                <br>
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
                <p><input type="checkbox" id="checkme" name="contidion" value="accept"> ยอมรับเงื่อนไขในการสมัครเป็นสมาชิก MY CARE</p>
                {{-- <div class="panel-body">
                    <h3 style="font-weight: normal !important;">เงื่อนไขและข้อกำหนดในการสมัครบัตร MY CARE</h3>
                    <p>บริษัท เอกการยางออโต้เซอร์วิส จำกัด ผู้ออกบัตรเรียกว่า "บริษัทฯ" ผู็ถือบัตรเรียกว่า "สมาชิก" ขอให้ทางบริษัทฯ ออกบัตรสมาชิก</p>
                    <span class="tab-number">1. สมาชิกยอมรับและตกลงว่า ข้อมูลทั้งหมดที่ใช้ในการสมัครบัตรสมาชิก MY CARE เป็นข้อมลูที่ถูกต้อง 
                        ตามความเป็นจริง กรณีที่ตรวจสอบข้อมูลไม่ตรงกับความเป็นจริง ทางบริษัทฯ ขอสงวนสิทธิ์ในการยกเลิกบัตรรวมทั้งสิทธิประโยชน์ทั้งหมด
                    </span><br>
                    <span class="tab-number">2. สมาชิกตกลง และยินยอมให้บริษัทฯ ใช้หรือเปิดเผยข้อมูลส่วนบุคคลของสมาชิก สำหรับการแจ้งข่าวสาร 
                        และกิจกรรมส่งเสริมการขายเกี่ยวกับผลิตภัณฑ์หรือบริการของทางบริษัท และใช้สำหรับการทำธุรกรรมกับบริษัทฯ ในลักษณะที่เป็นประโยชน์กับสมาชิก
                    </span><br>
                    <span class="tab-number">3. บัตรสมาชิก MY CARE ใช้เพื่อเป็นส่วนลดสินค้า สะสมคะแนน จากการใช้บริการร้านค้าพันธมิตรที่เข้าร่วม
                        กับทางบัตร MY CARE เท่านั้น ซึ่งกำหนดไว้ในแต่ละช่วงระยะเวลานั้นๆ
                    </span><br>
                    <span class="tab-number">4. คะแนนสะสมในบัตรสมาชิก MY CARE นี้ไม่สามารถแลก เปลี่ยน หรือทอนเป็นเงินสดได้</span><br>
                    <span class="tab-number">5. คะแนนสะสมและสิทธิประโยชน์ในบัตร MY CARE นี้ไม่สามารถโอนไปเป็นของบัตรอื่นได้ (ยกเว้นในกรณีออกบัตรทดแทนบัตรเดิม)</span><br>
                    <span class="tab-number">6. สมาชิกต้องแจ้งให้บริษัทฯ ทราบเมื่อมีการเปลี่ยนแปลงข้อมูลส่วนบุคคลเพื่อรักษาผลประโยชน์ของสมาชิก</span><br>
                    <span class="tab-number">7. ของรางวัลที่กำหนดให้แลกนั้น บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงของรางวัลที่มีมูลค่าเท่าเทียม 
                        หรือมีคุณภาพใกล้เคียงกันแทนของรางวัลเดิมโดยไม่ต้องแจ้งให้ทราบล่วงหน้า
                    </span><br>
                    <span class="tab-number">8. กรณีบัตรสมาชิก MY CARE ชำรุดสมาชิกต้องนำบัตรเก่ามาเปลี่ยนบัตรใบใหม่โดยไม่เสียค่าใช้จ่าย(ตัวเลขสมาชิก 16 หลักจาง หลุด ลอก จากตัวบัตร) 
                        ในกรณีสูญหาย สมาชิก สามารถติดต่อ ลูกค้าสัมพันธ์ Call center 082 628 2244 เพื่อขอรับบัตรใหม่ โดยจะมีค่าธรรมเนียม 
                        พร้อมกับโอนคะแนนที่เหลือไปยังบัตรใหม่ ดำเนินการยกเลิกบัตรเก่า และจัดส่งบัตรใหม่ให้สมาชิกภายใน 15 วัน นับจากวันที่ติดต่อลูกค้า
                    </span><br>
                    <span class="tab-number">9. บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงเงื่อนไขการใช้บัตรสมาชิก MY CARE คะแนนสะสมของบัตรสมาชิก MY CARE การแลกคะแนน สินค้า/บริการ 
                        และร้านค้าที่เข้าร่วมโครงการโดยไม่ต้องแจ้งให้ทราบล่วงหน้า
                    </span><br>
                    <span class="tab-number">10. กรณีสมาชิกปฎิบัติผิดเงื่อนไขการใช้บัตร บริษัทฯ มีสิทธิยกเลิกบัตรได้ทันทีโดยไม่ต้องแจ้งล่วงหน้า ทั้งนี้ การยกเลิกบัตรดังกล่าวให้มีผลเป็นการยกเลิกคะแนนสะสมที่สมาชิกมีอยู่ทั้งหมดทันทีด้วย 
                        และถือว่าบริษัทฯ ไม่มีภาระผูกพัน หนี้ หรือหน้าที่ในการจ่ายเงินทดแทนใดๆ จากคะแนนสะสมที่มีอยู่ให้แก่สมาชิก และสมาชิกจะไม่สามารถอ้างสิทธิใดๆ กับบริษัทฯ ได้
                    </span><br><br>
                </div>  --}}
                <button class="genric-btn info radius btn_sub" disabled="disabled" id="sendNewSms">สมัครสมาชิก</button>
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
    $('#expirepicker').datepicker("setDate", '+12m');

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
@endsection
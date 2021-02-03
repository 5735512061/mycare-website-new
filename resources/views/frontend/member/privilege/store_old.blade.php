@extends("/frontend/layouts/template/template-store")
<style>
@media only screen and (max-width: 768px) {
    #mobile {
      display: inline !important;
      padding: 5px;
    }
    #desktop {
      display: none;
    }
    #like-btn {
        top: -50px !important;
    }
}

/* Image on the left side */
.thumbnail {
	float: left;
	position: relative;
	left: 30px;
	top: -90px;
	height: 320px;
	width: 530px;
	-webkit-box-shadow: 10px 10px 10px 0px #9c9c9c;
	-moz-box-shadow: 10px 10px 10px 0px #9c9c9c;
	box-shadow: 10px 10px 10px 0px #9c9c9c;
	overflow: hidden;
}
.right {
	margin-left: 590px;
	margin-right: 20px;
	margin-top: -280px;
    height: 300px;
}

.right h1 {
  margin-top: 2px;
}

.right h4 {
  text-align: center;
}

.card {
	 position: absolute;
	 background: white;
	 margin: 0 auto;
	 box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
	 transition: all 0.3s;
}
 .card:hover {
	 box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

</style>
@section("content")
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 200px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				{{-- <center><h2 class="" style="font-size:2rem; color:#000085 !important; font-weight: normal !important;">{{$store->name}}</h2></center> --}}
				{{-- <hr style="border: 1px solid blue;"> --}}
			</div>
		</div>
    </div>
</section>
<div class="container" id="desktop">
    <div class="card">
      <div class="thumbnail" style="height:735px !important;">
        <img src="{{url('images/scan')}}/{{$store->scan}}" class="img-responsive" width="100%">
      </div>
      <div class="right" style="margin-top: -580px !important; height:520px !important;">
        <form class="sendurl">
            <div class="input-group form-group">
                <input type="text" id="serialnumber1" maxlength="19" minlength="19" name="serialnumber" placeholder="กรอกหมายเลขบัตรสมาชิก 16 หลัก" onfocus="this.placeholder = 'กรอกหมายเลขบัตรสมาชิก 16 หลัก'" class="single-input{{ $errors->has('serialnumber1') ? ' is-invalid' : '' }}">
                @if ($errors->has('serialnumber'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('serialnumber') }}</strong>
                    </span>
                @endif
                <input type="hidden" name="store_name" id="store_name" value="{{$store_name}}">
                <input type="hidden" name="point" id="point" value="{{$store->point}}">
            </div>
            <div class="form-group">
                <input style="background-color: #0517c4 !important;" class="genric-btn info radius btn_sub" type="submit" value="กดรับสิทธิ์" data-toggle="modal" data-target="#myModal"><br>
            </div>
        </form>  
        <a href="{{url('/alliance/login')}}">
            <div class="d-flex mobileinput" style="margin-top: 10%;">
                <div style="border:2px solid #0032e2; height: 150; width: 300;">
                    <div class="card-body">
                        <p style="color: #0529aa !important;">จำนวนสิทธิ์ที่ใช้เดือนนี้ : {{$now_statistic}} สิทธิ์</p>
                        <p style="color: #0529aa !important;">จำนวนสิทธิ์เดือนที่ผ่านมา : {{$previousmonth_statistic}} สิทธิ์</p>
                        <p style="color: #0529aa !important;">จำนวนสิทธิ์ทั้งหมด : {{$total_statistic}} สิทธิ์</p>
                    </div>
                </div>
            </div>
        </a>
      </div><br>
    </div>
</div><br>
<div class="container" id="mobile" style="display: none;">
    <div class="row" style="margin-right:0px !important; margin-left:0px !important; margin-top:-220px !important;">
        <div class="col-md-12">
            <a href="#">
				<div class="thecard">
				<div class="card-img" style="height:560px !important;">
					<img src="{{url('images/scan')}}/{{$store->scan}}" class="img-responsive" width="100%">
				</div>
				<div class="card-caption">
                    <form class="sendurl">
                        <div class="input-group form-group" style="margin-top:-40px !important;">
                            <input type="text" id="serialnumber" maxlength="19" minlength="19" name="serialnumber" placeholder="กรอกหมายเลขบัตรสมาชิก 16 หลัก" onfocus="this.placeholder = 'กรอกหมายเลขบัตรสมาชิก 16 หลัก'" class="single-input{{ $errors->has('serialnumber') ? ' is-invalid' : '' }}">
                            @if ($errors->has('serialnumber'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('serialnumber') }}</strong>
                                </span>
                            @endif
                            <input type="hidden" name="store_name" id="store_name" value="{{$store_name}}">
                            <input type="hidden" name="point" id="point" value="{{$store->point}}">
                        </div>
                        <div class="form-group">
                            <center><input style="background-color: #0517c4 !important;" class="genric-btn info radius btn_sub" type="submit" value="กดรับสิทธิ์" data-toggle="modal" data-target="#myModal"></center>
                        </div>
                    </form>
                </div>
                
            </div>
            </a><br><br><br>
            <a href="{{url('/alliance/login')}}">
                <div class="d-flex justify-content-center mobileinput" style="margin-top: 10%;">
                    <div style="border:2px solid #0032e2; height: 150; width: 300;">
                        <div class="card-body">
                            <p style="color: #0529aa !important;">จำนวนสิทธิ์ที่ใช้เดือนนี้ : {{$now_statistic}} สิทธิ์</p>
                            <p style="color: #0529aa !important;">จำนวนสิทธิ์เดือนที่ผ่านมา : {{$previousmonth_statistic}} สิทธิ์</p>
                            <p style="color: #0529aa !important;">จำนวนสิทธิ์ทั้งหมด : {{$total_statistic}} สิทธิ์</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="modal fade mobile" id="myModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-center">
            <i class="fas fa-gift" style="color: #0517c4; font-size: 30px;"></i>
        </p>
        <div id="tag-id"></div>
      </div>
      <div class="modal-footer" style="background-color: #0517C4;">
        <button data-target="#myModal" data-toggle="modal" data-backdrop="static" data-keyboard="false" id="close" type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script>

    // serial number
    $('#serialnumber').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        var newVal = '';
        while (val.length > 4) {
          newVal += val.substr(0, 4) + '-';
          val = val.substr(4);
        }
        newVal += val;
        this.value = newVal;
    });

$('.sendurl').submit(function(e){
    e.preventDefault();
    var serialnumber = $('#serialnumber').val();
    var store_name = $('#store_name').val();
    var point = $('#point').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "{!! url('/privilege/store/receive') !!}",
        data: {
            _token:$('meta[name="csrf-token"]').attr('content'),
            store_name : store_name,
            serialnumber : serialnumber,
            point : point
        },
            success: function(response) {
                console.log(response.status);
                if(response.status === "Fail") {
                    $('#tag-id').html('<p style="text-align: center; color:red;">ไม่สามารถรับสิทธิ์ได้<br> เนื่องจากวันนี้ท่านได้ใช้สิทธิ์ไปแล้ว</p>')
                } 
                if(response.status === "FULL") {
                    $('#tag-id').html('<p style="text-align: center;">ไม่สามารถรับสิทธิ์ได้<br> เนื่องจากเดือนนี้กดรับสิทธิ์ครบแล้ว</p>')
                }
                else if(response.status === "Not Found") {
                    $('#tag-id').html('<p style="text-align: center;">ไม่มีหมายเลขสมาชิกนี้<br> สมัครสมาชิก MY CARE<br>ได้ที่เอกการยางทุกสาขา</p>')
                } 
                else if(response.status === "Null") {
                    $('#tag-id').html('<p style="text-align: center;">กรุณากรอกหมายเลขสมาชิก</p>')
                }
                else if(response.status === "offline") {
                    $('#tag-id').html('<p style="text-align: center; color: red;">บัตรสมาชิกหมดอายุ<br></p><p style="text-align: center;">กรุณาติดต่อ ได้ที่เพจ MY CARE smart choice เพื่อนแท้ดูแลกัน</p>')
                }
                // else if(response.status === "PassFirst") {
                //     $('#tag-id').html('<p style="text-align: center; font-weight: bold;">สิทธิพิเศษสำหรับ คุณ'+response.member.name+'</p><p style="text-align: center;">คุณได้'+response.store.promotion+'</p><p class="text-center" style="color: red">** แสดงบัตร MY CARE พร้อม Booking ต่อพนักงาน เพื่อยืนยันการรับสิทธิ์</p><p style="text-align: center;">'+response.statistic.code+' กรุณาแสดงรหัสเพื่อรับสิทธิ์</p><p style="text-align: center; color:red;">คุณสามารถใช้สิทธิ์ได้อีก 1 ครั้งในเดือนนี้</p>')
                // }
                // else if(response.status === "PassSecond") {
                //     $('#tag-id').html('<p style="text-align: center; font-weight: bold;">สิทธิพิเศษสำหรับ คุณ'+response.member.name+'</p><p style="text-align: center;">คุณได้'+response.store.promotion+'</p><p class="text-center" style="color: red">** แสดงบัตร MY CARE พร้อม Booking ต่อพนักงาน เพื่อยืนยันการรับสิทธิ์</p><p style="text-align: center;">'+response.statistic.code+' กรุณาแสดงรหัสเพื่อรับสิทธิ์</p><p style="text-align: center; color:red;">คุณสามารถใช้สิทธิ์ครั้งต่อไปได้ในเดือนถัดไป</p>')
                // }
                else if(response.status === "Pass"){
                    $('#tag-id').html('<p style="text-align: center; font-weight: bold; color:#0517c4;">สิทธิพิเศษสำหรับ คุณ'+response.member.name+'</p><p style="text-align: center; color:#0517c4;">คุณได้'+response.store.promotion+'</p><p style="text-align: center; background-color:#0517c4; color:#ffffff; margin:0px 80px 0px 80px;">'+response.statistic.code+'</p><p style="margin-top:5px;font-size:15px; text-align: center; color:#979797;">* กรุณาแสดงรหัส คู่บัตร MY CARE ต่อพนักงาน เพื่อยืนยันการสิทธิ์</p>')
                }
                
                console.log(response);
            }
    });
});

    $('#close').click(function(){
        $('#ssn').val('')
        $('#member').text('')
        $('#point').text('')
        console.log("test");
    });
</script>
{{-- <script type="text/javascript">
    $('#myModal').modal({backdrop: 'static', keyboard: false})
</script> --}}
@endsection

@extends("/backend/layouts/template/template")
<style>
    h4 {
        font-family: 'Prompt' !important;
    }
</style>
@section("content")

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">ข้อมูลการสมัครสมาชิก</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12"> 
                    <br><a href="{{url('/admin/member/member-edit/')}}/{{$member->id}}" class="btn btn-warning"><i class="fa fa-exclamation-triangle"></i> เปิดบัตรสมาชิก</a>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <h2>{{$member->membertype}}</h2>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <h3>หมายเลขบัตรประชาชน : 
                        <?php echo DB::table('payments')->where('member_id',$member->id)->value('card_id'); ?>
                    </h3>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <h2>คุณ{{$member->name}} {{$member->surname}}</h2>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <h4>วัน/เดือน/ปีเกิด : {{$member->bday}}</h4>
                </div>
                <div class="col-md-6">
                    <h4>เบอร์โทรศัพท์ : {{$member->tel}}</h4>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <h4>ที่อยู่ : {{$member->address}} หมู่ {{$member->moo}} ตำบล{{$member->district}}
                    อำเภอ{{$member->amphoe}} จังหวัด{{$member->province}} {{$member->zipcode}}
                    </h4>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <h4>หมายเหตุ {{$member->comment}}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="headerH1"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:50px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ข้อมูลการใช้บริการ</h1><br>
            <?php 
                $slip = DB::table('payments')->where('member_id',$member->id)->value('slip'); 
            ?>
            <img src="{{url('/images/slip')}}/{{$slip}}" width="50%";>
        </div>
    </div>
</div><br>
@endsection
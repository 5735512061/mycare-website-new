@extends("/backend/layouts/template/template")
<link href="{{ asset('css/mycare/information-member-template.css')}}" type="text/css" rel="stylesheet">
<style>
    .generic-blockquote p {
        font-family: 'Prompt';
    }
    .table tr td,th{
        color: #000 !important;
        font-family: 'Prompt' !important;
        text-align:center !important;
    }
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
				<h2 style="text-align:center; color:#092895;">จำกัดสิทธิ์/บล็อก</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$member->membertype}}</h2>
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
                        <h4>ที่อยู่ : {{$member->village}} ซอย{{$member->road}} {{$member->address}} หมู่ {{$member->moo}} ตำบล{{$member->district}}
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
    </div><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-heading">
                    <P>
                        <a class="genric-btn success radius" href="{{url('/admin/member/status-member/')}}/{{$id}}/normal">เปิดใช้งาน</a>
                        <a class="genric-btn danger radius" href="{{url('/admin/member/status-member/')}}/{{$id}}/limit_2_perMonth">จำกัดสิทธิ์ 2 ครั้งต่อเดือน</a>
                        <a class="genric-btn danger radius" href="{{url('/admin/member/status-member/')}}/{{$id}}/limit_1_perDay">จำกัดสิทธิ์ 1 ครั้งต่อวัน</a>
                        <a class="genric-btn danger radius" href="{{url('/admin/member/status-member/')}}/{{$id}}/block">บล็อกการใช้งาน</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section><br>
@endsection
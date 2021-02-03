@extends("/backend/layouts/template/template")

<link href="{{ asset('css/mycare/information-member-template.css')}}" type="text/css" rel="stylesheet">

@section("content")

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">ลงทะเบียนผ่านเว็บไซต์</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<div class="container">

<div class="row">
    
    <div class="receipt-main col-xs-12 col-sm-12 col-md-12">
        <div class="row">
            <div class="col-md-12">
                <table class="table" style="margin-top: 20px;">
                    
                    {{$members->links()}}
                    <thead>
                        <tr>
                            <th style="color: #000;">ลำดับ</th>
                            <th style="color: #000;">หมายเลขสมาชิก</th>
                            <th style="color: #000;">หมายเลขบัตรประชาชน</th>
                            <th style="color: #000;">ชื่อลูกค้า</th>
                            <th style="color: #000;">เบอร์โทรติดต่อ</th>
                            <th style="color: #000;"></th>
                            <th style="color: #000;"></th>
                        </tr>
                    </thead>
                    @foreach($members as $member => $value)
                        <tbody>
                            <tr>
                                <td style="color: #000;">{{$NUM_PAGE*($page-1) + $member+1}}</td>
                                @if($value->serialnumber == NULL)
                                <td style="color:red;">ยังไม่ตรวจสอบข้อมูล</td>
                                @else
                                <td><a style="color: #000;" href="{{url('/admin/information-member/')}}/{{$value->id}}">{{$value->serialnumber}}</a></td>
                                @endif
                                <td style="color: #000;">{{$value->card_id}}</td>
                                <td style="color: #000;">{{$value->name}} {{$value->surname}}</td>
                                <td style="color: #000;">{{$value->tel}}</td>
                                @if($value->serialnumber == NULL && $value->comment != "ข้อมูลไม่ถูกต้อง")
                                <td>
                                    <a href="{{url('/admin/sales-information/')}}/{{$value->id}}" class="btn btn-warning"><i class="fa fa-exclamation-triangle"></i> ตรวจสอบข้อมูล</a>
                                </td>
                                @elseif($value->comment == "ข้อมูลไม่ถูกต้อง" && $value->serialnumber == NULL)
                                <td>
                                    <a href="{{url('/admin/sales-information/')}}/{{$value->id}}" class="btn btn-danger"><i class="fa fa-window-close"></i> ข้อมูลไม่ถูกต้อง</a>
                                </td>
                                @else
                                <td>
                                    <a href="{{url('/admin/sales-information/')}}/{{$value->id}}" class="btn btn-success"><i class="fa fa-check"></i> ตรวจสอบแล้ว</a>
                                </td>
                                @endif
                                <td>
                                    <center>
                                        <form action="{{url('/admin/sales/sales-delete/')}}/{{$value->id}}" enctype="multipart/form-data" method="post">@csrf
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure to delete ?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </center>
                                </td>
                                <input type="hidden" name="id" value="{{$value->id}}">
                            </tr>
                        </tbody>
                    @endforeach
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
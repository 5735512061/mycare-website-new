@extends("/backend/layouts/template/template")

<link href="{{ asset('css/mycare/information-member-template.css')}}" type="text/css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@section("content")
<style>
    .table tr td{
        padding: 5 15px !important;
        vertical-align: middle !important;
    }
</style>
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">รายชื่อพันธมิตร</h2><hr style="border: 1px solid blue;">
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
                    <br>
                    <table class="table table-bordered table-striped">
                        {{$stores->links()}}
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">ชื่อ</th>
                                <th style="color: #000; text-align:center;">ชื่อร้านค้า</th>
                                <th style="color: #000; text-align:center;">เบอร์ติดต่อ</th>
                                <th style="color: #000; text-align:center;">เริ่มโปรโมชั่น</th>
                                <th style="color: #000; text-align:center;">สิ้นสุดโปรโมชั่น</th>
                                <th style="color: #000; text-align:center;">โปรโมชั่น</th>
                                <th style="color: #000; text-align:center;">พอยท์</th>
                                <th colspan="2" style="color: #000; text-align:center;"></th>
                            </tr>   
                        </thead>
                        @foreach($stores as $store => $value)
                        <tbody class="table">
                            <tr>
                                <td style="color: #000; text-align:center;">{{$NUM_PAGE*($page-1) + $store+1}}</td>
                                <td style="color: #000; text-align:center;">{{$value->name}}</td>
                                <td style="color: #000; text-align:center;">{{$value->store_name}}</td>
                                <td style="color: #000; text-align:center;">{{$value->tel}}</td>
                                <td style="color: #000; text-align:center;">{{$value->date}}</td>
                                <td style="color: #000; text-align:center;">{{$value->expire}}</td>
                                <td style="color: #000; text-align:center;">{{$value->promotion}}</td>
                                <td style="color: #000; text-align:center;">{{$value->point}}</td>
                                <td>
                                    <center>
                                        <a href="{{url('/admin/alliance-edit/')}}/{{$value->id}}">
                                            <i class="fa fa-pencil-square" style="color:blue;"></i>
                                        </a>                                    
                                        <a href="{{url('/admin/alliance-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                            <i class="fa fa-trash" style="color:blue;"></i>
                                        </a>
                                    </center>
                                </td>
                                <input type="hidden" name="id" value="{{$value->id}}">
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
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
				<h2 style="text-align:center; color:#092895;">ข้อมูลพนักงาน</h2><hr style="border: 1px solid blue;">
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
                        {{$randoms->links()}}
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">หมายเลขบัตร</th>
                                <th style="color: #000; text-align:center;">วันที่ออกหมายเลข</th>
                            </tr>   
                        </thead>
                        @foreach($randoms as $random => $value)
                        <tbody class="table">
                            <tr>
                                <td style="color: #000;">{{$NUM_PAGE*($page-1) + $random+1}}</td>
                                <td style="color: #000;">{{$value->number}}</td>
                                <td style="color: #000;">{{$value->date}}</td>
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
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
				<h2 style="text-align:center; color:#092895;">จำนวนสิทธิ์</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <a href="{{url('/admin/summary-statistic')}}" class="genric-btn info radius btn_sub">รายงานสรุป</a>
        <div class="receipt-main col-xs-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        {{$statistics->links()}}
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">หมายเลขสมาชิก</th>
                                <th style="color: #000; text-align:center;">ชื่อลูกค้า</th>
                                <th style="color: #000; text-align:center;">ชื่อร้านค้า</th>
                                <th style="color: #000; text-align:center;">วันที่รับสิทธิ์</th>
                                <th style="color: #000; text-align:center;">เวลา</th>
                                <th style="color: #000; text-align:center;">CODE</th>
                                <th></th>
                            </tr>   
                        </thead>
                        @foreach($statistics as $statistic => $value)
                        <tbody class="table">
                            <tr>
                                <td style="color: #000;">{{$NUM_PAGE*($page-1) + $statistic+1}}</td>
                                <td style="color: #000;">
                                    <?php 
                                        if(DB::table('members')->where('id',$value->member_id)->value('serialnumber') != NULL) {
                                            echo (DB::table('members')->where('id',$value->member_id)->value('serialnumber'));
                                        } else {
                                            echo (DB::table('sales_members')->where('id',$value->sales_id)->value('serialnumber'));
                                        }
                                        
                                    ?>
                                </td>
                                <td style="color: #000;">
                                    <?php 
                                        if(DB::table('members')->where('id',$value->member_id)->value('serialnumber') != NULL) {
                                            echo (DB::table('members')->where('id',$value->member_id)->value('name'));
                                        } else {
                                            echo (DB::table('sales_members')->where('id',$value->sales_id)->value('name'));
                                        }
                                    ?> 
                                    <?php 
                                        if(DB::table('members')->where('id',$value->member_id)->value('serialnumber') != NULL) {
                                            echo (DB::table('members')->where('id',$value->member_id)->value('surname'));
                                        } else {
                                            echo (DB::table('sales_members')->where('id',$value->sales_id)->value('surname'));       
                                        }
                                    ?> 
                                </td>
                                <td style="color: #000;">
                                    <?php 
                                        echo (DB::table('stores')->where('id',$value->store_id)->value('name'));
                                    ?>
                                </td>
                                <td style="color: #000;">{{$value->date}}</td>
                                <td style="color: #000;">{{$value->created_at->format('H:i:s')}}</td>
                                <td style="color: #000;">{{$value->code}}</td>
                                <td>
                                    <center>
                                        <a href="{{url('/admin/statistic-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
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
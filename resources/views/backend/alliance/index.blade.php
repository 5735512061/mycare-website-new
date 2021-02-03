@extends("/backend/layouts/template/template-store")

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
				<h2 style="text-align:center; color:#092895;">ประวัติการใช้สิทธิ์</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <button style="width:100%;" class="genric-btn blue radius">
                <a href="{{ route('store.logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    ออกจากระบบ
                </a>
                <form id="logout-form" action="{{ 'App\Store' == Auth::getProvider()->getModel() ? route('store.logout') : route('store.logout') }}" method="POST" style="display: none;">@csrf</form>
            </button>
        </div>
    </div>
</div><br>

<center><div class="mobileinput" style="margin-top: 10%;">
    <div style="border:2px solid #0032e2; height: 150; width: 300;">
        <div class="card-body">
            <p style="color: #0529aa !important;">จำนวนสิทธิ์ที่ใช้เดือนนี้ : {{$now_statistic}} สิทธิ์</p>
            <p style="color: #0529aa !important;">จำนวนสิทธิ์เดือนที่ผ่านมา : {{$previousmonth_statistic}} สิทธิ์</p>
            <p style="color: #0529aa !important;">จำนวนสิทธิ์ทั้งหมด : {{$total_statistic}} สิทธิ์</p>
        </div>
    </div>
</div></center><br>

<div class="container">
    <div class="row">
        <div class="receipt-main col-xs-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        {{$statistics->links()}}
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">ชื่อ-นามสกุล</th>
                                <th style="color: #000; text-align:center;">วันที่รับสิทธิ์</th>
                            </tr>   
                        </thead>
                        @foreach($statistics as $statistic => $value)
                        <tbody id="myTable" class="table">
                            <tr>
                                <td style="color: #000;">{{$NUM_PAGE*($page-1) + $statistic+1}}</td>
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
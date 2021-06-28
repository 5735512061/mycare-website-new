@extends("/backend/layouts/template/template")

@section("content")
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">{{$store_name}}</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table table-responsive" style="margin-top: 20px; font-family:'Prompt' !important;">
                {{$statistics->links()}}
                <thead>
                    <tr>
                        <th style="color: #000;">ลำดับ</th>
                        <th style="color: #000;">หมายเลขสมาชิก</th>
                        <th style="color: #000;">ชื่อ-นามสกุล</th>
                        <th style="color: #000;">วันที่รับสิทธิ์</th>
                        <th style="color: #000;">CODE</th>
                    </tr>
                </thead>
                @foreach($statistics as $statistic => $value)
                    <tbody>
                        <tr>
                            <td>{{$NUM_PAGE*($page-1) + $statistic+1}}</td>
                            <td>
                                <?php 
                                    if(DB::table('members')->where('id',$value->member_id)->value('serialnumber') != NULL) {
                                        echo (DB::table('members')->where('id',$value->member_id)->value('serialnumber'));
                                    } else {
                                        echo (DB::table('sales_members')->where('id',$value->sales_id)->value('serialnumber'));
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if(DB::table('members')->where('id',$value->member_id)->value('name') != NULL) {
                                        echo (DB::table('members')->where('id',$value->member_id)->value('name'));
                                    } else {
                                        echo (DB::table('sales_members')->where('id',$value->sales_id)->value('name'));
                                    }
                                ?> 
                                <?php 
                                    if(DB::table('members')->where('id',$value->member_id)->value('surname') != NULL) {
                                        echo (DB::table('members')->where('id',$value->member_id)->value('surname'));
                                    } else {
                                        echo (DB::table('sales_members')->where('id',$value->sales_id)->value('surname'));
                                    }
                                ?>
                            </td>
                            <td>{{$value->date}}</td>
                            <td>{{$value->code}}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
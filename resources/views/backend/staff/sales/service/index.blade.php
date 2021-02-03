@extends("/backend/layouts/template/template-staff")

<link href="{{ asset('css/mycare/information-member-template.css')}}" type="text/css" rel="stylesheet">
<style>
    .alertdesign {
        text-align: center;
        color: red;
        border-style: solid;
        border-color: red;
        font-size: 20px;
        font-family: 'Prompt';
    }
    table tr th,td {
        font-family: 'Prompt';
        text-align: center;
    }
</style>
@section("content")

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">ประวัติการใช้บริการ</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<div class="container">
    
    @foreach($members as $member => $value)
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{$value->brand}} รุ่น {{$value->model}} สี{{$value->color}}</h3>
                </div>
            </div><br>
        </div>
    </div>
    @endforeach
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <P><a class="genric-btn info radius" href="{{url('/staff/createService-sales')}}/{{$member_id}}">เพิ่มข้อมูลบริการ</a></P>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center;">ลำดับ</th>
                        <th style="text-align:center;">สาขาที่ใช้บริการ</th>
                        <th style="text-align:center;">วันที่</th>
                        <th style="text-align:center;">รายการ</th>
                        <th style="text-align:center;">รวม</th>
                        <th></th>
                    </tr>   
                </thead>
                @foreach($services as $service => $value)
                <tbody class="table">
                    <tr>
                        <td style="color: #000;">{{$NUM_PAGE*($page-1) + $service+1}}</td>
                        <td style="color: #000;">{{$value->branch}}</td>
                        <td><a style="color: #000;" href="{{url('/staff/serviceInformation-sales/')}}/{{$value->id}}">{{$value->date}}</a></td>
                        <?php 
                            $list = DB::table('sales_services')->where('date',$value->date)
                                                               ->where('car_id',$value->car_id)
                                                               ->count();
                        ?>
                        <td><a style="color: #000;" href="{{url('/staff/serviceInformation-sales/')}}/{{$value->id}}">{{$list}} รายการ <i class="fa fa-pencil-square" style="color:blue;"></a></td>
                        <?php 
                            $sum = 0;
                            $sum = DB::table('sales_services')->where('date',$value->date)
                                                              ->where('car_id',$value->car_id)
                                                              ->sum(DB::raw('price * amount'));
                            $discount = DB::table('sales_services')
                                          ->where('car_id',$value->car_id)
                                          ->where('date',$value->date)
                                          ->distinct()
                                          ->sum(DB::raw('discount'));
                            $discountturn = DB::table('sales_services')
                                              ->where('car_id',$value->car_id)
                                              ->where('date',$value->date)
                                              ->distinct()
                                              ->sum(DB::raw('discountturn'));
                            $totaldiscount = number_format($sum-$discount-$discountturn);
                        ?>
                        <td style="color: #000;">{{$totaldiscount}} บาท</td>
                        <td style="color: #000;">
                            <center>
                                <a href="{{url('/staff/service-information/')}}/{{$value->id}}">
                                    <i class="fa fa-folder-open" style="color:blue;"></i>
                                </a>
                            </center>
                        </td>
                        <input type="hidden" name="id" value="{{$value->id}}">
                        <input type="hidden" name="member_id" value="{{$member}}">
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection
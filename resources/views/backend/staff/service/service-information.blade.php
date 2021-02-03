@extends("/backend/layouts/template/template-staff")
<style>
    th,tr {
        font-family: 'Prompt' !important;
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
<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h2>วันที่ใช้บริการ : {{$service_date}}</h2><br>
            <h2>เลขไมล์ล่าสุด : {{$service_mile}}</h2><br>
            <h2>สาขาที่เข้าใช้บริการ : {{$service_branch}}</h2><br>
            <div class="table-responsive"> 
                <table class="table">
                    <thead>
                        <tr>
                            <th style="color: #000;">ลำดับ</th>
                            <th style="color: #000;">สินค้า/บริการ</th>
                            <th style="color: #000;">จำนวน</th>
                            <th style="color: #000;">ราคา/หน่วย</th>
                            <th style="color: #000;">รวม</th>
                        </tr>
                    </thead>
                    @foreach($services as $service => $value)
                    <tbody>
                        <tr>
                            <td>{{$NUM_PAGE*($page-1) + $service+1}}</td>
                            <td>{{$value->service}}</td>
                            <td>{{$value->amount}} {{$value->unit}}</td>
                            <td>{{number_format($value->price)}} บาท</td>
                            <?php $sum = 0;
                                $sum = $value->amount*$value->price;
                            ?>
                            <td>{{number_format($sum)}} บาท</td>
                        </tr>
                    </tbody>
                    @endforeach
                    <?php
                            $total = 0;  
                            $price = 0;
                            foreach ($services as $service => $value) {
                                $price = $value->amount*$value->price;
                                $price = str_replace(',','',$price);
                                $total += floatval($price);
                                $price = number_format($total);
                                $discount = DB::table('services')
                                              ->where('member_id',$value->member_id)
                                              ->where('date',$value->date)
                                              ->distinct()
                                              ->sum(DB::raw('discount'));
                                $discountturn = DB::table('services')
                                                  ->where('member_id',$value->member_id)
                                                  ->where('date',$value->date)
                                                  ->distinct()
                                                  ->sum(DB::raw('discountturn'));
                                $totaldiscount = number_format($total-$discount-$discountturn);
                            }
                        ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="right">
                            <p>ราคารวม : </p>
                            <p>ส่วนลด : </p>
                            <p>หักเทริน : </p>
                            <p>รวมเงินทั้งสิ้น : </p>
                        </td>
                        <td align="right">
                            <p>{{$price}} บาท</p>
                            <p>{{number_format($discount)}} บาท</p>
                            <p>{{number_format($discountturn)}} บาท</p>
                            <p>{{$totaldiscount}} บาท</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>   
@endsection
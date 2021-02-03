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
        <div class="col-md-4">
            <table class="table table-bordered" style="font-family: 'Prompt' !important;">
                <thead>
                    <tr>
                        <td colspan="2" style="text-align:center;">ปี 2019</td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">เดือน</th>
                        <th style="text-align:center;">จำนวนสิทธิ์</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        for($m=1; $m<=12; ++$m){
                            $amount = DB::table('statistics')->where('store_id',$statistic)
                                                             ->whereYear('created_at','2019')
                                                             ->whereMonth('created_at',$m)->count();
                            $month = date('F', mktime(0, 0, 0, $m, 1));
                            $year = "2019";
                            echo 
                                '<tr>
                                    <td>'.$month.'</td>
                                    <td><a style="color:#000;" href="../../../admin/statistic/'.$store_name.'/'.$year.'/'.$month.'">'.$amount.'</a></td>
                                </tr>';
                        }
                    @endphp
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered" style="font-family: 'Prompt' !important;">
                <thead>
                    <tr>
                        <td colspan="2" style="text-align:center;">ปี 2020</td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">เดือน</th>
                        <th style="text-align:center;">จำนวนสิทธิ์</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        for($m=1; $m<=12; ++$m){
                            $amount = DB::table('statistics')->where('store_id',$statistic)
                                                             ->whereYear('created_at','2020')
                                                             ->whereMonth('created_at',$m)->count();
                            $month = date('F', mktime(0, 0, 0, $m, 1));
                            $year = "2020";
                            echo 
                                '<tr>
                                    <td>'.$month.'</td>
                                    <td><a style="color:#000;" href="../../../admin/statistic/'.$store_name.'/'.$year.'/'.$month.'">'.$amount.'</a></td>
                                </tr>';
                        }
                    @endphp     
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-bordered" style="font-family: 'Prompt' !important;">
                <thead>
                    <tr>
                        <td colspan="2" style="text-align:center;">ปี 2021</td>
                    </tr>
                    <tr>
                        <th style="text-align:center;">เดือน</th>
                        <th style="text-align:center;">จำนวนสิทธิ์</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        for($m=1; $m<=12; ++$m){
                            $amount = DB::table('statistics')->where('store_id',$statistic)
                                                             ->whereYear('created_at','2021')
                                                             ->whereMonth('created_at',$m)->count();
                            $month = date('F', mktime(0, 0, 0, $m, 1));
                            $year = "2021";
                            echo 
                                '<tr>
                                    <td>'.$month.'</td>
                                    <td><a style="color:#000;" href="../../../admin/statistic/'.$store_name.'/'.$year.'/'.$month.'">'.$amount.'</a></td>
                                </tr>';
                        }
                    @endphp
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
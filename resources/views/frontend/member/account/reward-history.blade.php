@extends("/frontend/layouts/template/template")

@section("content")
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">ประวัติการแลกคะแนน</h2><hr style="border: 1px solid blue;">
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
                    <table class="table table-bordered table-striped" style="font-family: 'Prompt'">
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">#</th>
                                <th style="color: #000; text-align:center;">รางวัล</th>
                                <th style="color: #000; text-align:center;">จำนวนพอยท์</th>
                                <th style="color: #000; text-align:center;">วันที่แลกรางวัล</th>
                                <th style="color: #000; text-align:center;">สถานะ</th>
                            </tr>   
                        </thead>
                        @foreach($reward_exchanges as $reward_exchange => $value)
                        @php
                            $reward = DB::table('rewards')->where('id',$value->reward_id)->value('reward_name');
                            $point = DB::table('rewards')->where('id',$value->reward_id)->value('point');
                        @endphp
                        <tbody>
                            <tr>
                                <td style="color: #000; text-align:center;">{{$NUM_PAGE*($page-1) + $reward_exchange+1}}</td>
                                <td style="color: #000; text-align:center;">{{$reward}}</td>
                                <td style="color: #000; text-align:center;">{{$point}}</td>
                                <td style="color: #000; text-align:center;">{{$value->date}}</td>
                                @if($value->status == 'รอดำเนินการ')
                                    <td style="color: red; text-align:center;">{{$value->status}}</td>
                                @elseif($value->status = 'แลกรางวัลสำเร็จ')
                                    <td style="color: green; text-align:center;">{{$value->status}}</td>
                                @endif
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
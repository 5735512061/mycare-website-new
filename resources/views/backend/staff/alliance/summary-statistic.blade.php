@extends("/backend/layouts/template/template-staff")

@section("content")
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">สรุปรายงานการใช้สิทธิ์</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        @foreach($stores as $store => $value)
            <div class="col-md-4">
                <section class="submit" style="font-family: 'Prompt' !important;">
                    <div class="submit-btn">
                        <div class="row">
                            <div class="col-md-12 column">
                            <a href="{{url('/staff/summary-statistic/')}}/{{$value->id}}" class="btn btn-primary" style="width:100%; font-family:'Prompt' !important;">{{$value->name}}</a>
                            <br>
                            <?php 
                                $amount = DB::table('statistics')->where('store_id',$value->id)->count();
                                $amountNow = DB::table('statistics')->where('store_id',$value->id)
                                                                    ->whereMonth('created_at','=',$dateNow)->count();
                            ?>
                                @if($amountNow == NULL)
                                <p>เดือนปัจจุบัน : 0 สิทธิ์</p>
                                @else   
                                <p>เดือนปัจจุบัน : {{$amountNow}} สิทธิ์</p>
                                @endif
                                <p>รวมทั้งหมด : {{$amount}} สิทธิ์</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
</div>
<br>

@endsection
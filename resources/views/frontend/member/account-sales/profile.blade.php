@extends("/frontend/layouts/template/template-bg")
<style>
    .genric-btn.blue {
        margin-top: 15px;
    }
</style>
@section("content")
                        {{-- คำนวณคะแนนสะสม --}}
                        <?php 
                            $sum = 0;  
                            $pointTotal = 0;
                            $balance = 0;
                            $point = 0;
                            $sumpoint = 0;
                            $sumpointStore = 0;
                            $sumpointStorex = 0;
                            $discount = 0;
                            $discountturn = 0;
                            $sumMore = 0;  
                            $discountMore = 0;
                            $discountturnMore = 0;
                        ?>

                        <?php 
                        $groupDates = $membersames->groupBy('date');

                        $groupBys = array();

                        foreach($groupDates as $groupDate){
                            foreach($groupDate->groupBy('bill_number') as $value){
                                array_push($groupBys, $value);
                            }
                        }


                        foreach($groupBys as $key => $groupBy){
                            $groupBy->created_at = $groupBy[0]->created_at;
                            $groupBy->discount = $groupBy[0]->discount;
                            $groupBy->discountturn = $groupBy[0]->discountturn;
                            
                        }


                        $sumdiscount = 0;
                        $sumdiscountturn = 0;
                        $sumdiscountMore = 0;
                        $sumdiscountturnMore = 0;

                        // หลังวันที่ 01/11/2020 ไม่คูณ 2
                        $DATEDEF = "01/11/2020";

                        foreach($groupBys as $key => $groupBy){
                            if(date_format(date_create_from_format('d/m/Y',$groupBy[0]->date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$DATEDEF),'Y-m-d')) {
                                $sumdiscount += floatval($groupBy[0]->discount);
                                $sumdiscountturn += floatval($groupBy[0]->discountturn);
                            }
                            else {
                                $sumdiscountMore += floatval($groupBy[0]->discount);
                                $sumdiscountturnMore += floatval($groupBy[0]->discountturn);
                                // dd($sumdiscountMore, $sumdiscountturnMore);
                            }
                        }

                        foreach($membersames as $membersame => $value){
                            if(date_format(date_create_from_format('d/m/Y',$value->date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$DATEDEF),'Y-m-d')) {
                                $sum += ($value->price)*($value->amount);
                            }
                            else {
                                $sumMore += ($value->price)*($value->amount);

                            }              
                        }



                        $sum = $sum - $sumdiscount - $sumdiscountturn; 
                        $sumMore = ($sumMore - $sumdiscountMore - $sumdiscountturnMore)*2;

                        // dd($sumdiscountMore);

                        $point = floor(($sum + $sumMore)/1000); 
                        $pointTotal += $point;
                        ?>

                        <?php 
            
                            $DATEST = "29/12/2020";
            
                            foreach($points as $point => $value) {

                                if(date_format(date_create_from_format('d/m/Y',$value->date),'Y-m-d') > date_format(date_create_from_format('d/m/Y',$DATEST),'Y-m-d')) {
                                    // $point = DB::table('stores')->where('id',$value->store_id)
                                    //                             ->value('point');
                                    $point = 0;
                                    $sumpointStore += $point;
                                    
                                }
                                else {
                                    $point = DB::table('stores')->where('id',$value->store_id)
                                                                ->value('point');
                                    $point = $point*2;
                                    $sumpointStorex += $point;
                                    
                                }
                            }
                         ?>
            
                        @foreach($scores as $score => $value)
                            <?php 
                                $point = DB::table('rewards')->where('id',$value->reward_id)
                                                             ->value('point');
                                $sumpoint += $point;
                            ?>
                        @endforeach
                        
                        <?php 
                            $balance = $pointTotal + $sumpointStore + $sumpointStorex - $sumpoint;
                        ?>

<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;"><img src="{{ asset('/img/mycare/symbol/arrow.png')}}" width="4%"> ข้อมูลส่วนตัว</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<section class="feature-area">
    <div class="row d-flex justify-content-center" style="margin-top:-90px !important;">
        <div class="col-lg-6">
            <div class="section-title text-center">
				<img src="{{ asset('img/mycare/logo-card.png')}}" width="50%" style="-webkit-filter: drop-shadow(7px 7px 7px #222); filter: drop-shadow(7px 7px 7px #222);"/>
                <div style="background-color:#FFF;">
					<h2 style="margin-top:20px; color:#646464;">คะแนนสะสม {{number_format($balance)}} คะแนน</h2>
				</div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row" style="margin-top:-40px;">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>คุณ{{$member->name}} {{$member->surname}}</h2>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <h4>วัน/เดือน/ปีเกิด : {{$member->bday}}</h4>
                </div>
                <div class="col-md-6">
                    <h4>เบอร์โทรศัพท์ : {{$member->tel}}</h4>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <h4>ที่อยู่ : {{$member->address}} หมู่ {{$member->moo}} ตำบล{{$member->district}}
                    อำเภอ{{$member->amphoe}} จังหวัด{{$member->province}} {{$member->zipcode}}
                    </h4>
                </div>
            </div><br>
            <?php 
                $id = DB::table('sales_members')->where('id',$member->id)
                                                ->value('id');

                $groupDates = array();

                $scanStatistic = DB::table('statistics')
                                ->where('sales_id',$id)
                                ->where('store_id','45')
                                ->orderBy('id','desc')
                                ->first();
                array_push($groupDates, $scanStatistic);

                $scanStatistic = DB::table('statistics')
                                ->where('sales_id',$id)
                                ->where('store_id','62')
                                ->orderBy('id','desc')
                                ->first();
                array_push($groupDates, $scanStatistic);

                $scanStatistic = DB::table('statistics')
                                   ->where('sales_id',$id)
                                   ->where('store_id','63')
                                   ->orderBy('id','desc')
                                   ->first();
                array_push($groupDates, $scanStatistic);
                    
                $scanStatistic = DB::table('statistics')
                                ->where('sales_id',$id)
                                ->where('store_id','64')
                                ->orderBy('id','desc')
                                ->first();
                array_push($groupDates, $scanStatistic);

                $scanStatistic = DB::table('statistics')
                                ->where('sales_id',$id)
                                ->where('store_id','65')
                                ->orderBy('id','desc')
                                ->first();
                array_push($groupDates, $scanStatistic);

                $scanStatistic = DB::table('statistics')
                                ->where('sales_id',$id)
                                ->where('store_id','66')
                                ->orderBy('id','desc')
                                ->first();
                array_push($groupDates, $scanStatistic);

                $scanStatistic = DB::table('statistics')
                                ->where('sales_id',$id)
                                ->where('store_id','45')
                                ->orderBy('id','desc')
                                ->first();
                array_push($groupDates, $scanStatistic);
                                
                $scanStatistic = DB::table('statistics')
                                ->where('sales_id',$id)
                                ->where('store_id','61')
                                ->orderBy('id','desc')
                                ->first();
                array_push($groupDates, $scanStatistic);

                // $service_date = max($groupDates);

                $groupDates = array_filter($groupDates);
                                    
                if($groupDates == null) {
                    $service_date = null;
                }
                else {
                    foreach ($groupDates as $groupDate => $value) {
                        $created_at = $value->created_at;
                    }
                    $service_date = date('d/m/Y',strtotime($created_at));
                }

                if($service_date == null) {
                    $service_date = '';
                    $expire = DB::table('sales_members')->where('id',$id)
                                ->value('expire');
                }
                else {
                    $service_date = strtr($service_date,'/','-');
                    $expire = date('d/m/Y',strtotime($service_date . "+90d"));
                    
                }
            ?>
            <div class="row">
                <div class="col-md-6">
                    <h4 style="color:red;">วันออกบัตร : {{$member->date}}</h4>
                </div>
                <div class="col-md-6">
                    <h4 style="color:red;">
                        วันหมดอายุ : 
                        @if($service_date == '')
                            @if(date_format(date_create_from_format('d/m/Y',$dateNow),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$member->expire),'Y-m-d'))
                                {{$member->expire}}
                            @else   
                                {{$member->expire}}<br>บัตรหมดอายุ
                            @endif
                        @else
                            @if(date_format(date_create_from_format('d/m/Y',$dateNow),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                                {{$expire}} 
                            @else 
                                {{$expire}}<br>บัตรหมดอายุ
                            @endif
                        @endif
                    </h4>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <h4>หมายเหตุ {{$member->comment}}</h4>
                </div>
            </div><br><br>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('member/sales/service/car-list') }}/{{$member->id}}"><button style="width:100%;" class="genric-btn blue radius">ประวัติการใช้บริการ</button></a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('password.change') }}"><button style="width:100%;" class="genric-btn blue radius">เปลี่ยนรหัสผ่าน</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('member/tel-change') }}"><button style="width:100%;" class="genric-btn blue radius">เปลี่ยนเบอร์โทรศัพท์</button></a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('member/profile-change') }}"><button style="width:100%;" class="genric-btn blue radius">แก้ไขข้อมูลส่วนตัว</button></a>
                    </div>
                </div>
                <div class="row">
                    <div class="COL-md-6"></div>
                    <div class="col-md-6">
                        <button style="width:100%;" class="genric-btn blue radius">
                            <a href="{{ route('sales.logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ 'App\Salesmember' == Auth::getProvider()->getModel() ? route('sales.logout') : route('sales.logout') }}" method="POST" style="display: none;">@csrf</form>
                        </button>
                    </div>
                </div>
            </div>
        <div class="col-md-2"></div>
        </div>
    </div>
</div>
@endsection
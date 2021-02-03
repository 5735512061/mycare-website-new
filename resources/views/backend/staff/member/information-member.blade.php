@extends("/backend/layouts/template/template-staff")
<link href="{{ asset('css/mycare/information-member-template.css')}}" type="text/css" rel="stylesheet">
<style>
    .generic-blockquote p {
        font-family: 'Prompt';
    }
    .table tr td,th{
        color: #000 !important;
        font-family: 'Prompt' !important;
        text-align:center !important;
    }
    h4 {
        font-family: 'Prompt' !important;
    }
</style>
@section("content")

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">ข้อมูลสมาชิก</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<section class="">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$member->membertype}}</h2>
                    </div>
                </div><br>
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
                    $serialnumber = DB::table('members')->where('id',$member->id)
                                                        ->value('serialnumber');
                    $ids = DB::table('members')->where('serialnumber',$serialnumber)->get();

                    $groupDates = array();

                    $DATEST = "01/09/2020";

                    foreach($ids as $id => $value) {
                        $serviceDate = DB::table('services')
                                        ->where('member_id',$value->id)
                                        ->whereDate('created_at', '<', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $serviceDate);
                                                                    
                    }

                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','45')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }
                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','62')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }
                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','63')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }
                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','64')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }
                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','65')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }
                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','66')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }
                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','67')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }

                    foreach($ids as $id => $value) {
                        $scanStatistic = DB::table('statistics')
                                        ->where('member_id',$value->id)
                                        ->where('store_id','61')
                                        ->whereDate('created_at', '>=', '2020-09-01 00:00:00')
                                        ->orderBy('id','desc')
                                        ->first();
                        array_push($groupDates, $scanStatistic);
                                                    
                    }

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
                            $expire = DB::table('members')->where('serialnumber',$serialnumber)
                                                          ->value('expire');
                        }
                        else {
                            // $service_date = strtr($service_date->date,'/','-');
                            $service_date = strtr($service_date,'/','-');
                            $expire = date('d/m/Y',strtotime($service_date . "+1 year"));
                            
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
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    $cnt_member = count($cntmember);
                ?>
                @if($membertype == "ลูกค้าทั่วไป" && $cnt_member < 11)
                    @if(date_format(date_create_from_format('d/m/Y',$dateNow),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                        <div class="panel-heading">
                            <P><a class="genric-btn info radius" href="{{url('/staff/member/create-member/')}}/{{$member_id}}">เพิ่มป้ายทะเบียน</a></P>
                        </div>
                    @else
                        <div class="panel-heading"></div>  
                    @endif
                @elseif($membertype == "กลุ่มรถมือสอง" && $cnt_member < 11)
                    @if(date_format(date_create_from_format('d/m/Y',$dateNow),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                        <div class="panel-heading">
                            <P><a class="genric-btn info radius" href="{{url('/staff/member/create-member/')}}/{{$member_id}}">เพิ่มป้ายทะเบียน</a></P>
                        </div>
                    @else
                        <div class="panel-heading"></div>  
                    @endif
                @elseif($membertype == "ป้ายเขียว-เหลือง" && $cnt_member < 11)
                    @if(date_format(date_create_from_format('d/m/Y',$dateNow),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                        <div class="panel-heading">
                            <P><a class="genric-btn info radius" href="{{url('/staff/member/create-member/')}}/{{$member_id}}">เพิ่มป้ายทะเบียน</a></P>
                        </div>
                    @else
                        <div class="panel-heading"></div>  
                    @endif
                @elseif($membertype == "สมัครผ่านเว็บไซต์" && $cnt_member < 11)
                    @if(date_format(date_create_from_format('d/m/Y',$dateNow),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                        <div class="panel-heading">
                            <P><a class="genric-btn info radius" href="{{url('/staff/member/create-member/')}}/{{$member_id}}">เพิ่มป้ายทะเบียน</a></P>
                        </div>
                    @else
                        <div class="panel-heading"></div>  
                    @endif
                @elseif($membertype == "exclusive")
                    @if(date_format(date_create_from_format('d/m/Y',$dateNow),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                        <div class="panel-heading">
                            <P><a class="genric-btn info radius" href="{{url('/staff/member/create-member/')}}/{{$member_id}}">เพิ่มป้ายทะเบียน</a></P>
                        </div>
                    @else
                        <div class="panel-heading"></div>  
                    @endif
                @endif
                <input type="hidden" value="{{$member_id}}">
                @if($countmembers == NULL || $countcarnull != NULL)
                    <a style="margin-top:15px; margin-bottom:15px;" href="{{url('/staff/member/create-member/')}}/{{$member_id}}" class="btn btn-warning"><i class="fa fa-exclamation-triangle"></i> ยังไม่มีข้อมูลรถ</a>
                    @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center;">ลำดับ</th>
                                <th style="text-align:center;">ป้ายทะเบียนรถ</th>
                                <th style="text-align:center;">ยี่ห้อรถ</th>
                                <th style="text-align:center;">รุ่นรถ</th>
                                <th style="text-align:center;">สี</th>
                            </tr>   
                        </thead>
                        @foreach($members as $member => $value)
                        <tbody class="table">
                            <tr>
                                <td style="color: #000;">{{$NUM_PAGE*($page-1) + $member+1}}</td>
                                <td style="color: #000;"><a style="color: #000;" href="{{url('/staff/service/')}}/{{$value->id}}">{{$value->carnumber}} {{$value->carprovince}}</a></td>
                                <td style="color: #000;">{{$value->brand}}</td>
                                <td style="color: #000;">{{$value->model}}</td>
                                <td style="color: #000;">{{$value->color}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
</section><br>
@endsection
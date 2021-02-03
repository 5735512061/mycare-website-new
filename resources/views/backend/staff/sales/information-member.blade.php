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
				<h2 style="text-align:center; color:#092895;">ข้อมูลสมาชิกเซลล์</h2><hr style="border: 1px solid blue;">
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
                        $expire = date('d/m/Y',strtotime($service_date . "+90days"));
                        
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
                <input type="hidden" value="{{$member_id}}">
                <div class="panel-heading">
                    <P><a class="genric-btn info radius" href="{{url('/staff/create-sales/')}}/{{$member->id}}">เพิ่มข้อมูลรถ</a></P>
                </div>
                @if($countmembers == NULL)
                    <a style="margin-top:15px; margin-bottom:15px;" href="{{url('/staff/create-sales/')}}/{{$member->id}}" class="btn btn-warning"><i class="fa fa-exclamation-triangle"></i> ยังไม่มีข้อมูลรถ</a>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center;">ลำดับ</th>
                                <th style="text-align:center;">ป้ายทะเบียน</th>
                                <th style="text-align:center;">ยี่ห้อรถ</th>
                                <th style="text-align:center;">รุ่นรถ</th>
                                <th style="text-align:center;">สี</th>
                            </tr>   
                        </thead>
                        @foreach($cntmember as $key => $value)
                        <tbody class="table">
                            <tr>
                                <td style="color: #000;"><a style="color: #000;" href="{{url('/staff/service-sales/')}}/{{$value->id}}">{{$NUM_PAGE*($page-1) + $key+1}}</a></td>
                                <td style="color: #000;"><a style="color: #000;" href="{{url('/staff/service-sales/')}}/{{$value->id}}">{{$value->carnumber}}</a></td>
                                <td style="color: #000;"><a style="color: #000;" href="{{url('/staff/service-sales/')}}/{{$value->id}}">{{$value->brand}}</a></td>
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
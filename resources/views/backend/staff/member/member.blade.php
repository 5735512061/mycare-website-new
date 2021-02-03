@extends("/backend/layouts/template/template-staff")

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
@include("/backend/layouts/header-staff")

<div class="container">
    <div class="row">
        <div class="receipt-main col-xs-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    {{-- <input class="form-control ssn" maxlength="19" minlength="19" id="myInput" type="text" placeholder="ค้นหาหมายเลขบัตรสมาชิก"> --}}
                    <form action="{{url('/staff/member/search-member')}}" enctype="multipart/form-data" method="post">@csrf
                        <input class="form-control ssn" maxlength="19" minlength="19" type="text" placeholder="ค้นหาหมายเลขบัตรสมาชิก" name="serialnumber">
                    </form>
                    <br>
                    @if($members == '0') 
                        <p style="text-align: center;">ไม่มีข้อมูลสมาชิก</p><br>
                    @else
                    <table class="table table-bordered table-striped">
                        {{$members->links()}}
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">หมายเลขสมาชิก</th>
                                <th style="color: #000; text-align:center;">ชื่อลูกค้า</th>
                                <th style="color: #000; text-align:center;">เบอร์โทรติดต่อ</th>
                                <th style="color: #000; text-align:center;">วันออกบัตร</th>
                                <th style="color: #000; text-align:center;">วันหมดอายุ</th>
                                <th colspan="2" style="color: #000; text-align:center;">ข้อมูลเพิ่มเติม</th>
                            </tr>   
                        </thead>
                        @foreach($members as $member => $value)
                        <tbody id="myTable" class="table">
                            <tr>
                                @php
                                    $memberId = $value->id;
                                @endphp

                                <td style="color: #000;">{{$NUM_PAGE*($page-1) + $member+1}}</td>
                                <td><a style="color: #000;" href="{{url('/staff/information-member/')}}/{{$memberId}}">{{$value->serialnumber}}</a></td>
                                <td style="color: #000;">{{$value->name}} {{$value->surname}}</td>
                                <td style="color: #000;">{{$value->tel}}</td>
                                <td style="color: #000;">{{$value->date}}</td>
                                <?php 
                                    $serialnumber = DB::table('members')->where('id',$value->id)
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
                                @if($service_date == '')
                                    @if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$value->expire),'Y-m-d'))
                                        <td style="color: #000;">{{$value->expire}}</td>
                                    @else
                                        <td style="color:red;">{{$value->expire}} บัตรหมดอายุ</td>
                                    @endif
                                @else
                                    @if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                                        <td style="color: #000;">{{$expire}}</td>
                                    @else
                                        <td style="color:red;">{{$expire}} บัตรหมดอายุ</td>
                                    @endif
                                @endif
                                <td>
                                    <center>
                                        <a href="{{url('/staff/information-member/')}}/{{$memberId}}">
                                            <i class="fa fa-folder-open" style="color:blue;"></i>
                                        </a>
                                    </center>
                                </td>
                                <input type="hidden" name="id" value="{{$memberId}}">
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>    
</div>

<script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

<script>
    $(document).ready(function(){
      $("#myInput2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>

<script>
        // serial number
        $('.ssn').keyup(function() {
        var val = this.value.replace(/\D/g, '');
        var newVal = '';
        while (val.length > 4) {
          newVal += val.substr(0, 4) + '-';
          val = val.substr(4);
        }
        newVal += val;
        this.value = newVal;
    });

</script>
@endsection
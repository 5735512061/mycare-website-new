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
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">ประวัติสมาชิกเซลล์</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<div class="container">
    <div class="row">
        {{-- <div class="panel-heading">
            <P><a class="genric-btn info radius" href="{{url('/staff/sales-register/')}}">สมัครสมาชิกเซลล์</a></P>
        </div> --}}
        <div class="receipt-main col-xs-12 col-sm-12 col-md-12">
            <div class="row">
                <div class="col-md-12">
                    
                    <br>
                    <form action="{{url('/staff/sales/search-member')}}" enctype="multipart/form-data" method="post">@csrf
                        <input class="form-control ssn" maxlength="19" minlength="19" type="text" placeholder="ค้นหาหมายเลขบัตรสมาชิก" name="serialnumber">
                    </form>
                    @if($members == '0') 
                        <p style="text-align: center;">ไม่มีข้อมูลสมาชิก</p><br>
                    @else
                    <table class="table table-bordered table-striped">
                        {{$members->links()}}
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">หมายเลขสมาชิก</th>
                                <th style="color: #000; text-align:center;">ชื่อ-นามสกุลเซลล์</th>
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
                                <td><a style="color: #000;" href="{{url('/staff/information-sales/')}}/{{$memberId}}">{{$value->serialnumber}}</a></td>
                                <td style="color: #000;">{{$value->name}} {{$value->surname}}</td>
                                <td style="color: #000;">{{$value->tel}}</td>
                                <td style="color: #000;">{{$value->date}}</td>

                                <?php 
                                $id = DB::table('sales_members')->where('id',$value->id)
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

                                @if($service_date == '')
                                    @if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$value->expire),'Y-m-d'))
                                        <td style="color: #000;">{{$value->expire}}</td>
                                    @else   
                                        <td style="color:red;">{{$value->expire}}<br>บัตรหมดอายุ</td>
                                    @endif
                                @else
                                    @if(date_format(date_create_from_format('d/m/Y',$date),'Y-m-d') < date_format(date_create_from_format('d/m/Y',$expire),'Y-m-d'))
                                        <td style="color: #000;">{{$expire}}</td>
                                    @else 
                                        <td style="color:red;">{{$expire}}<br>บัตรหมดอายุ</td>
                                    @endif
                                @endif

                                <td>
                                    <center>
                                        <a href="{{url('/staff/information-sales/')}}/{{$memberId}}">
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

    // number phone
    function phoneFormatter() {
        $('input.phone_format').on('input', function() {
            var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) { number = number.replace(/(\d{3})(\d{2})/, "$1-$2"); } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3"); 
                }
            $(this).val(number)
            $('input.phone_format').attr({ maxLength : 12 });    
        });
    };
    $(phoneFormatter);

</script>
@endsection
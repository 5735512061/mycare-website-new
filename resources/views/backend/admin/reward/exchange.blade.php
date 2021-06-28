@extends("/backend/layouts/template/template")

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
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">แลกคะแนนสะสม</h2><hr style="border: 1px solid blue;">
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
                    <br>
                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">หมายเลขสมาชิก</th>
                                <th style="color: #000; text-align:center;">รางวัล</th>
                                <th style="color: #000; text-align:center;">จำนวนพอยท์</th>
                                <th style="color: #000; text-align:center;">วันที่แลกรางวัล</th>
                                <th style="color: #000; text-align:center;">สถานะ</th>
                                <th style="color: #000; text-align:center;"></th>
                                <th style="color: #000; text-align:center;"></th>
                            </tr>   
                        </thead>
                        @foreach($exchanges as $exchange => $value)
                        @php
                            if(DB::table('members')->where('id',$value->member_id)->value('serialnumber') != NULL) {
                                $serialnumber = DB::table('members')->where('id',$value->member_id)->value('serialnumber');
                            } else {
                                $serialnumber = DB::table('sales_members')->where('id',$value->sales_id)->value('serialnumber');
                            }
                            $reward = DB::table('rewards')->where('id',$value->reward_id)->value('reward_name');
                            $point = DB::table('rewards')->where('id',$value->reward_id)->value('point');
                        @endphp
                        <tbody id="myTable" class="table">
                            <tr>
                                <td style="color: #000; text-align:center;">{{$NUM_PAGE*($page-1) + $exchange+1}}</td>
                                <td style="color: #000; text-align:center;">{{$serialnumber}}</td>
                                <td style="color: #000; text-align:center;">{{$reward}}</td>
                                <td style="color: #000; text-align:center;">{{$point}}</td>
                                <td style="color: #000; text-align:center;">{{$value->date}}</td>
                                @if($value->status == 'รอดำเนินการ')
                                    <td style="color: red; text-align:center;">{{$value->status}}</td>
                                @elseif($value->status = 'แลกรางวัลสำเร็จ')
                                    <td style="color: green; text-align:center;">{{$value->status}}</td>
                                @endif
                                <td style="color: #000; text-align:center;">
                                    <a href="{{url('/admin/reward/exchange/update')}}/{{$value->id}}" style="color: blue;"><i class="fa fa-pencil-square-o"></i> แลกสำเร็จ</a>
                                </td>
                                <td style="color: red; text-align:center;">
                                    <a href="{{url('/admin/exchange-delete/')}}/{{$value->id}}" style="color: red;" onclick="return confirm('Are you sure to delete ?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
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
@endsection
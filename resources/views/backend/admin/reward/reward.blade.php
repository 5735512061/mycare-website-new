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
				<h2 style="text-align:center; color:#092895;">ของรางวัล</h2><hr style="border: 1px solid blue;">
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
                    <a href="{{url('admin/create-reward')}}" class="genric-btn info radius btn_sub">เพิ่มของรางวัล</a>
                    <br><br>
                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table table-bordered table-striped">
                        {{$rewards->links()}}
                        <thead>
                            <tr>
                                <th style="color: #000; text-align:center;">ลำดับ</th>
                                <th style="color: #000; text-align:center;">ประเภท</th>
                                <th style="color: #000; text-align:center;">ของรางวัล</th>
                                <th style="color: #000; text-align:center;">รายละเอียด</th>
                                <th style="color: #000; text-align:center;">พอยท์</th>
                                <th style="color: #000; text-align:center;">วันหมดอายุ</th>
                                <th colspan="2" style="color: #000; text-align:center;">หมายเหตุ</th>
                            </tr>   
                        </thead>
                        @foreach($rewards as $reward => $value)
                        <tbody id="myTable" class="table">
                            <tr>
                                <td style="color: #000; text-align:center;">{{$NUM_PAGE*($page-1) + $reward+1}}</td>
                                <td style="color: #000; text-align:center;">{{$value->user_type}}</td>
                                <td style="color: #000; text-align:center;">{{$value->reward_name}}</td>
                                <td style="color: #000; text-align:center;">{{$value->detail}}</td>
                                <td style="color: #000; text-align:center;">{{$value->point}}</td>
                                <td style="color: #000; text-align:center;">{{$value->expire}}</td>
                                <td style="color: #000; text-align:center;">{{$value->comment}}</td>
                                <td style="color: #000; text-align:center;">
                                    <center>
                                        <a href="{{url('/admin/reward-edit/')}}/{{$value->id}}">
                                            <i class="fa fa-pencil-square" style="color:blue;"></i>
                                        </a>                                    
                                        <a href="{{url('/admin/reward-delete/')}}/{{$value->id}}" onclick="return confirm('Are you sure to delete ?')">
                                            <i class="fa fa-trash" style="color:blue;"></i>
                                        </a>
                                    </center>
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
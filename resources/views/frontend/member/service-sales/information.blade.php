@extends("/frontend/layouts/template/template")

@section("content")

<link rel="stylesheet" type="text/css" href="{{ asset('css/mycare/accordion.css')}}">

<style>
.shape{    
    border-style: solid; border-width: 0 40px 40px 0; float:right; height: 0px; width: 0px;
    -webkit-transform: rotate(360deg);  
    -moz-transform: rotate(360deg);  
    -o-transform: rotate(360deg);  
    transform: rotate(360deg); 
}
.shape-text{
    color:#fff; font-size:12px; font-weight:bold; position:relative; right:-22px; top:-3px; white-space: nowrap;
	-ms-transform:rotate(30deg); /* IE 9 */
	-o-transform: rotate(360deg);  /* Opera 10.5 */
	-webkit-transform:rotate(46deg); /* Safari and Chrome */
	transform:rotate(46deg);
}
.offer{
	background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
}
.shape {
	border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
}
.offer-radius{
	border-radius:7px;
}
.offer-primary {	border-color: #203ca0 ; }
.offer-primary .shape{
	border-color: transparent #203ca0  transparent transparent;
}

.offer-content{
	padding:0 20px 10px;
}
@media (min-width: 487px) {
  .container {
    max-width: 750px;
  }
  .col-sm-6 {
    width: 50%;
  }
}
@media (min-width: 900px) {
  .container {
    max-width: 970px;
  }
  .col-md-4 {
    width: 33.33333333333333%;
  }
}

@media (min-width: 1200px) {
  .container {
    max-width: 1170px;
  }
  .col-lg-3 {
    width: 25%;
  }
  }
}
</style>
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height: 300px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<center><h2 style="font-size:2rem; color:#000085 !important; font-weight: normal !important;">รายละเอียดการใช้บริการ</h2></center>
				<hr style="border: 1px solid blue;">
			</div>
		</div>
    </div>
</section>
<!-- End banner Area -->

<div class="container"> 
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <section id="service">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">
                                                วันที่ใช้บริการ {{$service_date}} เข้าใช้บริการ {{$service_branch}}
                                            </a>
                                        </h4>
                                    </div>
                                    <div>
                                        <div class="panel-body">
                                            <table class="table table-responsive">
                                                @foreach($services as $service => $value)
                                                <tbody style="font-family: 'Prompt' !important;">
                                                    <tr>
                                                        <td>#{{$NUM_PAGE*($page-1) + $service+1}}</td>
                                                        <td>{{$value->service}}</td>     
                                                        <td>จำนวน {{$value->amount}} {{$value->unit}}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

@endsection


@extends("/frontend/layouts/template/template-bg")

@section("content")

@include("/frontend/layouts/header/alliance/header-lifestyle")
<div class="container">

	<div class="row">
	  @foreach($lifestyles as $lifestyle => $value)
		<div class="col-md-4">
			<a href="{{url('alliance/detail/')}}/{{$value->id}}">
				<div class="thecard">
				<div class="card-img">
					<img src="{{url('images/store')}}/{{$value->image}}" class="img-responsive" width="100%">
				</div>
				<div class="card-caption">
					{{-- <h1>{{$value->name}}</h1> --}}
					{{-- <p>{{$value->promotion}}</p> --}}
					<h1 style="text-align:left; margin-top:10px; font-size:20px;">{{$value->promotion}}</h1>
					<p>{{$value->name}}</p>
					{{-- <p style="color:#092895;">รับคะแนนสะสม {{$value->point}} คะแนน</p> --}}
					<h4>โปรโมชั่น {{$value->date}} - {{$value->expire}}</h4>
					<img id="like-btn" src="{{url('images/logo')}}/{{$value->logo}}" width="25%;">
				</div>
				<div class="card-outmore">
					<h5>รายละเอียดเพิ่มเติม</h5>
					<i id="outmore-icon" class="fa fa-angle-right"></i>
				</div>
				</div>
			</a>
		</div>
    @endforeach
  </div>
</div>

@endsection
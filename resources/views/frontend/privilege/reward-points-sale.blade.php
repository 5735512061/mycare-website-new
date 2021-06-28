@extends("/frontend/layouts/template/template-bg")
<style>
  .prompt {
    font-family: 'Prompt' !important;
  }
  </style>
  
@section("content")

@include("/frontend/layouts/header/privilege/header-rewardPoints")

<div class="container">

  <div class="container" id="desktop">
    <div class="row" style="margin-right:20px !important; margin-left:20px !important;">
      @foreach($rewards as $reward => $value)
      <div class="col-xs-12 col-md-6 bootstrap snippets column {{$value->reward_type}}">
        <!-- product -->
        <div class="product-content product-wrap clearfix">
          <div class="row">
              <div class="col-md-5 col-sm-5 col-xs-5">
                <div class="product-image"> 
                  <center><img src="{{url('/images/reward')}}/{{$value->image}}" class="img-responsive" width="80%"></center>
                </div>
              </div>
              <div class="col-md-7 col-sm-7 col-xs-7">  
              <div class="product-deatil">
                  <h4 class="name">
                    <a href="#">
                      {{$value->reward_name}}
                    </a>
                  </h4><br>
                  <p class="price-container">
                    <span>แลก {{$value->point}} คะแนน</span>
                  </p>
              </div>
              <div class="product-info smart-form">
                  <a href="{{url('privilege/reward-detail/')}}/{{$value->id}}" class="genric-btn blue radius btn_sub" style="text-align: right;">รายละเอียด</a>
              </div>
            </div>
          </div>
        </div>
        <!-- end product -->
      </div>
      @endforeach
    </div>
  </div>

  <!-- END MAIN -->
  <div class="container" id="mobile" style="display: none;">
    <div class="row" style="margin-top:-10px !important; margin-right:20px !important; margin-left:-40px !important;">
      @foreach($rewards as $reward => $value)
      <div class="col-xs-12 col-md-6 bootstrap snippets column {{$value->reward_type}}">
        <!--Card-->
        <div class="card m-5" style="border: 2px solid rgba(0, 0, 0, .125) !important; margin-top:0px !important; margin-bottom:0.5rem !important; width: 22rem;">
          <!--Card content-->
          <div class="card-body">
            <!--Title-->
            <center><h4 class="card-title">{{$value->reward_name}}</h4></center>
            <center><h3 class="card-title" style="color:#34488d; font-size:18px; font-weight:normal;">ใช้คะแนน {{$value->point}} Point</h3></center>
            <!--Text-->
            <center><img src="{{url('/images/reward')}}/{{$value->image}}" class="img-responsive" width="80%"></center>
            <center><a href="{{url('privilege/reward-detail/')}}/{{$value->id}}" class="genric-btn blue radius btn_sub" style="text-align: right;">รายละเอียด</a></center>
          </div>
        
        </div>
        <!--/.Card-->
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
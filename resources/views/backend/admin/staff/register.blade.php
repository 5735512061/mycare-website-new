@extends("/backend/layouts/template/template")
<link rel="stylesheet" href="{{asset('jquery.Thailand.js/dist/jquery.Thailand.min.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@section("content")
<style>
    input[type="file"] {
    display: none;
    }
    .custom-file-upload {
    border: 2px solid #4aa1ff;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    font-family: 'Prompt';
    border-radius: 10px;
    /* background: #ececfc; */
    padding: 5px 20px;
    }
</style>
<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">ลงทะเบียนพนักงาน</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->

<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6">
            <form method="POST" action="{{ route('register.staff.submit') }}">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))

                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                <h2>ข้อมูลเบื้องต้น <i class="fa fa-caret-down" style="color:#777777;"></i></h2><br>
                <div class="row">
                    <div class="mt-10 col-md-12">
                        <input type="text" class="single-input" style="font-family:Prompt;" placeholder="ชื่อเข้าใช้งาน" onfocus="this.placeholder = 'ชื่อเข้าใช้งาน'" name="staff_name" value="{{ old('staff_name') }}" required >
                    </div>
                    <div class="mt-10 col-md-12">
                        <input type="text" class="single-input" style="font-family:Prompt;" placeholder="พนักงานสาขา" onfocus="this.placeholder = 'พนักงานสาขา'" name="branch" value="{{ old('branch') }}" required>
                    </div>
                    <div class="mt-10 col-md-12">
                        <input style="font-family:Prompt;" type="text" name="password" placeholder="รหัสผ่าน" onfocus="this.placeholder = 'รหัสผ่าน'" class="single-input" value="{{ old('password') }}">
                    </div>
                </div><br>
                <button class="genric-btn info radius">ลงทะเบียนพนักงาน</button>
                <br><br>
            </form>
        </div>
    </div>
    <div class="col-lg-3 col-md-3"></div>
</div>

@endsection
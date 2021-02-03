@extends("/backend/layouts/template/template")

<link href="{{ asset('css/mycare/information-member-template.css')}}" type="text/css" rel="stylesheet">
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
    padding: 5px 20px;
    }
    th,tr {
        font-family: 'Prompt' !important;
    }
</style>
@section("content")

<!-- start banner Area -->
<section class="home-banner-area">
	<div class="container">
		<div class="row d-flex align-items-center justify-content-between" style="height:250px !important;">
			<div class="home-banner-content col-lg-12 col-md-12">
				<h2 style="text-align:center; color:#092895;">แก้ไขข้อมูลการใช้บริการ</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-lg-1 col-md-1"></div>
        <div class="col-lg-10 col-md-10">
            <form action="{{url('/admin/serviceUpdate-sales')}}" enctype="multipart/form-data" method="post">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="branch" class="single-input" value="{{$service->branch}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="date" id="datepicker" data-date-format="dd/mm/yyyy" class="single-input" value="{{$service->date}}">
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="bill_number" class="single-input" value="{{$service->bill_number}}">
                    </div>
                </div> <br>
                <div class="table-responsive">        
                <table class="table order-list">
                    <thead>
                        <tr>
                            <th class="text-center">
                                สินค้า/บริการ
                                @if ($errors->has('service'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('service') }})</span>
                                @endif
                            </th>
                            <th class="text-center">
                                จำนวน
                                @if ($errors->has('amount'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('amount') }})</span>
                                @endif
                            </th>
                            <th class="text-center">
                                หน่วย
                                @if ($errors->has('unit'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('unit') }})</span>
                                @endif
                            </th>
                            <th class="text-center">
                                ราคา/หน่วย
                                @if ($errors->has('price'))
                                <span class="text-danger" style="font-size: 17px;">({{ $errors->first('price') }})</span>
                                @endif
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name='service' class="form-control" value="{{$service->service}}"/></td>
                            <td><input type="text" name='amount' class="form-control" value="{{$service->amount}}"/></td>
                            <td><input type="text" name='unit' class="form-control" value="{{$service->unit}}"/></td>
                            <td><input type="text" name='price' class="form-control" value="{{$service->price}}"/></td>
                            {{-- <td class="col-sm-2"><a class="deleteRow"></a></td> --}}
                        </tr>
                    </tbody>
                </table>
                </div>

                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="discount" class="single-input" value="{{$service->discount}}">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="discountturn" class="single-input" value="{{$service->discountturn}}">
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="comment" class="single-input" value="{{$service->comment}}">
                    </div>
                </div><br>
                <input type="hidden" name="id" value="{{$service->id}}">
                <button class="genric-btn info radius">แก้ไขข้อมูล</button>
            </form>
        </div>
        <div class="col-lg-1 col-md-1"></div>
    </div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    // date
    $('#datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());

@endsection
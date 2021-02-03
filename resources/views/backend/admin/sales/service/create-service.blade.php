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
				<h2 style="text-align:center; color:#092895;">ข้อมูลการใช้บริการ</h2><hr style="border: 1px solid blue;">
			</div>
		</div>
	</div>
</section>
<!-- End banner Area -->
<div class="container">
    <div class="row">
        <div class="col-lg-1 col-md-1"></div>
        <div class="col-lg-10 col-md-10">
            <form action="{{url('/admin/createService-sales')}}" enctype="multipart/form-data" method="post">@csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                      @if(Session::has('alert-' . $msg))
                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                      @endif
                    @endforeach
                </div>
                <h3>เพิ่มข้อมูลบริการ</h3>
                <p>&nbsp;</p>
                <p><span class="red">*</span> กรุณากรอกข้อมูลให้ครบถ้วน และถูกต้องตามความจริง</p>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="branch" class="single-input" value="สาขาบายพาส">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="date" id="datepicker" data-date-format="dd/mm/yyyy" placeholder="วัน/เดือน/ปี ค.ศ ที่ใช้บริการ" onfocus="this.placeholder = 'วัน/เดือน/ปี ค.ศ ที่ใช้บริการ'" class="single-input">
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="bill_number" placeholder="เลขที่บิล (กรอกเป็นตัวเลข)" onfocus="this.placeholder = 'เลขที่บิล (กรอกเป็นตัวเลข)'" class="single-input">
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
                            <td><input type="text" name='service[]'  placeholder='สินค้า/บริการ' class="form-control"/></td>
                            <td><input type="text" name='amount[]' placeholder='จำนวน (กรอกเป็นตัวเลข)' class="form-control"/></td>
                            <td><input type="text" name='unit[]' placeholder='หน่วย' class="form-control"/></td>
                            <td><input type="text" name='price[]' placeholder='ราคา (กรอกเป็นตัวเลข)' class="form-control"/></td>
                            {{-- <td class="col-sm-2"><a class="deleteRow"></a></td> --}}
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td  style="font-family:'Prompt';" colspan="5" style="text-align: left;">
                                <input type="button" class="genric-btn info radius btn-block" id="addrow" value="เพิ่มบริการ"/>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>

                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="discount" placeholder="ส่วนลด (กรอกเป็นตัวเลข)" onfocus="this.placeholder = 'ส่วนลด (กรอกเป็นตัวเลข)'" class="single-input">
                    </div>
                    <div class="mt-10 col-md-6">
                        <input type="text" name="discountturn" placeholder="หักเทริน (กรอกเป็นตัวเลข)" onfocus="this.placeholder = 'หักเทริน (กรอกเป็นตัวเลข)'" class="single-input">
                    </div>
                </div>
                <div class="row">
                    <div class="mt-10 col-md-6">
                        <input type="text" name="comment" placeholder="หมายเหตุ" onfocus="this.placeholder = 'หมายเหตุ'" class="single-input">
                    </div>
                </div><br>
                <input type="hidden" name="car_id" value="{{$member->id}}">
                <button class="genric-btn info radius">บันทึกข้อมูล</button>
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

// add service
$(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" placeholder="สินค้า/บริการ" name="service[]' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="จำนวน" name="amount[]' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="หน่วย" name="unit[]' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" placeholder="ราคา" name="price[]' + counter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="ลบ"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });

    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });
});

function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();
}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}

</script>
@endsection
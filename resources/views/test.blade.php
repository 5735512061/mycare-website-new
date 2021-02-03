@extends("/frontend/layouts/template/template-Memberlogin")
<link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
@section("content")
<!--Bootsrap 4 CDN-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<!--Fontawesome CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<!--Custom styles-->
<link href="{{ asset('css/mycare/page-login.css')}}" type="text/css" rel="stylesheet">     
    
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('member.login.submit') }}" autocomplete="off">
                    @csrf
                 <div class="input-group form-group">
                     <div class="input-group-prepend">
                         <span class="input-group-text"><i class="fas fa-user"></i></span>
                     </div>
                     <input type="text" style="font-family:Prompt;" class="form-control{{ $errors->has('serialnumber') ? ' is-invalid' : '' }}" placeholder="หมายเลขสมาชิก MY CARE" name="serialnumber" id="ssn" maxlength="19" minlength="19">
                     @if ($errors->has('serialnumber'))
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('serialnumber') }}</strong>
                         </span>
                     @endif
                 </div>
                 <div class="form-group">
                     <input type="submit" value="เข้าสู่ระบบ" class="btn float-left login_btn">
                 </div>
             </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('https://code.jquery.com/jquery-3.2.1.min.js')}}"></script>
<script>
    // serial number
    $('#ssn').keyup(function() {
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



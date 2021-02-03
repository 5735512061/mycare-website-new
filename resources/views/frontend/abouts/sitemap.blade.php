@extends("/frontend/layouts/template/template-bg")

@section("content")
<style>
    .underline {
        border-bottom : 1px solid #0038ff;
        color: #0038ff;
    }
    .mg-t {
        margin-top: 16px;
    }
    p{
        color: #0038ff;
    }
    a{
        color:#0038ff;
    }
    a:hover{
        color:#34a6f5;
    }
</style>
@include("/frontend/layouts/header/about/header-sitemap")

<div class="container">
     <div class="row" style="background-color: #fff; margin-top:-90px !important;">
        <div class="col-md-2"> 
            <span class="underline"><a href="{{url('/')}}">หน้าหลัก</a></span> <i class="fa fa-caret-right" style="color:#d4d3d3; font-size:32px;"></i><i class="fa fa-caret-left"></i><br><br><br>
        </div>
        {{-- <div class="col-md-2"> 
            <span class="underline"><a href="{{url('/privilege/reward-points')}}">แลกคะแนนสะสม</a></span> <i class="fa fa-caret-right" style="color:#d4d3d3; font-size:32px;"></i><i class="fa fa-caret-left"></i><br><br><br>
        </div> --}}
        <div class="col-md-3">
            <span class="underline"><a href="{{url('/promotion')}}">ติดตามข่าวสาร</a></span> <i class="fa fa-caret-right" style="color:#d4d3d3; font-size:32px;"></i><i class="fa fa-caret-left"></i><br><br><br>
        </div>
        <div class="col-md-3">
            <span class="underline">เกี่ยวกับเรา</span> <i class="fa fa-caret-right" style="color:#d4d3d3; font-size:32px;"></i><i class="fa fa-caret-left"></i>
            <p class="mg-t" style="font-size: 16px;"><a href="{{url('/about')}}">เกี่ยวกับบัตรสมาชิก</a></p>
            <p style="font-size: 16px;"><a href="{{url('/about/condition')}}">ข้อกำหนดและเงื่อนไข</a></p>
            <p style="font-size: 16px;"><a href="{{url('/about/faqs')}}">คำถามที่พบบ่อย</a></p><br>
        </div>
        <div class="col-md-2">
            <span class="underline">ส่วนลดเพื่อนแท้</span> <i class="fa fa-caret-right" style="color:#d4d3d3; font-size:32px;"></i><i class="fa fa-caret-left"></i>
            <p class="mg-t" style="font-size: 16px;"><a href="{{url('/alliance/store')}}">เพื่อนแท้ อิ่มอร่อย</a></p>
            <p style="font-size: 16px;"><a href="{{url('/alliance/lifestyle')}}">เพื่อนแท้ ไลฟ์สไตล์</a></p>
            <p style="font-size: 16px;"><a href="{{url('/alliance/hotel')}}">เพื่อนแท้ ชวนฝัน</a></p>
            <p style="font-size: 16px;"><a href="{{url('/alliance/car-service')}}">เพื่อนแท้ ดูแลรถยนต์</a></p>
        </div>
     </div>
</div>

@endsection
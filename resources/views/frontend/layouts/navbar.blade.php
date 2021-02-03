<!-- start header Area -->

{{-- <header id="header"> --}}
	<div class="container main-menu">
		<div class="row align-items-center justify-content-between d-flex">
			<div id="logo">
				<a href="#">
					{{-- <img src="{{ asset('img/mycare/logo-mycare.png')}}" width="108px;" height="36px;"/> --}}
				</a>
			</div>
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li class="menu-active">
						<a href="{{url('/')}}">หน้าหลัก</a>
					</li>
					<li>
						<a href="{{url('/privilege/reward-points')}}">แลกคะแนนสะสม</a>
					</li>
					<li>
						<a href="{{url('/promotion')}}">ติดตามข่าวสาร</a>
					</li>
					<li>
						<a href="{{url('/alliance/index')}}">ส่วนลดเพื่อนแท้</a>
					</li>

					@if(Auth::guard('member')->user() == NULL && Auth::guard('sales_members')->user() == NULL)
						<li><a href="{{url('/member/login')}}">เข้าสู่ระบบ</a></li>
					@endif

					@auth('member')
					<li>
						<a href="{{url('/member/profile')}}">บัญชีสมาชิก</a>
					</li>
					@endauth

					@auth('sales_members')
						<li>
							<a href="{{url('/member/profile')}}">บัญชีสมาชิก</a>
						</li>
					@endauth
				</ul>
			</nav>
		</div>
	</div>
{{-- </header> --}}
<!-- end header Area -->
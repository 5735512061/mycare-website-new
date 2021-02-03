<!-- start header Area -->
<header id="header">
	<div class="container main-menu">
		<div class="row align-items-center justify-content-between d-flex">
			<div id="logo">
				{{-- <a href="index.html">
					<img src="{{ asset('img/mycare/logo-mycare.png')}}" width="108px;" height="36px;"/>
				</a> --}}
			</div>
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li class="menu-active">
						<a href="{{url('/')}}">หน้าหลัก</a>
					</li>
					<li class="menu-has-children">
						<a href="#">สิทธิพิเศษ</a>
						<ul>
							<li><a href="{{url('/privilege/point')}}">คะแนนสะสม</a></li>
							<li><a href="{{url('/privilege/reward-points')}}">แลกคะแนน</a></li>
						</ul>
					</li>
					<li>
						<a href="{{url('/promotion')}}">ข่าวสารและโปรโมชั่น</a>
					</li>
					<li class="menu-has-children">
						<a href="#">เกี่ยวกับเรา</a>
						<ul>
							<li><a href="{{url('/about')}}">เกี่ยวกับ MY CARE</a></li>
							<li><a href="{{url('/about/condition')}}">ข้อกำหนดและเงื่อนไข</a></li>
							<li><a href="{{url('/about/faqs')}}">คำถามที่พบบ่อย</a></li>
						</ul>
					</li>
					<li class="menu-has-children">
						<a href="#">พันธมิตร</a>
						<ul>
							<li><a href="{{url('/alliance/store')}}">ร้านอาหาร</a></li>
							<li><a href="{{url('/alliance/lifestyle')}}">ไลฟ์สไตล์</a></li>
						</ul>
					</li>
					<li class="menu-active">
						@auth
                            <a href="{{ route('member.logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ 'App\Member' == Auth::getProvider()->getModel() ? route('member.logout') : route('member.logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                        @endauth
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<!-- end header Area -->
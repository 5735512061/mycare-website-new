<!-- start header Area -->
<header id="header">
	<div class="container main-menu">
		<div class="row align-items-center justify-content-between d-flex">
			<div id="logo"></div>
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li class="menu-active">
						<a href="{{url('staff/member')}}">หน้าหลัก</a>
					</li>
					<li class="menu-active">
						<a href="{{url('staff/member')}}">ข้อมูลสมาชิกทั้งหมด</a>
					</li>
					<li class="menu-active">
						<a href="{{url('staff/sales')}}">ข้อมูลสมาชิกเซลล์</a>
					</li>
					<li>
						<a href="{{url('/member/register')}}">สมัครสมาชิกใหม่</a>
					</li>
					<li class="menu-active">
						@auth
                            <a href="{{ route('staff.logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ 'App\Staff' == Auth::getProvider()->getModel() ? route('staff.logout') : route('staff.logout') }}" method="POST" style="display: none;">
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
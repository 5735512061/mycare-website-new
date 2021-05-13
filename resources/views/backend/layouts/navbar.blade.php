<!-- start header Area -->
<header id="header">
	<div class="container main-menu">
		<div class="row align-items-center justify-content-between d-flex">
			<div id="logo"></div>
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li class="menu-active">
						<a href="{{url('admin/member')}}">หน้าหลัก</a>
					</li>
					<li class="menu-has-children">
						<a href="#">สมาชิก</a>
						<ul class="colordesign">
							<li><a href="{{url('admin/member')}}">ข้อมูลสมาชิกทั้งหมด</a></li>
							<li><a href="{{url('admin/member-register')}}">สมัครผ่านเว็บไซต์</a></li>
							<li><a href="{{url('admin/staff')}}">ข้อมูลพนักงาน</a></li>
							<li><a href="{{url('admin/sales')}}">ข้อมูลสมาชิกเซลล์</a></li>
							<li><a href="{{url('privilege/expire-mycare-member/MycareExpire')}}"><i class="fa fa-address-card-o"></i></a></li>
						</ul>
					</li>
					<li class="menu-has-children">
						<a href="#">พันธมิตร</a>
						<ul class="colordesign">
							<li><a href="{{url('admin/alliance')}}">ข้อมูลพันธมิตร</a></li>
							<li><a href="{{url('admin/statistic')}}">จำนวนสิทธิ์</a></li>
						</ul>
					</li>
					<li class="menu-has-children">
						<a href="#">สิทธิพิเศษ</a>
						<ul class="colordesign">
							<li><a href="{{url('admin/reward')}}">ของรางวัล</a></li>
							<li><a href="{{url('admin/reward/exchange')}}">แลกคะแนนสะสม</a></li>
						</ul>
					</li>
					<li class="menu-has-children">
						<a href="#">ลงทะเบียน</a>
						<ul class="colordesign">
							<li><a href="{{url('/register')}}">ลงทะเบียนผู้ดูแลระบบ</a></li>
							<li><a href="{{url('/admin/staff/register-staff')}}">ลงทะเบียนพนักงาน</a></li>
							<li><a href="{{url('/admin/alliance/register-alliance')}}">ลงทะเบียนพันธมิตร</a></li>
						</ul>
					</li>
					<li class="menu-active">
						@auth
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                ออกจากระบบ
                            </a>
                            <form id="logout-form" action="{{ 'App\User' == Auth::getProvider()->getModel() ? route('logout') : route('logout') }}" method="POST" style="display: none;">
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
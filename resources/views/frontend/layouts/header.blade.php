	
	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					<!-- Logo desktop -->		
					<a href="#" class="logo">
						Logo
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="/">Home</a>
							
							</li>
							<li class="active-menu">
								<a href="#">Test</a>
							</li>
						</ul>
					</div>	
					
					<div class="wrap-icon-header flex-w flex-r-m">
						<ul class="main-menu">
							<li>
								@if(auth()->guard('customer')->check())
									<a href="{{url('dashboard')}}">{{auth()->guard('customer')->user()->name}}</a>
								@else
									<a href="{{route('c_login.get')}}">Login</a>
								@endif
							</li>

							@if(!auth()->guard('customer')->check())
							<li class="active-menu">
								<a href="{{route('c_login.get')}}">Register</a>
							</li>
							@endif
							@if(auth()->guard('customer')->check())
							<li class="active-menu">
								<form action="{{route('c_logout')}}" method="post">
									@csrf
									<button type="submit">Logout</button>
								</form>
							</li>
							@endif
						</ul>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="#">
					Logo
				</a>
			</div>

			<!-- Icon header -->
			

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="/">Home</a>
					
				</li>

				<li>
					<a href="#">Test</a>
				</li>
			</ul>
		</div>
	</header>
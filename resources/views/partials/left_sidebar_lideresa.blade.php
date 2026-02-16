<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	<aside class="app-sidebar sidebar-scroll">
		<div class="main-sidebar-header active">
			<a class="desktop-logo logo-light active" href="{{route('profile.get')}}"><img src="../../images/Logo1-viejo2.png" class="main-logo" alt="logo"></a>
			<a class="desktop-logo logo-dark active" href="index.html"><img src="../../assets/img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
			<a class="logo-icon mobile-logo icon-light active" href="index.html"><img src="../../images/Logo1-viejo2.png" class="logo-icon" alt="logo"></a>
			<a class="logo-icon mobile-logo icon-dark active" href="index.html"><img src="../../assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
		</div>
		<div class="main-sidemenu">
			<div class="app-sidebar__user clearfix">
				<div class="dropdown user-pro-body">
					<div class="">
						@if(isset($perfil['foto_perfil_url']))
							<img alt="user-img" class="avatar avatar-xl brround" src="{{ \Storage::disk('s3')->temporaryUrl($perfil['foto_perfil_url'], '+10 minutes') }}"><span class="avatar-status profile-status bg-green"></span>
						@endif
					</div>
					<div class="user-info">
						<!-- <h4 class="font-weight-semibold mt-3 mb-0">Petey Cruiser</h4> -->
						<a class="main-contact-star" href="">
							<i class="mdi mdi-star mr-1 text-warning"></i>
							<i class="mdi mdi-star mr-1 text-warning"></i>
							<i class="mdi mdi-star mr-1 text-warning"></i>
							<i class="mdi mdi-star mr-1 text-warning"></i>
							<i class="fe fe-star mr-1 text-warning"></i>
						</a>
						<br>
						<span class="mb-0 text-muted"></span>
					</div>
				</div>
			</div>
			<ul class="side-menu">
				<li class="side-item side-item-category">Menú</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('profile.get') }}"><i class=" side-menu__icon fa fa-user"></i><span class="side-menu__label">Mi Perfil</span></a>
				</li>
				{{-- <li class="slide">
					<a class="side-menu__item" href="{{ route('offer.index') }}"><i class=" side-menu__icon fa fa-align-justify"></i><span class="side-menu__label">Ofertas</span></a>
				</li> --}}
				<li class="slide">
					<a class="side-menu__item" href="{{ route('candidate.index') }}"><i class=" side-menu__icon fa fa-users"></i><span class="side-menu__label">Mis Mentee</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('program.index') }}"><i class=" side-menu__icon fa fa-book"></i><span class="side-menu__label">Programas</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('entrenamiento.index') }}"><i class=" side-menu__icon fa fa-book"></i><span class="side-menu__label">Mi entrenamiento</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('logout') }}"><i class=" side-menu__icon fa fa-sign-out" ></i><span class="side-menu__label">Salir</span></a>
				</li>
			</ul>
		</div>
	</aside>
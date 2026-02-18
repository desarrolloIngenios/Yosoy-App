<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	<aside class="app-sidebar sidebar-scroll">
		<div class="main-sidebar-header active">
			<a class="desktop-logo logo-light active" href="{{route('profile.get')}}"><img src="{{URL::asset('/images/Logo1-viejo2.png')}}" class="main-logo" alt="logo"></a>
			<a class="desktop-logo logo-dark active" href="index.html"><img src="{{URL::asset('/assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
			<a class="logo-icon mobile-logo icon-light active" href="index.html"><img src="{{URL::asset('/images/Logo1-viejo2.png')}}" class="logo-icon" alt="logo"></a>
			<a class="logo-icon mobile-logo icon-dark active" href="index.html"><img src="{{URL::asset('/assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
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
				<li class="side-item side-item-category">Administrador</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('profile.get') }}"><i class=" side-menu__icon fa fa-user"></i><span class="side-menu__label">Mi Perfil</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('user_list') }}"><i class=" side-menu__icon fa fa-users"></i><span class="side-menu__label">Usuarios</span></a>
				</li>
			

				{{-- <li class="slide">
					<a class="side-menu__item" href="{{ route('offer.index') }}"><i class=" side-menu__icon fa fa-align-justify"></i><span class="side-menu__label">Ofertas</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('star_rating.index') }}"><i class=" side-menu__icon fa fa-star"></i><span class="side-menu__label">Calificaciones</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('offer.questions.show') }}"><i class=" side-menu__icon fa fa-star"></i><span class="side-menu__label">Calificación Oferta</span></a>
				</li> --}}
				
				{{-- <li class="slide">
					<a class="side-menu__item" href="{{ route('oferta.create') }}"><i class=" side-menu__icon fa fa-plus"></i><span class="side-menu__label">Crear Oferta</span></a>
				</li> --}}
				{{-- <li class="slide">
					<a class="side-menu__item" href="{{ route('web.generate_codes') }}"><i class=" side-menu__icon fa fa-barcode"></i><span class="side-menu__label">Generar Codigos</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('web.show_codes') }}"><i class=" side-menu__icon fa fa-barcode"></i><span class="side-menu__label">Ver Codigos</span></a>
				</li>
				<li class="slide">
					<a class="side-menu__item" href="{{ route('wompi.index') }}"><i class=" side-menu__icon fa fa-file"></i><span class="side-menu__label">Facturación</span></a>
				</li> --}}
				<li class="slide">
					<a class="side-menu__item" target="_blank" href="{{ route('terminos_condiciones') }}"><i class=" side-menu__icon fa fa-file"></i><span class="side-menu__label">Política de datos.</span></a>
				</li>
				
				<li class="slide">
					<a class="side-menu__item" href="{{ route('logout') }}"><i class=" side-menu__icon fa fa-sign-out" ></i><span class="side-menu__label">Salir</span></a>
				</li>
			</ul>
		</div>
	</aside>
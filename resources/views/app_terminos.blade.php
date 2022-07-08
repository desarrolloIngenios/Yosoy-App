<!DOCTYPE html>
<html lang="en">
    @include('partials/head')
    <body class="main-body app sidebar-mini">
        @include('partials/loader')

        <div class="page">

			<!-- main-sidebar -->
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	<aside class="app-sidebar sidebar-scroll">
		<div class="main-sidebar-header active">
			<a class="desktop-logo logo-light active" href="{{route('profile.get')}}"><img src="../../images/Logo1.png" class="main-logo" alt="logo"></a>
			<a class="desktop-logo logo-dark active" href="index.html"><img src="../../assets/img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
			<a class="logo-icon mobile-logo icon-light active" href="index.html"><img src="../../images/Logo1.png" class="logo-icon" alt="logo"></a>
			<a class="logo-icon mobile-logo icon-dark active" href="index.html"><img src="../../assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
		</div>
	</aside>
			<!-- main-sidebar -->

			<!-- main-content -->
            <div class="main-content app-content">

				<!-- main-header -->
			
				<!-- /main-header -->

				<!-- container -->
				<div class="container-fluid">

                	<!-- breadcrumb -->
                    @include('partials/breadcrumb')
					<!-- breadcrumb -->

			        @yield('content')

                </div>
				<!-- Container closed -->
			</div>
            <!-- main-content closed -->

            <!-- Sidebar-right-->
			@include('partials/sidebar_right')
			<!--/Sidebar-right-->

			<!-- Footer opened -->
			@include('partials/footer')
			<!-- Footer closed -->

		</div>
        @include('partials/include_js')
    </body>
</html>
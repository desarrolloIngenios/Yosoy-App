<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>

		<!-- Title -->
		<title> Yo Soy </title>

		<!-- Favicon -->
		<link rel="icon" href="../../images/ico.png" type="image/x-icon"/>

		<!-- Icons css -->
		<link href="../../assets/css/icons.css" rel="stylesheet">

		<!--  Right-sidemenu css -->
		<link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="../../assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!--  Left-Sidebar css -->
		<link rel="stylesheet" href="../../assets/css/closed-sidemenu.css">

		<!--- Style css --->
		<link href="../../assets/css/style.css" rel="stylesheet">

		<!--- Dark-mode css --->
		<link href="../../assets/css/style-dark.css" rel="stylesheet">

		<!---Skinmodes css-->
		<link href="../../assets/css/skin-modes.css" rel="stylesheet" />

		<!--- Animations css-->
		<link href="../../assets/css/animate.css" rel="stylesheet">

	</head>
	<body class="error-page1 main-body bg-light">

		<!-- Loader -->
		<div id="global-loader">
			<img src="../../assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- Page -->
		<div class="page">

			<div class="container-fluid">
				<div class="row no-gutter">
					<!-- The image half -->
					<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
						<div class="row wd-100p mx-auto text-center">
							<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
								<img src="../../images/Logo1.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
							</div>
						</div>
					</div>
					<!-- The content half -->
					<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
						<div class="login d-flex align-items-center py-2">
							<!-- Demo content-->
							<div class="container p-0">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
										<div class="card-sigin">
											<div class="mb-5 d-flex"> <a href="{{ route('login') }}"><img src="../../images/Logo1.png" class="sign-favicon ht-40" alt="logo"></a></div>
													<div class="card-sigin">
														<div class="main-signup-header">
															<h2>Olvidaste tu contraseña!</h2>
															@if (session('status'))
															<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
																<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
																<span class="alert-inner--text"><strong></strong> {{ session('status') }}</span>
																<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">×</span>
																</button>
															</div>
															@endif
															@if (session('success'))
															<div class="alert alert-success alert-dismissible fade show" role="alert">
																<span class="alert-inner--icon"><i class="fe fe-thumbs-up"></i></span>
																<span class="alert-inner--text"> {{ session('success') }} </span>
																<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">×</span>
																</button>
															</div>
															@endif
													<h5 class="font-weight-semibold mb-4">Por favor ingresa tu correo electrónico</h5>
													
													
													<form action="{{ route('forgot.post') }}" method="post">
													@csrf
														<div class="form-group">
															<label>Correo Electrónico</label> <input name="email" class="form-control" placeholder="Ingresa tu correo electrónico" type="email" value="{{ old('email') }}" required>
														</div>
														<button type="submit" class="btn btn-main-primary btn-block">Recuperar contraseña</button>
														
													</form>
													<div class="main-signin-footer mt-5">
														<p>Todavía no tienes cuenta? <a href="{{ route('registro.get') }}">Crea una Cuenta</a> ó <a href="{{ route('login') }}">Inicia Sesión.</a></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
					</div><!-- End -->
				</div>
			</div>

		</div>
		<!-- End Page -->

		<!-- JQuery min js -->
		<script src="../../assets/plugins/jquery/jquery.min.js"></script>

		<!-- Bootstrap Bundle js -->
		<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Ionicons js -->
		<script src="../../assets/plugins/ionicons/ionicons.js"></script>

		<!-- Moment js -->
		<script src="../../assets/plugins/moment/moment.js"></script>

		<!-- P-scroll js -->
		<script src="../../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="../../assets/plugins/perfect-scrollbar/p-scroll.js"></script>

		<!-- eva-icons js -->
		<script src="../../assets/js/eva-icons.min.js"></script>

		<!-- Rating js-->
		<script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>
		<script src="../../assets/plugins/rating/jquery.barrating.js"></script>

		<!-- custom js -->
		<script src="../../assets/js/custom.js"></script>
		<script>
	
		</script>
	</body>
</html>
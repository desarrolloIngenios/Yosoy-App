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

		<!--- Favicon --->
		<link rel="icon" href="../../images/ico.png" type="image/x-icon"/>

		<!--- Icons css --->
		<link href="../../assets/css/icons.css" rel="stylesheet">

		<!-- Internal Select2 css -->
		<link href="../../assets/plugins/select2/css/select2.min.css" rel="stylesheet">	

		<!--- Right-sidemenu css --->
		<link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="../../assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!--- Style css --->
		<link href="../../assets/css/style.css" rel="stylesheet">

		<!--- Skinmodes css --->
		<link href="../../assets/css/skin-modes.css" rel="stylesheet">

		<!--- Darktheme css --->
		<link href="../../assets/css/style-dark.css" rel="stylesheet">

		<!--- Animations css --->
		<link href="../../assets/css/animate.css" rel="stylesheet">

	</head>
	<body class="error-page1 main-body">

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
					<div class="col-md-6 col-lg-6 col-xl-7 bg-primary-transparent" style="display: flex; align-items: center; justify-content: center; height: 100vh;">
						<img src="../../images/Logo1.png" class="logo1-crop" style="max-height: 65vh; max-width: 65vw; width: auto; height: auto;" alt="logo">
					</div>
					<!-- The content half -->
					<div class="col-md-6 col-lg-6 col-xl-5 bg-white py-3 pb-5" style="height: 100vh; overflow-y: auto;">
						<div class="login d-flex align-items-center py-2" style="height: 100%;">
							<div class="container p-0" style="height: 100%;">
								<div class="row" style="height: 100%;">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto" style="height: 100%;">
										<div class="card-sigin" style="height: 100%;">
											<div class="mb-5 d-flex"> <h1 class="text-primary"><a href="{{ route('login') }}"><img
                                                            src="../../images/Logo1.png" class="sign-favicon" style="width: 10rem;"
                                                            alt="logo"></a> {{ $nombre !== 'Lideresa' ? 'Mentee' : $nombre }}</h1></div>
											<div class="main-signup-header">
												<h2 class="text-primary">Crea tu perfil</h2>
												<h5 class="font-weight-normal mb-4">Solo te toma un minuto.</h5>
												@if ( $errors->count() > 0 )
													<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
													@foreach( $errors->all() as $message )
														<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
														<span class="alert-inner--text"><strong></strong> {{ $message }}</span>
													@endforeach
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">x</span>
														</button>
													</div>
												@endif
												<form action="{{ route('registro.post') }}" method="post">
												@csrf
												<input name="is_empirico" type="hidden" value="{{ $is_empirico }}">
													{{-- @if ($nombre!='Lideresa')    --}}
													{{-- Eliminados selects: cargo_id, nivel_experiencia_id, tiempo_experiencia_id --}}
													@if ($nombre=='Lideresa')
														<input type="hidden" name="is_lideresa" value="1">
													@endif
													<div class="form-group">
														<label>Nombre(s)</label> <input class="form-control" name="name" placeholder="Ingresa tu(s) nombre(s)" value="{{ old('name') }}" type="text" required>
													</div>
													<div class="form-group">
														<label>Apellidos</label> <input class="form-control" name="last_name" placeholder="Ingresa tus apellidos" value="{{ old('last_name') }}" type="text" required>
													</div>
													<div class="form-group">
														<label for="numero_contacto_1">Número de contacto / Celular</label>
														<input class="form-control" value="{{ old('numero_contacto_1') }}" placeholder="Número contacto" name="numero_contacto_1" type="number" required>
													</div>
													<div class="form-group">
														<label>Correo Electrónico</label> <input class="form-control" name="email" placeholder="Ingresa tu Correo Electrónico" value="{{ old('email') }}" type="email" required>
													</div>
													<div class="form-group">
														<label>Contraseña</label> <input class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" type="password" required>
														<input id ="check" type="checkbox" onclick="(function(){
																	var x = document.getElementById('password');
																	if (x.type === 'password') {
																	x.type = 'text';
																	} else {
																	x.type = 'password';
																	}
														})();return false;">Mostrar Contraseña
					<br>
													</div>
													
													<div class="form-group">
														<input type="hidden" name="is_empresario" value="0">
													</div>
													<div class="form-group">
														<label>¿Pertenece a algún grupo social?</label>
														<select class="form-control select2" name="grupo_social_id" id="grupo_social_id" placeholder="" required>
															<option value="" selected disabled>Seleccione una opción</option>	
															<option value="1">No</option>
															<option value="2">Grupos étnicos</option>{{--daniela--}}
															<option value="3">Afrodecelendientes</option>{{--emilia--}}
															<option value="24">Con hijos familiares con discapacidad</option>{{--emilia--}}
															<option value="25">Jóvenes 18 a 35 años</option>{{--daniela--}}
															<option value="4">Venezolanas</option>
															<option value="5">Fundación Acción Interna</option>
															<option value="7">Fundación Afro, Indígenas y Mestizos</option>
															<option value="9">Fundación Soy Oportunidad</option>
															<option value="10">Mujeres Endógenas del Cauca</option>
															<option value="11">Fundación Compromiso Valle</option>
															<option value="12">Fundación Apoyar</option>
															<option value="13">Fundación para la reconciliación</option>
															<option value="14">Fundación CIREC</option>
															<option value="15">Fundación levántate y anda</option>
															<option value="16">Fundación Fé</option>
															<option value="17">Tiempo de Juego</option>
															<option value="18">Fundación Creando Futuro</option>
															<option value="19">Fundación Huellas</option>
															<option value="20">Fundación Laudes Infantis</option>
															<option value="21">Fundación poder joven</option>
															<option value="22">Centro Mya</option>
															<option value="23">Fundación AR</option>
															<option value="6">Otros</option>
														</select>
													</div>
													@if ($nombre!='Lideresa')
														<div class="form-group">
															<label>¿Pertenece a algúna lideresa?</label>
															<select class="form-control select2" name="id_lideresa" id="id_lideresa" placeholder="" required>
																{{-- <option value="0">Sin lideresa</option> --}}
																@foreach($lideresas as $lider)
																	<option value="{{ $lider->id }}"> 
																			{{ $lider->profile->name }} {{ $lider->profile->last_name }}
																		</option>
																@endforeach
															</select>
                                            
														</div>
													@endif
													<div id="alert_valido" class="alert alert-success alert-dismissible fade show mb-0" role="alert">
														<span class="alert-inner--text"><strong></strong>Código Válido</span>
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">x</span>
														</button>
													</div>
													<div id="alert_no_valido" class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
														<span class="alert-inner--icon"><i class="fe fe-slash"></i></span>
														<span class="alert-inner--text"><strong></strong>El código no es válido</span>
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">x</span>
														</button>
													</div>
													<div  id="code_div" class="row">
														<div class="col-lg-8 mg-b-8 mg-lg-b-8">
															<input class="form-control" id="code" name="code" placeholder="Ingresa tu código de registro" type="text" required>
														</div>
														<div class="col-lg-4 mg-b-4 mg-lg-b-4">
															<button type="button" id="validar_button" class="btn btn-main-primary btn-block" >Validar</button>
														</div>
													</div>
													<div class="form-group mb-0 justify-content-end">
													<div class="checkbox">
														<div class="custom-checkbox custom-control">
															<input type="checkbox"  class="custom-control-input" id="checkbox-2" required>
															<label for="checkbox-2" class="custom-control-label mt-1">He leído y acepto <a target="_blank" href="{{ route('terminos_condiciones') }}">la política de privacidad de datos.</a></label>
														</div>
														<div class="custom-checkbox custom-control">
															<input type="checkbox"  class="custom-control-input" id="checkbox-3" required>
															<label for="checkbox-3" class="custom-control-label mt-1">He leído y acepto <a target="_blank" href="{{ route('aviso_privacidad') }}">aviso de privacidad.</a></label>
														</div>
													</div>
													<br>
													<button id="submit_button" type="submit" class="btn btn-main-primary btn-block" disabled> Regístrate</button>
												</form>
												<div class="main-signup-footer mt-5">
													<p>Ya tienes un cuenta? <a href="{{ route('login') }}">Inicia Sesión</a></p>
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

		<!--- JQuery min js --->
		<script src="../../assets/plugins/jquery/jquery.min.js"></script>

		<!--- Bootstrap Bundle js --->
		<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!--- Ionicons js --->
		<script src="../../assets/plugins/ionicons/ionicons.js"></script>

		<!--- JQuery sparkline js --->
		<script src="../../assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>


		<!--- Moment js --->
		<script src="../../assets/plugins/moment/moment.js"></script>

		<!-- P-scroll js -->
		<script src="../../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="../../assets/plugins/perfect-scrollbar/p-scroll.js"></script>

		<!--- Eva-icons js --->
		<script src="../../assets/js/eva-icons.min.js"></script>

		<!--- Rating js --->
		<script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>
		<script src="../../assets/plugins/rating/jquery.barrating.js"></script>

		<!--- Custom js --->
		<script src="../../assets/js/custom.js"></script>

        @include('partials/include_js')

			<script type="text/javascript">
				// Devuelve true si ambos checkboxes de términos/aviso están marcados (implementación jQuery)
				function areTermsAccepted() {
					return $('#checkbox-2').is(':checked') && $('#checkbox-3').is(':checked');
				}
				$(window).on('load', function() {
				$('#code').prop('required',false);
				$('#code_div').hide();
				$('#alert_valido').hide();
				$('#alert_no_valido').hide();

				const lideresas = @json($lideresas);

				// Buscar lideresas con category 1 y 2 (desde profile)
				// const lideresaCategoria1 = lideresas.find(l => l.category == 1);
				// const lideresaCategoria2 = lideresas.find(l => l.category == 2);

				

				$('#grupo_social_id').on('change', function() {
					const selectedValue = parseInt(this.value);

					// Limpiar y habilitar por defecto
					// $('#id_lideresa').val('0').prop('disabled', false).trigger('change');

					// if ((selectedValue === 2 || selectedValue === 25) && lideresaCategoria1) {
					// 	$('#id_lideresa').val(String(lideresaCategoria1.id)).prop('disabled', true).trigger('change');
					// }

					// if ((selectedValue === 3 || selectedValue === 24) && lideresaCategoria2) {
					// 	$('#id_lideresa').val(String(lideresaCategoria2.id)).prop('disabled', true).trigger('change');
					// }



					if(this.value == 5) // Fundación Acción Interna
					{
						$('#code').prop('required',true);
						$('#code_div').show('slow');
						$('#submit_button').prop('disabled', true);
					} 
					else
					{
						$('#code').prop('required',false);
						$('#code_div').hide('slow');
						$('#code').val('');
						// habilitar solo si ambos checkboxes están marcados
						if (areTermsAccepted()) {
							$('#submit_button').prop('disabled', false);
						} else {
							$('#submit_button').prop('disabled', true);
						}
					}
				});

				// Centraliza la lógica para habilitar/deshabilitar el botón de submit
				function updateSubmitState() {
					var grupoVal = $('#grupo_social_id').val();
					var termsOk = areTermsAccepted();

					// Si el grupo social requiere código (value 5)
					if (String(grupoVal) === '5') {
						var codeValidated = $('#alert_valido').is(':visible');
						// Habilita solo si código validado y términos aceptados
						if (codeValidated && termsOk) {
							$('#submit_button').prop('disabled', false);
						} else {
							$('#submit_button').prop('disabled', true);
						}
					} else {
						// Si no requiere código, solo depende de términos
						if (termsOk) {
							$('#submit_button').prop('disabled', false);
						} else {
							$('#submit_button').prop('disabled', true);
						}
					}
				}

				$('#validar_button').click(function() {
					var code = $('#code').val();
					$.post("{{route('api.validate_code')}}", {code: code}, function(data, status){
						if(data.data){
							$('#alert_valido').show('slow');
							$('#alert_no_valido').hide('slow');
							$('#code_div').hide('slow');
							// Solo habilitar si los checkboxes también están aceptados
							updateSubmitState();

						} else {
							$('#alert_valido').hide('slow');
							$('#alert_no_valido').show('slow');
							updateSubmitState();
						}
					});
				});

				// Cuando cambian los checkboxes, reevaluar el estado del botón
				$('#checkbox-2, #checkbox-3').on('change', function() {
					updateSubmitState();
				});

				// Llamar al inicio para establecer el estado correcto
				updateSubmitState();
			});
		</script>

	</body>
</html>
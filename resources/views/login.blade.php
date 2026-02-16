<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4" />

    <title> Yo Soy - test </title>

    <link rel="icon" href="../../images/ico.png" type="image/x-icon" />
    <link href="../../assets/css/icons.css" rel="stylesheet">
    <link href="../../assets/plugins/sidebar/sidebar.css" rel="stylesheet">
    <link href="../../assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/closed-sidemenu.css">
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="../../assets/css/style-dark.css" rel="stylesheet">
    <link href="../../assets/css/skin-modes.css" rel="stylesheet" />
    <link href="../../assets/css/animate.css" rel="stylesheet">
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
</head>

<body class="error-page1 main-body bg-light">
    <div id="global-loader">
        <img src="../../assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>

    <!-- Page -->
    <div class="page">

        <div class="container-fluid">
            <div class="row no-gutter">
                <!-- The image half -->
                <div class="col-md-6 col-lg-6 col-xl-7 bg-primary-transparent" style="display: flex; align-items: center; justify-content: center; height: 100vh;">
						<img src="../../images/Logo1.png" class="logo1-crop" style="max-height: 65vh; max-width: 65vw; width: auto; height: auto;" alt="logo">
					</div>
                <!-- The content half -->
                <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                    <div class="login d-flex align-items-center py-2">
                        <!-- Demo content-->
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                    <div class="card-sigin">
                                        <div class="card-sigin">
                                            <div class="main-signup-header">
                                                <h2 style="font-size: 37px;"><a href="{{ route('login') }}"><img
                                                            src="../../images/Logo1.png" class="sign-favicon" style="width: 10rem;"
                                                            alt="logo"></a> Usuario!</h2>
                                                @if (session('status'))
                                                    <div class="alert alert-danger alert-dismissible fade show mb-0"
                                                        role="alert">
                                                        <span class="alert-inner--icon"><i
                                                                class="fe fe-slash"></i></span>
                                                        <span class="alert-inner--text"><strong></strong>
                                                            {{ session('status') }}</span>
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                @endif
                                                @if (session('success'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        <span class="alert-inner--icon"><i
                                                                class="fe fe-thumbs-up"></i></span>
                                                        <span class="alert-inner--text"> {{ session('success') }}
                                                        </span>
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                @endif
                                                <h5 class="font-weight-semibold mb-4">Inicia Sesión</h5>
												<div class="column col-lg-12 col-md-12 col-sm-12">
													@if($errors->any())
														<div class="message-box error">
														<p>{{$errors->first()}}</p>
														<button class="close-btn"><span class="close_icon"></span></button>
													</div>
													@endif
													@if(session('message'))
														<div class="message-box success">
														<p>{{ session('message') }}</p>
														<button class="close-btn"><span class="close_icon"></span></button>
													</div>
													@endif
												</div>


                                                <form action="{{ route('login.post') }}" method="post">
                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="email">Correo Electrónico</label>
                                                        <input name="email" class="form-control" placeholder="Ingresa tu correo electrónico" type="email" value="{{ old('email') }}" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Contraseña</label>
                                                        <input id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" type="password" required>
                                                        <br>
                                                        <div class="form-check mt-2">
                                                            <input class="form-check-input" type="checkbox" id="show-password">
                                                            <label class="form-check-label" for="show-password">Mostrar Contraseña</label>
                                                        </div>
                                                        <br>
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                                        @error('g-recaptcha-response')
                                                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                        @enderror
                                                    </div> -->

                                                    <button type="submit" class="btn btn-main-primary btn-block">Ingresar</button>
                                                </form>

                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var checkbox = document.getElementById('show-password');
                                                        var passwordField = document.getElementById('password');

                                                        checkbox.addEventListener('change', function() {
                                                            if (checkbox.checked) {
                                                                passwordField.type = 'text';
                                                            } else {
                                                                passwordField.type = 'password';
                                                            }
                                                        });
                                                    });
                                                </script>





                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="{{ route('forgot') }}">Olvidaste la contraseña?</a></p>
                                                    <p>Todavía no tienes cuenta? <a
                                                            href="{{ route('registro.get') }}">Crea una Cuenta</a></p>
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
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/plugins/ionicons/ionicons.js"></script>
    <script src="../../assets/plugins/moment/moment.js"></script>
    <script src="../../assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../assets/plugins/perfect-scrollbar/p-scroll.js"></script>
    <script src="../../assets/js/eva-icons.min.js"></script>
    <script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>
    <script src="../../assets/plugins/rating/jquery.barrating.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script>
		  window.addEventListener('DOMContentLoaded', function() {
            var formularios = document.querySelectorAll('form');


            formularios.forEach(function(formulario) {
                formulario.addEventListener('submit', function() {
                    // Deshabilitar el botón de envío
                    var botonEnvio = formulario.querySelector(
                        'input[type="submit"], button[type="submit"]');
                    botonEnvio.disabled = true;
                    // botonEnvio.innerHTML = 'Enviando...';
                    setTimeout(function() {
                        botonEnvio.disabled = false;
                        botonEnvio.innerHTML = 'Enviar';
                    }, 5000); // 5000 milisegundos = 5 segundos
                });
            });
        });
	</script>
</body>

</html>

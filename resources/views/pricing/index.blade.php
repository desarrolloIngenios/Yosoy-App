@extends('app')
@section('content')
<!-- row -->
<div class="modal" id="modaldemo1">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-content-demo">
			<div class="modal-header">
				<h6 class="modal-title"></h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<h6>Hola, te invitamos a adquirir uno de nuestros planes online a fin de acompañarte en tu búsqueda de servicio o vacante, y/o contáctanos WhatsApp 3219356028</h6>
			</div>
		</div>
	</div>
</div>
<div class="row row-sm">
  
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Planes</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                    <div class="row">
					
						<!-- <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="panel price panel-color">
								<div class="panel-heading bg-warning  p-0 text-center">
									<h3>Buscas Servicio y/o Vacante Trabajadores informales y técnicos</h3>
								</div>
								<div class="panel-body text-center">
									<p class="lead"><strong>Gratis</strong></p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item">La plataforma entregará hasta 5 contactos por cada servicio y/o vacantes, entre 3 y 6 días.</li>
									<li class="list-group-item">1 Mes gratis para tu búsqueda de servicios y/o Vacantes</li>
									<li class="list-group-item">Hasta 2 servicios y/o vacantes</li>
									<li class="list-group-item">Cobertura : Nacional</li>
									<li class="list-group-item border-bottom-0">Listo para tu búsqueda, haz clic y en 5 pasos ágiles escribe el servicio y/o vacante</li>
								</ul>
							</div>
						</div> -->
						
						<div class="col-xs-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="panel price panel-color">
								<div class="panel-heading bg-primary p-0 text-center">
									<h3>Buscas Servicio y/o Vacante Trabajadores informales y técnicos</h3>
								</div>
								<div class="panel-body text-center">
									<p class="lead"><strong>$75.000</strong></p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item">La plataforma entregará hasta 5 contactos por cada servicio y/o vacantes, entre 2 y 4 días.</li>
									<li class="list-group-item">Garantía : Si tu servicio y/o trabajador no cumple tus expectativas, dar click y solicita de nuevo tu servicio y/o técnicos</li>
									<li class="list-group-item">Cobertura : Nacional</li>
									<li class="list-group-item">Listo para tu búsqueda, haz clic y en 5 pasos ágiles escribe el servicio y/o vacante</li>
								</ul>
								<div class="panel-footer text-center">
									<!-- <a class="btn btn-primary" target="_blank" href="https://checkout.wompi.co/l/FDGtt6">Ir a pagar!</a> -->
									<form id="1">
										<script id="script1"
											src="https://checkout.wompi.co/widget.js"
											data-render="button"
											data-public-key="{{ $public_key_wompi }}"
											data-currency="COP"
											data-cantidad-ofertas="1"
											data-amount-in-cents="7500000"
											data-reference="{{ uniqid('ref_'.session()->get('user_id').'_') }}"
											data-redirect-url="{{ route('pricing.index') }}"
											>
										</script>
									</form>
								</div>
								
							</div>
						</div><!-- COL-END -->
						<div class="col-xs-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="panel price panel-color">
								<div class="panel-heading bg-warning  p-0 text-center">
									<h3>Buscas Servicio, vacante contratos sabatinos, medio tiempo y tiempo completo</h3>
								</div>
								<div class="panel-body text-center">
									<p class="lead"><strong>$95.000</strong></p>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item">La plataforma entregará hasta 5 contactos por cada servicio y/o vacantes, entre 2 y 4 días.</li>
									<li class="list-group-item">Garantía : Si tu servicio y/o trabajador no cumple tus expectativas, dar de click y solicita de nuevo tu servicio y/o técnicos</li>
									<li class="list-group-item">Cobertura : Nacional</li>
									<li class="list-group-item">Listo para tu búsqueda, haz clic y en 5 pasos ágiles escribe el servicio y/o vacante</li>
								</ul>
								<div class="panel-footer text-center">
									<form id="2">
										<script id="script2"
											src="https://checkout.wompi.co/widget.js"
											data-render="button"
											data-public-key="{{ $public_key_wompi }}"
											data-currency="COP"
											data-cantidad-ofertas="1"
											data-amount-in-cents="9500000"
											data-reference="{{ uniqid('ref_'.session()->get('user_id').'_') }}"
											data-redirect-url="{{ route('pricing.index') }}"
											>
										</script>
									</form>
									<!-- <a class="btn btn-warning" target="_blank" href="https://checkout.wompi.co/l/JJbr4j">Ir a pagar!</a> -->
								</div>
							</div>
						</div><!-- COL-END -->
						<div class="col-xs-6 col-sm-6 col-lg-6 col-xl-4">
							<div class="panel price panel-color">
								<div class="panel-heading bg-warning  p-0 text-center">
									<h3>Buscas más de una vacante</h3>
								</div>
								<div class="panel-body text-center">
									<p class="lead" id="text_precio"><strong>$95.000</strong></p>
									<div class="col-lg-12">
											<input class="rangeslider1" data-extra-classes="irs-outline" id="range_number" name="range_number" type="text">
										</div>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item">La plataforma entregará hasta 5 contactos por cada servicio y/o vacantes, entre 2 y 4 días.</li>
									<li class="list-group-item">Garantía : Si tu servicio y/o trabajador no cumple tus expectativas, dar de click y solicita de nuevo tu servicio y/o técnicos</li>
									<li class="list-group-item">Cobertura : Nacional</li>
									<li class="list-group-item">Listo para tu búsqueda, haz clic y en 5 pasos ágiles escribe el servicio y/o vacante</li>
								</ul>
								<div class="panel-footer text-center">
								@foreach($descuentos as $descuento)
									<div id="ofertas_{{$descuento->numero_ofertas}}" class="div_ofertas" style="display: none">
										<form id="{{$descuento->numero_ofertas}}">
											<script id="script{{$descuento->numero_ofertas}}"
												src="https://checkout.wompi.co/widget.js"
												data-render="button"
												data-public-key="{{ $public_key_wompi }}"
												data-currency="COP"
												data-cantidad-ofertas="{{$descuento->numero_ofertas}}"
												data-amount-in-cents="{{ (1- $descuento->porcentaje_descuento/100) * $precio_base * 100 * $descuento->numero_ofertas}}";
												data-reference="{{ uniqid('ref_'.session()->get('user_id').'_') }}"
												data-redirect-url="{{ route('pricing.index') }}"
												>
											</script>
										</form>
									</div>
								@endforeach

									<!-- <a class="btn btn-warning" target="_blank" href="https://checkout.wompi.co/l/JJbr4j">Ir a pagar!</a> -->
								</div>
							</div>
						</div><!-- COL-END -->
						<div style="text-align: center;">
							<img src="{{URL::asset('/images/wompi.png')}}" class="logo-1" alt="logo">
						</div>

            </div>
        </div>
    </div>
</div>

<!-- row -->
@endsection


@section('js')
<script type="text/javascript">
    $(window).on('load', function() {
        $('#modaldemo1').modal('show');
		
		$( ".waybox-button" ).click(function() {
			var script_name = 'script'+$(this).parent().attr('id');
			var referencia = $('#'+script_name).attr('data-reference');
			var cantidad_ofertas = $('#'+script_name).attr('data-cantidad-ofertas');
			var user_id = {{ session()->get('user_id') }}
			$.get("{{ route('store_datos_transaccion') }}", { user_id : user_id, referencia: referencia, cantidad_ofertas: cantidad_ofertas }, function(resp) {
				console.log(resp);
			});
   		});

		$('.rangeslider1').ionRangeSlider({
			min: 3,
			max: 9,
			from: 3,
			step: 1
		});

		var descuentos_var = [];
		var precio_base = {{$precio_base}};
		@foreach($descuentos as $descuento)
			descuentos_var[{{ $descuento->numero_ofertas}}] = {{$descuento->porcentaje_descuento}};
		@endforeach
		//console.log(descuentos_var)

		$('#range_number').change(function() {
			numero_ofertas = $(this).val();
			porcentaje_descuento = descuentos_var[numero_ofertas];
			valor_oferta = (1- porcentaje_descuento/100) * precio_base;
			valor_total_ofertas_en_centavos = valor_oferta * 100 * numero_ofertas;
			$('#text_precio').html("<strong>$"+valor_oferta+" c/u </strong>");

			$('#script3').attr('data-amount-in-cents', valor_total_ofertas_en_centavos);
			$('.div_ofertas').hide();
			$('#ofertas_'+numero_ofertas).show();
		});
		$('#range_number').trigger('change')
		
	});
	

</script>
@endsection
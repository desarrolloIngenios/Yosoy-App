@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">

    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header pb-0">
                <h5 class="card-title ">{{$offer['cargo']['nombre']}} - {{$offer['sector']['nombre']}}  - {{$offer['tiempo_experiencia']['nombre']}}  </h5>
                <h5 class="card-title ">
                    @foreach($offer['tipo_contrato'] as $tipo_contrato)
                        {{ $tipo_contrato['nombre'] }} @if(!$loop->last) {{", "}} @endif
                    @endforeach
                </h5>
                <h5 class="card-title mb-0 pb-0">{{ $offer['nivel_educativo']['nombre'] }} </h5>
            </div>
            <div class="card-body text-primary">
                {{$offer['description']}}
            </div>
            <div class="card-footer" >
                {{ $offer['ciudad']['pais_departamento_ciudad'] }}
            </div>

        </div>
    </div>
</div>

<div>
    <h4>Postulados</h4>
    @include('profile/profiles_table')
</div>

<div >
    <h4>Búsqueda</h4>
    @include('profile/profiles_table', ['users' => $users_busqueda, 'style' => "display: none;", 'table_id'=>'tabla_busqueda'])
</div>
<div class="container">
    <div class="col-sm-6 col-md-3">
			<button id="button_ver_mas" class="btn btn-success btn-block" >Ver más +</button>
		</div>
    </div>

<!-- row -->
@endsection

@section('js')
<script type="text/javascript">
    $(window).on('load', function() {
        
        var index_show = 5;

        $("#button_ver_mas").click(function() {
            index_show += 5;
            show_hide_rows_user_table();
        });

        show_hide_rows_user_table();

        function show_hide_rows_user_table(){
            if(index_show < 0 ){
                $('#tabla_busqueda .user_row').hide();
            } else {
                $('#tabla_busqueda .user_row:lt('+index_show+')').show();
            }
        }
	});

    
	

</script>
@endsection
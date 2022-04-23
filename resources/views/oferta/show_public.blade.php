@extends('app_public')
@section('content')
<!-- row -->
<h2 class="">Oferta</h2>
<div class="row row-sm">

    <div class="col-12 col-sm-6 col-lg-6">
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
            <div class="card-footer">
                {{ $offer['ciudad']['pais_departamento_ciudad'] }}
            </div>
        </div>
    </div>
</div>

<!-- row -->
@endsection
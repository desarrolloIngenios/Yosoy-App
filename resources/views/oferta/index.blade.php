@extends('app')
@section('content')
<!-- row -->
<h2 class="">Listado de Ofertas</h2>
<div class="row row-sm">

@foreach($offers as $offer)
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
                <div class="row row-sm">
                <div class="col-sm-12 col-lg-12">

                    @if(session('role') == 'ADMIN' || session('role') == 'EMPRESARIO')
                        <a href="{{ route('offer.show_public', $offer['id']) }}" target="_blank">
                            <button class="btn btn-info"><i class="typcn typcn-arrow-back-outline"></i></button>
                        </a>
                        <a href="{{ route('offer.show', $offer['id']) }}">
                            <button class="btn btn-primary "><i class="typcn typcn-plus-outline"> Listado de Postulados</i></button>
                        </a>
                    @endif

                    @if(!in_array($offer['id'], $offers_apply_ids))
                        @if(session('role') != 'EMPRESARIO')
                        <a href="{{ route('offer.apply', $offer['id']) }}">
                            <button class="btn btn-primary "><i class="typcn typcn-plus-outline"> Aplicar</i></button>
                        </a>
                        @endif
                    @else
                        <button class="btn btn-success "><i class="typcn typcn-input-checked"> Aplicado</i></button>
                    @endif
                    </div>

                </div>     
            </div>

        </div>
    </div>
@endforeach
</div>

<!-- row -->
@endsection
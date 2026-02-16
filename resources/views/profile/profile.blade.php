@extends('app')

<!-- jQuery UI Smoothness Theme for Datepicker -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/smoothness/jquery-ui.css">
<style>
    /* Personalización extra para el datepicker */
    .ui-datepicker {
        font-size: 1em;
        z-index: 9999 !important;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .ui-datepicker-header {
        background: #2e757c;
        color: #fff;
        border: none;
        border-radius: 8px 8px 0 0;
    }
    .ui-datepicker-title {
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }
    .ui-datepicker-title select {
        background: #fff;
        color: #2e757c;
        border: none;
        border-bottom: 2px solid #e787da;
        border-radius: 0;
        padding: 6px 16px 6px 8px;
        font-size: 1.15em;
        font-weight: 600;
        margin: 0 6px;
        outline: none;
        box-shadow: 0 2px 8px rgba(46,117,124,0.08);
        transition: border-color 0.2s, box-shadow 0.2s;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        min-width: 90px;
        background-image: url('data:image/svg+xml;utf8,<svg fill="%232e757c" height="16" viewBox="0 0 24 24" width="16" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 18px 18px;
    }
    .ui-datepicker-title select:focus {
        border-bottom: 2.5px solid #2e757c;
        box-shadow: 0 4px 16px #e787da33;
        background-color: #f5e1f7;
    }
    .ui-datepicker-title select:hover {
        background-color: #f5e1f7;
    }
    /* Quitar flechas nativas en select Chrome */
    .ui-datepicker-title select::-ms-expand {
        display: none;
    }
    .ui-datepicker-title select option {
        background: #fff;
        color: #2e757c;
        font-weight: 500;
    }
    .ui-state-active, .ui-widget-content .ui-state-active {
        background: #e787da !important;
        color: #fff !important;
        border-radius: 4px;
    }
    .ui-state-highlight, .ui-widget-content .ui-state-highlight {
        background: #f5e1f7 !important;
        color: #2e757c !important;
    }
    .ui-datepicker-calendar td a {
        padding: 0.4em 0.7em;
    }
</style>
</style>
@section('content')
<!-- row -->
<div class="row row-sm">
  


    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">INFORMACIÓN PERSONAL</h4>
                <p class="mb-2"></p>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('profile.post') }}" method="post">
                    @csrf

                    <div class="">

                        <div class="row row-sm">
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Tipo de documento</p><select name="tipo_documento_id" class="form-control select2" placeholder="Tipo de documento" required>
                                    <option value=""></option>
                                    @foreach($tipo_documentos as $tipo_documento)
                                        @if(isset($perfil['tipo_documento_id']) && $perfil['tipo_documento_id'] == $tipo_documento['id'])
                                            <option value="{{ $tipo_documento['id'] }}" selected>
                                                {{ $tipo_documento['descripcion'] }}
                                            </option>
                                        @else
                                            <option value="{{ $tipo_documento['id'] }}">
                                                {{ $tipo_documento['descripcion'] }}
                                            </option>
                                        @endif
                                       
                                    @endforeach
                                </select>
                            </div>  
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="numero_documento">Número de documento</label>
                                    <input name="numero_documento" class="form-control" value="{{isset($perfil['numero_documento'])? $perfil['numero_documento']:''}}" placeholder="Número de documento" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nombre(s)</label>
                                    <input name="name" class="form-control" value="{{isset($perfil['name'])? $perfil['name']:''}}" placeholder="Nombre(s)" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_name">Apellidos</label>
                                    <input name="last_name" class="form-control" value="{{isset($perfil['last_name'])? $perfil['last_name']:''}}" placeholder="Apellidos" type="text" required>
                                </div>
                            </div>
                        </div>


                        <div class="row row-sm">
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Género</p><select name="genero_id" class="form-control select2" placeholder="Género"  required>
                                    <option value=""></option>
                                    @foreach($generos as $genero)
                                       
                                        @if(isset($perfil['genero_id']) && $perfil['genero_id'] == $genero['id'])
                                            <option value="{{ $genero['id'] }}" selected>
                                                {{ $genero['descripcion'] }}
                                            </option>
                                        @else
                                            <option value="{{ $genero['id'] }}">
                                                {{ $genero['descripcion'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>   
                           
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                    <input class="form-control fc-datepicker" name="fecha_nacimiento" placeholder="MM/DD/YYYY" value="{{ isset($perfil['fecha_nacimiento']) ? date('m/d/Y', strtotime($perfil['fecha_nacimiento'])) : '' }}" type="text" required autocomplete="off">
                                </div>
                            </div>
                        </div>


                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                    <input class="form-control" value="{{isset($perfil['email'])? $perfil['email']:''}}" placeholder="Correo electrónico" type="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="numero_contacto_1">Número de contacto / Celular</label>
                                    <input class="form-control" value="{{isset($perfil['numero_contacto_1'])? $perfil['numero_contacto_1']:''}}" placeholder="Número contacto" name="numero_contacto_1" type="text"  required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="numero_contacto_2">Otro número de contacto / Celular</label>
                                    <input class="form-control" value="{{isset($perfil['numero_contacto_2'])? $perfil['numero_contacto_2']:''}}" placeholder="Otro número contacto"  name="numero_contacto_2" type="text">
                                </div>
                            </div>

                         

                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Ciudad de residencia</p><select class="form-control select2" name="ciudad_residencia_id" id="ciudad_residencia_id" placeholder="País" required>
                                    <option value=""></option>
                                </select>
                            </div>   
                           
                           
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Dirección de residencia</label>
                                    <input class="form-control" value="{{isset($perfil['direccion_residencia'])? $perfil['direccion_residencia']:''}}" placeholder="Dirección de residencia" name="direccion_residencia" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Bancarización</p><select id="bancarizacion_id" name="bancarizacion_id" class="form-control select2" placeholder="Bancarización"  required>
                                    <option value=""></option>
                                    @foreach($bancarizaciones as $bancarizacion)
                                       
                                        @if(isset($perfil['bancarizacion_id']) && $perfil['bancarizacion_id'] == $bancarizacion['id'])
                                            <option value="{{ $bancarizacion['id'] }}" selected>
                                                {{ $bancarizacion['nombre'] }}
                                            </option>
                                        @else
                                            <option value="{{ $bancarizacion['id'] }}">
                                                {{ $bancarizacion['nombre'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>   
                            


                            <div class="col-lg-6 mg-b-6 mg-lg-b-0" id="banco" style="display: none;">
                                <p class="mg-b-10">Banco</p><select name="banco"  class="form-control select2" placeholder="Banco">
                                    <option value=""></option>
                                        @foreach($banco as $banco)                                       
                                            @if(isset($perfil['banco']) && $perfil['banco'] == $banco['description'])
                                                <option value="{{ $banco['description'] }}" selected>
                                                    {{ $banco['description'] }}
                                                </option>
                                            @else
                                                <option value="{{ $banco['description'] }}">
                                                    {{ $banco['description'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>   
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0" id="monedero" style="display: none;">
                                <p class="mg-b-10">Billeteras digitales</p><select name="billetera"  class="form-control select2" placeholder="Monedero">
                                    <option value=""></option>
                                        @foreach($billetera as $billetera)                                       
                                            @if(isset($perfil['billetera']) && $perfil['billetera'] == $billetera['description'])
                                                <option value="{{ $billetera['description'] }}" selected>
                                                    {{ $billetera['description'] }}
                                                </option>
                                            @else
                                                <option value="{{ $billetera['description'] }}">
                                                    {{ $billetera['description'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <div class="form-group">
                                    <label for="numero_hijos">Número de hijos</label>
                                    <select name="numero_hijos" class="form-control" id="numero_hijos">
                                        <option value="0" {{ (isset($perfil['numero_hijos']) && $perfil['numero_hijos'] == '0') ? 'selected' : '' }}>0</option>
                                        <option value="1" {{ (isset($perfil['numero_hijos']) && $perfil['numero_hijos'] == '1') ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ (isset($perfil['numero_hijos']) && $perfil['numero_hijos'] == '2') ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ (isset($perfil['numero_hijos']) && $perfil['numero_hijos'] == '3') ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ (isset($perfil['numero_hijos']) && $perfil['numero_hijos'] == '4') ? 'selected' : '' }}>4</option>
                                        <option value="mas" {{ (isset($perfil['numero_hijos']) && $perfil['numero_hijos'] == 'mas') ? 'selected' : '' }}>4 o más</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Tipo de afiliación EPS o sistema de salud</p>
                                <select name="eps" id="eps_tipo" class="form-control select2" required>
                                    <option value="">Seleccione...</option>
                                    <option value="cotizante" {{ (isset($perfil['eps']) && $perfil['eps'] == 'cotizante') ? 'selected' : '' }}>Cotizante</option>
                                    <option value="beneficiaria" {{ (isset($perfil['eps']) && $perfil['eps'] == 'beneficiaria') ? 'selected' : '' }}>Beneficiaria</option>
                                    <option value="ninguna" {{ (isset($perfil['eps']) && $perfil['eps'] == 'ninguna') ? 'selected' : '' }}>Ninguna</option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0" id="eps_nombre_wrap" style="display: {{ (isset($perfil['eps']) && ($perfil['eps'] == 'cotizante' || $perfil['eps'] == 'beneficiaria')) ? 'block' : 'none' }};">
                                <p class="mg-b-10">Nombre de la EPS o sistema de salud</p>
                                <select name="nombre_eps" id="eps_nombre" class="form-control select2" {{ (isset($perfil['eps']) && ($perfil['eps'] == 'cotizante' || $perfil['eps'] == 'beneficiaria')) ? 'required' : '' }}>
                                    <option value="">Seleccione EPS...</option>
                                    @if(isset($eps) && count($eps) > 0)
                                        @foreach($eps as $epsItem)
                                            <option value="{{ $epsItem['nombre'] }}" {{ (isset($perfil['nombre_eps']) && $perfil['nombre_eps'] == $epsItem['nombre']) ? 'selected' : '' }}>
                                                {{ $epsItem['nombre'] }} @if(isset($epsItem['pais']))({{ $epsItem['pais'] }})@endif
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="">No hay EPS disponibles</option>
                                    @endif
                                </select>
                                <!-- Debug info -->
                                {{-- <small class="text-muted">Debug: {{ isset($eps) ? count($eps) : 0 }} EPS disponibles</small> --}}
                            </div>
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <div class="form-group">
                                    <label for="currently_works">Estado laboral actual</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="currently_works" id="currently_works" value="1" {{ (isset($perfil['currently_works']) && $perfil['currently_works']) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="currently_works">
                                            ¿Está trabajando actualmente?
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Actualizar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Foto Perfil</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Cargar Foto Perfil</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    {{-- <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Perfil Laboral / Servicio</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
            @if(count($perfil['perfiles_laborales']) < 3)
                <form action="{{ route('profile_laboral.post') }}" method="post">
                        @csrf
                        <div class="row row-sm">
                            <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                                <p class="mg-b-10">Yo Soy</p>
                                <!-- Hacer opcional: remover 'required' para permitir guardar perfil sin este campo -->
                                <select class="form-control select2" name="cargo_id" placeholder="">
                                <option value=""></option>
                                    @foreach($cargos as $item)
                                        <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                                <p class="mg-b-10">Nivel de experiencia</p>
                                <select class="form-control select2" name="nivel_experiencia_id" placeholder="">
                                @foreach($nivel_experiencia as $item)
                                        <option value=""></option>
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                                <p class="mg-b-10">Tiempo de experiencia</p>
                                <select class="form-control select2" name="tiempo_experiencia_id" placeholder="">
                                @foreach($tiempo_experiencia as $item)
                                        <option value=""></option>
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                            <br>
                                <button type="submit" class="btn btn-primary mt-6 mb-0">Agregar</button>
                            </div>
                        </div>
                </form>
                @endif
                <br>
                        <div class="table-responsive">
                            <table class="table mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Cargo</th>
                                        <th>Nivel Experiencia</th>
                                        <th>Tiempo Experiencia</th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($perfil['perfiles_laborales'] as $index => $perfil_laboral)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{$perfil_laboral['cargo']['nombre']}}</td>
                                        <td>{{$perfil_laboral['nivel_experiencia']['nombre']}}</td>
                                        <td>{{$perfil_laboral['tiempo_experiencia']['nombre']}}</td>
                                        <td>
                                            @if ($perfil['perfiles_laborales'][0]['id'] != $perfil_laboral['id'])
                                                <a href="{{ route('profile_laboral.delete', $perfil_laboral['id'])}}" class="card-link text-secondary"><i class="typcn typcn-trash"></i> Eliminar</a>
                                            @endif 
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
            </div>
        </div>
    </div> --}}

@if(!$perfil['is_empirico'])
    {{-- <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Experiencia Laboral / Servicio</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
            @if(count($perfil['experiencias_laborales']) < 5)
            <form action="{{ route('experiencia_laboral.post') }}" method="post">
                @csrf
                <div class="row row-sm">
                    <div class="col-lg-4 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Cargo*</p><select class="form-control select2" name="cargo_id" placeholder="">
                        <option value=""></option>
                            @foreach($cargos as $item)
                                <option value="{{ $item['id'] }}">
                                        {{ $item['nombre'] }}
                                    </option>
                            @endforeach
                        </select>
                    </div>  
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="empleador">Empleador*</label>
                            <input name="empleador" class="form-control" placeholder="Empleador" type="text" required>
                        </div>
                    </div> 
                    <div class="col-lg-4 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Sector*</p><select class="form-control select2" name="sector_id" placeholder="">
                        <option value=""></option>
                            @foreach($sector as $item)
                                <option value="{{ $item['id'] }}">
                                        {{ $item['nombre'] }}
                                    </option>
                            @endforeach
                        </select>
                    </div> 
              
                    <div class="col-lg-4 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Ciudad*</p><select class="form-control select2" name="ciudad_id" id="ciudad_id" placeholder="">
                        <option value=""></option>
                        </select>
                    </div> 
                    <div class="col-lg-4 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Tipo de contrato*</p>
                            <select class="form-control select2"name='contrato_id' placeholder="Hola">
                                @foreach($tipo_contrato as $item)
                                    <option value=""></option>
                                    @if(isset($perfil['tipo_contrato_id']) && $perfil['tipo_contrato_id'] == $item['id'])
                                        <option value="{{ $item['id'] }}" selected>
                                            {{ $item['nombre'] }}
                                        </option>
                                    @else
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['nombre'] }}
                                        </option>
                                    @endif
                                @endforeach  
                            </select>
                        <select class="form-control select2" name="contrato" id="contrato_id" placeholder="">
                            <option value="Por horas">Por horas</option>
                            <option value="medio tiempo">medio tiempo</option>
                            <option value="Horas y emprenderismo">Horas y emprenderismo</option>
                            <option value="medio tiempo y emprenderismo">medio tiempo y emprenderismo</option>
                            <option value="tiempo completo">tiempo completo</option>
                            <option value="Sabatinas">Sabatinas</option>
                        </select> 
                    </div> 


                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio*</label>
                            <input class="form-control fc-datepicker" name="fecha_inicio" placeholder="MM/DD/YYYY" value="" type="text" autocomplete="off" required>
                        </div>
                    </div>
                    
                    <div class="col-lg-2" id="fecha_fin">
                        <div class="form-group">
                            <label for="fecha_fin">Fecha Fin</label>
                            <input class="form-control fc-datepicker" id="fin" name="fecha_fin" placeholder="MM/DD/YYYY" value="" autocomplete="off" type="text">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="fecha_fin">Actualidad</label>
                            <input id="actual" class="" name="" placeholder="" value=""  type="checkbox">
                        </div>
                    </div>
                    

                    <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                        <button type="submit" class="btn btn-primary mt-6 mb-0">Agregar</button>
                    </div>
                </div>
            </form>
            @endif
                <br>


                <div class="row">
                    <div class="table-responsive">
                        <table class="table mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Cargo</th>
                                    <th>Empleador</th>
                                    <th>Sector</th>
                                    <th>País - Ciudad</th>
                                    <th>Tipo contrato</th>
                                    <th>Fecha</th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($perfil['experiencias_laborales'] as $index => $experiencia_laboral)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$experiencia_laboral['cargo']['nombre']}}</td>
                                    <td>{{$experiencia_laboral['empleador']}}</td>

                                    @isset ($experiencia_laboral['contrato']['nombre'])
                                        <td>{{$experiencia_laboral['contrato']['nombre']}}</td>
                                    @else
                                        <td>{{$experiencia_laboral['contrato']}}</td>
                                    @endif 
                                    
                                    <td>{{$experiencia_laboral['sector']['nombre']}}</td>
                                    <td>{{$experiencia_laboral['ciudad']['departamento']['pais']['nombre']}} - {{$experiencia_laboral['ciudad']['departamento']['nombre']}} - {{$experiencia_laboral['ciudad']['nombre']}}</td> 
                                    @if ($experiencia_laboral['fecha_fin'] == null)
                                        <td>{{explode(' ', $experiencia_laboral['fecha_inicio'])[0] ." / Actualidad"}}</td>
                                    @else
                                        <td>{{explode(' ', $experiencia_laboral['fecha_inicio'])[0] ." / ". explode(' ', $experiencia_laboral['fecha_fin'])[0]}}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('experiencia_laboral.delete', $experiencia_laboral['id'])}}" class="card-link text-secondary"><i class="typcn typcn-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
    
                </div>
        </div>
    </div> --}}
@if(!$perfil['is_empirico'])

    {{-- <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Educación</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
            @if(count($perfil['educaciones']) < 2)
            <form action="{{ route('educacion.post') }}" method="post" autocomplete="off">
                        @csrf
                <div class="row row-sm">
                <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Título*</p><select class="form-control select2" name="titulo_educativo_id" placeholder="Nivel Educativo">
                        <option value=""></option>
                            @foreach($titulo_educativo as $item)
                                <option value="{{ $item['id'] }}">
                                        {{ $item['nombre'] }}
                                    </option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Nivel Educativo*</p><select class="form-control select2" name="nivel_educativo_id" placeholder="Nivel Educativo">
                        <option value=""></option>
                            @foreach($nivel_educativo as $item)
                                <option value="{{ $item['id'] }}">
                                        {{ $item['nombre'] }}
                                    </option>
                            @endforeach
                        </select>
                    </div> 
                </div>
                <div class="row row-sm">
                    <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Institución Educativa*</p><select class="form-control select2" name="institucion_educativa_id" placeholder="Institucion Educativa">
                        <option value=""></option>
                            @foreach($institucion_educativa as $item)
                                <option value="{{ $item['id'] }}">
                                        {{ $item['nombre'] }}
                                    </option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                        <p class="mg-b-10">Ciudad*</p><select class="form-control select2" name="ciudad_id" id="ciudad_id2" placeholder="">
                        <option value=""></option>
                        </select>
                    </div> 
                    <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                        <button type="submit" class="btn btn-primary mt-6 mb-0">Agregar</button>
                    </div>
                </div>
                <br>
            </form>
            @endif
                <div class="row">
               
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Título</th>
                                <th>Nivel Educativo</th>
                                <th>Institución</th>
                                <th>País</th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perfil['educaciones'] as $index => $educacion)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$educacion['titulo_educativo']['nombre']}}</td>
                                    <td>{{$educacion['nivel_educativo']['nombre']}}</td>
                                    <td>{{$educacion['institucion_educativa']['nombre']}}</td>
                                    <td>{{$educacion['ciudad']['pais_departamento_ciudad']}}</td>
                                    <td>
                                        <a href="{{ route('educacion.delete', $educacion['id'])}}" class="card-link text-secondary"><i class="typcn typcn-trash"></i> Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            </div>
        </div>
    </div> --}}
@endif
    {{-- <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Cargo</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                <form >
                    <div class="">

                        <div class="row row-sm">
                            <div class="col-lg-12 mg-b-20 mg-lg-b-0">
                                <p class="mg-b-10">Cargo al que aspira / Servicio</p><select class="form-control select2" multiple="multiple" placeholder="Hola">
                                @foreach($cargos as $cargo)
                                        <option value=""></option>
                                        @if(isset($perfil['cargo_id']) && $perfil['cargo_id'] == $cargo['id'])
                                            <option value="{{ $cargo['id'] }}" selected>
                                                {{ $cargo['nombre'] }}
                                            </option>
                                        @else
                                            <option value="{{ $cargo['id'] }}">
                                                {{ $cargo['nombre'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>   
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-12 mg-b-20 mg-lg-b-0">
                                <p class="mg-b-10">Tipo de contrato / Servicio que esta buscando</p><select class="form-control select2" multiple="multiple" placeholder="Hola">
                                    @foreach($tipo_contrato as $item)
                                        <option value=""></option>
                                        @if(isset($perfil['tipo_contrato_id']) && $perfil['tipo_contrato_id'] == $item['id'])
                                            <option value="{{ $item['id'] }}" selected>
                                                {{ $item['nombre'] }}
                                            </option>
                                        @else
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                        @endif
                                    @endforeach    
                                </select>
                            </div>   
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Actualizar</button>
                </form>
            </div>
        </div>
    </div> --}}


        {{-- <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1">Visibilidad / Configuraciones</h4>
                    <p class="mb-2"></p>
                </div>
                <div class="card-body pt-0">
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg-12 mg-b-20 mg-lg-b-0">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0"><button class="btn btn-primary btn-with-icon btn-block"><i class="typcn typcn-trash"></i> Eliminar Cuenta</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}




@endif
<!-- if perfiles laborales == 0 -->








</div>
<!-- row -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Configuración avanzada para .fc-datepicker (permite seleccionar año fácilmente)
        if (typeof $ !== 'undefined' && $.fn.datepicker) {
            // Regionalización en español para jQuery UI Datepicker
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                'Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                weekHeader: 'Sm',
                dateFormat: 'mm/dd/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);

            $('.fc-datepicker').datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1940:' + new Date().getFullYear(),
                dateFormat: 'mm/dd/yy',
                showButtonPanel: true,
                // Opcional: puedes personalizar más opciones aquí
                beforeShow: function(input, inst) {
                    setTimeout(function() {
                        // Cambiar el texto del botón "Done" a "Cerrar"
                        var buttonPane = $(inst.dpDiv).find('.ui-datepicker-buttonpane');
                        buttonPane.find('button').each(function() {
                            if ($(this).text() === 'Done') {
                                $(this).text('Cerrar');
                            }
                        });
                    }, 1);
                }
            });
        }

         var form = document.querySelector('form[action="'+window.location.origin+'{{ route('profile.post') }}"]') || document.querySelector('form[action="{{ route('profile.post') }}"]');
        if(form) {
            form.addEventListener('submit', function(e) {
                var fechaInput = form.querySelector('input[name="fecha_nacimiento"]');
                if (!fechaInput) return;
                var valor = fechaInput.value.trim();
                // Validar formato MM/DD/YYYY y que sea fecha válida
                var regex = /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/;
                if (!regex.test(valor)) {
                    alert('Por favor ingresa una fecha de nacimiento válida en formato MM/DD/YYYY.');
                    fechaInput.focus();
                    e.preventDefault();
                    return false;
                }
                // Validar que sea una fecha real
                var partes = valor.split('/');
                var mes = parseInt(partes[0], 10);
                var dia = parseInt(partes[1], 10);
                var anio = parseInt(partes[2], 10);
                var fecha = new Date(anio, mes - 1, dia);
                if (fecha.getFullYear() !== anio || fecha.getMonth() + 1 !== mes || fecha.getDate() !== dia) {
                    alert('La fecha de nacimiento no es válida.');
                    fechaInput.focus();
                    e.preventDefault();
                    return false;
                }
            });
        }
        
       
        
        const bancarizacionId = {{ $perfil['bancarizacion_id'] ?? 'null' }};
        const banco = document.getElementById('banco');
        const monedero = document.getElementById('monedero');
        
        if (bancarizacionId == 1) {
            banco.style.display = 'block';
        } else if (bancarizacionId == 2) {
            monedero.style.display = 'block';
        }
        
        const actualCheckbox = document.getElementById('actual');
        if (actualCheckbox) {
            actualCheckbox.addEventListener('click', function() {
                var dechaFinInput = document.getElementById('fecha_fin');
                var FinInput = document.getElementById('fin');
                if (this.checked) {
                    dechaFinInput.style.display = 'none';
                    FinInput.value = '';
                } else {
                    dechaFinInput.style.display = 'block';
                }
            });
        }
        
        
        const selectElement = $('#bancarizacion_id');
        selectElement.select2();
        selectElement.on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data.id);
            
            var banco = document.getElementById('banco');
            var monedero = document.getElementById('monedero');
            
            if (data.id == '' || data.id == 3) {
                banco.style.display = 'none';
                monedero.style.display = 'none';
            } else if (data.id == 2) {  
                banco.style.display = 'none';
                monedero.style.display = 'block';
            } else if (data.id == 1) {
                banco.style.display = 'block';
                monedero.style.display = 'none';
            }
        });

        // EPS
        const epsTipo = $('#eps_tipo');
        const epsNombreWrap = document.getElementById('eps_nombre_wrap');
        const epsNombre = $('#eps_nombre');
        
        // Inicializar select2
        epsTipo.select2();
        epsNombre.select2();
        
        function toggleEpsNombre(value) {
            if (value === 'cotizante' || value === 'beneficiaria') {
                epsNombreWrap.style.display = 'block';
                epsNombre.prop('required', true);
                
                
                // Verificar si ya hay un valor seleccionado
                const selectedValue = epsNombre.val();
                
                
                // Verificar cuántas opciones tiene el select
                const options = epsNombre.find('option');
                
                
                // Forzar actualización de Select2
                epsNombre.trigger('change.select2');
                
            } else {
                epsNombreWrap.style.display = 'none';
                epsNombre.prop('required', false);
                // Solo limpiar si no había un valor previo importante
                if (value !== '' && value !== null) {
                    epsNombre.val('').trigger('change');
                }
                
            }
        }
        
        // Evento select2:select para EPS
        epsTipo.on('select2:select', function (e) {
            var data = e.params.data;
            
            toggleEpsNombre(data.id);
        });
        
        // Al cargar la página, usar setTimeout para asegurar que select2 está listo
        enableEpsOnLoad();
        function enableEpsOnLoad() {
            setTimeout(function() {
                // Verificar que los elementos existen
                if (!epsTipo.length) {
                    console.error('Elemento epsTipo no encontrado');
                    return;
                }
                if (!epsNombre.length) {
                    console.error('Elemento epsNombre no encontrado');
                    return;
                }
                
                const currentValue = epsTipo.val();
              
                
                toggleEpsNombre(currentValue);
            }, 300); // Aumentamos más el tiempo
        }

        // Currently works checkbox functionality
        const currentlyWorksCheckbox = document.getElementById('currently_works');
        if (currentlyWorksCheckbox) {
            currentlyWorksCheckbox.addEventListener('change', function() {
                console.log('Estado laboral actual:', this.checked ? 'Trabajando' : 'Buscando empleo');
            });
        }
    });
    
    fetchCiudades();

    function fetchCiudades() {
        fetch('/api/ciudades')
            .then(response => response.json())
            .then(data => {
                const ciudadSelect = document.getElementById('ciudad_residencia_id');
                const ciudadSelect1 = document.getElementById('ciudad_id');
                const ciudadSelect2 = document.getElementById('ciudad_id2');
                const ciudadResidenciaId = {{ $perfil['ciudad_residencia_id'] ?? 'null' }};
                
                data.forEach(ciudad => {
                    const option = document.createElement('option');
                    option.value = ciudad.id;
                    option.text = ciudad.pais_departamento_ciudad;
                    if (ciudadResidenciaId && ciudadResidenciaId == ciudad.id) {
                        option.selected = true;
                    }
                    ciudadSelect.appendChild(option);
                });
                data.forEach(ciudad => {
                    const option = document.createElement('option');
                    option.value = ciudad.id;
                    option.text = ciudad.pais_departamento_ciudad;
                    ciudadSelect2.appendChild(option);
                });
                data.forEach(ciudad => {
                    const option = document.createElement('option');
                    option.value = ciudad.id;
                    option.text = ciudad.pais_departamento_ciudad;
                    ciudadSelect1.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching ciudades:', error));
    }
</script>


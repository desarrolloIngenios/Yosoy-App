@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  
@if(count($perfil['perfiles_laborales']) == 0)
    @include('profile/partial_profile_perfil_laboral')
@else

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
                                    <input class="form-control fc-datepicker" name="fecha_nacimiento" placeholder="MM/DD/YYYY" value="{{isset($perfil['fecha_nacimiento'])? date('m/d/Y', strtotime($perfil['fecha_nacimiento'])):''}}" type="text"  required>
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

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
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
                                <p class="mg-b-10">Yo Soy</p><select class="form-control select2" name="cargo_id" placeholder="" required>
                                <option value=""></option>
                                    @foreach($cargos as $item)
                                        <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                                <p class="mg-b-10">Nivel de experiencia</p><select class="form-control select2" name="nivel_experiencia_id" placeholder="" required>
                                @foreach($nivel_experiencia as $item)
                                        <option value=""></option>
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                                <p class="mg-b-10">Tiempo de experiencia</p><select class="form-control select2" name="tiempo_experiencia_id" placeholder="" required>
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
    </div>

@if(!$perfil['is_empirico'])
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
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
                        {{-- <select class="form-control select2" name="contrato" id="contrato_id" placeholder="">
                            <option value="Por horas">Por horas</option>
                            <option value="medio tiempo">medio tiempo</option>
                            <option value="Horas y emprenderismo">Horas y emprenderismo</option>
                            <option value="medio tiempo y emprenderismo">medio tiempo y emprenderismo</option>
                            <option value="tiempo completo">tiempo completo</option>
                            <option value="Sabatinas">Sabatinas</option>
                        </select> --}}
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
                                    {{-- <th>Sector</th>
                                    <th>País - Ciudad</th> --}}
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

                                    
                                    <td>{{$experiencia_laboral['contrato']['nombre']}}</td>
                                    {{-- <td>{{$experiencia_laboral['sector']['nombre']}}</td>
                                    <td>{{$experiencia_laboral['ciudad']['departamento']['pais']['nombre']}} - {{$experiencia_laboral['ciudad']['departamento']['nombre']}} - {{$experiencia_laboral['ciudad']['nombre']}}</td> --}}
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
    </div>
@endif
@if(!$perfil['is_empirico'])

    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
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
    </div>
@endif
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
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
    </div>


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
        
        
        const bancarizacionId = {{ $perfil['bancarizacion_id'] ?? 'null' }};
        const banco = document.getElementById('banco');
        const monedero = document.getElementById('monedero');
        
        if (bancarizacionId == 1) {
            banco.style.display = 'block';
        } else if (bancarizacionId == 2) {
            monedero.style.display = 'block';
        }
        
        document.getElementById('actual').addEventListener('click', function() {
            var dechaFinInput = document.getElementById('fecha_fin');
            var FinInput = document.getElementById('fin');
            if (this.checked) {
                dechaFinInput.style.display = 'none';
            FinInput.value = '';
            } else {
                dechaFinInput.style.display = 'block';
            }
        });

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
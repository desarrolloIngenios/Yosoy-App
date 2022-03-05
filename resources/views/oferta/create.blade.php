@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Oferta</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('profile.post') }}" method="post">
                    @csrf

                    <div class="row row-sm">
                        <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                            <p class="mg-b-10">Cargo</p><select class="form-control select2" name="cargo_id" placeholder="">
                            <option value=""></option>
                                @foreach($cargos as $item)
                                    <option value="{{ $item['id'] }}">
                                            {{ $item['nombre'] }}
                                        </option>
                                @endforeach
                            </select>
                        </div>   
                        <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                            <p class="mg-b-10">Tiempo de experiencia</p><select class="form-control select2" name="tiempo_experiencia_id" placeholder="País">
                            @foreach($tiempo_experiencia as $item)
                                    <option value=""></option>
                                        <option value="{{ $item['id'] }}">
                                            {{ $item['nombre'] }}
                                        </option>
                                @endforeach
                            </select>
                        </div>  

                        <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                            <p class="mg-b-10">Sector*</p><select class="form-control select2" name="sector_id" placeholder="">
                            <option value=""></option>
                                @foreach($sector as $item)
                                    <option value="{{ $item['id'] }}">
                                            {{ $item['nombre'] }}
                                        </option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                            <p class="mg-b-10">Ciudad*</p><select class="form-control select2" name="ciudad_id" placeholder="">
                            <option value=""></option>
                                @foreach($ciudades as $item)
                                    <option value="{{ $item['id'] }}">
                                            {{ $item['pais_departamento_ciudad'] }}
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
                        <div class="col-lg-6 mg-b-12 mg-lg-b-6">
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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" placeholder="Resume brevemente el perfil o servicio que estás buscando." rows="4" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 mb-0">Actualizar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cargo</th>
                                <th>Tiempo Experiencia</th>
                                <th>Sector</th>
                                <th>Ciudad</th>
                                <th>Nivel Educativo</th>
                                <th>Tipo Contrato</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Cargo</td>
                                <td>Tiempo Experiencia</td>
                                <td>Sector</td>
                                <td>Ciudad</td>
                                <td>Nivel Educativo</td>
                                <td>Tipo Contrato</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Cargo</td>
                                <td>Tiempo Experiencia</td>
                                <td>Sector</td>
                                <td>Ciudad</td>
                                <td>Nivel Educativo</td>
                                <td>Tipo Contrato</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Cargo</td>
                                <td>Tiempo Experiencia</td>
                                <td>Sector</td>
                                <td>Ciudad</td>
                                <td>Nivel Educativo</td>
                                <td>Tipo Contrato</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Cargo</td>
                                <td>Tiempo Experiencia</td>
                                <td>Sector</td>
                                <td>Ciudad</td>
                                <td>Nivel Educativo</td>
                                <td>Tipo Contrato</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Cargo</td>
                                <td>Tiempo Experiencia</td>
                                <td>Sector</td>
                                <td>Ciudad</td>
                                <td>Nivel Educativo</td>
                                <td>Tipo Contrato</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- bd -->
            </div><!-- bd -->
        </div><!-- bd -->
    </div>


</div>


<!-- row -->
@endsection
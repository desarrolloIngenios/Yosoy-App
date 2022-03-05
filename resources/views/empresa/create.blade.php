@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">CREAR EMPRESA</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('profile.post') }}" method="post">
                    @csrf

                    <div class="">

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="numero_documento">Empresa ( Razón social ) o nombre del servicio</label>
                                    <input name="numero_documento" class="form-control" value="{{isset($perfil['numero_documento'])? $perfil['numero_documento']:''}}" placeholder="Empresa ( Razón social ) o nombre del servicio" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Nit</label>
                                    <input name="name" class="form-control" value="{{isset($perfil['name'])? $perfil['name']:''}}" placeholder="Nit" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_name">Dirección</label>
                                    <input name="last_name" class="form-control" value="{{isset($perfil['last_name'])? $perfil['last_name']:''}}" placeholder="Dirección" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Ciudad</p><select class="form-control select2" name="ciudad_residencia_id" placeholder="País" required>
                                    <option value=""></option>
                                    @foreach($ciudades as $ciudad)
                                        @if(isset($perfil['ciudad_residencia_id']) && $perfil['ciudad_residencia_id'] == $ciudad['id'])
                                            <option value="{{ $ciudad['id'] }}" selected>
                                                {{ $ciudad['pais_departamento_ciudad'] }}
                                            </option>
                                        @else
                                            <option value="{{ $ciudad['id'] }}">
                                                {{ $ciudad['pais_departamento_ciudad'] }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>   
                        </div>

                           
                        </div>


                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="numero_contacto_1">Número de contacto</label>
                                    <input class="form-control" value="{{isset($perfil['numero_contacto_1'])? $perfil['numero_contacto_1']:''}}" placeholder="Número contacto" name="numero_contacto_1" type="text"  required>
                                </div>
                            </div>
                           
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="numero_contacto_1">Descripción</label>
                                    <textarea type="text" class="form-control" value="{{isset($perfil['numero_contacto_1'])? $perfil['numero_contacto_1']:''}}" placeholder="Descripción" name="numero_contacto_1" type="text"  required></textarea>
                                </div>
                            </div>
                          
                        </div>

                        <div class="row row-sm">
                          
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Crear</button>
                </form>

                
            </div>
        </div>
    </div>
<!-- row -->
@endsection
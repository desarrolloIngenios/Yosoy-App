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
                <form action="{{ route('empresa_create.post') }}" method="post">
                    @csrf

                    <div class="">

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Empresa ( Razón social ) o nombre del servicio</label>
                                    <input name="nombre" class="form-control" value="{{isset($perfil['nombre'])? $perfil['nombre']:''}}" placeholder="Empresa ( Razón social ) o nombre del servicio" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nit">Nit/Cédula</label>
                                    <input name="nit" class="form-control" value="{{isset($perfil['nit'])? $perfil['nit']:''}}" placeholder="Nit" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input name="direccion" class="form-control" value="{{isset($perfil['direccion'])? $perfil['direccion']:''}}" placeholder="Dirección" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Ciudad</p><select class="form-control select2" name="ciudad_id" placeholder="Ciudad" required>
                                    <option value=""></option>
                                    @foreach($ciudades as $ciudad)
                                        @if(isset($perfil['ciudad_id']) && $perfil['ciudad_id'] == $ciudad['id'])
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
                                    <label for="numero_contacto">Número de contacto</label>
                                    <input name="numero_contacto" class="form-control" value="{{isset($perfil['numero_contacto'])? $perfil['numero_contacto']:''}}" placeholder="Número contacto" name="numero_contacto_1" type="text"  required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Correo para factura electrónica</label> <input class="form-control" name="email_factura_electronica" placeholder="Correo para factura electrónica" type="email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea type="text" name="descripcion" class="form-control" placeholder="Descripción" type="text" required></textarea>
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
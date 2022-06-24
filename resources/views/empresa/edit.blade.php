@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">EDITAR EMPRESA</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                <form action="{{ route('empresa_update.post') }}" method="post">
                    @csrf
                     <div class="">
                     <input id="id" name="id" type="hidden" value="{{$empresa['id']}}">
                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre">Empresa ( Razón social ) o nombre del servicio</label>
                                    <input name="nombre" class="form-control" value="{{isset($empresa['nombre'])? $empresa['nombre']:''}}" placeholder="Empresa ( Razón social ) o nombre del servicio" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nit">Nit</label>
                                    <input name="nit" class="form-control" value="{{isset($empresa['nit'])? $empresa['nit']:''}}" placeholder="Nit" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input name="direccion" class="form-control" value="{{isset($empresa['direccion'])? $empresa['direccion']:''}}" placeholder="Dirección" type="text" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mg-b-6 mg-lg-b-0">
                                <p class="mg-b-10">Ciudad</p><select class="form-control select2" name="ciudad_id" placeholder="Ciudad" required>
                                    <option value=""></option>
                                    @foreach($ciudades as $ciudad)
                                        @if(isset($empresa['ciudad_id']) && $empresa['ciudad_id'] == $ciudad['id'])
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
                                    <input name="numero_contacto" class="form-control" value="{{isset($empresa['numero_contacto'])? $empresa['numero_contacto']:''}}" placeholder="Número contacto" name="numero_contacto_1" type="text"  required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Correo para factura electrónica</label> <input class="form-control" name="email_factura_electronica" placeholder="Correo para factura electrónica" value="{{isset($empresa['email_factura_electronica'])? $empresa['email_factura_electronica']:''}}" type="email" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea type="text" name="descripcion" class="form-control" placeholder="Descripción"  required>{{isset($empresa['descripcion'])? $empresa['descripcion']:''}}</textarea>
                                </div>
                            </div>
                          
                        </div>

                        <div class="row row-sm">
                          
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-0">Guardar</button> 
                </form>

                
            </div>
        </div>
    </div>
</div>
<!-- row -->
@endsection
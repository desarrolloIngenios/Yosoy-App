<div class="">

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="nombre">Empresa ( Razón social ) o nombre del servicio</label>
                <input name="nombre" class="form-control"
                    value="{{ isset($empresa['nombre']) ? $empresa['nombre'] : '' }}"
                    placeholder="Empresa ( Razón social ) o nombre del servicio" type="text" required>
            </div>
        </div>
    </div>
    <div class="row row-sm">

        <div class="col-lg-4">
            <p class="mg-b-10">Tipo documento</p><select class="form-control select2" name="tipo_documento_id"
                placeholder="Tipo Documento" required>
                <option value=""></option>
                @foreach ($tipo_documento as $documento)
                    @if (isset($empresa['tipo_documento_id']) && $empresa['tipo_documento_id'] == $documento->id)
                        <option value="{{ $documento->id }}" selected>
                            {{ $documento->nombre }} - {{ $documento->descripcion }}
                        </option>
                    @else
                        <option value="{{ $documento->id }}">
                            {{ $documento->nombre }} - {{ $documento->descripcion }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nit">Número Identificación</label>
                <input name="nit" class="form-control" value="{{ isset($empresa['nit']) ? $empresa['nit'] : '' }}"
                    placeholder="Número Identificación" type="text" required>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="digito_verificacion">Dígito Verificación</label>
                <input name="digito_verificacion" class="form-control"
                    value="{{ isset($empresa['digito_verificacion']) ? $empresa['digito_verificacion'] : '' }}"
                    placeholder="Dígito de Verifiación" type="text" required>
            </div>
        </div>
    </div>

    <div class="row row-sm">

        <div class="col-lg-6">
            <p class="mg-b-10">Regimen</p><select class="form-control select2" name="regimen_id" placeholder="Regimen"
                required>
                <option value=""></option>
                @foreach ($regimen as $regimen_obj)
                    @if (isset($empresa['regimen_id']) && $empresa['regimen_id'] == $regimen_obj->id)
                        <option value="{{ $regimen_obj->id }}" selected>
                            {{ $regimen_obj->descripcion }}
                        </option>
                    @else
                        <option value="{{ $regimen_obj->id }}">
                            {{ $regimen_obj->descripcion }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-lg-6">
            <p class="mg-b-10">Actividad económica CIIU</p><select class="form-control select2"
                name="actividad_economica_id" placeholder="Actividad Económica" required>
                <option value=""></option>
                @foreach ($actividad_economica as $actividad_economica_obj)
                    @if (isset($empresa['actividad_economica_id']) && $empresa['actividad_economica_id'] == $actividad_economica_obj->id)
                        <option value="{{ $actividad_economica_obj->id }}" selected>
                            {{ $actividad_economica_obj->ciiu219 }} - {{ $actividad_economica_obj->descripcion }}
                        </option>
                    @else
                        <option value="{{ $actividad_economica_obj->id }}">
                            {{ $actividad_economica_obj->ciiu219 }} - {{ $actividad_economica_obj->descripcion }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>



    <div class="row row-sm">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input name="direccion" class="form-control"
                    value="{{ isset($empresa['direccion']) ? $empresa['direccion'] : '' }}" placeholder="Dirección"
                    type="text" required>
            </div>
        </div>
        <div class="col-lg-6 mg-b-6 mg-lg-b-0">
            <p class="mg-b-10">Ciudad</p><select class="form-control select2" name="ciudad_id" placeholder="Ciudad"
                required>
                <option value=""></option>
                @foreach ($ciudades as $ciudad)
                    @if (isset($empresa['ciudad_id']) && $empresa['ciudad_id'] == $ciudad['id'])
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
            <input name="numero_contacto" class="form-control"
                value="{{ isset($empresa['numero_contacto']) ? $empresa['numero_contacto'] : '' }}"
                placeholder="Número contacto" name="numero_contacto_1" type="text" required>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Correo para factura electrónica</label> <input class="form-control" name="email_factura_electronica"
                value="{{ isset($empresa['email_factura_electronica']) ? $empresa['email_factura_electronica'] : '' }}"
                placeholder="Correo para factura electrónica" type="email" required>
        </div>
    </div>
</div>

<div class="row row-sm">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea type="text" name="descripcion" class="form-control" placeholder="Descripción" type="text" required>{{ isset($empresa['descripcion']) ? $empresa['descripcion'] : '' }}</textarea>
        </div>
    </div>

</div>

<div class="row row-sm">

</div>

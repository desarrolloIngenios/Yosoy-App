
<div class="table-responsive border-top userlist-table">
    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-lg-20p"><span>Nombre/Nit</span></th>
                <th class="wd-lg-20p"><span>Dirección/Ciudad</span></th>
                <th class="wd-lg-20p"><span>Número Contacto / Correo</span></th>
                <th class="wd-lg-20p">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empresas as $user)
            <tr>
                <td>
                        {{ $user['nombre'] }} 
                    <br>
                        {{ $user['nit'] }}
                </td>
                <td>
                    {{ $user['direccion'] }}
                    <br>
                    {{ $user['ciudad'] ? $user['ciudad']['pais_departamento_ciudad']:'-' }}
                </td>
                <td>
                    {{ $user['numero_contacto'] }}
                    <br>
                    {{ $user['email_factura_electronica'] }} 
                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary">
                        <i class="las la-search"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-info">
                        <i class="las la-pen"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-danger">
                        <i class="las la-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
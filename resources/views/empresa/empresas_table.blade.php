<section id="no-more-tables">
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
                <td data-title="Nombre">
                        {{ $user['nombre'] }} 
                    <br>
                        {{ $user['nit'] }}
                </td>
                <td data-title="Dirección">
                    {{ $user['direccion'] }}
                    <br>
                    {{ $user['ciudad'] ? $user['ciudad']['pais_departamento_ciudad']:'-' }}
                </td>
                <td data-title="Número">
                    {{ $user['numero_contacto'] }}
                    <br>
                    {{ $user['email_factura_electronica'] }} 
                </td>
                <td data-title="Acciones">
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=57{{ str_replace(' ', '', $user['numero_contacto']); }}" class="btn btn-sm">
                        <img alt="avatar" class="rounded-circle avatar-md mr-2" src="../../assets/img/faces/WhatsApp.webp">
                    </a>
                    <a target="_blank" href="tel:{{ str_replace(' ', '', $user['numero_contacto']); }}" class="btn btn-sm btn-primary">
                        <i class="las la-phone"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</section>
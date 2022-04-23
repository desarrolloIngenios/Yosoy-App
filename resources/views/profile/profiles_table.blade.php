
<div class="table-responsive border-top userlist-table">
    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-lg-8p"><span>User</span></th>
                <th class="wd-lg-20p"><span></span></th>
                <th class="wd-lg-20p"><span>Contacto</span></th>
                <th class="wd-lg-20p"><span>Perfil</span></th>
                <th class="wd-lg-20p">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    @if(isset($user['foto_perfil_url']))
                        <img alt="avatar" class="rounded-circle avatar-md mr-2" src="{{ \Storage::disk('s3')->temporaryUrl($user['foto_perfil_url'], '+10 minutes') }}">
                    @else
                        <img alt="avatar" class="rounded-circle avatar-md mr-2" src="../../assets/img/faces/1.jpg">
                    @endif
                </td>
                <td>
                    @if(trim($user['full_name']) == "")
                        {{ $user['user']['name'] }} 
                    @else
                        {{ $user['full_name'] }} 
                    @endif
                    <br>
                    {{ $user['ciudad_residencia'] ? $user['ciudad_residencia']['pais_departamento_ciudad']:'-' }}
                </td>
                <td>
                    {{ $user['numero_contacto_1'] }} - {{ $user['numero_contacto_2'] }} 
                    <br>
                    @if(trim($user['email']) == "")
                        {{ $user['user']['email'] }} 
                    @else
                        {{ $user['email'] }} 
                    @endif
                </td>
                <td>
                    @foreach($user['perfiles_laborales'] as $perfil_laboral)
                        {{ $perfil_laboral['nivel_experiencia'] ? $perfil_laboral['nivel_experiencia']['nombre'] : '' }}
                        -
                        {{ $perfil_laboral['cargo'] ? $perfil_laboral['cargo']['nombre'] : '' }} 
                        <br> 
                    @endforeach
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
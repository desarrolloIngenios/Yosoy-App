@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">LISTADO USUARIOS</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
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
                                    {{ $user['full_name'] }} 
                                    <br>
                                    {{ $user['ciudad_residencia'] ? $user['ciudad_residencia']['pais_departamento_ciudad']:'-' }}
                                </td>
                                <td>
                                    {{ $user['numero_contacto_1'] }} - {{ $user['numero_contacto_2'] }} 
                                    <br>
                                    {{ $user['email'] }}
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

                
            </div>
        </div>
    </div>
</div>
<!-- row -->
@endsection
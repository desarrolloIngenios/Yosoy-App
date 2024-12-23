<section id="no-more-tables">
    <div class="table-responsive border-top userlist-table">
        <table id="{{ $table_id ?? '' }}" class="table card-table table-striped table-vcenter text-nowrap mb-0">
            <thead>
                <tr>
                    <th class="wd-lg-8p"><span>Usuario</span></th>
                    <th class="wd-lg-20p"><span></span></th>
                    <th class="wd-lg-20p"><span>Contacto</span></th>
                    <th class="wd-lg-20p"><span>Experiencia</span></th>
                    <th class="wd-lg-20p">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @if (is_null($user) || is_null($user['name']))
                        @continue
                    @endif
                        <tr id="{{ $loop->index }}" class="user_row" style="{{ $style ?? '' }}">
                            <td data-title="">
                                @if (isset($user['foto_perfil_url']))
                                    <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                        src="{{ \Storage::disk('s3')->temporaryUrl($user['foto_perfil_url'], '+10 minutes') }}">
                                @else
                                    <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                        src="{{ URL::asset('/assets/img/faces/1.jpg') }}">
                                @endif

                            </td>
                            <td data-title="Nombre">
                                <i class="las la-{{ $user->is_empirico ? 'hammer' : 'graduation-cap' }} tx-20"></i>
                                @if (trim($user['full_name']) == '')
                                    {{ '-' }}
                                @else
                                    {{ $user['full_name'] }}
                                @endif
                                <br>
                                {{ $user['grupo_social_nombre'] }}
                                <br>
                                {{ $user['ciudad_residencia'] ? $user['ciudad_residencia']['pais_departamento_ciudad'] : '-' }}
                            </td>
                            <td data-title="Número">
                                {{ $user['numero_contacto_1'] }} - {{ $user['numero_contacto_2'] }}
                                <br>
                                @if (trim($user['email']) == '')
                                    {{ '-' }}
                                @else
                                    {{ $user['email'] }}
                                @endif
                            </td>
                            <td data-title="Experiencia">
                                @foreach ($user['perfiles_laborales'] as $perfil_laboral)
                                    {{ $perfil_laboral['nivel_experiencia'] ? $perfil_laboral['nivel_experiencia']['nombre'] : '' }}
                                    -
                                    {{ $perfil_laboral['cargo'] ? $perfil_laboral['cargo']['nombre'] : '' }}
                                    -
                                    {{ $perfil_laboral['tiempo_experiencia'] ? $perfil_laboral['tiempo_experiencia']['nombre'] : '' }}
                                    <br>
                                @endforeach
                            </td>
                            <td data-title="Acciones">

                                <div class="d-flex my-xl-auto right-content">
                                    <div class="pr-1 mb-xl-0">
                                        <a target="_blank"
                                            href="https://api.whatsapp.com/send?phone=57{{ str_replace(' ', '', $user['numero_contacto_1']) }}"
                                            class="btn btn-icon mr-2">
                                            <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                                src="{{ URL::asset('/assets/img/faces/WhatsApp.webp') }}">
                                        </a>
                                    </div>
                                
                                    <div class="pr-1 mb-xl-0">
                                        <a target="_blank"
                                            href="tel:{{ str_replace(' ', '', $user['numero_contacto_1']) }}"
                                            class="btn btn-icon btn-warning mr-2">
                                            <i class="las la-phone"></i>
                                        </a>
                                    </div>

                                    <div class="pr-1 mb-xl-0">
                                        <a
                                            href="{{ route('recordatorio_llenar_perfil', [$user['id']]) }}"
                                            class="btn btn-icon btn-primary mr-2">
                                            <i class="las la-mail-bulk"></i>
                                        </a>
                                    </div>
                                    @if (session('role') == 'ADMIN')
                                        @if(isset($offer))
                                            <div class="pr-1 mb-xl-0">
                                                <a target="_blank"
                                                    href="{{ route('star_rating.show', [$user['user_id'], $offer['id']]) }}"
                                                    class="btn btn-danger btn-icon mr-2">
                                                    <i class="las la-star"></i>
                                                </a>
                                            </div>
                                        @endif
                                        @if($user && $user->roles && $user->roles->contains('name', 'EMPRESARIO'))
                                                {{-- @if($user->user->roles->contains('name', 'EMPRESARIO')) --}}
                                            <div class="pr-1 mb-xl-0">
                                                <a href="{{ route('offer.agregar_gratis', [$user['user_id']]) }}"
                                                    class="btn btn-primary">
                                                    <i class="">Oferta de Prueba</i>
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

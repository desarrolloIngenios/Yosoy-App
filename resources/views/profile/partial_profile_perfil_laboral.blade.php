
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Perfil Laboral / Servicio</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
            @if(count($perfil['perfiles_laborales']) < 3)
                <form action="{{ route('profile_laboral.post') }}" method="post">
                        @csrf
                        <div class="row row-sm">
                            <div class="col-lg-6 mg-b-12 mg-lg-b-6">
                                <p class="mg-b-10">Yo Soy</p><select class="form-control select2" name="cargo_id" placeholder="">
                                <option value=""></option>
                                    @foreach($cargos as $item)
                                        <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                                <p class="mg-b-10">Nivel de experiencia</p><select class="form-control select2" name="nivel_experiencia_id" placeholder="País">
                                @foreach($nivel_experiencia as $item)
                                        <option value=""></option>
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>   
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                                <p class="mg-b-10">Tiempo de experiencia</p><select class="form-control select2" name="tiempo_experiencia_id" placeholder="País">
                                @foreach($tiempo_experiencia as $item)
                                        <option value=""></option>
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['nombre'] }}
                                            </option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="col-lg-2 mg-b-6 mg-lg-b-6">
                            <br>
                                <button type="submit" class="btn btn-primary mt-6 mb-0">Agregar</button>
                            </div>
                        </div>
                </form>
                @endif
                <br>
                        <div class="table-responsive">
                            <table class="table mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Cargo</th>
                                        <th>Nivel Experiencia</th>
                                        <th>Tiempo Experiencia</th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($perfil['perfiles_laborales'] as $index => $perfil_laboral)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{$perfil_laboral['cargo']['nombre']}}</td>
                                        <td>{{$perfil_laboral['nivel_experiencia']['nombre']}}</td>
                                        <td>{{$perfil_laboral['tiempo_experiencia']['nombre']}}</td>
                                        <td>
                                            <a href="{{ route('profile_laboral.delete', $perfil_laboral['id'])}}" class="card-link text-secondary"><i class="typcn typcn-trash"></i> Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
            </div>
        </div>
    </div>

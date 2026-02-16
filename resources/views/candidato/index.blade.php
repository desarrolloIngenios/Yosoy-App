@extends('app')
@section('content')
    <!-- row -->

    <div class="row row-sm">
        
        <div class="col-md-3 col-sm-12">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="icon1 mt-2 text-center">
                                <i class="fa fa-users tx-40"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-0 text-center">
                                <span class="text-white">Usuarios</span>
                                <h2 class="text-white mb-0">{{ count($candidatas) }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mb-3">
            <div class="card border rounded">
                <div class="card-body ">
                    <form method="GET" id="filtro-candidatas">
                        <div class="row align-items-end">
                            <div class="col-md-4 mb-2">
                                <label for="filtro_perfil" class="font-weight-bold">Estado de perfil</label>
                                <select name="filtro_perfil" id="filtro_perfil" class="form-control">
                                    <option value="">Todos</option>
                                    <option value="completo" {{ request('filtro_perfil') == 'completo' ? 'selected' : '' }}>Completos</option>
                                    <option value="incompleto" {{ request('filtro_perfil') == 'incompleto' ? 'selected' : '' }}>Incompletos</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="filtro_mes" class="font-weight-bold">Mes de registro</label>
                                <select name="filtro_mes" id="filtro_mes" class="form-control">
                                    <option value="">Todos</option>
                                    @php
                                        $meses = [];
                                        foreach($candidatas as $c) {
                                            $mes = \Carbon\Carbon::parse($c['created_at'])->format('Y-m');
                                            $meses[$mes] = \Carbon\Carbon::parse($c['created_at'])->translatedFormat('F Y');
                                        }
                                    @endphp
                                    @foreach(array_unique($meses) as $mesVal => $mesLabel)
                                        <option value="{{ $mesVal }}" {{ request('filtro_mes') == $mesVal ? 'selected' : '' }}>{{ ucfirst($mesLabel) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-block font-weight-bold"><i class="fa fa-filter mr-1"></i> Filtrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1">Mis Mentee</h4>
                    <p class="mb-2"></p>
                </div>
                <div class="card-body pt-0">
                    @include('profile.candidate_table', ['candidatas' => $candidatas])
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

@extends('app')
@section('content')
    <!-- row -->
    <div class="row row-sm">

        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header pb-0">
                    @if (!$offer['active'])
                        <div class="badge bg-pink">OFERTA CERRADA</div>
                    @endif
                    @if ($offer['is_garantia'])
                        <div class="badge bg-success">Garantía</div>
                    @endif
                    <h5 class="card-title ">{{ $offer['cargo']['nombre'] }} - {{ $offer['sector']['nombre'] }} -
                        {{ $offer['tiempo_experiencia']['nombre'] }} </h5>
                    <h5 class="card-title ">
                        @foreach ($offer['tipo_contrato'] as $tipo_contrato)
                            {{ $tipo_contrato['nombre'] }} @if (!$loop->last)
                                {{ ', ' }}
                            @endif
                        @endforeach
                    </h5>
                    <h5 class="card-title mb-0 pb-0">{{ $offer['nivel_educativo']['nombre'] }} </h5>
                </div>
                <div class="card-body text-primary">
                    {{ $offer['description'] }}
                </div>
                <div class="card-footer">
                    {{ $offer['ciudad']['pais_departamento_ciudad'] }}
                    <br>
                    {{ \Carbon\Carbon::createFromTimeStamp(strtotime($offer['created_at']))->locale('es')->diffForHumans() }}

                    @php
                        $fechaCreacion = \Carbon\Carbon::parse($offer['created_at']);
                        $fechaActual = \Carbon\Carbon::now();
                        $diasRestantes = 30 - $fechaActual->diffInDays($fechaCreacion);
                    @endphp
                    <br>
                    <br>
                    @if (count($user_with_contrato) > 0)
                        @if ($diasRestantes > 0 && !$offer['is_garantia'])
                            <form action="{{ route('offer.garantia') }}" method="post">
                                @csrf
                                <input type="hidden" name="offer_id" value="{{ $offer['id'] }}">
                                <button type="submit" class="btn btn-success">Solicitar Garantía</button>
                                Tienes ({{ $diasRestantes }}) días restantes para solicitar garantía.
                            </form>
                            {{-- <button id="button_ver_mas" class="btn btn-success">Solicitar Garantía</button> --}}
                        @elseif(is_null($offer['is_garantia_date']) || (!is_null($offer['is_garantia_date']) && !$offer['active']))
                            <a href="{{ route('oferta.create.copy', $offer['id']) }}" class="btn btn-success">Publicar
                                Oferta</a>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>


    {{-- <div >
    <h4>Búsqueda Inteligente (Match)</h4>
    @include('profile/profiles_table', ['users' => $users_busqueda, 'style' => "display: none;", 'table_id'=>'tabla_busqueda'])
</div>
<div class="container">
<div class="col-sm-6 col-md-3">
        <button id="button_ver_mas" class="btn btn-success btn-block" >Ver más +</button>
    </div>
</div>
<br>
<br>
<br>
<div>
    <h4>Postulados</h4>
    @include('profile/profiles_table')
</div> --}}

    <div class="row">
        @if ((!count($user_with_contrato) > 0 && $offer['active']) || ($offer['is_garantia'] && $offer['active']))
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <h4>Búsqueda Inteligente (Match)</h4>
                        </div>
                        @include('profile/profiles_table_oferta', [
                            'users' => $users_busqueda,
                            'style' => 'display: none;',
                            'table_id' => 'tabla_busqueda',
                        ])
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <button id="button_ver_mas" class="btn btn-success">Ver más +</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <h4>Postulados</h4>
                        </div>
                        @include('profile/profiles_table_oferta')
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            <h4>Contratos</h4>
                        </div>
                        @include('profile/profiles_table_oferta', ['users' => $user_with_contrato_objs])
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="contratoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seleccionar tipo de contrato y fecha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="modalUserId" value="">
                    <div class="form-group">
                        <label for="tipoContrato">Tipo de contrato:</label>
                        <select class="form-control" id="tipoContrato" name="tipoContrato">
                            <option value="1">Contrato por servicios</option>
                            <option value="2">Contrato a término fijo</option>
                            <option value="3">Contrato indefinido</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fechaContrato">Fecha del contrato:</label>
                        <input type="date" class="form-control" id="fechaContrato" name="fechaContrato"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarContrato()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- row -->
@endsection

@section('js')
    <script type="text/javascript">
        $(window).on('load', function() {

            $('#contratoModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que activó la modal
                var userId = button.data('user-id'); // Obtener el valor de user_id del botón
                $('#modalUserId').val(userId); // Actualizar el campo oculto en la modal
            });

            var index_show = 5;

            $("#button_ver_mas").click(function() {
                index_show += 5;
                show_hide_rows_user_table();
            });

            show_hide_rows_user_table();

            function show_hide_rows_user_table() {
                if (index_show < 0) {
                    $('#tabla_busqueda .user_row').hide();
                } else {
                    $('#tabla_busqueda .user_row:lt(' + index_show + ')').show();
                }
            }
        });

        function guardarContrato() {
            var userId = $('#modalUserId').val();
            // Agregar los valores seleccionados al formulario
            var tipoContrato = document.getElementById('tipoContrato').value;
            var fechaContrato = document.getElementById('fechaContrato').value;

            var inputTipoContrato = document.createElement('input');
            inputTipoContrato.type = 'hidden';
            inputTipoContrato.name = 'tipoContrato';
            inputTipoContrato.value = tipoContrato;

            var inputFechaContrato = document.createElement('input');
            inputFechaContrato.type = 'hidden';
            inputFechaContrato.name = 'fechaContrato';
            inputFechaContrato.value = fechaContrato;

            // Agregar los elementos de input al formulario
            var form = $('#'+userId);
            console.log("userId");
            console.log(userId);
            console.log(inputFechaContrato);
            console.log(form);
            form.append(inputTipoContrato);
            form.append(inputFechaContrato);

            // Enviar el formulario

            form.submit();
        }
    </script>
@endsection

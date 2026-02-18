@extends('app')

@section('css')
  
@section('content')
{{-- <div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header">
                Gráfico 1: 
            </div>
            <div class="card-body">
                <div id="chart1"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                Gráfico 2: 
            </div>
            <div class="card-body">
                <div id="chart2"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header">
                Gráfico 3: 
            </div>
            <div class="card-body">
                <div id="chart3"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                Gráfico 4: 
            </div>
            <div class="card-body">
                <div id="chart4"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                Gráfico 5: 
            </div>
            <div class="card-body">
                <div id="chart5"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header">
                Gráfico 7: 
            </div>
            <div class="card-body">
                <div id="chart7"></div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-6">
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
                            <span class="text-white">LIDERESAS</span>
                            <h2 class="text-white mb-0">{{ $lideresas }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center">
                            <i class="fa fa-users tx-40"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center">
                            <span class="text-white">Mentees</span>
                            <h2 class="text-white mb-0">{{ $candidatas }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div id="chart-perfil"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div id="chart-edad"></div>
            </div>
        </div>
    </div>
  
</div>
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div id="chart-documento"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <div id="chart-social"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>

        
        var ageGroups = @json($edades);
        var cargosData = [];
        var perCompletados = @json($per_completados); 
        var perNoCompletados = @json($per_nocompletados);

        var datosDocumentos = {
            'CC': {{ $cedula_ciudadania }},
            'CE': {{ $cedula_extrajera }},
            'TI': {{ $tarjeta_identidad }},
            'TE': {{ $tarjeta_extrajera }},
            'PA': {{ $pasaporte }},
            'NIT': {{ $nit }},
            'Otro': {{ $otro }}
        };

        var grupoSocial = {
            'Sin grupo': {{ $social_no }},
            'Etnicos': {{ $social_etnico }},
            'Afros': {{ $social_afros }},
            'Venezolanos': {{ $social_venezolanos }},
            'Fundaciones': {{ $social_fundaciones }},
            'Otros': {{ $social_otros }},
        };
        

        // Grafico de Edad
        var options1 = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Usuarios',
                data: Object.values(ageGroups) 
            }],
            xaxis: {
                categories: Object.keys(ageGroups)
            },
            title: {
                text: 'Perfil completado y edades '
            },
            colors: ['#F1B715']
        };

        var chart1 = new ApexCharts(document.querySelector("#chart-edad"), options1);
        chart1.render();



        //perfiles completados
        var options3 = {
            chart: {
                type: 'pie',  
                height: 350
            },
            series: [perCompletados, perNoCompletados], 
            labels: ['Completados', 'No Completados'], 
            title: {
                text: 'Perfiles Completados vs No Completados' 
            },
            colors: ['#F1B715', '#5D1D88'],  

        };

        var chart3 = new ApexCharts(document.querySelector("#chart-perfil"), options3);
        chart3.render();

        //docuentos
        var options4 = {
            chart: {
                type: 'area',
                height: 350
            },
            series: [{
                name: 'Cantidad',
                data: Object.values(datosDocumentos)
            }],
            xaxis: {
                categories: Object.keys(datosDocumentos), 
            },
            title: {
                text: 'Perfiles completado y Documento'
            },
            colors: ['#5D1D88'], 
        };

        var chart4 = new ApexCharts(document.querySelector("#chart-documento"), options4);
        chart4.render();
        
        //social
        var options5 = {
            chart: {
                type: 'area',
                height: 350
            },
            series: [{
                name: 'Cantidad',
                data: Object.values(grupoSocial)
            }],
            xaxis: {
                categories: Object.keys(grupoSocial), 
            },
            title: {
                text: 'Usuarios por grupo social'
            },
            colors: ['#F1B715'], 
        };

        var chart5 = new ApexCharts(document.querySelector("#chart-social"), options5);
        chart5.render();
    </script>

@endsection
@extends('app')

@section('css')
    <style>
        
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .acordeon {
            background-color: #fff;
            border: 1px solid #adadad;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .acordeon .contenido {
            padding: 10px;
            display: none;  
            background-color: #fff;
            border-top: 1px solid #ddd;
            border-radius: 10px;
        }

        .acordeon input[type="checkbox"] {
            display: none; 
        }

        .acordeon label {
            display: block;
            padding: 10px;
            background-color: #adadad;
            cursor: pointer;
            font-weight: bold;
        }

        .acordeon input[type="checkbox"]:checked + label + .contenido {
            display: block; 
        }
    </style>
  
@section('content')
    @if (!$perfil['is_complete_form'])
        <div class="row row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1 text-center">Debe completar el perfil para ingresar a los cursos</h4>
                        <p class="mb-2"></p>
                    </div>
                </div>
            </div>
        </div>
        
    @else
        @if (!$programas)
            <div class="row row-sm">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header">
                            <h4 class="card-title mb-1 text-center">No tiene asignado ningun programa</h4>
                            <p class="mb-2"></p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @foreach($programas as $programa)
                <div class="acordeon">
                    {{-- {{ $programas[0]['show__title'] }} --}}
                    <input type="checkbox" id="acordeon{{$programa['show__id']}}">
                    <label for="acordeon{{ $programa['show__id'] }}">{{ $programa['show__title'] }} - PROGRESO {{ $programa['show__user__progress__percent'] }} %</label>
                    <div class="contenido">
                        <iframe id="iframe_embed" width="100%" height="800" src="https://business.suonos.co/es/snippet/show/{{ $programa['show__id']}}?api_key=45bf480161eb6be5179b5a4a1a13228588071064&user_email={{$user->email}}" referrerpolicy="origin"
                        title="Suonos Audio Player" frameborder="0"></iframe>
                    </div>
                </div>
            @endforeach
        @endif
       
    @endif
    

@endsection
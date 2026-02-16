@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  
        @if(session('role') != 'LIDERESA' && session('role') != 'SUPERLIDERESA')
            <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="panel price panel-color">
                    <div class="panel-heading bg-primary p-0 text-center">
                        <h3>Soy mujer</h3>
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="../../images/empirico.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                    <ul class="list-group list-group-flush text-center">
                    </ul>
                    <div class="panel-footer text-center">
                        <a class="btn btn-primary" href="{{ route('save_soy_empirico.get') }}">Crear perfil</a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="panel price panel-color">
                    <div class="panel-heading bg-warning  p-0 text-center">
                        <h3>Técnico</h3>
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="../../images/tecnico.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                    <ul class="list-group list-group-flush text-center">

                    </ul>
                    <div class="panel-footer text-center">
                        <a class="btn btn-warning" href="{{ route('save_soy_tecnico.get') }}">Soy Técnico</a>
                    </div>
                </div>
            </div> --}}
        @endif
        @if(session('role') == 'LIDERESA')
            <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="panel price panel-color">
                    <div class="panel-heading bg-warning  p-0 text-center">
                        <h3>Lideresa</h3>
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="../../images/tecnico.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                    <ul class="list-group list-group-flush text-center">
    
                    </ul>
                    <div class="panel-footer text-center">
                        <a class="btn btn-warning" href="{{ route('save_soy_lideresa.get') }}">Soy Lideresa</a>
                    </div>
                </div>
            </div>
        @endif
        @if(session('role') == 'SUPERLIDERESA')
            <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="panel price panel-color">
                    <div class="panel-heading bg-warning  p-0 text-center">
                        <h3>Super Lideresa</h3>
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                            <img src="../../images/tecnico.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                        </div>
                    </div>
                    <ul class="list-group list-group-flush text-center">
    
                    </ul>
                    <div class="panel-footer text-center">
                        <a class="btn btn-warning" href="{{ route('save_soy_superlideresa.get') }}">Soy Super Lideresa</a>
                    </div>
                </div>
            </div>
        @endif
        
       
        
</div>
<!-- row -->
@endsection
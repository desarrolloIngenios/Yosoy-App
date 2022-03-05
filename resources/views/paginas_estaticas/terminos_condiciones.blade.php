@extends('app_terminos')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="tabs-menu ">
            <!-- Tabs -->
            <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                <li class="active">
                    <a href="#terminos" data-toggle="tab" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 mr-1"></i></span> <span class="hidden-xs">Términos y condiciones</span> </a>
                </li>
                <li class="">
                    <a href="#politica" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 mr-1"></i></span> <span class="hidden-xs">Política de privacidad</span> </a>
                </li>
            </ul>
        </div>
        <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
            <div class="tab-pane active" id="terminos">
                @include('paginas_estaticas/terminos_condiciones_texto')
            
            </div>
            <div class="tab-pane" id="politica">
                @include('paginas_estaticas/politica_texto')
            </div>
        </div>
    </div>
</div>

@endsection
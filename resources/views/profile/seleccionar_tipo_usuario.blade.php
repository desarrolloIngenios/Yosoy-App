@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  

        <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="panel price panel-color">
                <div class="panel-heading bg-primary p-0 text-center">
                    <h3>Empírico / Independiente</h3>
                </div>
                <div class="panel-body text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="../../images/empirico.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <!-- <li class="list-group-item"><strong> 2 Free</strong> Domain Name</li>
                    <li class="list-group-item"><strong>3 </strong> One-Click Apps</li>
                    <li class="list-group-item"><strong> 1 </strong> Databases</li>
                    <li class="list-group-item"><strong> Money </strong> BackGuarantee</li>
                    <li class="list-group-item border-bottom-0"><strong> 24/7</strong> support</li> -->
                </ul>
                <div class="panel-footer text-center">
                    <a class="btn btn-primary" href="{{ route('save_soy_empirico.get') }}">Soy Empírico / Informal</a>
                </div>
            </div>
        </div><!-- COL-END -->
        <div class="col-xs-6 col-sm-6 col-lg-6 col-xl-3">
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
                    <!-- <li class="list-group-item"><strong> 3 Free</strong> Domain Name</li>
                    <li class="list-group-item"><strong>4 </strong> One-Click Apps</li>
                    <li class="list-group-item"><strong> 2 </strong> Databases</li>
                    <li class="list-group-item"><strong> Money </strong> BackGuarantee</li>
                    <li class="list-group-item border-bottom-0"><strong> 24/7</strong> support</li> -->
                </ul>
                <div class="panel-footer text-center">
                    <a class="btn btn-warning" href="{{ route('save_soy_tecnico.get') }}">Soy Técnico</a>
                </div>
            </div>
        </div><!-- COL-END -->
        
        
</div>
<!-- row -->
@endsection
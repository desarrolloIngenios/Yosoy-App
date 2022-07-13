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
                            <h2 class="text-white mb-0">{{ count($users) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center">
                            <i class="fa fa-hammer tx-40"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center">
                            <span class="text-white">Empíricos</span>
                            <h2 class="text-white mb-0">{{ count(array_filter($users,function($element) {
                                                            return $element['is_empirico']==true;
                                                            })) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="icon1 mt-2 text-center">
                            <i class="fa fa-graduation-cap tx-40"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-0 text-center">
                            <span class="text-white">Técnicos</span>
                            <h2 class="text-white mb-0">{{ abs(count(array_filter($users,function($element) {
                                                            return $element['is_empirico']==true;
                                                            })) - count($users)) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">LISTADO USUARIOS</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                @include('profile/profiles_table')
            </div>
        </div>
    </div>
</div>
<!-- row -->
@endsection
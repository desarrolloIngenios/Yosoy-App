@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">
  
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
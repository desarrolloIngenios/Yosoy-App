@extends('app')
@section('content')
    <!-- row -->
    <div class="row row-sm">

        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1">EDITAR EMPRESA</h4>
                    <p class="mb-2"></p>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('empresa_update.post') }}" method="post">
                        @csrf
                        <input id="id" name="id" type="hidden" value="{{ $empresa['id'] }}">
                        @include('empresa/partial_form_empresa')
                        <button type="submit" class="btn btn-primary mt-3 mb-0">Guardar</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

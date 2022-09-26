@extends('app')
@section('content')
<!-- row -->

<div class="row row-sm">

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">LISTADO CÓDIGOS</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                


            <div class="table-responsive border-top userlist-table">
    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-lg-10p"><span>ID</span></th>
                <th class="wd-lg-20p"><span>Código</span></th>
                <th class="wd-lg-20p"><span>Fecha Uso</span></th>
                <th class="wd-lg-30p"><span>Fecha Creación</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($codes as $code)
            <tr>
                <td data-title="">
                    {{ $code->id }}
                </td>
                <td data-title="">
                    {{ $code->code }}
                </td>
                <td data-title="">
                    {{ $code->used_date }}
                </td>
                <td data-title="">
                    {{ $code->created_at }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>












            </div>
        </div>
    </div>
</div>
<!-- row -->
@endsection
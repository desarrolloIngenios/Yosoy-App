@extends('app')
@section('content')
<!-- row -->

<div class="row row-sm">

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">Listado Transacciones</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                


            <div class="table-responsive border-top userlist-table">
    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-lg-30p"><span>INFO</span></th>
                <th class="wd-lg-20p"><span>Id</span></th>
                <th class="wd-lg-20p"><span>Referencia</span></th>
                <th class="wd-lg-30p"><span>Estado</span></th>
                <th class="wd-lg-30p"><span>Metodo de Pago</span></th>
                <th class="wd-lg-30p"><span>Valor</span></th>
                <th class="wd-lg-30p"><span>Correo</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td data-title="">
                    {{ isset($transaction->customer_email)? $transaction->customer_email : '' }}
                    @if(isset($transaction->customer_data))
                        <br>
                        {{ isset($transaction->customer_data['full_name'])? $transaction->customer_data['full_name'] : '' }}
                        <br>
                        {{ isset($transaction->customer_data['phone_number'])? $transaction->customer_data['phone_number'] : '' }}
                    @endif
                </td>
                <td data-title="">
                    {{ isset($transaction->id)? $transaction->id : '' }}
                </td>
                <td data-title="">
                    {{ isset($transaction->reference)? $transaction->reference : '' }}
                </td>
                <td data-title="">
                    {{ isset($transaction->status)? $transaction->status : '' }}
                </td>
                <td data-title="">
                    {{ isset($transaction->payment_method_type)? $transaction->payment_method_type : '' }}
                </td>
                <td data-title="">
                    {{ isset($transaction->amount_in_cents)? number_format($transaction->amount_in_cents/100) : '' }}
                </td>
               
                <td data-title="">
                    {{ isset($transaction->created_at)? \Carbon\carbon::createFromFormat("Y-m-d\TH:i:s.uP",  $transaction->created_at)  : '' }}
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
@extends('app')
@section('content')
<!-- row -->

<div class="row row-sm">

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card  box-shadow-0 ">
            <div class="card-header">
                <h4 class="card-title mb-1">LISTADO OFERTAS CALIFICADAS</h4>
                <p class="mb-2"></p>
            </div>
            <div class="card-body pt-0">
                


            <div class="table-responsive border-top userlist-table">
    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-lg-20p"><span>Oferta</span></th>
                <th class="wd-lg-20p"><span>Estrellas</span></th>
                <th class="wd-lg-30p"><span>Comentarios</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($offer_question_response as $key =>  $offer)
            <tr>
                <td data-title="">
                {{ \App\Models\Offer::find($key)->id; }} - {{ \App\Models\Offer::find($key)->cargo->nombre; }}
                </td>
                <td data-title="">
                    @if(isset($offer['App\Models\OfferQuestionStar']))
                        @foreach($offer['App\Models\OfferQuestionStar'] as $response)
                            {{ $question_star->where('id', $response->offer_question_id)->first()->name }}: {{$response->star_response}}
                            </br>
                        @endforeach
                    @endif
                </td>
                <td data-title="">
                    @if(isset($offer['App\Models\OfferQuestionText']))
                        @foreach($offer['App\Models\OfferQuestionText'] as $response)
                            {{ $question_text->where('id', $response->offer_question_id)->first()->name }}: {{$response->text_response}}
                            </br>
                        @endforeach
                    @endif
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
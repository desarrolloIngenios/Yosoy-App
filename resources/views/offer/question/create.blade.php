@extends('app')
@section('css')
    @include('offer/question/partial_css')
@endsection

@section('content')
<!-- row -->
<div class="row row-sm">

    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header pb-0">
                <h5 class="card-title ">Encuesta de servicio</h5>
                <h5 class="card-title ">

                <form action="{{ route('offer.question.store') }}" method="post">
                @csrf
                <input name="offer_id" type="hidden" value="{{ $offer->id }}">
                @foreach($question_star as $star)
                    <input name="star_ids[]" type="hidden" value="{{ $star->id }}">
                    <label>{{ $star->name }}</label>
                    <p class="clasificacion_{{$star->id}}">
                        <input id="radio1_{{$star->id}}" type="radio" name="star_response_{{ $star->id }}" value="5" checked required><!--
                        --><label for="radio1_{{$star->id}}">★</label><!--
                        --><input id="radio2_{{$star->id}}" type="radio" name="star_response_{{ $star->id }}" value="4" required><!--
                        --><label for="radio2_{{$star->id}}">★</label><!--
                        --><input id="radio3_{{$star->id}}" type="radio" name="star_response_{{ $star->id }}" value="3" required><!--
                        --><label for="radio3_{{$star->id}}">★</label><!--
                        --><input id="radio4_{{$star->id}}" type="radio" name="star_response_{{ $star->id }}" value="2" required><!--
                        --><label for="radio4_{{$star->id}}">★</label><!--
                        --><input id="radio5_{{$star->id}}" type="radio" name="star_response_{{ $star->id }}" value="1" required><!--
                        --><label for="radio5_{{$star->id}}">★</label>
                    </p>
                @endforeach
                @foreach($question_text as $text)
                <div class="row mg-t-10">

                    <div id="div_comment" class="col-lg-12">
                        <label for="comment">{{ $text->name }}:</label><br>
                        <input name="text_ids[]" type="hidden" value="{{ $text->id }}">
                        <textarea class="form-control" id="comment" name="text_response[]" rows="4" style="width:100%" required></textarea>
                    </div>      
                    </div>
                @endforeach
                <br>
                <button id="submit_button" type="submit" class="btn btn-main-primary btn-block">Enviar</button>
                </form>
            </div>
            <div class="card-body text-primary">
            </div>
            <div class="card-footer" >
            </div>
            

        </div>
    </div>

</div>

<!-- row -->
@endsection

@section('js')
<script type="text/javascript">
    $(window).on('load', function() {
        //$("#submit_button").hide();
    });
</script>
@endsection
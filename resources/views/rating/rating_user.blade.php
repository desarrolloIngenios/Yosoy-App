@extends('app')
@section('css')
<style>
#form {
  width: 250px;
  margin: 0 auto;
  height: 100px;
}

form p {
  text-align: center;
}

form p label {
  font-size: 40px;
}

input[type="radio"] {
  display: none;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
}

.clasificacion label:hover,
.clasificacion label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}
</style>

@endsection

@section('content')
<!-- row -->
<div class="row row-sm">

    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header pb-0">
                <h5 class="card-title ">Calificación </h5>
                <h5 class="card-title ">
                    <span>{{ $offer->cargo->nombre }} - {{ $offer->sector->nombre }}</span>
                    <br>
                    <br>
                    <span>{{ $user->profile->full_name }}</span>

                @if(count($items)>0)

                        <form action="{{ route('star_rating.store') }}" method="post">
                        @csrf
                        <input name="user_id" type="hidden" value="{{ $user_id }}">
                        <input name="offer_id" type="hidden" value="{{ $offer_id }}">
                        <p class="clasificacion">
                            <input id="radio1" type="radio" name="rating" value="5"><!--
                            --><label for="radio1">★</label><!--
                            --><input id="radio2" type="radio" name="rating" value="4"><!--
                            --><label for="radio2">★</label><!--
                            --><input id="radio3" type="radio" name="rating" value="3"><!--
                            --><label for="radio3">★</label><!--
                            --><input id="radio4" type="radio" name="rating" value="2"><!--
                            --><label for="radio4">★</label><!--
                            --><input id="radio5" type="radio" name="rating" value="1"><!--
                            --><label for="radio5">★</label>
                        </p>

                        <div id="alert" style="display:none" class="alert alert-success alert-dismissible fade show" role="alert">
                            <span id="alert_text" class="alert-inner--text"><strong></strong>Código Válido</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        
                        <div id="div_items_checkbox" style="display:none" class="col-lg-12">
                            @foreach($items as $item)
                                <label class="ckbox">
                                    <input name="input_items_checkbox[]" value="{{ $item['id'] }}" type="checkbox"><span>{{ $item['name'] }}</span>
                                </label>
                                <br>
                            @endforeach
                        </div>
                        <div id="div_comment" class="col-lg-12">
                            <label for="comment">Comentario:</label><br>
                            <textarea id="comment" name="comment" rows="8" style="width:100%"></textarea>
                        </div>      
                        
                                
                        
                        </h5>
                        <br>
                        <button id="submit_button" type="submit" class="btn btn-main-primary btn-block">Enviar</button>
                    @else
                        El usuario ya fue calificado
                    @endif
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
        $("#submit_button").hide();
        $("#div_comment").hide();
        var rating = 0;
        var alert_text = '';
        $('input[name="rating"]').change( function() {
            if(this.value == '1'){
                rating = 1;
                alert_text = "Selecciona 4 opciones.";
                show_items_checkbox();
            } else if(this.value == '2'){
                rating = 2;
                alert_text = "Selecciona 3 opciones.";
                show_items_checkbox();
            } else if(this.value == '3'){
                rating = 3;
                alert_text = "Selecciona 2 opciones.";
                show_items_checkbox();
            } else if(this.value == '4'){
                rating = 4;
                alert_text = "Selecciona 1 opción.";
                show_items_checkbox();
            } else if(this.value == '5'){
                rating = 5;
                show_items_checkbox();
            } else {
                alert(0);
            }
        });
        function show_items_checkbox() {
            $("#alert").hide();
            $('#alert_text').text("");
            if(rating == 5){
                //$("#items_checkbox").show('slow');
                $("#submit_button").show('slow');
                $('input[type="checkbox"]').prop('checked', false);
                $('#div_items_checkbox').hide('slow');
                $("#alert").hide('slow');
                $('#alert_text').text("");
            } else {
                $("#submit_button").hide('slow');
                $("#div_items_checkbox").show('slow');
                $('input[type="checkbox"]').prop('checked', false);
                $('input[type="checkbox"]').prop('disabled', false);
                $("#alert").show('slow');
                $('#alert_text').text(alert_text);
            }
            if(rating >0 && rating <= 3){
                $("#div_comment").show('fast');
            } else {
                $("#div_comment").hide();
            }
        }
        $('input[type="checkbox"]').change( function() {
            if($('input[type="checkbox"]:checked').length + rating == 5){
                $("#submit_button").show('slow');
                $('input[type="checkbox"]').prop('disabled', true);
                $('input[type="checkbox"]:checked').prop('disabled', false)
            } else {
                $("#submit_button").hide();
            }

            //alert($('input[type="checkbox"]:checked').length);
        });
        
    });
</script>
@endsection

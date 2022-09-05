@extends('app')
@section('content')
<!-- row -->
<div class="row row-sm">

    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header pb-0">
                <h5 class="card-title ">Calificación  </h5>
                <h5 class="card-title ">
                <form action="{{ route('star_rating.store') }}" method="post">
                    @csrf
                    <input name="user_id" type="hidden" value="{{ $user_id }}">
                    <input name="offer_id" type="hidden" value="{{ $offer_id }}">
                    @foreach($items as $item)
                        <div   class="form-group col-lg-4 mg-b-4 mg-lg-b-4">
                            <label for="numero_contacto_1">{{ $item['name'] }}</label>
                            <input type="hidden" class="form-control" name="ids[]" value="{{ $item['id'] }}" required>
                            <input class="form-control" min="1" max="5" value="5" placeholder="Calificación" name="rating[]" type="number" required>
                        </div>
                        <br>
                    @endforeach
                </h5>
                <br>
                    <button type="submit" class="btn btn-main-primary btn-block">Guardar</button>
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
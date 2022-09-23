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
                


            <div class="table-responsive border-top userlist-table">
    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-lg-8p"><span>Usuario</span></th>
                <th class="wd-lg-8p"><span>Oferta</span></th>
                <th class="wd-lg-20p"><span>Calificación</span></th>
                <th class="wd-lg-20p"><span>Items</span></th>
                <th class="wd-lg-20p"><span>Comment</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($star_rating as $rating)
                @if(is_null($rating) || is_null($rating['user']) || is_null($rating['user']['name']))
                    @continue
                @endif
            <tr>
                <td data-title="">
                    @if(isset($rating['user']['profile']['foto_perfil_url']))
                        <img alt="avatar" class="rounded-circle avatar-md mr-2" src="{{ \Storage::disk('s3')->temporaryUrl($rating['user']['profile']['foto_perfil_url'], '+10 minutes') }}">
                    @else
                        <img alt="avatar" class="rounded-circle avatar-md mr-2" src="{{URL::asset('/assets/img/faces/1.jpg')}}">
                    @endif
                    @if(trim($rating['user']['profile']['full_name']) == "")
                        {{ "-" }} 
                    @else
                        {{ $rating['user']['profile']['full_name'] }} 
                    @endif
                </td>
                <td data-title="Número">
                    @if(!is_null($rating['offer']))
                        {{ $rating['offer']['id'] }}-{{ $rating['offer']['cargo']['nombre'] }}
                    @endif
                </td>
                <td data-title="Número">
                    {{ $rating['rating'] }} 
                </td>
                <td data-title="">
                    @foreach($rating['star_rating_items_selected'] as $item)
                        {{ $item['name'] }} <br>
                    @endforeach
                </td>
                <td data-title="Número">
                    {{ $rating['comment'] }} 
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
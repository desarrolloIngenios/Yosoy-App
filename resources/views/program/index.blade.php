@extends('app')
@section('content')
    <!-- row -->

    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0 ">
                <div class="card-header">
                    <h4 class="card-title mb-1">PROGRAMAS</h4>
                    <p class="mb-2"></p>
                </div>
                <div class="card-body pt-0">
                    <section id="no-more-tables">
                        <div class="table-responsive border-top userlist-table">
                            <table id="{{ $table_id ?? '' }}" class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-lg-20p"><span>Titulo</span></th>
                                        <th class="wd-lg-20p"><span>Descripción</span></th>
                                        <th class="wd-lg-20p"><span>Inscritos</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programas as $program)
                                        <tr class="user_row">
                                            <td data-title="" class="wd-lg-20p">
                                                {{ $program['title'] }}
                    
                                            </td>
                                            <td data-title="" class="wd-lg-60p" title="{{ $program['show_description'] }}">
                                                {{ Str::limit($program['show_description'], 80) }} 
                                            </td>    
                                            <td data-title="" class="wd-lg-20p">
                                                {{ $program['num_users'] }}
                                            </td>                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
@endsection

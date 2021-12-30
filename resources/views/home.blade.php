@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="row">

                        <div class="col-md-4">
                            {{ __('Dashboard') }}
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm" style="float:right;" id="add_client" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clientNew">Nuevo cliente</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="text-align:center;">CODE</th>
                                <th style="text-align:center;">NAME</th>
                                <th style="text-align:center;">CITY</th>
                                <th style="text-align:center;">ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client as $item)
                            <tr>
                                <td style="text-align:center;">{{$item->code}}</td>
                                <td style="text-align:center;">{{$item->name}}</td>
                                <td style="text-align:center;">{{$item->cities->name}}</td>
                                <td style="text-align:center;"><button class="btn btn-warning btn-sm edit_client" data-bs-toggle="modal" data-bs-target="#clientNew" data-id={{$item->code}}><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg></button>
                                    <button class="btn btn-danger btn-sm delete_client" data-id={{$item->code}}><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg></button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }} -->

                </div>
                <div class="container">

                    @if ($client->lastPage() > 1)

                    <ul class="pagination">
                        <li class="{{ ($client->currentPage() == 1) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $client->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $client->lastPage(); $i++)
                            <li class="{{ ($client->currentPage() == $i) ? ' active' : '' }}">
                                <a class="page-link" href="{{ $client->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor
                            <li class="{{ ($client->currentPage() == $client->lastPage()) ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $client->url($client->currentPage()+1) }}">Siguiente</a>
                            </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="clientNew" tabindex="-1" aria-labelledby="new_client" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- <form action="client" method="post">
                    @csrf -->
                <div class="modal-body">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Nombre</label>
                                <input class="form-control" name="name_client" id="name_client" type="text" placeholder="Nombre del cliente">
                                <input type="hidden" id="code_client">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Ciudad</label>
                                <select class="form-control" name="city" id="city">
                                    <option value="">Seleccione..</option>
                                    @foreach ($cities as $city)
                                    <option value={{$city->code}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                    <button type="button" id="save_client" class="btn btn-success btn-block new_client">Guardar cliente</button>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
@endsection
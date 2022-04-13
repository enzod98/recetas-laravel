@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')

    <h2 class="text-center mb-5">Administrar recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Títulos</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $recetas as $receta )
                    <tr>
                        <td>{{ $receta->titulo }}</td>
                        <td>{{ $receta->categoria->nombre }}</td>
                        <td>
                            <eliminar-receta
                            receta-id="{{ $receta->id }}" ></eliminar-receta>
                            <a href="{{route('recetas.edit', ['receta' => $receta->id])}}" class="btn btn-dark mr-1 d-block w-100 mb-1">Editar</a>
                            <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-success mr-1 d-block w-100 mb-1">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

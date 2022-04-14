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
        <div class="col-12 mt-4 d-flex justify-content-center">
            {{ $recetas->links() }}
        </div>
        <h2 class="text-center my-5">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            @if( count( $recetasFavoritas ) > 0 )
                <ul class="list-group">
                    @foreach( $recetasFavoritas as $receta )
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p>{{ $receta->titulo }}</p>
                            <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" class="btn btn-outline-success">Ver</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center">Aún no tienes recetas favoritas</p>
            @endif
        </div>
    </div>

@endsection

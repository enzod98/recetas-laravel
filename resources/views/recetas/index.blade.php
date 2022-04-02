<h1>Recetas</h1>


@foreach($recetas as $key)
    <li> {{ $key }} </li>
@endforeach


<h1>Categorias</h1>

@foreach($categorias as $key)
    <li> {{ $key }} </li>
@endforeach
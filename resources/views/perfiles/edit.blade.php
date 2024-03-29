@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
        integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 icono" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
</svg>
Volver</a>
@endsection

@section('content')
<h1 class="text-center">Editar mi perfil</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-10 bg-white p-3">
        <form
        action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}"
        method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror "placeholder="Su nombre"
                value="{{ $perfil->usuario->name }}">

                @error('nombre')
                    <span class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nombre">Sitio web</label>
                <input type="url" name="paginaweb" id="paginaweb" class="form-control @error('paginaweb') is-invalid @enderror "placeholder="Su sitio Web"                 value="{{ $perfil->usuario->paginaweb }}">

                @error('paginaweb')
                    <span class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="biografia">Biografia</label>
                <input id="biografia" type="hidden" name="biografia" value="{{ $perfil->biografia }}" >
                <trix-editor input="biografia" class=" trix-content @error('biografia') is-invalid @enderror"></trix-editor>

                @error('biografia')
                <span class="invalid-feedback d-block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="imagen">Tu imagen</label>
                <input
                    id="imagen"
                    type="file"
                    class="form-control @error('imagen') is-invalid @enderror"
                    name="imagen">

                @if( $perfil->imagen )
                    <div class="mt-4">
                        <p>Imagen actual:</p>
                        <img src="/storage/{{ $perfil->imagen }}" alt="imagen" style="width: 300px">
                    </div>

                    @error('imagen')
                        <span class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @endif
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
            </div>

        </form>
    </div>
</div>

@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
        integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection

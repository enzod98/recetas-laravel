<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{ $receta->imagen }}" alt="imagen receta" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">
                {{ $receta->titulo }}
            </h3>

            <div class="meta-receta d-flex justify-content-between">
                <p class="text-primary fecha font-weight-bold">
                    <fecha-receta fecha="{{ $receta->created_at }}" />
                </p>
                <p>Les gustó a {{ count($receta->likes) }}</p>
            </div>
            <p class="card-text">
                {{ Str::words(strip_tags( $receta->preparacion ), 20, '...') }}
            </p>
            <a href="{{ route('recetas.show', ['receta' => $receta->id ]) }}" target="_blank"
                class="btn btn-primary d-block font-weight-bold text-uppercase">Ver receta</a>
        </div>
    </div>
</div>

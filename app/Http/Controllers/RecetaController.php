<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);  //Middleware para sólo autenticados, a excepción del método show
    }

    public function index()
    {
        $recetasUsuario = Auth::user()->recetas;

        return view('recetas.index')->with('recetas', $recetasUsuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Básicamente un SELECT nombre, id FROM categoria_receta
        $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
        //De esta forma obtenemos las categorías SIN hacer uso del modelo


        //Con el modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create', compact( [ 'categorias' ] ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( $request[ 'imagen' ]->store( 'uploads-recetas', 'public' ) );

        //Validación
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image'
        ]);


        //Obtener link de la imagen
        $ruta_imagen = $request[ 'imagen' ]->store( 'uploads-recetas', 'public' );

        //Resize de la imagen
        $img = Image::make( public_path("storage/" . $ruta_imagen))->fit(1000, 550);
        $img->save();

        //Almacenar en DB sin usar un modelo
        // DB::table( 'recetas' )->insert([
        //     'titulo' => $data['titulo'],
        //     'categoria_id' => $data['categoria'],
        //     'preparacion' => $data['preparacion'],
        //     'ingredientes' => $data['ingredientes'],
        //     'imagen' => $ruta_imagen,
        //     'user_id' => Auth::user()->id
        // ]);

        //Almacenar en BD con un modelo
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'categoria_id' => $data['categoria'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen
        ]);

        //redireccionamiento
        return redirect() -> action('RecetaController@index');  //Nombre del constroller
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */

    //public function show($receta) //Esto recibimos en versiones anteriores de Laravel
    public function show(Receta $receta)
    {
        //En el objeto Receta que recibimos como parámetro de la función
        //ya recibimos toda la info del id seleccionado
        //sin embargo en versiones anteriores de laravel esto no era así

        //Algunos métodos para obtener información de la receta en versiones antiguas de Laravel:
        //$receta = Receta::find($receta);
        //$receta = Receta::findOrFail($receta);



        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view( 'recetas.edit', compact( 'categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        //Revisar el policy
        $this->authorize('update', $receta);

        //Validación
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required'
        ]);

        //Si el usuario cambia su imagen
        if( request('imagen') ){
            $ruta_imagen = $request[ 'imagen' ]->store( 'uploads-recetas', 'public' );

            //Resize de la imagen
            $img = Image::make( public_path("storage/" . $ruta_imagen))->fit(1000, 550);
            $img->save();

            $receta->imagen = $ruta_imagen;
        }

        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];

        $receta->save();

        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        $this->authorize('delete', $receta);

        //Eliminar
        $receta->delete();

        return redirect()->action('RecetaController@Index');
    }
}

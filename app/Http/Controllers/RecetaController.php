<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $recetas = ['Receta pizza', 'Receta Hamburguesa', 'Receta tacos'];
        $categorias = [ 'Comida mexicana', 'Comida Paraguaya', 'Postres' ];
        // return view('recetas.index') -> with( 'recetas', $recetas ) -> with( 'categorias', $categorias ) ;     //Forma de pasar datos a la vista
        
        
        return view('recetas.index', compact( 'recetas', 'categorias' ));   //De esta forma no especificamos la llave/valor sino que ambos llevan el mismo nombre que sería el de la variable
    }
}

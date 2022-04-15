<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        //Mostrar las recetas por cantidad de votos
        // $votadas = Receta::has('likes', '>', 0)->get(); //Consulta con operador
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        //Obtener las recetas más nuevas
        // $nuevas = Receta::orderBy('created_at', 'desc')->get();
        $nuevas = Receta::latest()->take(5)->get();  //Lo mismo de arriba

        //Recetas por categoria
        //Obtener todas las categorias
        $categorias = CategoriaReceta::all();

        //Agrupar recetas por categoria
        $recetas = [];

        foreach($categorias as $categoria){
            $recetas[ Str::slug( $categoria->nombre ) ][] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }


        return view('inicio.index', compact('nuevas', 'recetas' , 'votadas'));
    }
}

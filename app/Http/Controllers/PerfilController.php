<?php

namespace App\Http\Controllers;

use App\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        return view('perfiles.show', compact('perfil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //Validar
        $data = request()->validate([
            'nombre' => 'required',
            'paginaweb' => 'required',
            'biografia' => 'required'
        ]);

        //Si el usuario sube una imagen
        if( $request['imagen'] ){
            $ruta_imagen = $request[ 'imagen' ]->store( 'uploads-perfiles', 'public' );

            //Resize de la imagen
            $img = Image::make( public_path("storage/" . $ruta_imagen))->fit(600, 600);
            $img->save();

            //Crear arreglo de imagen
            $array_imagen = ['imagen' => $ruta_imagen];

        }

        //Asignar nombre y URL
        auth()->user()->name = $data['nombre'];
        auth()->user()->paginaweb = $data['paginaweb'];
        auth()->user()->save();

        //Eliminar URL y nombre de $data
        unset($data['nombre']);
        unset($data['paginaweb']);

        //Asginar bio e Imagen
        auth()->user()->perfil()->update( array_merge(
            $array_imagen ?? [],
            $data
        ));
        //Guardar Info

        //Redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}

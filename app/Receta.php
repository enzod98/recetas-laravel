<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //  los campos que se pueden agregar
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen', 'categoria_id'
    ];

    //  Obtener la categoría de la receta pór su FK
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    //Obtener la info del usuario
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');  //Especificar el nombre del FK en la tabla Receta
    }
}

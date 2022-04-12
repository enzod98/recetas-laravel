<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //RELACIÓN DE UNO A UNO CON USER
    public function usuario(){
        return $this->belongsTo(User::class);
    }

}

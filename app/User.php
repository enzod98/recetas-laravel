<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*  CON EL FILLABLE LARAVEL PROTEGE LOS CAMPOS QUE SE PUEDEN REGISTRAR  */
    protected $fillable = [
        'name', 'email', 'password', 'paginaweb'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // EVENTO QUE SE EJECUTA AL CREAR EL USUARIO
    protected static function boot(){
        parent::boot();

        //Asignar perfil una vez creado el usuario nuevo
        static::created(function ($user){
            $user->perfil()->create();
        });
    }

    //  RELACIÓN DE UNO A MUCHOS ENTRE USUARIO Y RECETAS
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    //RELACIÓN DE UNO A UNO CON PERFILS
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Si usas hashing para la contraseña, asegúrate de definir el atributo "hidden"
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Otras configuraciones necesarias, como casts, pueden ir aquí
}

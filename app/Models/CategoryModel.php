<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name', // Campo para el nombre de la categoría
        'description', // Campo para la descripción
    ];
}

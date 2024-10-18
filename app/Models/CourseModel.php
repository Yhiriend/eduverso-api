<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    use HasFactory;

    protected $table = 'course';

    protected $fillable = ['title', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}

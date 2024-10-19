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

    public function categories()
    {
        return $this->belongsToMany(CategoryModel::class, 'category_course', 'course_id', 'category_id');
    }
}

<?php

namespace App\Repositories;

use App\Models\CourseModel;

class CourseRepository
{
    public function all()
    {
        return CourseModel::all();
    }

    public function find($id)
    {
        return CourseModel::find($id);
    }

    public function create(array $data)
    {
        return CourseModel::create($data);
    }

    public function update($id, array $data)
    {
        $curso = $this->find($id);
        if ($curso) {
            $curso->update($data);
            return $curso;
        }
        return null;
    }

    public function delete($id)
    {
        $curso = $this->find($id);
        if ($curso) {
            $curso->delete();
            return true;
        }
        return false;
    }
}

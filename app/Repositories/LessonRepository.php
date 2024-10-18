<?php

namespace App\Repositories;

use App\Models\LessonModel;

class LessonRepository
{
    public function all()
    {
        return LessonModel::with('course')->get();
    }

    public function find($id)
    {
        return LessonModel::with('course')->find($id);
    }

    public function create(array $data)
    {
        return LessonModel::create($data);
    }

    public function update($id, array $data)
    {
        $lesson = $this->find($id);
        if ($lesson) {
            $lesson->update($data);
            return $lesson;
        }
        return null;
    }

    public function delete($id)
    {
        $lesson = $this->find($id);
        if ($lesson) {
            $lesson->delete();
            return true;
        }
        return false;
    }
}

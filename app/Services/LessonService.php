<?php

namespace App\Services;

use App\Repositories\LessonRepository;

class LessonService
{
    protected $lessonRepository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function getAllLessons()
    {
        return $this->lessonRepository->all();
    }

    public function getLesson($id)
    {
        return $this->lessonRepository->find($id);
    }

    public function createLesson(array $data)
    {
        return $this->lessonRepository->create($data);
    }

    public function updateLesson($id, array $data)
    {
        return $this->lessonRepository->update($id, $data);
    }

    public function deleteLesson($id)
    {
        return $this->lessonRepository->delete($id);
    }
}

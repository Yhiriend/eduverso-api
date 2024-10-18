<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $curseRepository;

    public function __construct(CourseRepository $curseRepository)
    {
        $this->curseRepository = $curseRepository;
    }

    public function getAllCourses()
    {
        return $this->curseRepository->all();
    }

    public function getCourse($id)
    {
        return $this->curseRepository->find($id);
    }

    public function createCourse(array $data)
    {
        return $this->curseRepository->create($data);
    }

    public function updateCourse($id, array $data)
    {
        return $this->curseRepository->update($id, $data);
    }

    public function deleteCourse($id)
    {
        return $this->curseRepository->delete($id);
    }
}

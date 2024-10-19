<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getAllCourses()
    {
        return $this->courseRepository->getAll();
    }

    public function createCourse(array $data)
    {
        return $this->courseRepository->create($data);
    }

    public function getCourse($id)
    {
        return $this->courseRepository->find($id);
    }

    public function updateCourse($id, array $data)
    {
        return $this->courseRepository->update($id, $data);
    }

    public function deleteCourse($id)
    {
        return $this->courseRepository->delete($id);
    }

    public function getCoursesByCategories(array $categories)
    {
        return $this->courseRepository->getByCategories($categories);
    }
}

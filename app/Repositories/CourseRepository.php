<?php

namespace App\Repositories;

use App\Models\CourseModel;
use Exception;
use Illuminate\Support\Facades\Log;

class CourseRepository
{
    public function getAll()
    {
        try {
            return CourseModel::with('categories')->get();
        } catch (Exception $e) {
            throw new Exception("Error fetching courses: " . $e->getMessage());
        }
    }

    public function create(array $data)
    {
        try {
            $curso = CourseModel::create($data);
            $curso->categories()->attach($data['categories']);
            return $curso->load('categories');
        } catch (Exception $e) {
            throw new Exception("Error creating course: " . $e->getMessage());
        }
    }

    public function find($id)
    {
        try {
            return CourseModel::with('categories')->find($id);
        } catch (Exception $e) {
            throw new Exception("Error finding course: " . $e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        try {
            $curso = CourseModel::find($id);
            if ($curso) {
                $curso->update($data);
                if (isset($data['categories'])) {
                    $curso->categories()->sync($data['categories']);
                }
                return $curso->load('categories');
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Error updating course: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $curso = CourseModel::find($id);
            if ($curso) {
                $curso->categories()->detach();
                return $curso->delete();
            }
            return false;
        } catch (Exception $e) {
            throw new Exception("Error deleting course: " . $e->getMessage());
        }
    }

    public function getByCategories(array $categories)
    {
        try {
            Log::info("CATEGORIES");
            Log::info(json_encode($categories, JSON_PRETTY_PRINT));
            return CourseModel::with('categories')
                ->whereHas('categories', function ($query) use ($categories) {
                    $query->whereIn('categories.id', $categories);
                })
                ->get();
        } catch (Exception $e) {
            throw new Exception("Error fetching courses by categories: " . $e->getMessage());
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\CategoryModel;

class CategoryRepository
{
    public function all()
    {
        return CategoryModel::all();
    }

    public function create(array $data)
    {
        return CategoryModel::create($data);
    }

    public function find($id)
    {
        return CategoryModel::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = $this->find($id);
        return $category->delete();
    }
}

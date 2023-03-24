<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    public function byCompany(int $companyId, int $perPage = 0)
    {
        $categories = Category::where('company_id', $companyId);
        return $perPage > 0 ? $categories->paginate($perPage) : $categories->get();
    }

    public function search(string $search,int $companyId, int $perPage = 0)
    {
        $categories = Category::where('name', 'ilike', "%$search%")->where('company_id', $companyId);
        return $perPage > 0 ? $categories->paginate($perPage)->appends(['search' => $search]) : $categories->get();
    }

    public function store(array $data)
    {
        return Category::create($data);
    }

    public function byId(int $id)
    {
        return Category::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $category =$this->byId($id);
        $category->update($data);

        return $category;
    }

    public function destroy(int $id)
    {
        $category = $this->byId($id);
        $category->delete();

        return true;
    }
}
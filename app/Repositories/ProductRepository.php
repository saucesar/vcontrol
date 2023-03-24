<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function byCategory(int $categoryId, int $perPage = 0)
    {
        $products = Product::where('category_id', $categoryId);
        return $perPage > 0 ? $products->paginate($perPage) : $products->get();
    }

    public function byCompany(int $companyId, int $perPage = 0)
    {
        $products = Product::where('company_id', $companyId);
        return $perPage > 0 ? $products->paginate($perPage) : $products->get();
    }

    public function byId(int $id)
    {
        return Product::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $product = $this->byId($id);
        $product->update($data);

        return $product;
    }

    public function destroy(int $id)
    {
        $product = $this->byId($id);
        $product->delete();

        return true;
    }

    public function search(string $search, int $companyId, int $perPage = 0)
    {
        $products = Product::orWhere('description', 'ilike', "%$search%")
                           ->where('company_id', $companyId)
                           ->orWhere('ean', 'ilike', "%$search%")
                           ->where('company_id', $companyId);
        return $perPage > 0 ? $products->paginate($perPage)->appends(['search' => $search]) : $products->get();
    }
}
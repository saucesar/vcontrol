<?php

namespace App\Repositories;

use App\Models\Product;
use Carbon\Carbon;

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

    public function getProductsByDate(Carbon $date, ?int $companyId = null)
    {
        $today = Carbon::now();
        $query = Product::join('dates', 'dates.product_id', '=', 'products.id')
                      ->where('dates.date', '>=', $today)
                      ->where('dates.date', '<=', $date)
                      ->select('products.*', 'dates.date as date', 'dates.amount as amount')
                      #->distinct('products.id')
                      ->groupBy('products.id', 'date', 'amount')
                      ->orderBy('date');
        if($companyId) {
            $query = $query->where('products.company_id', $companyId);
        }

        return $query->get();
    }
}
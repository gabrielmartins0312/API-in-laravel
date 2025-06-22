<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;

class ProductRepository
{
    public function all(): array
    {
        return Product::all()->toArray();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): void
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}

<?php

namespace App\Repositories\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function create(array $data): Product;
    public function all(): iterable;
    public function update(int $id, array $data): Product;
    public function delete(int $id): void;

}

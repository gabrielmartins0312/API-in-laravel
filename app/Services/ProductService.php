<?php

namespace App\Services;

use App\Repositories\Eloquent\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function list(): array
    {
        return $this->productRepository->all();
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $this->productRepository->delete($id);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        $products = $this->productService->list();
        return response()->json($products);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->validated());

        return response()->json([
            'message' => 'Produto cadastrado com sucesso',
            'product' => $product
        ], 201);
    }

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $product = $this->productService->update($id, $request->validated());

        return response()->json([
            'message' => 'Produto atualizado com sucesso',
            'product' => $product
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->productService->delete($id);

            return response()->json(['message' => 'Produto excluído com sucesso']);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao excluir produto',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

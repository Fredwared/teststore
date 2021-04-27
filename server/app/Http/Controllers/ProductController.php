<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Вывод товаров
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = $this->productService->fetchWithPaginate();
        return ProductResource::collection($products);
    }

    /**
     * Новый товар
     *
     * @param ProductStoreRequest $productStoreRequest
     * @return ProductResource
     */
    public function store(ProductStoreRequest $productStoreRequest): ProductResource
    {
        $product = $this->productService->create($productStoreRequest->validated());

        return new ProductResource($product);
    }

    /**
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $productUpdateRequest
     * @param Product $product
     * @return ProductResource
     */
    public function update(ProductUpdateRequest $productUpdateRequest, Product $product): ProductResource
    {
        $product = $this->productService->update($productUpdateRequest->validated(), $product);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(['message' => "Товар {$product->name} был удалён"], Response::HTTP_NO_CONTENT);
    }
}

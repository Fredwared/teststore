<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

/**
 * Class ProductControllerTest
 * @package Tests\Unit
 */
class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Тест на вывод товаров
     */
    public function testForFetchProducts()
    {
        $request = $this->get( route('products.index') );

        $this->assertTrue( $request->isSuccessful() );

        /** @var array $response */
        $response = $request->decodeResponseJson();
        $responseData = $response['data'];
        $this->assertTrue( isset($responseData) );

        /** @var ProductService $productService */
        $productService = app(ProductService::class);

        /** @var LengthAwarePaginator $products */
        $products = $productService->fetchWithPaginate();

        $this->assertTrue( $response['meta']['total'] === $products->total() );
    }

    /**
     * Тест на поиск товара по названию
     */
    public function testForSearchProductByName()
    {
        /** @var Product $product */
        $product = Product::query()->inRandomOrder()->first();

        $request = $this->get( route('products.index') . "?name={$product->name}" );

        $this->assertTrue( $request->isSuccessful() );

        /** @var array $response */
        $response = $request->decodeResponseJson();

        /** @var array $responseData */
        $responseData = $response['data'];
        $this->assertTrue( isset($responseData) );


        $this->assertTrue( $responseData[0]['name'] === $product->name  );
    }


    /**
     * Тест на создание товара
     */
    public function testForStoreProduct()
    {
        $data = factory(Product::class)
            ->make()
            ->toArray();

        $request = $this->post(route('products.store'), $data);

        $this->assertTrue( $request->isSuccessful() );
    }

    /**
     * Тест на Обновление значении товара
     */
    public function testForUpdateProduct()
    {
        /** @var Product $product */
        $product = Product::query()->inRandomOrder()->first();

        $newName = $product->name . microtime();

        $request = $this->put(route('products.update', ['product' => $product->id]), [
            'name' => $newName
        ]);

        $this->assertTrue( $request->isSuccessful() );

        /** @var Product|null $updatedProduct */
        $updatedProduct = Product::query()->find($product->id);

        $this->assertTrue( $updatedProduct->exists() );

        $this->assertTrue( $updatedProduct->name === $newName );
    }

    /**
     * Тест на удаление товара
     */
    public function testForDestroyProduct()
    {
        /** @var Product $product */
        $product = Product::query()->inRandomOrder()->first();

        $request = $this->delete( route('products.destroy', ['product' => $product->id]));

        $this->assertTrue( $request->isSuccessful() );

        $this->assertTrue( $request->getStatusCode() === Response::HTTP_NO_CONTENT );
    }
}

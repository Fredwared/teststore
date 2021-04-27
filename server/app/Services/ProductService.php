<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPaginate(): LengthAwarePaginator
    {
        /** @var Request $request */
        $request = request();

        if($request->has('name')){
            return Product::query()
                ->latest()
                ->where('name', $request->get('name'))
                ->paginate(7);
        }

        return Product::query()->latest()->paginate(7);
    }

    /**
     * @param array $validated
     * @return Builder|Model
     */
    public function create(array $validated)
    {
        return Product::query()->create($validated);
    }

    /**
     * @param array $data
     * @param Product $product
     * @return mixed
     */
    public function update(array $data, Product $product)
    {
        $product->fill($data)->save();
        return $product->fresh();
    }
}

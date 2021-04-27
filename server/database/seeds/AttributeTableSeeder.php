<?php

namespace Database\Seeders;

use App\Constants\ProductAttributesConstants;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('rinvex.attributes.attribute')->create([
            'slug' => ProductAttributesConstants::COLOR,
            'type' => 'varchar',
            'name' => 'Цвет',
            'entities' => [Product::class],
        ]);

        app('rinvex.attributes.attribute')->create([
            'slug' => ProductAttributesConstants::WEIGHT,
            'type' => 'integer',
            'name' => 'Вес',
            'entities' => [Product::class],
        ]);
    }
}

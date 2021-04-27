<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Constants\ProductAttributesConstants;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->realText(),
        'price' => $faker->numberBetween(50,1000)
    ];
});

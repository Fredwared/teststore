<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Rinvex\Attributes\Models\Attribute;
use Rinvex\Attributes\Models\Type\Integer;
use Rinvex\Attributes\Models\Type\Text;
use Rinvex\Attributes\Models\Type\Varchar;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Attribute::typeMap([
            'text' => Text::class,
            'varchar' => Varchar::class,
            'integer' => Integer::class
        ]);
    }
}

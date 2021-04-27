<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rinvex\Attributes\Traits\Attributable;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    use Attributable;

    protected $guarded = ['id'];
}

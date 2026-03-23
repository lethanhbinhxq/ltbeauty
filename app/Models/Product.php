<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;
    const STATUS_IN_STOCK = 'in_stock';
    const STATUS_OUT_OF_STOCK = 'out_of_stock';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'thumbnail',
        'detail',
        'cat_id',
        'status'
    ];

    public function cat() {
        return $this->belongsTo(ProductCat::class, 'cat_id');
    }
}

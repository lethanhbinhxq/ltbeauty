<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    //
    const STATUS_PUBLIC = 'public';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'name',
        'parent_id',
        'status',
    ];

    public function parent() {
        return $this->belongsTo(ProductCat::class, 'parent_id');
    }
}

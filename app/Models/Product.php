<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    const STATUS_PUBLIC = 'public';
    const STATUS_PENDING = 'pending';
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
        return $this->hasOne(PostCat::class, 'id');
    }
}

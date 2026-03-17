<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    const STATUS_PUBLIC = 'public';
    const STATUS_PENDING = 'pending';
    protected $fillable = [
        'title',
        'cat_id',
        'thumbnail',
        'status'
    ];

    public function cat() {
        return $this->hasOne(PostCat::class, 'id');
    }
}

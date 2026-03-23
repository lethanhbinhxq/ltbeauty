<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //
    use SoftDeletes;
    const STATUS_PUBLIC = 'public';
    const STATUS_PENDING = 'pending';
    protected $fillable = [
        'title',
        'cat_id',
        'detail',
        'slug',
        'thumbnail',
        'status'
    ];

    public function cat() {
        return $this->belongsTo(PostCat::class, 'cat_id');
    }
}

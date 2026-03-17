<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCat extends Model
{
    //
    const STATUS_PUBLIC = 'public';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'name',
        'parent_id',
        'status',
    ];
}

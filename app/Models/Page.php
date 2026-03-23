<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    //
    use SoftDeletes;
    const STATUS_PUBLIC = 'public';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'title',
        'detail',
        'status',
    ];
}

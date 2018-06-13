<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostGroup extends Model
{
    protected $table = 'post_group';

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}

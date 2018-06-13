<?php

namespace App\Models;

use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Model;

class MetaField extends \Eloquent
{
    protected $table = 'meta_field';

    public $timestamps = false;

    protected $fillable = ['key_name', 'key_value', 'post_id'];

    public function post() {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
}

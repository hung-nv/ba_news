<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends \Eloquent
{
    protected $table = 'category';

    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'parent_id', 'image', 'icon', 'meta_title', 'meta_description', 'system_link_stype_id'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_category', 'category_id', 'post_id');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_category', 'category_id', 'product_id');
    }

    public function limitProduct() {
        return $this->belongsToMany('App\Models\Product', 'product_category', 'category_id', 'product_id')->limit(8);
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function childrens() {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function system_link_type() {
    	return $this->belongsTo('App\Models\SystemLinkType', 'system_link_type_id');
    }

	public function getNewGameOfCategory() {
    	return $this->posts()->select('name', 'slug', 'introduction', 'image')->limit(6)->get();
	}

	public function scopeOfType($query, $type) {
        return $query->where('system_link_type_id', $type);
    }

    public function scopeActive($query) {
        return $query->where('status', 1);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends \Eloquent
{
    protected $table = 'menu';

    protected $fillable = ['name', 'slug', 'parent_id', 'direct', 'route', 'menu_group_id', 'order', 'type', 'system_link_type_id'];

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    public function childrens() {
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }

    public function scopeGroup($query, $menu_group_id) {
    	return $query->where('menu_group_id', $menu_group_id)->get();
    }
}

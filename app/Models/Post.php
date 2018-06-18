<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends \Eloquent
{
    protected $table = 'posts';

    protected $dates = [
        'created_at',
        'updated_at'
    ];

	protected $appends = ['url'];

    protected $fillable = ['name', 'slug', 'image', 'description', 'content', 'user_id', 'system_link_type_id', 'status',
            'meta_title', 'meta_description', 'meta_keywords', 'introduction', 'view'];

    public function category()
    {
        return $this->belongsToMany('App\Models\Category', 'post_category', 'post_id', 'category_id');
    }

    public function fields() {
        return $this->hasMany('App\Models\MetaField');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group', 'post_group', 'post_id', 'group_id');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Models\Tag', 'post_tag', 'post_id', 'tag_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrderDesc($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('system_link_type_id', $type);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H.i', strtotime($value));
    }

    public function getUrlAttribute($value)
    {
    	return route('news.view', ['slug' => $this->slug]);
    }

    public function scopeInWeek($query)
    {
    	return $query->havingRaw('(UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(created_at)) < ?', [604800]);
    }

	public function relatedPostsByTag()
	{
		return $this->whereHas('tags', function ($query) {
			$tagIds = $this->tags()->pluck('tags.id')->all();
			$query->whereIn('tags.id', $tagIds);
		})->where('id', '<>', $this->id)->limit(5)->get();
	}
}

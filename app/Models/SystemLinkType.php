<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLinkType extends \Eloquent
{
    protected $table = 'system_link_type';

	public function scopeTypeOfCategory($query)
	{
		return $query->where('type', 1);
	}

	public function getPrefixGameDetails() {
		$prefix = $this->where([['name', 'like', '%game details%'], ['type', 2]])->first()->slug;
		if(!isset($prefix)) {
			$prefix = 'game';
		}
		return $prefix;
	}

	public function getPrefixNewsDetails() {
		$prefix = $this->where([['name', 'like', '%news details%'], ['type', 2]])->first()->slug;
		if(!isset($prefix)) {
			$prefix = 'news';
		}
		return $prefix;
	}

	public function getPrefixPageDetails() {
		$prefix = $this->where([['name', 'like', '%page details%'], ['type', 2]])->first()->slug;
		if(!isset($prefix)) {
			$prefix = 'page';
		}
		return $prefix;
	}

	public function getPrefixListGame() {
		$prefix = $this->where([['name', 'like', '%list game%'], ['type', 1]])->first()->slug;
		if(!isset($prefix)) {
			$prefix = 'g';
		}
		return $prefix;
	}

	public function getPrefixListNews() {
		$prefix = $this->where([['name', 'like', '%list news%'], ['type', 1]])->first()->slug;
		if(!isset($prefix)) {
			$prefix = 'category';
		}
		return $prefix;
	}
}

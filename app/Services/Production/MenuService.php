<?php
/**
 * Created by PhpStorm.
 * User: linh
 * Date: 11/8/17
 * Time: 11:59 AM
 */

namespace App\Services\Production;

use App\Models\Category;
use App\Models\Menu;
use App\Models\SystemLinkType;
use App\Services\Interfaces\MenuInterface;

class MenuService implements MenuInterface {
	public function upadteCategoryToMenu( $category_id, $old_slug, $old_type ) {
		$category = Category::findOrFail( $category_id );
		$system_link_type = SystemLinkType::findOrFail($category->system_link_type_id);
		$data     = [
			'slug' => $category->slug,
			'name' => $category->name,
			'type' => $system_link_type->name,
			'system_link_type_id' => $system_link_type->id
		];

		Menu::where( [
			[ 'slug', $old_slug ],
			[ 'system_link_type_id', $old_type ]
		] )->update( $data );
	}

	public function updatePageToMenu( $old_slug, $new_name, $new_slug ) {
		Menu::where( [
			[ 'slug', $old_slug ],
			[ 'type', 'page' ]
		] )->update( [
			'name' => $new_name,
			'slug' => $new_slug
		] );
	}

	public function deleteCategoryFromMenu( $old_slug, $old_type ) {
		Menu::where( [
			[ 'slug', $old_slug ],
			[ 'type', $old_type ]
		] )->delete();
	}
}
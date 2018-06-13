<?php
/**
 * Created by PhpStorm.
 * User: linh
 * Date: 11/8/17
 * Time: 11:21 AM
 */

namespace App\Services\Interfaces;

interface MenuInterface {
	public function upadteCategoryToMenu( $category_id, $old_slug, $old_type );

	public function updatePageToMenu( $old_slug, $new_name, $new_slug );

	public function deleteCategoryFromMenu( $old_slug, $old_type );
}
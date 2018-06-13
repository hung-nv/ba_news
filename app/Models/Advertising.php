<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertising extends Model {
	protected $table = 'advertising';

	protected $fillable = [ 'name', 'code', 'is_mobile', 'location' ];

	public function getLocation() {
		switch ( $this->attributes['location'] ) {
			case '1':
				return 'Sau Menu';
				break;
			case '2':
				return 'Sau mục Download (Trang chi tiết)';
				break;
			case '3':
				return 'Sau Description (Trang chi tiết)';
				break;
			case '4':
				return 'Sau Content (Trang chi tiết)';
				break;
			case '5':
				return 'Sau Bài viết liên quan (Trang chi tiết)';
				break;
			case '6':
				return 'Sau Bài viết nổi bật (Trang chi tiết)';
				break;
			case '7':
				return 'Sau Bài viết mới (Trang chủ)';
				break;
			case '8':
				return 'Sau Bài viết nổi bật (Trang chủ)';
				break;
			case '9':
				return 'Luôn hiển thị dưới cùng';
				break;
			case '10':
				return 'Auto';
				break;
			default:
				return 'Chua biet';
		}
	}

	static public function getAds( $location ) {
    	$ads = Advertising::where('location', $location)->first();
    	if($ads) {
    		return $ads->code;
	    }
	}
}

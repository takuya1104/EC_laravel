<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	public static function is_exist_id ($item_id) {
		return  Item::where('id', $item_id)->exists();
	}

	public static function is_exist_stock ($item_id) {
		return  Item::where('id', $item_id)->where('stock', '>', 0)->exists();
	}
}

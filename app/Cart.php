<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $fillable = ['item_id', 'customer_id', 'item_amount'];

	public static function in_cart($cart_id, $customer_id) {
		return Cart::where('id', $cart_id)->where('customer_id', $customer_id);
	}

	public function item()
	{
		return $this->belongsTo(Item::class, 'item_id', 'id');
	}

}

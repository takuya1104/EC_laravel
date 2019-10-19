<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $fillable = ['id', 'auth_id', 'customer_name', 'postal_code', 'prefecture', 'city', 'phone_number'];

	public function del_blank($string) {
		$del_blank  = preg_replace("/( |　)/", "", $string );
		return $del_blank;
	}
}

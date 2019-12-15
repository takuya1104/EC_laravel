<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	protected $fillable = ['id', 'user_id', 'customer_name', 'postal_code', 'prefecture_id', 'city', 'phone_number'];

	public function del_blank($string) {
		$del_blank  = preg_replace("/( |　)/", "", $string );
		return $del_blank;
	}

	public function prefecture()
	{
		return $this->belongsTo(Prefecture::class, 'prefecture_id', 'id');
	}
}

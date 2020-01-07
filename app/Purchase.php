<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
	use SoftDeletes;
	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	public function settlement()
	{
		return $this->belongsTo(Settlement::class, 'settlement_id', 'id');
	}

	public function address()
	{
		return $this->hasManyThrough(Prefecture::class, Settlement::class, 'prefecture_id', 'id', null, 'prefecture_id');
	}
	public function test()
	{
		return $this->belongsTo(Settlement::class);
	}
}

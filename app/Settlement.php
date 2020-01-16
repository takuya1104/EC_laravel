<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settlement extends Model
{
	use SoftDeletes;
	public function prefecture()
	{
		return $this->belongsTo(Prefecture::class);
	}

	public function purchase()
	{
		return $this->belongsTo(Purchase::class, 'id', 'settlement_id');
	}

	public function item()
	{
		return $this->belongsTo(Item::class);
	}

	//中間テーブルから商品取得
	public function getItems()
	{
		return $this->hasManyThrough(Item::class, Purchase::class, 'settlement_id', 'id', null, 'item_id');
	}

	public function getPurchases()
	{
		return $this->belongsToMany(Item::class)
			->withPivot('id', 'status_id', 'deleted_at', 'item_amount')
			->wherePivot('deleted_at', NULL);
	}

}

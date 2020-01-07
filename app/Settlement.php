<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settlement extends Model
{
	use SoftDeletes;
	//都道府県マスターからリレーションで取得
	public function prefecture()
	{
		return $this->belongsTo(Prefecture::class);
	}

	public function purchase()
	{
		return $this->belongsTo(Purchase::class, 'id', 'settlement_id');
	}

	//中間テーブルから商品取得
	public function getItems()
	{
		return $this->hasManyThrough(Item::class, Purchase::class, 'settlement_id', 'id', null, 'item_id');
	}
}

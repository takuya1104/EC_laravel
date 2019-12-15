<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
	//
	Public function info()
	{
		return $this->belongsTo(User::class);
	}
}

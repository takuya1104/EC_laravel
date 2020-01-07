<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password', 'stripe_id', 'card_brand', 'card_last_four', 'twitter_id', 'token', 'token_secret'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function item()
	{
		return $this->hasMany(Item::class);
	}

	Public function address()
	{
		return $this->hasMany(Address::class);
	}

	Public function add()
	{
		return $this->hasManyThrough(Prefecture::class, Address::class, 'user_id', 'prefecture_id', 'id', 'id');
	}


}

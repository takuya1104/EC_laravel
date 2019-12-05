<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EditUser extends Model
{
	//プライマリーキーをしてしないとデフォルトでid = NULL のSQLが書き上がる
	protected $table = 'edit_users';
	protected $primaryKey = 'user_id';
	public $incrementing = false;
	protected $fillable = ['user_id', 'name', 'new_password', 'using_password', 'email_address', 'token'];
}

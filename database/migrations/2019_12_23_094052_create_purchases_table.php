<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases', function (Blueprint $table) {
			$table->increments('id');
			//ユーザーID
			$table->integer('user_id');
			//商品ID
			$table->integer('item_id');
			//商品ID
			$table->integer('item_amount');
			//一意になる決済ID
			$table->integer('settlement_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('purchases');
	}
}

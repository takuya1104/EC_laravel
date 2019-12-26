<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settlements', function (Blueprint $table) {
			$table->increments('id');
			//決済実行ユーザーのID
			$table->integer('user_id');
			//決済実行ユーザーのID
			$table->integer('address_id');
			//決済時の一意になるID
			$table->string('stripe_id');
			//カード保持者名前
			$table->string('name');
			//登録地点の郵便番号
			$table->string('postal_code');
			//登録地点の都道府県ID
			$table->integer('prefecture_id');
			//登録地点の都市
			$table->integer('city');
			//登録地点の電話番号
			$table->integer('phone_number');
			//商品数量
			$table->integer('quantity');
			//商品金額
			$table->integer('amount');
			//エラーコード
			$table->integer('failure_code')->nullable();
			//エラーメッセージ
			$table->string('failure_message')->nullable();
			//成功時決済完了のフラグを保持
			$table->integer('status_code')->nullable();
			//クーポンがある一定の期間継続される場合終了の日時指定
			$table->timestamp('ends_at')->nullable();
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
		Schema::dropIfExists('settlements');
	}
}

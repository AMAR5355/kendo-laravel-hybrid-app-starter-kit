<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_groups', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->default(0)->unsigned();
			$table->integer('group_id')->default(0)->unsigned();
			$table->boolean('is_group_admin')->default(0);
			$table->timestamps();
		});


		Schema::table('users_groups', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('group_id')->references('id')->on('groups');
			$table->unique('user_id', 'group_id');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_groups');
        $table->dropForeign('user_id_foreign');
        $table->dropForeign('group_id_foreign');
	}
}
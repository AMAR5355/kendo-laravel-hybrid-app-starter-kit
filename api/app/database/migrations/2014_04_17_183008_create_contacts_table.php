<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			if (Config::get('database.default') === 'mysql') {
				$table->engine = "InnoDB";
			}
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('company');
			$table->string('email');
			$table->string('phone');
			$table->text ('message_body');
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
		Schema::drop('contacts');
	}

}

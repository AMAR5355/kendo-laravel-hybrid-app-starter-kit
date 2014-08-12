<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->nullable()->unsigned();
			$table->integer('event_type_id')->nullable()->unsigned();
			$table->string('title');
			$table->text('details');
			$table->boolean('all_day');
			$table->timestamp('start_on');
			$table->timestamp('end_on');
			$table->boolean('public');
			$table->enum('recurring', array('daily', 'weekly', 'bi-weekly', 'monthly', 'quarterly', 'semi-annually', 'annually'));
			$table->boolean('reminder');
			$table->timestamp('remind_on');
			$table->timestamp('recurring_end_on');
			$table->timestamps();
		});

		// Foreign Keys
		Schema::table('events', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('event_type_id')->references('id')->on('event_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}
}
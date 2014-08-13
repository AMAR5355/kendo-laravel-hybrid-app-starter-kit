<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table)
        {
		    $table->increments('id');
		    $table->string('first_name', 20);
		    $table->string('last_name', 20);
		    $table->string('email', 255)->unique();
		    $table->string('username', 255)->unique();
            $table->string('remember_token', 100)->nullable();
		    $table->string('password', 64);
		    $table->boolean('active')->default(true);
		    $table->timestamps();
            //-- Custom Column Name
            $table->date('dob')->default('0000-00-00');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('users', function ($table)
        {
            //-- Custom Column Name
            Schema::drop('users');
        });
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function (Blueprint $table)
        {
		    $table->increments('id');
		    $table->string('name', 255);
			$table->enum('invite_approval', array('admin-only', 'admin-approval', 'anyone'))->default('admin-approval');
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
        $table->drop('groups');
	}

}

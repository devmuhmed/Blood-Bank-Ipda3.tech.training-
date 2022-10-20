<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email');
			$table->bigInteger('phone')->unique();
			$table->string('name');
			$table->date('d_o_b');
			$table->date('last_donation_date');
			$table->integer('pin_code');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->string('password');
			$table->string('api_token', 60)->unique()->nullable();
			$table->boolean('is_active')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}

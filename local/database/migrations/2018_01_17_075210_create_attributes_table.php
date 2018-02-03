<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attributes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('display_name')->default('');
			$table->integer('p_attr_id')->default(0);
			$table->integer('attributetype_id')->default(0);
			$table->text('description', 65535);
			$table->text('attribute_value', 65535);
			$table->integer('size')->default(0);
			$table->string('measure_unit')->default('');
			$table->boolean('required')->default(0)->comment('0- optional, 1- required');
			$table->boolean('searchable')->default(0)->comment('0- no, 1- searchable');
			$table->boolean('status')->default(0);
			$table->integer('show_type')->nullable()->comment('1 = Contact Details and 2 = Key Details');
			$table->boolean('show_list');
			$table->string('icon', 55);
			$table->string('metatitle')->default('');
			$table->text('metadescription', 65535);
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
		Schema::drop('attributes');
	}

}

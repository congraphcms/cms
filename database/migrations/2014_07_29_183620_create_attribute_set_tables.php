<?php
/*
 * This file is part of the congraph/eav package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateAttributeSetTables migration
 * 
 * Creates tables for attributes sets in database needed for this package
 * 
 * @uses   		Illuminate\Database\Schema\Blueprint
 * @uses   		Illuminate\Database\Migrations\Migration
 * 
 * @author  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @copyright  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @package 	congraph/eav
 * @since 		0.1.0-alpha
 * @version  	0.1.0-alpha
 */
class CreateAttributeSetTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// 1.0 Create attribute_sets table
		// ---------------------------------------------------

		Schema::create('attribute_sets', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// Attribute set code for internal use
			$table->string('code', 100)->unique();

			// Entity type ID
			$table->integer('entity_type_id');
			
			// Attribute set name for internal use
			$table->string('name', 100)->default('');

			// Primary attribute ID
			$table->integer('primary_attribute_id');
			
			// created_at and updated_at timestamps
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

			// create indexes
			$table->index('entity_type_id');
		});


		// 2.0 Create attribute_groups table
		// ---------------------------------------------------

		// Schema::create('attribute_groups', function($table) {

		// 	// primary key, autoincrement
		// 	$table->increments('id');

		// 	// relations

		// 	// Attribute set ID
		// 	$table->integer('attribute_set_id');

		// 	// Group slug for internal use
		// 	$table->string('code', 50)->default('');

		// 	// Group name for use in administration
		// 	$table->string('admin_label', 250)->default('');

		// 	// Order of the group in attribute set
		// 	$table->integer('sort_order')->default(0);
			
		// 	// created_at and updated_at timestamps
		// 	$table->timestamps();
		// });


		// 2.1 Create attribute_group_translations table
		// ---------------------------------------------------

		// Schema::create('attribute_group_translations', function($table) {

		// 	// primary key, autoincrement
		// 	$table->increments('id');

		// 	// relations

		// 	// Attribute group ID
		// 	$table->integer('attribute_group_id');
		// 	// Language ID
		// 	$table->integer('language_id');

		// 	// translations

		// 	// Name of the group
		// 	$table->string('name', 250)->default('');
			
		// 	// created_at and updated_at timestamps
		// 	$table->timestamps();
		// });


		// 3.0 Create set_attributes table
		// ---------------------------------------------------

		Schema::create('set_attributes', function($table) {

			// primary key, autoincrement
			$table->increments('id');
			
			// Attribute set ID
			$table->integer('attribute_set_id');

			// Attribute ID
			$table->integer('attribute_id');

			// Order of the attribute in group
			$table->integer('sort_order')->default(0);

			// create indexes
			$table->index('attribute_set_id');
			$table->index('attribute_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		// 1.0 Drop table set_attributes

		Schema::drop('set_attributes');

		// 2.0 Drop table attribute_group_translations

		// Schema::drop('attribute_group_translations');

		// 2.1 Drop table attribute_groups

		// Schema::drop('attribute_groups');

		// 3.0 Drop table attribute_sets

		Schema::drop('attribute_sets');


	}

}

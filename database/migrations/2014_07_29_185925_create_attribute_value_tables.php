<?php
/*
 * This file is part of the cookbook/eav package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateAttributeValueTables migration
 * 
 * Creates tables for attributes values in database needed for this package
 * 
 * @uses   		Illuminate\Database\Schema\Blueprint
 * @uses   		Illuminate\Database\Migrations\Migration
 * 
 * @author  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @copyright  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @package 	cookbook/eav
 * @since 		0.1.0-alpha
 * @version  	0.1.0-alpha
 */
class CreateAttributeValueTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// 1.0 Create attribute_values_datetime table
		// ---------------------------------------------------

		Schema::create('attribute_values_datetime', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// relations
			
			// Attribute ID
			$table->integer('attribute_id');
			// Entity ID
			$table->integer('entity_id');
			// Entity type ID
			$table->integer('entity_type_id');
			// Attribute Set ID
			$table->integer('attribute_set_id');
			// Language ID
			$table->integer('locale_id');

			// Sort order
			$table->integer('sort_order')->nullable()->default(0);

			// Attribute value
			$table->dateTime('value')->nullable();

			// create indexes
			$table->index('entity_type_id');
			$table->index('attribute_set_id');
			$table->index('attribute_id');
			$table->index('entity_id');
			$table->index('locale_id');
		});


		// 1.1 Create attribute_values_integer table
		// ---------------------------------------------------

		Schema::create('attribute_values_integer', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// relations
			
			// Attribute ID
			$table->integer('attribute_id');
			// Entity ID
			$table->integer('entity_id');
			// Entity type ID
			$table->integer('entity_type_id');
			// Attribute Set ID
			$table->integer('attribute_set_id');
			// Language ID
			$table->integer('locale_id');

			// Sort order
			$table->integer('sort_order')->nullable()->default(0);

			// Attribute value
			$table->integer('value')->nullable();

			// create indexes
			$table->index('entity_type_id');
			$table->index('attribute_set_id');
			$table->index('attribute_id');
			$table->index('entity_id');
			$table->index('locale_id');
		});


		// 1.2 Create attribute_values_decimal table
		// ---------------------------------------------------

		Schema::create('attribute_values_decimal', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// relations
			
			// Attribute ID
			$table->integer('attribute_id');
			// Entity ID
			$table->integer('entity_id');
			// Entity type ID
			$table->integer('entity_type_id');
			// Attribute Set ID
			$table->integer('attribute_set_id');
			// Language ID
			$table->integer('locale_id');

			// Sort order
			$table->integer('sort_order')->nullable()->default(0);

			// Attribute value
			$table->decimal('value')->nullable();

			// create indexes
			$table->index('entity_type_id');
			$table->index('attribute_set_id');
			$table->index('attribute_id');
			$table->index('entity_id');
			$table->index('locale_id');
		});


		// 1.3 Create attribute_values_text table
		// ---------------------------------------------------

		Schema::create('attribute_values_text', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// relations
			
			// Attribute ID
			$table->integer('attribute_id');
			// Entity ID
			$table->integer('entity_id');
			// Entity type ID
			$table->integer('entity_type_id');
			// Attribute Set ID
			$table->integer('attribute_set_id');
			// Language ID
			$table->integer('locale_id');

			// Sort order
			$table->integer('sort_order')->nullable()->default(0);

			// Attribute value
			$table->text('value')->nullable();

			// create indexes
			$table->index('entity_type_id');
			$table->index('attribute_set_id');
			$table->index('attribute_id');
			$table->index('entity_id');
			$table->index('locale_id');
		});

		// 1.4 Create attribute_values_fulltext table
		// ---------------------------------------------------

		Schema::create('attribute_values_fulltext', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// relations
			
			// Attribute ID
			$table->integer('attribute_id');
			// Entity ID
			$table->integer('entity_id');
			// Entity type ID
			$table->integer('entity_type_id');
			// Attribute Set ID
			$table->integer('attribute_set_id');
			// Language ID
			$table->integer('locale_id');

			// Sort order
			$table->integer('sort_order')->nullable()->default(0);

			// Attribute value
			$table->text('value')->nullable();

			// create indexes
			$table->index('entity_type_id');
			$table->index('attribute_set_id');
			$table->index('attribute_id');
			$table->index('entity_id');
			$table->index('locale_id');
		});

		DB::statement('ALTER TABLE attribute_values_fulltext ADD FULLTEXT(value)');


		// // 1.4 Create attribute_values_varchar table
		// // ---------------------------------------------------

		// Schema::create('attribute_values_varchar', function($table) {

		// 	// primary key, autoincrement
		// 	$table->increments('id');

		// 	// relations
			
		// 	// Attribute ID
		// 	$table->integer('attribute_id');
		// 	// Entity ID
		// 	$table->integer('entity_id');
		// 	// Entity type ID
		// 	$table->integer('entity_type_id');
		// 	// Attribute Set ID
		// 	$table->integer('attribute_set_id');
		// 	// Language ID
		// 	$table->integer('locale_id');

		// 	// Sort order
		// 	$table->integer('sort_order')->nullable()->default(0);

		// 	// Attribute value
		// 	$table->string('value')->nullable();
		// });

		// // 1.5 Create attribute_values_relations table
		// // ---------------------------------------------------

		// Schema::create('attribute_values_relations', function($table) {

		// 	// primary key, autoincrement
		// 	$table->increments('id');

		// 	// relations
			
		// 	// Attribute ID
		// 	$table->integer('attribute_id');
		// 	// Entity ID
		// 	$table->integer('entity_id');
		// 	// Entity type ID
		// 	$table->integer('entity_type_id');
		// 	// Attribute Set ID
		// 	$table->integer('attribute_set_id');
		// 	// Language ID
		// 	$table->integer('locale_id');

		// 	// Sort order
		// 	$table->integer('sort_order')->nullable()->default(0);

		// 	// Attribute value
		// 	$table->integer('value')->nullable();
		// });

		// // 1.6 Create attribute_values_assets table
		// // ---------------------------------------------------

		// Schema::create('attribute_values_assets', function($table) {

		// 	// primary key, autoincrement
		// 	$table->increments('id');

		// 	// relations
			
		// 	// Attribute ID
		// 	$table->integer('attribute_id');
		// 	// Entity ID
		// 	$table->integer('entity_id');
		// 	// Entity type ID
		// 	$table->integer('entity_type_id');
		// 	// Attribute Set ID
		// 	$table->integer('attribute_set_id');
		// 	// Language ID
		// 	$table->integer('locale_id');

		// 	// Sort order
		// 	$table->integer('sort_order')->nullable()->default(0);

		// 	// Attribute value
		// 	$table->integer('value')->nullable();
		// });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// 1.0 Drop table attribute_values_assets

		Schema::drop('attribute_values_assets');
		
		// 1.1 Drop table attribute_values_relations

		Schema::drop('attribute_values_relations');

		// 1.2 Drop table attribute_values_varchar

		Schema::drop('attribute_values_varchar');

		// 1.3 Drop table attribute_values_text

		Schema::drop('attribute_values_text');

		// 1.4 Drop table attribute_values_decimal

		Schema::drop('attribute_values_decimal');

		// 1.5 Drop table attribute_values_integer

		Schema::drop('attribute_values_integer');

		// 1.6 Drop table attribute_values_datetime

		Schema::drop('attribute_values_datetime');
	}

}

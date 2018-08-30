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
 * CreateAttributeTables migration
 * 
 * Creates tables for attributes in database needed for this package
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
class CreateAttributeTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// 1.0 Create attributes table
		// ---------------------------------------------------

		Schema::create('attributes', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// unique attribute code for internal use
			$table->string('code', 100)->unique();

			// label for use on administration
			$table->string('admin_label', 100)->default('');

			// instructions for administration
			$table->string('admin_notice', 1000)->default('');

			// type of the attribute (text input, wysiwyg editor, number...)
			$table->string('field_type', 100);

			$table->string('table', 100);

			// flag for language dependency of attribute
			$table->boolean('localized')->default(0);

			// default value for this attribute
			$table->text('default_value')->nullable()->default(null);

			// flag for unique attributes
			$table->boolean('unique')->default(0);
			// flag for required attributes
			$table->boolean('required')->default(0);

			// flag if entities will be filterable by this attribute
			$table->boolean('filterable')->default(1);

			// flag if entities will be searchable (FullText Search) by this attribute
			$table->boolean('searchable')->default(0);

			// flag if entities will be searchable (FullText Search) by this attribute
			$table->float('search_boost')->default(1);

			// attribute status ('user-defined', 'admin', 'required', 'locked'...)
			$table->string('status', 100)->default('user_defined');

			// extra data required for some attributes (usualy json string)
			$table->text('data')->nullable();
			
			// created_at and updated_at timestamps
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

			
		});


		// // 1.1 Create attribute_translations table
		// // ---------------------------------------------------

		// Schema::create('attribute_translations', function($table) {

		// 	// primary key, autoincrement
		// 	$table->increments('id');

		// 	// relations

		// 	// Attribute ID
		// 	$table->integer('attribute_id');
		// 	// Language ID
		// 	$table->integer('locale');

		// 	// translations

		// 	// Attribute name for frontend use
		// 	$table->string('label', 250)->nullable()->default('');
		// 	// Note used for help when populating values
		// 	$table->string('description')->nullable()->default('');
		// });

		// 2.0 Create attribute_options table
		// ---------------------------------------------------

		Schema::create('attribute_options', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// relations

			// Attribute ID
			$table->integer('attribute_id');
			// Language ID
			$table->integer('locale')->default(0);

			// values

			// Label for option
			$table->string('label', 250)->nullable()->default('');
			// Value for option
			$table->string('value', 250)->nullable()->default('');

			// flag for using this option as default value
			$table->boolean('default')->default(0);

			// order of option in selection
			$table->integer('sort_order')->default(0);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		// 1.0 Drop table attribute_options

		Schema::drop('attribute_options');

		// 2.0 Drop table attribute_translations

		// Schema::drop('attribute_translations');

		// 2.1 Drop table attributes

		Schema::drop('attributes');
	}

}

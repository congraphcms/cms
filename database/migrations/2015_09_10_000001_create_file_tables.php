<?php
/*
 * This file is part of the congraph/filesystem package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateFileTables migration
 * 
 * Creates tables for files in database needed for this package
 * 
 * @uses   		Illuminate\Database\Schema\Blueprint
 * @uses   		Illuminate\Database\Migrations\Migration
 * 
 * @author  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @copyright  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @package 	congraph/filesystem
 * @since 		0.1.0-alpha
 * @version  	0.1.0-alpha
 */
class CreateFileTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// 1.0 Create files table
		// ---------------------------------------------------

		Schema::create('files', function($table) {

			// primary key, autoincrement
			$table->increments('id');

			// unique relative url to file
			$table->string('url', 1000);

			// filename
			$table->string('name', 500);

			// file extension
			$table->string('extension', 50);

			// file mime type
			$table->string('mime_type', 50);

			// file size
			$table->integer('size');

			// file caption
			$table->string('caption', 500)->default('');

			// file description
			$table->text('description')->nullable();
			
			// created_at and updated_at timestamps
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
		});


		
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		// 1.0 Drop table files

		Schema::drop('files');
	}

}

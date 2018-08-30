<?php
/*
 * This file is part of the cookbook/oauth-2 package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateRoleTables migration
 * 
 * Creates tables for roles in database needed for this package
 * 
 * @uses   		Illuminate\Database\Schema\Blueprint
 * @uses   		Illuminate\Database\Migrations\Migration
 * 
 * @author  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @copyright  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @package 	cookbook/oauth-2
 * @since 		0.1.0-alpha
 * @version  	0.1.0-alpha
 */
class CreateRoleTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('roles')) {
			Schema::create('roles', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('description');
				$table->timestamp('created_at')->nullable();
				$table->timestamp('updated_at')->nullable();
			});
		}

		if (!Schema::hasTable('user_roles')) {
			Schema::create('user_roles', function (Blueprint $table) {
				// primary key, autoincrement
				$table->increments('id');
				
				// User ID
				$table->integer('user_id')->unsigned();

				// Role ID
				$table->integer('role_id')->unsigned();

				$table->timestamp('created_at')->nullable();
				$table->timestamp('updated_at')->nullable();

				$table->index('user_id');
	            $table->index('role_id');
			});
		}

		if (!Schema::hasTable('role_scopes')) {
			Schema::create('role_scopes', function (Blueprint $table) {
				// primary key, autoincrement
				$table->increments('id');

				// Role ID
				$table->integer('role_id')->unsigned();

				// Scope ID
				$table->string('scope_id', 40);

				$table->timestamp('created_at')->nullable();
				$table->timestamp('updated_at')->nullable();

				$table->index('role_id');
	            $table->index('scope_id');

			});
		}
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
		Schema::drop('user_roles');
		Schema::drop('role_scopes');
	}

}

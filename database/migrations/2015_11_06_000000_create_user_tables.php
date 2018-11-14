<?php
/*
 * This file is part of the congraph/oauth package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateUserTables migration
 * 
 * Creates tables for users in database needed for this package
 * 
 * @uses   		Illuminate\Database\Schema\Blueprint
 * @uses   		Illuminate\Database\Migrations\Migration
 * 
 * @author  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @copyright  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @package 	congraph/oauth
 * @since 		0.1.0-alpha
 * @version  	0.1.0-alpha
 */
class CreateUserTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('users')) {
			Schema::create('users', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('email')->unique();
				$table->string('password', 60);
				$table->rememberToken();
				$table->timestamp('created_at')->nullable();
				$table->timestamp('updated_at')->nullable();
			});
		}
		if (!Schema::hasTable('password_resets')) {
			Schema::create('password_resets', function (Blueprint $table) {
				$table->string('email')->index();
				$table->string('token')->index();
				$table->timestamp('created_at')->nullable();
				$table->timestamp('updated_at')->nullable();
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
		Schema::drop('users');
		Schema::drop('password_resets');
	}

}

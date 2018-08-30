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
class AlterScopesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasTable('oauth_scopes')) {
			Schema::table('oauth_scopes', function (Blueprint $table) {
				$table->renameColumn('description', 'label');
	        });
	        Schema::table('oauth_scopes', function (Blueprint $table) {
	            $table->string('description')->after('label');
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
		// Schema::drop('roles');
	}

}

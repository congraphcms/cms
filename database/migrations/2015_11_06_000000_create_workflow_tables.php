<?php
/*
 * This file is part of the congraph/workflows package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CreateWorkflowTables migration
 * 
 * Creates tables for workflow in database needed for this package
 * 
 * @uses   		Illuminate\Database\Schema\Blueprint
 * @uses   		Illuminate\Database\Migrations\Migration
 * 
 * @author  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @copyright  	Nikola Plavšić <nikolaplavsic@gmail.com>
 * @package 	congraph/workflows
 * @since 		0.1.0-alpha
 * @version  	0.1.0-alpha
 */
class CreateWorkflowTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workflows', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description')->default('');
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
		});

		Schema::create('workflow_points', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('workflow_id')->usigned();
			$table->string('status', 50);
			$table->string('endpoint', 50);
			$table->string('action', 250);
			$table->string('name', 250);
			$table->boolean('public')->default(0);
			$table->boolean('deleted')->default(0);
			$table->string('description')->default('');
			$table->integer('sort_order')->default(0);
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

			// create indexes
			$table->index('workflow_id');
			$table->index('status');
		});

		Schema::create('workflow_steps', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('workflow_id')->usigned();
			$table->integer('from_id')->usigned();
			$table->integer('to_id')->usigned();
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

			// create indexes
			$table->index('workflow_id');
			$table->index('from_id');
			$table->index('to_id');
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workflows');
		Schema::drop('workflow_points');
		Schema::drop('workflow_steps');
	}

}

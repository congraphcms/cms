<?php
/*
 * This file is part of the congraph/filesystem package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


return array(
	/**
	 *	path to directory where uploaded files will be stored
	 */
	'uploads_path' => 'files',

	
	'image_versions' => [
		'admin_thumb' => 'Congraph\Filesystem\Handlers\Images\AdminThumbHandler',
		'admin_image' => 'Congraph\Filesystem\Handlers\Images\AdminImageHandler'
	],

	'cache_lifetime' => 1440

);
<?php
/*
 * This file is part of the congraph/api package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */



return [
	
	/*
	 * Option for including meta data in API results
	 */
	'include_metadata' => env('INCLUDE_METADATA', true),

	/*
	 * There are two options for serving included objects
	 * (objects that are not part of result, but are included as part of some relationship)
	 *
	 * You can serve them nested inside the result,
	 * or you can serve them as separate array of objects
	 */
    'nested_include' => env('NESTED_INCLUDE', true),
    
];
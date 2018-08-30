<?php
/*
 * This file is part of the congraph/entity-elastic package.
 *
 * (c) Nikola Plavšić <nikolaplavsic@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


return array(

	'hosts' => [
	    // This is effectively equal to: "https://username:password!#$?*abc@foo.com:9200/"
	    [
	        'host' => env('ES_HOST', 'localhost'),
	        'port' => env('ES_PORT', '9200'),
	        'scheme' => env('ES_SCHEME', 'http'),
	        'user' => env('ES_USER', 'elastic'),
	        'pass' => env('ES_PASSWORD', 'changeme')
	    ]
	],

	'index_prefix' => env('ES_INDEX_PREFIX', 'congraph_'),

    'use_date_relevance' => env('ES_USE_DATE_RELEVANCE', true),

    // how often should the difference be made (in days)
    'date_relevance_interval' => env('ES_DATE_RELEVANCE_INTERVAL', 30),

    // how long in the past should relevance reach (count * interval)
    'date_relevance_interval_count' => env('ES_DATE_RELEVANCE_INTERVAL_COUNT', 6),

    // how much boost should each interval have
    'date_relevance_boost_step' => env('ES_DATE_RELEVANCE_BOOST_STEP', 5),

	'default_index_mappings' => [
		'settings' => [
            // "index.mapping.single_type" => true,
            "analysis" => [
                "analyzer" => [
                    "default" => [
                        "tokenizer" => "standard",
                        "filter" => ["standard", "my_ascii_folding", "lowercase"],
                        "char_filter" => [
                          "small_dj",
                          "big_dj"
                        ]
                    ]
                ],
                "filter" => [
                    "my_ascii_folding" => [
                        "type" => "asciifolding",
                        "preserve_original" => true
                    ]
                ],
                "char_filter" => [
                  "small_dj" => [
                    "type" => "pattern_replace",
                    "pattern" => "(\\S*)(đ)(\\S*)",
                    "replacement" => "$0 $1dj$3"
                  ],
                  "big_dj" => [
                    "type" => "pattern_replace",
                    "pattern" => "(\\S*)(Đ)(\\S*)",
                    "replacement" => "$0 $1Dj$3"
                  ]
                ]
            ]
        ],
        'mappings' => [
            'doc' => [
                'properties' => [
                    'entity_type_id' => [
                        'type' => 'integer'
                    ],
                    'attribute_set_id' => [
                        'type' => 'integer'
                    ],
                    'localized' => [
                        'type' => 'boolean'
                    ],
                    'localized_workflow' => [
                        'type' => 'boolean'
                    ],
                    'status' => [
                        'type' => 'nested',
                        'properties' => [
                            'locale' => [
                                'type' => 'keyword'
                            ],
                            'status' => [
                                'type' => 'keyword'
                            ],
                            'state' => [
                                'type' => 'keyword'
                            ],
                            'created_at' => [
                                "type" => "date",
                                "format" => "yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis"
                            ],
                            'updated_at' => [
                                "type" => "date",
                                "format" => "yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis"
                            ]
                        ]
                    ],
                    'created_at' => [
                        "type" => "date",
                        "format" => "yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis"
                    ],
                    'updated_at' => [
                        "type" => "date",
                        "format" => "yyyy-MM-dd HH:mm:ss||yyyy-MM-dd||epoch_millis"
                    ],
                    'fields' => [
                        'type' => 'object'
                    ],
                ]
            ]
        ]
    ]

);
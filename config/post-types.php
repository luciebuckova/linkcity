<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Post types to be registered with Extended CPTs
    | <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post_types' => [
		'project' => [
			'menu_icon' => 'dashicons-building',
			'menu_position' => 22,
			'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
			'show_in_rest' => true,
			'hierarchical' => false,
			'names' => [
				'singular' => 'Projekt',
				'plural' => 'Projekty',
				'slug' => 'projekty'
			],
			'labels' => [
				'menu_name' => 'Projekty',
				'add_new' => 'Vytvořit projekt',
				'add_new_item' => 'Nový projekt',
				'edit_item' => 'Upravit projekt',
				'new_item' => 'Nový projekt',
				'view_item' => 'Zobrazit projekt',
				'view_items' => 'Zobrazit projekty',
				'search_items' => 'Vyhledat projekty',
				'all_items' => 'Přehled projektů',
				'archives'=> 'Archív projektů',
				'attributes' => 'Parametry projektů',
				'insert_into_item' => 'Vložit k projektu',
				'uploaded_to_this_item' => 'Nahráno k tomuto projektu',
				'filter_items_list' => 'Filtrovat seznam projektů'
			]
		],
	    'news' => [
		    'menu_icon' => 'dashicons-edit',
		    'menu_position' => 23,
		    'supports' => ['title', 'thumbnail'],
		    'show_in_rest' => true,
		    'public' => true,
		    'has_archive' => false,
		    'publicly_queryable' => false,
		    'hierarchical' => false,
		    'names' => [
			    'singular' => 'Aktualita',
			    'plural' => 'Aktuality'
		    ],
		    'labels' => [
			    'menu_name' => 'Aktuality',
			    'add_new' => 'Přidat aktualitu',
			    'add_new_item' => 'Nová aktualita',
			    'edit_item' => 'Upravit aktualitu',
			    'new_item' => 'Nová aktualita',
			    'view_item' => 'Zobrazit aktualitu',
			    'view_items' => 'Zobrazit aktuality',
			    'search_items' => 'Vyhledat aktuality',
			    'all_items' => 'Přehled aktualit',
			    'archives'=> 'Archív aktualit',
			    'attributes' => 'Parametry aktuality',
			    'insert_into_item' => 'Vložit k aktualitě',
			    'uploaded_to_this_item' => 'Nahráno k této aktualitě',
			    'filter_items_list' => 'Filtrovat seznam aktualit'
		    ]
	    ]
	],

    /*
    |--------------------------------------------------------------------------
    | Post Statuses
    |--------------------------------------------------------------------------
    |
    | Post statuses to be registered with Wordpress API
    | <https://developer.wordpress.org/reference/functions/register_post_status/>
    */

    'post_statuses' => [],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Taxonomies to be registered with Extended CPTs library
    | <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomies' => [
	    'group' => [
		    'post_types' => ['project'],
		    'public' => true,
		    'show_in_rest' => true,
		    'rewrite' => false,
		    //'rewrite' => array('slug' => 'typ-projektu', 'with_front' => false),
		    'names' => [
			    'singular' => __('Typ projektu'),
			    'plural' => __('Typy projektu')
		    ],
	    ],
	    'topic' => [
		    'post_types' => ['news'],
		    'public' => true,
		    'hierarchical' => false,
		    'names' => [
			    'singular' => __('Téma'),
			    'plural' => __('Témata')
		    ],
	    ]
	],
];

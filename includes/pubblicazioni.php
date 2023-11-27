<?php
if ( ! function_exists('pubblicazioni_post_type') ) {

	// Register Custom Post Type
	function pubblicazioni_post_type() {

		$labels = array(
			'name'                  => _x( 'Pubblicazioni', 'Post Type General Name', 'wm-child-maremma' ),
			'singular_name'         => _x( 'Pubblicazione', 'Post Type Singular Name', 'wm-child-maremma' ),
			'menu_name'             => __( 'Pubblicazioni', 'wm-child-maremma' ),
			'name_admin_bar'        => __( 'Pubblicazioni', 'wm-child-maremma' ),
			'archives'              => __( 'Item Archives', 'wm-child-maremma' ),
			'attributes'            => __( 'Item Attributes', 'wm-child-maremma' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wm-child-maremma' ),
			'all_items'             => __( 'All Items', 'wm-child-maremma' ),
			'add_new_item'          => __( 'Add New Item', 'wm-child-maremma' ),
			'add_new'               => __( 'Add New', 'wm-child-maremma' ),
			'new_item'              => __( 'New Item', 'wm-child-maremma' ),
			'edit_item'             => __( 'Edit Item', 'wm-child-maremma' ),
			'update_item'           => __( 'Update Item', 'wm-child-maremma' ),
			'view_item'             => __( 'View Item', 'wm-child-maremma' ),
			'view_items'            => __( 'View Items', 'wm-child-maremma' ),
			'search_items'          => __( 'Search Item', 'wm-child-maremma' ),
			'not_found'             => __( 'Not found', 'wm-child-maremma' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wm-child-maremma' ),
			'featured_image'        => __( 'Featured Image', 'wm-child-maremma' ),
			'set_featured_image'    => __( 'Set featured image', 'wm-child-maremma' ),
			'remove_featured_image' => __( 'Remove featured image', 'wm-child-maremma' ),
			'use_featured_image'    => __( 'Use as featured image', 'wm-child-maremma' ),
			'insert_into_item'      => __( 'Insert into item', 'wm-child-maremma' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'wm-child-maremma' ),
			'items_list'            => __( 'Items list', 'wm-child-maremma' ),
			'items_list_navigation' => __( 'Items list navigation', 'wm-child-maremma' ),
			'filter_items_list'     => __( 'Filter items list', 'wm-child-maremma' ),
		);
		$args = array(
			'label'                 => __( 'Pubblicazioni', 'wm-child-maremma' ),
			'description'           => __( 'Pubblicazioni', 'wm-child-maremma' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 20,
			'menu_icon'             => 'dashicons-book',
            "supports"              => array("title","editor","thumbnail","excerpt","custom-fields","revisions","author","page-attributes","post-formats"),
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
		);
		register_post_type( 'pubblicazioni', $args );

        unset( $args );
        unset( $labels );

        // Add new taxonomy, make it hierarchical (like categories) SOGGETTI 
        $labels = array(
            'name'              => _x( 'Soggetti', 'taxonomy general name', 'wm-child-maremma' ),
            'singular_name'     => _x( 'Soggetto', 'taxonomy singular name', 'wm-child-maremma' ),
            'search_items'      => __( 'Search Soggetti', 'wm-child-maremma' ),
            'all_items'         => __( 'All Soggetti', 'wm-child-maremma' ),
            'parent_item'       => __( 'Parent Soggetto', 'wm-child-maremma' ),
            'parent_item_colon' => __( 'Parent Soggetto:', 'wm-child-maremma' ),
            'edit_item'         => __( 'Edit Soggetto', 'wm-child-maremma' ),
            'update_item'       => __( 'Update Soggetto', 'wm-child-maremma' ),
            'add_new_item'      => __( 'Add New Soggetto', 'wm-child-maremma' ),
            'new_item_name'     => __( 'New Soggetto Name', 'wm-child-maremma' ),
            'menu_name'         => __( 'Soggetti', 'wm-child-maremma' ),
        );
    
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_tagcloud'     => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => array( 'slug' => 'soggetti' ),
        );
    
        register_taxonomy( 'soggetti', array( 'pubblicazioni' ), $args );

        unset( $args );
        unset( $labels );

        // Add new taxonomy, make it hierarchical (like categories) Autori
        $labels = array(
            'name'              => _x( 'Autori', 'taxonomy general name', 'wm-child-maremma' ),
            'singular_name'     => _x( 'Autore', 'taxonomy singular name', 'wm-child-maremma' ),
            'search_items'      => __( 'Search Autori', 'wm-child-maremma' ),
            'all_items'         => __( 'All Autori', 'wm-child-maremma' ),
            'parent_item'       => __( 'Parent Autore', 'wm-child-maremma' ),
            'parent_item_colon' => __( 'Parent Autore:', 'wm-child-maremma' ),
            'edit_item'         => __( 'Edit Autore', 'wm-child-maremma' ),
            'update_item'       => __( 'Update Autore', 'wm-child-maremma' ),
            'add_new_item'      => __( 'Add New Autore', 'wm-child-maremma' ),
            'new_item_name'     => __( 'New Autore Name', 'wm-child-maremma' ),
            'menu_name'         => __( 'Autori', 'wm-child-maremma' ),
        );
    
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_tagcloud'     => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => array( 'slug' => 'autori' ),
        );
    
        register_taxonomy( 'autori', array( 'pubblicazioni' ), $args );

        unset( $args );
        unset( $labels );

        // Add new taxonomy, make it hierarchical (like categories) Altri Autori
        $labels = array(
            'name'              => _x( 'Altri Autori', 'taxonomy general name', 'wm-child-maremma' ),
            'singular_name'     => _x( 'Altro Autore', 'taxonomy singular name', 'wm-child-maremma' ),
            'search_items'      => __( 'Search Altri Autori', 'wm-child-maremma' ),
            'all_items'         => __( 'All Altri Autori', 'wm-child-maremma' ),
            'parent_item'       => __( 'Parent Altro Autore', 'wm-child-maremma' ),
            'parent_item_colon' => __( 'Parent Altro Autore:', 'wm-child-maremma' ),
            'edit_item'         => __( 'Edit Altro Autore', 'wm-child-maremma' ),
            'update_item'       => __( 'Update Altro Autore', 'wm-child-maremma' ),
            'add_new_item'      => __( 'Add New Altro Autore', 'wm-child-maremma' ),
            'new_item_name'     => __( 'New Altro Autore Name', 'wm-child-maremma' ),
            'menu_name'         => __( 'Altri Autori', 'wm-child-maremma' ),
        );
    
        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'public'            => true,
            'show_in_nav_menus' => true,
            'show_admin_column' => true,
            'show_tagcloud'     => true,
            'query_var'         => true,
            'show_in_rest'      => true,
            'rewrite'           => array( 'slug' => 'altri-autori' ),
        );
    
        register_taxonomy( 'altri-autori', array( 'pubblicazioni' ), $args );

	}
	add_action( 'init', 'pubblicazioni_post_type', 0 );

}



if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_60ec4b6159b56',
        'title' => 'Pubblicazioni ACF',
        'fields' => array(
            array(
                'key' => 'wm_pubblicazioni_anno',
                'label' => 'Anno',
                'name' => 'anno',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'wpml_cf_preferences' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'wm_pubblicazioni_codice',
                'label' => 'Codice',
                'name' => 'codice',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'wpml_cf_preferences' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'wm_pubblicazioni_luogho',
                'label' => 'Luogo di pubblicazione',
                'name' => 'luogo_di_pubblicazione',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'wpml_cf_preferences' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'wm_pubblicazioni_inventari',
                'label' => 'Inventari',
                'name' => 'inventari',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'wpml_cf_preferences' => 0,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'wm_pubblicazioni_cdd',
                'label' => 'CDD',
                'name' => 'cdd',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'wpml_cf_preferences' => 0,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'wm_pubblicazioni_lingua',
                'label' => 'Lingua',
                'name' => 'lingua',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'ITA' => 'ITA',
                    'ENG' => 'ENG',
                    'FRA' => 'FRA',
                ),
                'default_value' => false,
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'wpml_cf_preferences' => 0,
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'wm_pubblicazioni_editori',
                'label' => 'Editori',
                'name' => 'editori',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'wpml_cf_preferences' => 1,
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'pubblicazioni',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'acfe_display_title' => '',
        'acfe_autosync' => '',
        'acfe_form' => 0,
        'acfe_meta' => '',
        'acfe_note' => '',
    ));
    
    endif;
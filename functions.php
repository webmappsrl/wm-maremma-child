<?php
/* Custom functions code goes here. */

require ('shortcodes/all_events.php');
require ('shortcodes/single_track.php');
require ('shortcodes/grid_track.php');
require ('shortcodes/get_parent.php');
require ('assets/geohub_taxonomy_mapping.php');
require ('includes/pubblicazioni.php');

add_action( 'wp_enqueue_scripts', 'Divi_parent_theme_enqueue_styles' );
function Divi_parent_theme_enqueue_styles() {
    wp_enqueue_script( 'general_javascript', get_stylesheet_directory_uri() . '/js/main.js', array ('jquery') );
}


function get_next_weekend()
  {
    $next_saturday =  strtotime('next saturday'); 
    $next_sunday =  strtotime('next sunday'); 
    $today =  strtotime('today'); 
    if ($today == $next_sunday) {
        $next_weekend = $next_sunday;
    } else {
        $next_weekend = $next_saturday;
    }
    // return date("Y-m-d", $next_weekend);
    return $next_weekend;
  }

// custom shortcode to display monarch share icons
function monarchShortcode(){
    $monarch = $GLOBALS['et_monarch'];
    $monarch_options = $monarch->monarch_options;
    return $monarch->generate_inline_icons('et_social_inline_custom');
}   
add_shortcode('et_social_share_custom', 'monarchShortcode');


if ( class_exists('Tribe__Events__Main') ){

  /* get event category names in text format */
  function tribe_get_text_categories ( $event_id = null ) {

  if ( is_null( $event_id ) ) {
  $event_id = get_the_ID();
  }

  $event_cats = '';

  $term_list = wp_get_post_terms( $event_id, Tribe__Events__Main::TAXONOMY );

  foreach( $term_list as $term_single ) {
  $event_cats .= $term_single->name . ', ';
  }

  return rtrim($event_cats, ', ');

  }

}



/** create a template for child-pages plugin for SEO pages */
function custom_ccchildpage_inner_template($template) {

  $template = '<div class="ccchildpage-wm"><div class="list"><img src="/wp-content/uploads/2021/06/bullet-tiangle.png"></div><div class="content"><h3{{title_class}}><a target="_blank" class="ccpage_title_link" href="{{link}}">{{title}}</a></h3>{{excerpt}}</div></div>';
  return $template;
}
add_filter( 'ccchildpages_inner_template' ,'custom_ccchildpage_inner_template' );



// /**changes the breadcrumb link of POI in yoast */
add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link' );
function yoast_seo_breadcrumb_append_link( $links ) {
	
    if ( is_singular( 'pubblicazioni' ) ) {
        $breadcrumb[] = array(
            'url' => site_url( '/cosa-facciamo/ricerca-scientifica/archivio-ricerche-scientifiche/' ),
            'text' => __('Pubblicazioni', 'wm-child-cyclando'),
        );
        array_splice( $links, 1,1, $breadcrumb );
    }
    return $links;
	
}
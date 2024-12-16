<?php
/* Custom functions code goes here. */

require('shortcodes/all_events.php');
require('shortcodes/single_track.php');
require('shortcodes/grid_track.php');
require('shortcodes/get_parent.php');
require('assets/geohub_taxonomy_mapping.php');
require('includes/pubblicazioni.php');

add_action('wp_enqueue_scripts', 'Divi_parent_theme_enqueue_styles');
function Divi_parent_theme_enqueue_styles()
{
  wp_enqueue_script('general_javascript', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'));
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
function monarchShortcode()
{
  $monarch = $GLOBALS['et_monarch'];
  $monarch_options = $monarch->monarch_options;
  return $monarch->generate_inline_icons('et_social_inline_custom');
}
add_shortcode('et_social_share_custom', 'monarchShortcode');


if (class_exists('Tribe__Events__Main')) {

  /* get event category names in text format */
  function tribe_get_text_categories($event_id = null)
  {

    if (is_null($event_id)) {
      $event_id = get_the_ID();
    }

    $event_cats = '';

    $term_list = wp_get_post_terms($event_id, Tribe__Events__Main::TAXONOMY);

    foreach ($term_list as $term_single) {
      $event_cats .= $term_single->name . ', ';
    }

    return rtrim($event_cats, ', ');
  }
}



/** create a template for child-pages plugin for SEO pages */
function custom_ccchildpage_inner_template($template)
{

  $template = '<div class="ccchildpage-wm"><div class="list"><img src="/wp-content/uploads/2021/06/bullet-tiangle.png"></div><div class="content"><h3{{title_class}}><a target="_blank" class="ccpage_title_link" href="{{link}}">{{title}}</a></h3>{{excerpt}}</div></div>';
  return $template;
}
add_filter('ccchildpages_inner_template', 'custom_ccchildpage_inner_template');



// /**changes the breadcrumb link of POI in yoast */
add_filter('wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link');
function yoast_seo_breadcrumb_append_link($links)
{

  if (is_singular('pubblicazioni')) {
    $breadcrumb[] = array(
      'url' => site_url('/cosa-facciamo/ricerca-scientifica/archivio-ricerche-scientifiche/'),
      'text' => __('Pubblicazioni', 'wm-child-cyclando'),
    );
    array_splice($links, 1, 1, $breadcrumb);
  }
  return $links;
}

// disables right clicking //
function disable_right_click()
{
  if (!is_user_logged_in()) {
?>
    <script type="text/javascript">
      document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
      }, false);
    </script>
  <?php
  }
}
add_action('wp_footer', 'disable_right_click');

function remove_target_blank_from_child_pages()
{
  ?>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a.ccpage_title_link').removeAttr('target');
    });
  </script>
<?php
}
add_action('wp_footer', 'remove_target_blank_from_child_pages');

function add_slick_slider()
{
  wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
  wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
  wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'add_slick_slider');

/** 
 * Escludi eventi già inviati dal feed
 */
function exclude_sent_events_from_feed($query)
{
  if ($query->is_feed() && $query->get('post_type') === 'tribe_events') {
    $meta_query = array(
      array(
        'key'     => '_sent_in_feed',
        'compare' => 'NOT EXISTS',
      ),
    );
    $query->set('meta_query', $meta_query);
  }
}
add_action('pre_get_posts', 'exclude_sent_events_from_feed');

/** 
 * Schedule a cron job to update the _sent_in_feed field
 */
add_action('init', 'schedule_mark_sent_events_cron');
function schedule_mark_sent_events_cron()
{
  if (!wp_next_scheduled('mark_sent_events_cron')) {
    $first_run = strtotime('11:14:00');
    if ($first_run < time()) {
      $first_run = strtotime('tomorrow 11:14:00'); // Make sure it is scheduled for tomorrow if the time has already passed
    }
    wp_schedule_event($first_run, 'daily', 'mark_sent_events_cron');
  }
}

/** 
 * Function to mark unsent events as "sent"
 */
add_action('mark_sent_events_cron', 'mark_events_as_sent_in_feed');
function mark_events_as_sent_in_feed()
{
  $args = array(
    'post_type'   => 'tribe_events',
    'meta_query'  => array(
      array(
        'key'     => '_sent_in_feed',
        'compare' => 'NOT EXISTS',
      ),
    ),
    'posts_per_page' => -1,
  );

  $events = get_posts($args);

  foreach ($events as $event) {
    update_post_meta($event->ID, '_sent_in_feed', current_time('mysql'));
  }
}

/** 
 * Remove the immediate update from the feed
 */
remove_action('rss2_item', 'mark_event_as_sent_in_feed');

// Delete the existing cron job
// add_action('init', 'reset_mark_sent_events_cron');
// function reset_mark_sent_events_cron() {
//     if (wp_next_scheduled('mark_sent_events_cron')) {
//         wp_clear_scheduled_hook('mark_sent_events_cron');
//     }
//     // Re-record the cron job for 
//     $first_run = strtotime('19:00:00');
//     if ($first_run < time()) {
//         $first_run = strtotime('tomorrow 19:00:00');
//     }
//     wp_schedule_event($first_run, 'daily', 'mark_sent_events_cron');
// }

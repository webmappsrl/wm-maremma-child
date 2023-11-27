<?php

/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if (!defined('ABSPATH')) {
	die('-1');
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

// get additional fields
$fields = tribe_get_custom_fields();

// get time fields
$time_format          = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );
$show_time_zone       = tribe_get_option( 'tribe_events_timezones_show_zone', false );
$time_zone_label      = Tribe__Events__Timezones::get_event_timezone_abbr( $event_id );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

// Get the venue city ( partenza )
$venue_city = tribe_get_city($event_id);
$venue_name = tribe_get_venue($event_id);

$prenota_ora = '';
$note = '';

function eventAddtFieldTranslation($name){
	$output = '';
	if (strtolower($name) == 'lunghezza (km)') {
		$output = __('Distance (km)', 'wm-child-maremma');
	}
	if (strtolower($name) == 'durata (ore)') {
		$output = __('Duration (hr)', 'wm-child-maremma');
	}
	if (strtolower($name) == 'difficoltà') {
		$output = __('Difficulty', 'wm-child-maremma');
	}
	if (strtolower($name) == 'biglietti') {
		$output = __('Tickets', 'wm-child-maremma');
	}
	return $output;
}
?>

<div id="tribe-events-content" class="tribe-events-single">
	<div class="pm-breadcrumb-yoast">
		<div class="wpb_wrapper">
			<?php echo do_shortcode('[wpseo_breadcrumb]') ?>
		</div>
	</div>
	<!-- Event header -->
	<section class="l-section wpb_row height_small with_img with_overlay">
		<div class="l-section-img loaded" style="background-image: url(<?php echo get_the_post_thumbnail_url($event_id); ?>);background-repeat: no-repeat;" data-img-width="1000" data-img-height="620"></div>
		<div class="l-section-overlay" style="background: linear-gradient(180deg,rgba(0,0,0,0.00),rgba(0,0,0,0.85))"></div>
		<div class="l-section-h i-cf">
			<div class="g-cols vc_row type_default valign_bottom">
				<div class="vc_col-sm-12 wpb_column vc_column_container">
					<div class="vc_column-inner">
						<div class="wpb_wrapper">
							<div class="w-separator size_custom pm-event-banner-separator"></div>
							<div class="wpb_widgetised_column wpb_content_element pm-event-category">
								<div class="wpb_wrapper">
									<?php echo tribe_get_text_categories($event_id); ?>
								</div>
							</div><?php the_title('<h1 class="tribe-events-single-event-title">', '</h1>'); ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- #tribe-events-header -->

	<?php while (have_posts()) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


			<section class="l-section wpb_row height_small">
				<div class="l-section-h i-cf">
					<div class="g-cols vc_row type_default valign_top pm-event-content-grid">
						<div class="vc_col-sm-8 wpb_column vc_column_container pm-event-content-col">
							<div class="vc_column-inner">
								<div class="wpb_wrapper">
									<!-- Event content -->
									<div class="tribe-events-single-event-description tribe-events-content">
										<div class="pm-event-mobile-content-title"><?php echo __('Description', 'wm-child-maremma');?></div>
										<?php the_content(); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="vc_col-sm-4 wpb_column vc_column_container pm-event-detail-col">
							<div class="vc_column-inner">
								<div class="wpb_wrapper pm-event-details-container">
									<h3 class="pm-event-details-title">
										<?php echo __('Visit details', 'wm-child-maremma');  ?>
									</h3>
									<p><label> <?php echo __('When', 'wm-child-maremma').': ';  ?></label><strong> <?php echo $start_date?> </strong></p>
									<p><label> <?php echo __('Departure', 'wm-child-maremma').': ';  ?></label><strong> <?php echo $start_time?> </strong></p>
									<p><label> <?php echo __('Meeting place', 'wm-child-maremma').': ';  ?></label><strong> <?php echo $venue_name; ?> </strong></p>
									<?php foreach ( $fields as $name => $value ): ?>
										<?php if (strtolower($name) == 'prenota ora') {
											$prenota_ora = $value;
										} elseif (strtolower($name) == 'note') {
											$note = $value;
										} else {
											?>
											<p><label> <?php echo eventAddtFieldTranslation($name).': ';  ?></label><strong> <?php echo $value; ?> </strong></p>
											<?php
										}
										?>
									<?php endforeach ?>
									</div>
									<div class="wpd_wrapper pm-event-note-container">
										<?php if ($note) {
											?>
											<p><?php echo $note;?></p>
											<?php
										} ?>
										<?php if ($prenota_ora) {
											?>
											<div class="pm-event-book-btn-container">
												<a class="w-btn us-btn-style_1" href="<?= $prenota_ora ?>"><span class="w-btn-label"><?= __('Book', 'wm-child-maremma') ?></span></a>
											</div>
											<?php
										} ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			
		</div> <!-- #post-x -->
	<?php endwhile; ?>


</div><!-- #tribe-events-content -->
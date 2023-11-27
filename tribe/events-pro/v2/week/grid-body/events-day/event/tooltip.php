<?php
/**
 * View: Week View - Event Tooltip
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events-pro/v2/week/grid-body/events-day/event/tooltip.php
 *
 * See more documentation about our views templating system.
 *
 * @link https://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */


$fields = tribe_get_custom_fields();

$prenota_ora = '';
?>
<div class="tribe-events-pro-week-grid__event-tooltip-template tribe-common-a11y-hidden">
	<div
		class="tribe-events-pro-week-grid__event-tooltip"
		id="tribe-events-tooltip-content-<?php echo esc_attr( $event->ID ); ?>"
		role="tooltip"
	>
		<?php //$this->template( 'week/grid-body/events-day/event/tooltip/featured-image', [ 'event' => $event ] ); ?>
		<?php $this->template( 'week/grid-body/events-day/event/tooltip/date', [ 'event' => $event ] ); ?>
		<?php $this->template( 'week/grid-body/events-day/event/tooltip/title', [ 'event' => $event ] ); ?>
		<?php $this->template( 'week/grid-body/events-day/event/tooltip/description', [ 'event' => $event ] ); ?>
		<?php $this->template( 'week/grid-body/events-day/event/tooltip/cost', [ 'event' => $event ] ); ?>
		<div class="tribe-event-tooltip-additional-fields">
		<?php foreach ( $fields as $name => $value ): ?>
			<?php if (strtolower($name) == 'prenota ora') {
				$prenota_ora = $value;
			} else {
				?>
				<p><label> <?php echo esc_html( $name ).': ';  ?></label><strong> <?php echo $value; ?> </strong></p>
				<?php
			}
			?>
		<?php endforeach ?>
		<?php if ($prenota_ora) {
			?>
			<a class="w-btn us-btn-style_1" href="<?= $prenota_ora ?>"><span class="w-btn-label"><?= __('Book', 'wm-child-maremma') ?></span></a>
			<?php
		} ?>
		</div>
	</div>
</div>

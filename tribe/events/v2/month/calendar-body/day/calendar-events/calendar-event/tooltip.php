<?php
/**
 * View: Month View - Calendar Event Tooltip
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/calendar-body/day/calendar-events/calendar-event/tooltip.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 4.9.13
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

?>
<div class="tribe-events-calendar-month__calendar-event-tooltip-template tribe-common-a11y-hidden">
	<div
		class="tribe-events-calendar-month__calendar-event-tooltip"
		id="tribe-events-tooltip-content-<?php echo esc_attr( $event->ID ); ?>"
		role="tooltip"
	>
		<?php $this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/featured-image', array( 'event' => $event ) ); ?>
		<div class="tribe-events-calendar-month__calendar-event-tooltip-body">
			<?php $this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/date', array( 'event' => $event ) ); ?>
			<?php $this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/title', array( 'event' => $event ) ); ?>
			<?php $this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/description', array( 'event' => $event ) ); ?>
			<a href="<?php echo esc_url( get_the_permalink( $event->ID ) ); ?>" class="underline-link">
				<?php echo esc_html__( 'Learn More', 'am' ); ?>
			</a>
		</div>
	</div>
</div>

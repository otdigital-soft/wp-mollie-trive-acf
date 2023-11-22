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
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = Tribe__Events__Main::postIdHelper( get_the_ID() );

/**
 * Allows filtering of the event ID.
 *
 * @since 6.0.1
 *
 * @param int $event_id
 */
$event_id = apply_filters( 'tec_events_single_event_id', $event_id );

/**
 * Allows filtering of the single event template title classes.
 *
 * @since 5.8.0
 *
 * @param array  $title_classes List of classes to create the class string from.
 * @param string $event_id The ID of the displayed event.
 */
$title_classes = apply_filters( 'tribe_events_single_event_title_classes', array( 'tribe-events-single-event-title' ), $event_id );
$title_classes = implode( ' ', tribe_get_classes( $title_classes ) );

/**
 * Allows filtering of the single event template title before HTML.
 *
 * @since 5.8.0
 *
 * @param string $before HTML string to display before the title text.
 * @param string $event_id The ID of the displayed event.
 */
$before = apply_filters( 'tribe_events_single_event_title_html_before', '<h1 class="' . $title_classes . '">', $event_id );

/**
 * Allows filtering of the single event template title after HTML.
 *
 * @since 5.8.0
 *
 * @param string $after HTML string to display after the title text.
 * @param string $event_id The ID of the displayed event.
 */
$after = apply_filters( 'tribe_events_single_event_title_html_after', '</h1>', $event_id );

/**
 * Allows filtering of the single event template title HTML.
 *
 * @since 5.8.0
 *
 * @param string $after HTML string to display. Return an empty string to not display the title.
 * @param string $event_id The ID of the displayed event.
 */
$title = apply_filters( 'tribe_events_single_event_title_html', the_title( $before, $after, false ), $event_id );
$cost  = tribe_get_formatted_cost( $event_id );

?>
<?php
while ( have_posts() ) :
	the_post();
	?>
	<article class="event-detail">
		<div class="container">
			<div class="event-detail__inner">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="event-detail__media bg-cover a-up">
					<?php the_post_thumbnail( 'full-content-image' ); ?>
				</div>
				<?php endif; ?>
				<div class="event-detail__content">
					<h1 class="event-detail__title a-up">
						<?php the_title(); ?>
					</h1>
					<?php
					// tribe event category
					$terms = get_the_terms( get_the_ID(), 'tribe_events_cat' );
					if ( $terms ) {
						echo '<p class="event-detail__cat text-lg a-up a-delay-1">' . implode( ', ', wp_list_pluck( $terms, 'name' ) ) . '</p>';
					}
					?>
					<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
					<div class="event-detail__copy section-copy a-up a-delay-1">
						<?php the_content(); ?>
					</div>
					<?php do_action( 'tribe_events_single_event_after_the_content' ); ?>

					<div class="event-detail__item a-up a-delay-3">
						<!-- Event meta -->
						<?php do_action( 'tribe_events_single_event_before_the_meta' ); ?>
						<?php tribe_get_template_part( 'modules/meta' ); ?>
						<?php do_action( 'tribe_events_single_event_after_the_meta' ); ?>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php endwhile; ?>

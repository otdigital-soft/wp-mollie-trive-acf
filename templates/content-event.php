<?php
/**
 * Single Event Template
 */
$date    = get_field( 'date' );
$time    = get_field( 'time' );
$website = get_field( 'website' );
$booking = get_field( 'booking' );
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
				<div class="event-detail__copy section-copy a-up a-delay-1">
					<?php the_content(); ?>
				</div>
				<div class="event-detail__buttons">
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v' => 'website',
							'c' => 'btn btn-outline a-up a-delay-2',
							'o' => 'f',
						)
					);
					?>
				</div>
				<?php if ( $date ) : ?>
					<div class="event-detail__item a-up a-delay-3">
						<h6 class="text-caption-lg"><?php echo esc_html__( 'Date', 'am' ); ?></h6>
						<p class="text-lg event-detail__date"><?php echo esc_html( $date ); ?></p>
					</div>
				<?php endif; ?>
				<?php if ( $time ) : ?>
					<div class="event-detail__item a-up a-delay-4">
						<h6 class="text-caption-lg"><?php echo esc_html__( 'Time', 'am' ); ?></h6>
						<p class="text-lg event-detail__time">
							<?php echo $time; ?>
						</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>

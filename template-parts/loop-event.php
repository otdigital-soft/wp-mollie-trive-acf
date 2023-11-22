<?php
$booking = get_field( 'booking' );
?>
<article class="loop-event a-up">
	<div class="container loop-event__inner">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="loop-event__media bg-cover">
				<?php the_post_thumbnail( 'loop-event' ); ?>
			</div>
		<?php endif; ?>
		<div class="loop-event__content">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-event__title h2">
				<?php the_title(); ?>
			</a>
			<div class="loop-event__meta">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'date',
						't'  => 'p',
						'tc' => 'loop-event__date text-lg',
						'o'  => 'f',
					)
				);
				?>
				<?php if ( has_excerpt() ) : ?>
					<div class="loop-event__excerpt"><?php the_excerpt(); ?></div>
				<?php endif; ?>
				<div class="loop-event__buttons"> 
					<?php if ( $booking ) : ?>
						<a href="<?php echo esc_url( $booking['url'] ); ?>" class="btn btn-outline loop-event__booking" target="<?php echo esc_attr( $booking['target'] ? $booking['target'] : '_self' ); ?>">
							<?php echo esc_html( $booking['title'] ); ?>
						</a>
					<?php endif; ?>
					<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="link loop-event__more">
						<?php echo esc_html__( 'View More', 'am' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</article>

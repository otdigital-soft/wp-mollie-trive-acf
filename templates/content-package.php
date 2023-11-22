<?php
/**
 * Single Package Template
 */

$booking_url = get_field( 'booking_url' );
$terms       = get_field( 'terms_conditions' );
?>
<article class="package-detail">
	<div class="container">
		<div class="package-detail__inner">
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="package-detail__media bg-cover a-up">
				<?php the_post_thumbnail( 'full-content-image' ); ?>
			</div>
			<?php endif; ?>
			<div class="package-detail__content">
				<h1 class="package-detail__title a-up">
					<?php the_title(); ?>
				</h1>
				<div class="package-detail__copy section-copy a-up a-delay-1">
					<?php the_content(); ?>
				</div>
				<?php if ( $booking_url ) : ?>
					<a href="<?php echo esc_url( $booking_url ); ?>" class="btn btn-outline package-detail__booking a-up a-delay-2" target="_blank">
						<?php echo esc_html__( 'Book Now', 'am' ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $terms ) : ?>
					<div class="package-detail__terms a-up a-delay-3">
						<p class="package-detail__terms-heading"><?php echo esc_html__( 'Terms & Conditions', 'am' ); ?></p>
						<?php echo $terms; ?>
					</div> 
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>

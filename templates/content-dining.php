<?php
/**
 * Single Dining Template
 */

global $post;

// Load ACF Fields
$booking_url    = get_field( 'booking_url' );
$gallery        = get_field( 'gallery' );
$related_dining = get_field( 'related_dining' );
?>

<!-- Rooms Banner -->
<section class="full-height-banner">
	<?php if ( has_post_thumbnail() ) : ?>
		<img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="" class="full-height-banner__bg">
	<?php endif; ?>
	<div class="container">
		<!-- <button class="btn-scroll-next a-op a-delay-1"><?php echo esc_html__( 'Explore', 'am' ); ?></button> -->
		<h1 class="full-height-banner__heading a-up">
			<?php echo str_replace( '/', '/<br>', get_the_title() ); ?>
		</h1>
	</div>
</section>

<?php get_template_part( 'template-parts/breadcrumb' ); ?>

<!-- Dining Details -->
<section class="dining-details">
	<div class="container">
		<div class="row">
			<div class="col col-md-6">
				<div class="dining-details__content section-copy a-up">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="col col-md-6 dining-details__reserve">
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'reserve_cta',
						'c' => 'btn btn-outline btn-reserve a-up a-delay-1',
						'o' => 'f',
					)
				);
				?>
			</div>
			<div class="col col-md-12 dining-details__hm">
				<?php if ( have_rows( 'hours' ) ) : ?>
					<div class="dining-details__items a-up a-delay-2">
						<p class="text-lg"><?php echo esc_html__( 'Hours', 'am' ); ?></p>
						<?php
						while ( have_rows( 'hours' ) ) :
							the_row();
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v' => 'hour',
									't' => 'p',
								)
							);
						endwhile;
						?>
					</div>
				<?php endif; ?>
				<?php if ( have_rows( 'menus' ) ) : ?>
					<div class="dining-details__items a-up a-delay-3">
						<p class="text-lg"><?php echo esc_html__( 'Menus', 'am' ); ?></p>
						<?php
						while ( have_rows( 'menus' ) ) :
							the_row();
							get_template_part_args(
								'template-parts/content-modules-cta',
								array(
									'v' => 'cta',
									'c' => 'underline-link',
									'w' => 'div',
								)
							);
						endwhile;
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php if ( $gallery ) : ?>
	<!-- Dining Gallery -->
	<section class="room-gallery">
		<div class="container">
			<h2 class="section-heading a-up"><?php echo esc_html__( 'Gallery', 'am' ); ?></h2>
			<div class="room-gallery__images">
				<?php foreach ( $gallery as $image ) : ?>
					<a href="<?php echo esc_url( $image['url'] ); ?>" class="room-gallery__image a-up" data-fancybox="gallery">
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
						<?php if ( $image['caption'] ) : ?>
							<p class="text-caption room-gallery__title d-md-only"><?php echo esc_html( $image['caption'] ); ?></p>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>


<?php if ( $related_dining ) : ?>
	<!-- Related Dining -->
	<section class="dining-related a-up">
		<div class="container">
			<?php
			foreach ( $related_dining as $post ) :
				setup_postdata( $post );
				get_template_part( 'template-parts/loop', 'dining' );
			endforeach;
			?>
		</div>
	</section>
<?php endif; ?>

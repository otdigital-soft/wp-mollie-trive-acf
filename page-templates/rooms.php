<?php
/**
 * Template Name: Rooms
 * Template Post Type: page
 */

get_header();
?>
<?php
$image        = get_field( 'image' );
$mobile_image = get_field( 'mobile_image' );
if ( $image ) :
	?>
<!-- Rooms Banner -->
<section class="full-height-banner">
	<?php if ( $mobile_image ) : ?>
		<picture>
			<source srcset="<?php echo esc_url( $image ); ?>" media="(min-width: 576px)">
			<img class="full-height-banner__bg" src="<?php echo esc_url( $mobile_image ); ?>" alt="">
		</picture>
	<?php else : ?>
		<img class="full-height-banner__bg" src="<?php echo esc_url( $image ); ?>" alt="">
	<?php endif; ?>
	<div class="container">
		<h2 class="h1 full-height-banner__heading a-up"><?php the_title(); ?></h2>
		<!-- <button class="btn-scroll-next a-op a-delay-1"><?php echo esc_html__( 'Explore', 'am' ); ?></button> -->
	</div>
</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/breadcrumb' ); ?>

<!-- Rooms Details -->
<section class="rooms-details">
	<div class="container">
		<div class="row">
			<div class="col col-md-5">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 's2_heading',
						't'  => 'h1',
						'tc' => 'section-heading a-up',
						'o'  => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 's2_content',
						't'  => 'div',
						'tc' => 'section-copy rooms-details__content a-up a-delay-1',
						'o'  => 'f',
					)
				);
				?>
			</div>
			<div class="col col-md-7">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 's2_amenities',
						't'  => 'div',
						'tc' => 'rooms-details__amenities section-copy a-up a-delay-2',
						'o'  => 'f',
					)
				);
				?>
			</div>
		</div>
	</div>
</section>

<?php if ( have_rows( 'navigation' ) ) : ?>
	<!-- Navigation -->
	<section class="page-navigation a-up">
		<div class="container">
			<ul>
				<?php
				while ( have_rows( 'navigation' ) ) :
					the_row();
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v' => 'link',
							'c' => 'page-navigation__link',
							'w' => 'li',
						)
					);
				endwhile;
				?>
			</ul>
		</div>
	</section>
<?php endif; ?>

<?php
if ( have_rows( 'rooms' ) ) :
	while ( have_rows( 'rooms' ) ) :
		the_row();
		$heading = get_sub_field( 'heading' );
		$type    = get_sub_field( 'room_type' );
		$style   = get_sub_field( 'style' );
		$args    = array(
			'post_type'      => 'room',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'room_type',
					'field'    => 'term_id',
					'terms'    => $type,
				),
			),
		);
		$query   = new WP_Query( $args );
		?>
		<!-- Rooms Slider -->
		<section class="rooms-block"<?php echo $heading ? ' id="' . sanitize_title( $heading ) . '"' : ''; ?>>
			<div class="container">
				<div class="row rooms-block__top">
					<div class="rooms-block__top-left col col-md-6">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h3',
								'tc' => 'h2 section-heading a-up',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'sub_heading',
								't'  => 'h6',
								'tc' => 'rooms-block__top-subheading a-up a-delay-1',
							)
						);
						?>
					</div>
					<div class="col col-md-6 rooms-block__content">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'section-copy a-up a-delay-1',
							)
						);
						?>
						<?php if ( 'slider' == $style && $query->found_posts > 1 ) : ?>
							<div class="slick-controls a-up a-delay-2">
								<button class="btn-slick-arrow btn-slick-prev" aria-label="<?php echo esc_html__( 'Previous Slider', 'am' ); ?>"></button>
								<p class="slick-pagination"></p>
								<button class="btn-slick-arrow btn-slick-next" aria-label="<?php echo esc_html__( 'Next Slider', 'am' ); ?>"></button>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ( $query->have_posts() ) : ?>
					<div class="rooms-<?php echo esc_attr( $style ); ?> a-op a-delay-2">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							get_template_part( 'template-parts/loop', 'room' );
						endwhile;
						?>
					</div>
					<?php
					endif;
				wp_reset_postdata();
				?>
			</div>
		</section>
		<?php
	endwhile;
endif;
?>


<!-- Rooms Amenities -->
<section class="hp-taste full-content-image" id="<?php the_field( 'amenities_anchor_id' ); ?>">
	<div class="container full-content-image__inner">
		<?php
		get_template_part_args(
			'template-parts/content-modules-image',
			array(
				'v'     => 'hotel_image',
				'v2x'   => false,
				'is'    => 'full-content-image',
				'is_2x' => 'full-content-image-2x',
				'w'     => 'div',
				'wc'    => 'hp-taste__media bg-cover',
				'o'     => 'o',
			)
		);
		?>
		<div class="hp-taste__content full-content-image__content">
			<div class="hp-taste__top">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'hotel_heading',
						't'  => 'h2',
						'tc' => 'h1 section-heading a-up',
						'o'  => 'o',
					)
				);
				?>
			</div>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'hotel_amenities',
					't'  => 'div',
					'tc' => 'hp-taste__links hp-taste__amenities a-up a-delay-2',
					'o'  => 'o',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'hotel_content',
					't'  => 'div',
					'tc' => 'section-copy a-up a-delay-3',
					'o'  => 'o',
				)
			);
			?>
		</div>
	</div>
</section>
<?php
get_footer();

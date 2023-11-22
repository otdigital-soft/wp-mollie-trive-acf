<?php
/**
 * Template Name: Explore
 * Template Post Type: page
 */
get_header();
global $post;
?>
<section class="explore-banner">
	<?php
	get_template_part_args(
		'template-parts/content-modules-image',
		array(
			'v'     => 'image',
			'v2x'   => false,
			'is'    => false,
			'is_2x' => false,
			'c'     => 'explore-banner__bg',
			'o'     => 'f',
		)
	);
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col col-md-6">
				<?php
				echo breadcrumb_trail(
					array(
						'separator' => ' ',
					)
				);
				?>
			</div>
			<div class="col col-md-6 text-right">
				<h1 class="explore-banner__title a-up"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</section>

<?php
$categories = get_terms( array( 'taxonomy' => 'location_category' ) );
$args       = array(
	'post_type'      => 'location',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
);
$query      = new WP_Query( $args );
?>
<section class="explore">
	<div class="container">
		<?php if ( $categories ) : ?>
			<ul class="explore-filters d-md-only">
				<li>
					<button class="explore-cat is-active" data-cat="all"><?php echo esc_html__( 'All', 'am' ); ?></button>
				</li>
				<?php foreach ( $categories as $category ) : ?>
					<li>
						<button class="explore-cat" data-cat="<?php echo esc_attr( $category->term_id ); ?>">
							<?php echo esc_html( $category->name ); ?>
						</button>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="d-sm-only">
				<select name="" id="" class="explore-select jcf-select">
					<option value="all"><?php echo esc_html__( 'All Locations', 'am' ); ?></option>
					<?php foreach ( $categories as $category ) : ?>
						<option value="<?php echo esc_attr( $category->term_id ); ?>">
							<?php echo esc_html( $category->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>
		<div class="explore-locations">
			<?php if ( $query->have_posts() ) : ?>
				<div class="explore-locations-nearby" id="explore_locations-epxlore-locations-nearby">
					<div class="locations-nearby">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							get_template_part( 'template-parts/loop', 'location' );
						endwhile;
						?>
					</div>
				</div>
				<?php
			endif;
			wp_reset_postdata(); ?>
			<div class="explore-locations-canvas mapboxgl-map"
				id="explore_locations-epxlore-locations"
				data-latitude="<?php the_field( 'latitude' ); ?>" 
				data-longitude="<?php the_field( 'longitude' ); ?>"
				data-pin="<?php echo esc_url( get_template_directory_uri() . '/assets/img/mollie-pin.png' ); ?>"
				data-pin-olive="<?php echo esc_url( get_template_directory_uri() . '/assets/img/mollie-pin-olive.png' ); ?>"
				data-key="<?php the_field( 'mapbox_key' ); ?>"
				></div>
		</div>
	</div>
</section>

<!-- Learning Content Image -->
<section class="full-content-image learning-rest">
	<div class="container full-content-image__inner">
		<div class="full-content-image__content learning-rest__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's3_heading',
					't'  => 'h2',
					'tc' => 'section-heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's3_sub_heading',
					't'  => 'h6',
					'tc' => 'section-subheading a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
		</div>
		<div class="full-content-image__media learning-rest__media">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's3_content',
					't'  => 'div',
					'tc' => 'section-copy a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-cta',
				array(
					'v' => 's3_cta',
					'c' => 'link learning-rest__link a-up a-delay-3',
					'o' => 'f',
				)
			);
			?>
			<div class="full-content-image__image learning-rest__image bg-cover a-up a-delay-4">
				<?php
				get_template_part_args(
					'template-parts/content-modules-image',
					array(
						'v'     => 's3_image',
						'v2x'   => false,
						'is'    => 'full-content-image',
						'is_2x' => 'full-content-image-2x',
						'c'     => 'full-content-image__img',
						'o'     => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 's3_caption',
						't'  => 'p',
						'tc' => 'full-content-image__caption d-md-only',
						'o'  => 'f',
					)
				);
				?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();

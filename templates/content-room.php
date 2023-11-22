<?php
/**
 * Single Room Template
 */

global $post;

$room_types = get_the_terms( $post->ID, 'room_type' );

// Load ACF fields
$size         = get_field( 'size' );
$amenities    = get_field( 'amenities' );
$floor_plan   = get_field( 'floor_plan' );
$gallery      = get_field( 'gallery' );
$related_type = get_field( 'room_type' );
?>
<!-- Room Banner -->
<section class="room-banner">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="room-banner__bg">
			<?php the_post_thumbnail( 'full' ); ?>
			<a href="<?php echo esc_url( get_the_post_thumbnail_url( null, 'full' ) ); ?>" class="img-fancybox__btn" data-fancybox="gallery">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-plus.svg' ); ?>" alt="<?php echo esc_html__( 'Open Lightbox', 'am' ); ?>">
			</a>
		</div>
	<?php endif; ?>
	<div class="container-fluid room-banner__content">
		<?php if ( $room_types || $size ) : ?>
		<div class="room-banner__top a-up">
			<?php if ( $room_types ) : ?>
				<h6 class="room-banner__type"><?php echo esc_html( $room_types[0]->name ); ?></h6>
			<?php endif; ?>
			<?php if ( $size ) : ?>
				<p class="room-banner__size"><?php echo esc_html( $size . ' SQFT' ); ?></p>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<h1 class="room-banner__title a-up a-delay-1"><?php the_title(); ?></h1>
	</div>
</section>

<?php get_template_part( 'template-parts/breadcrumb' ); ?>

<!-- Room Content -->
<section class="room-content">
	<div class="container">
		<div class="basic-editor a-up">
			<?php the_content(); ?>
			<?php if ( $amenities || $floor_plan ) : ?>
			<div class="room-content__btns">
				<?php if ( $amenities ) : ?>
					<a href="javascript:;" class="btn btn-outline" data-fancybox data-src="#amenities-popup">
						<?php echo esc_html__( 'View Amenities', 'am' ); ?>
					</a>
					<div class="fancybox-popup-inline" id="amenities-popup">
						<p class="fancybox-popup-inline__heading"><?php echo esc_html__( 'Amenities', 'am' ); ?></p>
						<div class="fancybox-popup-inline__content">
							<?php echo $amenities; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $floor_plan ) : ?>
					<a href="javascript:;" class="link link-arrow" data-fancybox data-src="#floor-plan">
						<?php echo esc_html__( 'View Layout', 'am' ); ?>
					</a>
					<div class="fancybox-popup-inline" id="floor-plan">
						<p class="fancybox-popup-inline__heading"><?php echo esc_html__( 'Room Layout', 'am' ); ?></p>
						<div class="fancybox-popup-inline__content">
							<img class="fancybox-popup-inline__img" src="<?php echo esc_url( $floor_plan ); ?>" alt="">
						</div>
					</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if ( $gallery ) : ?>
	<!-- Room Gallery -->
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

<!-- Room Amenities -->
<section class="hp-taste sr-amenities full-content-image">
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
if ( $related_type ) :
	$related_args  = array(
		'post_type'      => 'room',
		'posts_per_page' => 1,
		'post__not_in'   => array( $post->ID ),
		'tax_query'      => array(
			array(
				'taxonomy' => 'room_type',
				'field'    => 'term_id',
				'terms'    => $related_type,
			),
		),
	);
	$related_query = new WP_Query( $related_args );
	if ( $related_query->have_posts() ) :
		?>
		<!-- Related Room -->
		<section class="room-related">
			<div class="container">
				<?php
				while ( $related_query->have_posts() ) :
					$related_query->the_post();
					get_template_part( 'template-parts/loop', 'room' );
				endwhile;
				?>
			</div>
		</section>
		<?php
	endif;
endif; ?>

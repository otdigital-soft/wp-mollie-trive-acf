<?php
global $post;

// Load ACF field values
$booking   = get_field( 'booking_url' );
$td_view   = get_field( '3d_view' );
$amenities = get_field( 'amenities' );
$floor     = get_field( 'floor_plan' );
$size      = get_field( 'size' );
$gallery   = get_field( 'gallery' );

?>
<article class="loop-room">
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="loop-room__image">
		<?php if ( $gallery ) : ?>
			<div class="loop-room__carousel" id="room_carousel_<?php echo esc_attr( get_the_ID() ); ?>">
				<?php foreach ( $gallery as $image ) : ?>
					<a href="<?php echo esc_url( $image['url'] ); ?>" class="loop-room__slide">
						<div class="bg-cover">
							<img src="<?php echo esc_url( $image['sizes']['loop-room'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
						</div>
						<span class="img-fancybox__btn d-md-only">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-plus.svg' ); ?>" alt="<?php echo esc_html__( 'Open Lightbox', 'am' ); ?>">
						</span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<?php the_post_thumbnail( 'loop-room' ); ?>
		<?php endif; ?>
		<?php if ( $td_view ) : ?>
			<a href="<?php echo esc_url( $td_view ); ?>" class="underline-link loop-room__3d d-md-only" target="_blank">
				<?php echo esc_html__( 'View 3D', 'am' ); ?>
			</a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="loop-room__details">
		<a href="<?php echo esc_url( get_the_permalink() ); ?>"><h5 class="loop-room__title"><?php the_title(); ?></h5></a>
		<div class="loop-room__meta">
			<?php if ( $amenities ) : ?>
				<div class="fancybox-popup-inline" id="loop-room-amenities-<?php echo esc_attr( $post->ID ); ?>">
					<p class="fancybox-popup-inline__heading"><?php echo esc_html__( 'Amenities', 'am' ); ?></p>
					<div class="fancybox-popup-inline__content">
						<?php echo $amenities; ?>
					</div>
				</div>
				<a href="javascript:;" class="underline-link" data-fancybox data-src="#loop-room-amenities-<?php echo esc_attr( $post->ID ); ?>">
					<?php echo esc_html__( 'Room Amenities', 'am' ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $floor ) : ?>
				<span class="sep">|</span>
				<div class="fancybox-popup-inline" id="loop-room-floor-<?php echo esc_attr( $post->ID ); ?>">
					<p class="fancybox-popup-inline__heading"><?php echo esc_html__( 'Room Layout', 'am' ); ?></p>
					<div class="fancybox-popup-inline__content">
						<img class="fancybox-popup-inline__img" src="<?php echo esc_url( $floor ); ?>" alt="">
					</div>
				</div>
				<a href="javascript:;" class="underline-link" data-fancybox data-src="#loop-room-floor-<?php echo esc_attr( $post->ID ); ?>">
					<?php echo esc_html__( 'Floor Plan', 'am' ); ?>
				</a>
			<?php endif; ?>
			<?php if ( $size ) : ?>
				<span class="sep">|</span>
				<p class="loop-room__size"><?php echo esc_html( $size . ' SQFT' ); ?></p>
			<?php endif; ?>
		</div>
		<!-- <div class="loop-room__btns">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="underline-link loop-room__more"><?php echo esc_html( 'View more', 'am' ); ?></a>
			<?php if ( $booking ) : ?>
				<a href="<?php echo esc_url( $booking ); ?>" class="btn btn-outline loop-room__booking" target="_blank"><?php echo esc_html__( 'Reserve Room', 'am' ); ?></a>
			<?php endif; ?>
		</div> -->
	</div>
</article>

<?php
$gallery = get_field( 'gallery' );
if ( $gallery ) :
	foreach ( $gallery as $image ) :
		?>
		<a href="<?php echo esc_url( $image['url'] ); ?>" class="gallery-image a-up" data-fancybox="gallery">
			<div class="gallery-image__inner">
				<img src="<?php echo esc_url( $image['url'] ); ?>" 
					alt="<?php echo esc_attr( $image['alt'] ); ?>">
				<?php if ( $image['caption'] ) : ?>
					<p class="text-caption d-md-only"><?php echo $image['caption']; ?></p>
				<?php endif; ?>
			</div>
		</a>
		<?php
	endforeach;
endif;

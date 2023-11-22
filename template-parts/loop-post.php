<?php
$categories = get_the_category();
?>
<article class="loop-post a-up">
	<div class="container">
		<div class="loop-post__inner">
			<div class="loop-post__content">
				<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post__title h1">
					<?php the_title(); ?>
				</a>
				<div class="loop-post__details">
					<?php if ( $categories ) : ?>
						<p class="text-lg loop-post__cat">
							<?php echo implode( ', ', wp_list_pluck( $categories, 'name' ) ); ?>
						</p>
					<?php endif; ?>
					<?php if ( has_excerpt() ) : ?>
						<div class="loop-post__excerpt">
							<?php the_excerpt(); ?>
						</div>
						<?php endif; ?>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="loop-post__link link">
							<?php echo esc_html__( 'Read More', 'am' ); ?>
						</a>
				</div>
			</div>
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="loop-post__media bg-cover">
				<?php the_post_thumbnail( 'full-content-image' ); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</article>

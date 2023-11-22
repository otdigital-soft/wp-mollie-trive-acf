<?php
/**
 * Single Post Template
 */

global $post;

$related_post = get_field( 'related_post' );
?>
<?php if ( has_post_thumbnail() ) : ?>
	<section class="post-banner bg-cover">
		<?php the_post_thumbnail( 'full' ); ?>
	</section>
<?php endif; ?>

<?php get_template_part( 'template-parts/breadcrumb' ); ?>

<article class="post-content" id="post-<?php the_ID(); ?>">
	<div class="container">
		<h1 class="section-heading h3 a-up"><?php the_title(); ?></h1>
		<div class="section-copy a-up a-delay-2">
			<?php the_content( __( 'Read more', 'am' ) ); ?>
		</div>
	</div>
</article><!-- /post -->

<?php if ( $related_post ) : ?>
	<section class="related-post">
		<?php
		foreach ( $related_post as $post ) :
			setup_postdata( $post );
			get_template_part( 'template-parts/loop', 'post' );
		endforeach;
		?>
	</section>
	<?php
endif;
wp_reset_postdata();
?>

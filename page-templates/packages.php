<?php
/**
 * Template Name: Packages
 * Template Post Type: page
 */
get_header();

global $post;

$type = get_field( 'type' );
if ( 'custom' == $type ) {
	$packages = get_field( 'packages' );
} else {
	$args     = array(
		'post_type'      => 'package',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	);
	$packages = get_posts( $args );
}
?>
<section class="default-banner">
	<div class="container">
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
			<div class="col col-md-6">
				<h1 class="default-banner__title a-up"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</section>

<?php if ( $packages ) : ?>
	<section class="packages">
		<?php
		foreach ( $packages as $post ) :
			setup_postdata( $post );
			get_template_part( 'template-parts/loop', 'package' );
		endforeach;
		?>
	</section>
	<?php
endif;
wp_reset_postdata();
?>

<?php
get_footer();

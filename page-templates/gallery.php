<?php
/**
 * Template Name: Gallery
 * Template Post Type: page
 */
get_header();

global $post;

$args  = array(
	'post_type'      => 'gallery',
	'post_status'    => 'publish',
	'posts_per_page' => '-1',
);
$query = new WP_Query( $args );
?>
<!-- Default Banner -->
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
				<?php if ( $query->have_posts() ) : ?>
					<div class="default-banner__image">
						<div>
							<button data-target="all" class="gallery-category default-banner__link is-active"><?php echo esc_html__( 'All', 'am' ); ?></button>
						</div>
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							$title = get_the_title();
							?>
							<div>
								<button data-target="<?php echo esc_attr( $post->ID ); ?>" class="gallery-category default-banner__link">
									<?php echo $title; ?>
								</button>
							</div>
						<?php endwhile; ?>
					</div>
					<?php
					endif;
				wp_reset_postdata();
				?>
				<h1 class="default-banner__title a-up"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</section>

<?php if ( $query->have_posts() ) : ?>
	<!-- Gallery -->
	<section class="gallery">
		<div class="container">
			<div class="gallery-grid">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					get_template_part( 'template-parts/loop', 'gallery' );
				endwhile;
				?>
			</div>
		</div>
	</section>
	<?php
endif;
wp_reset_postdata();
?>
<?php
get_footer();

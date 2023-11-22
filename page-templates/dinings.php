<?php
/**
 * Template Name: Dinings
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
			'v'     => 'banner_image',
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
<?php if ( have_rows( 'navigation_links' ) ) : ?>
<!-- Navigation -->
<section class="page-navigation">
	<div class="container">
		<ul>
			<?php
			while ( have_rows( 'navigation_links' ) ) :
				the_row();
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'cta',
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
$dinings = get_field( 'dinings' );
if ( $dinings ) :
	foreach ( $dinings as $post ) :
		setup_postdata( $post );
		$title = strtolower( get_the_title() );
		?>
		<section class="hp-taste dinings-single full-content-image" id="<?php echo esc_attr( str_replace( '/', '-', $title ) ); ?>">
			<div class="container full-content-image__inner">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="hp-taste__media">
					<div class="hp-taste__slide bg-cover<?php echo 1 == get_row_index() ? ' is-active' : ''; ?>">
						<?php the_post_thumbnail(); ?>
					</div>
					<a href="<?php echo esc_url( the_post_thumbnail_url( 'full' ) ); ?>" class="hp-taste__fancybox" data-fancybox="gallery">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-plus.svg' ); ?>" alt="<?php echo esc_html__( 'Open Lightbox', 'am' ); ?>" loading="lazy">
					</a>
				</div>
				<?php endif; ?>
				<div class="hp-taste__content full-content-image__content">
					<h2 class="section-heading a-up"><?php the_title(); ?></h2>
					<?php if ( have_rows( 'hours' ) ) : ?>
						<div class="hp-taste__hours a-up a-delay-1">
							<?php
							while ( have_rows( 'hours' ) ) :
								the_row();
								$hour = get_sub_field( 'hour' );
								if ( $hour ) :
									?>
									 <p><?php echo $hour; ?></p>
									<?php
								endif;
							endwhile;
							?>
						</div>
					<?php endif; ?>
					<?php if ( have_rows( 'menus' ) ) : ?>
						<div class="hp-taste__menus a-up a-delay-2">
							<p class="text-lg"><?php echo esc_html__( 'Menus', 'am' ); ?></p>
							<div class="hp-taste__links">
								<?php
								while ( have_rows( 'menus' ) ) :
									the_row();
									$link = get_sub_field( 'cta' );
									if ( $link ) :
										?>
										<a href="<?php echo esc_url( $link['url'] ); ?>" class="hp-taste__link" target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>">
											<?php echo esc_html( $link['title'] ); ?>
										</a>
										<?php
									endif;
								endwhile;
								?>
							</div>
						</div>
					<?php endif; ?>
					<div class="section-copy a-up a-delay-3">
						<?php the_content(); ?>
					</div>
					<div class="section-buttons a-up a-delay-4">
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'reserve_cta',
								'c' => 'btn btn-outline',
								'w' => 'div',
								'o' => 'f',
							)
						);
						?>
						<div>
							<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="link">
								<?php echo esc_html__( 'View More', 'am' ); ?>
							</a>
						</div>
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 's4_cta',
								'c' => 'link',
								'w' => 'div',
								'o' => 'f',
							)
						);
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	endforeach;
endif;
wp_reset_postdata();
?>
<?php
get_footer();

<?php
/**
 * Template Name: Gather
 * Template Post Type: page
 */
get_header();
?>
<?php
if ( have_rows( 'modules' ) ) :
	while ( have_rows( 'modules' ) ) :
		the_row();
		$anchor_id = get_sub_field( 'anchor_id' );
		if ( 'banner' == get_row_layout() ) :
			?>
			<section class="default-banner default-banner--images"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<?php
				get_template_part_args(
					'template-parts/content-modules-image',
					array(
						'v'     => 'bg_image',
						'v2x'   => false,
						'is'    => false,
						'is_2x' => false,
						'c'     => 'default-banner__bg',
					)
				);
				?>
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
							<?php if ( have_rows( 'navigation_links' ) ) : ?>
								<div class="default-banner__images a-up a-delay-1">
									<?php
									while ( have_rows( 'navigation_links' ) ) :
										the_row();
										$image = get_sub_field( 'image' );
										$cta   = get_sub_field( 'cta' );
										?>
										<div class="default-banner__image">
											<?php
											get_template_part_args(
												'template-parts/content-modules-image',
												array(
													'v'   => 'image',
													'v2x' => false,
													'is'  => false,
													'is_2x' => false,
													'c'   => 'default-banner__img',
												)
											);
											?>
											<?php
											get_template_part_args(
												'template-parts/content-modules-cta',
												array(
													'v' => 'cta',
													'c' => 'default-banner__link',
												)
											);
											?>
										</div>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
							<h1 class="default-banner__title a-up"><?php the_title(); ?></h1>
						</div>
					</div>
				</div>
			</section>
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
		<?php elseif ( 'two_columns_content' == get_row_layout() ) : ?>
			<!-- Two columns Content -->
			<section class="two-columns-content"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
					<div class="row">
						<div class="col col-md-6">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 's2_heading',
									't'  => 'h2',
									'tc' => 'section-heading two-columns-content__heading a-up',
								)
							);
							?>
						</div>
						<div class="col col-md-6">
							<div class="two-columns-content__content">
								<?php
								get_template_part_args(
									'template-parts/content-modules-text',
									array(
										'v'  => 's2_content',
										't'  => 'div',
										'tc' => 'section-copy two-columns-content__copy a-up a-delay-1',
									)
								);
								?>
								<?php
								get_template_part_args(
									'template-parts/content-modules-cta',
									array(
										'v' => 's2_cta',
										'c' => 'link a-up a-delay-2',
									)
								);
								?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'content_image' == get_row_layout() ) :
			$direction = get_sub_field( 'content_direction' );
			$image     = get_sub_field( 'image' );
			?>
			<!-- Content Image -->
			<section class="hp-taste full-content-image full-content-image--<?php echo esc_attr( $direction ); ?>"
			<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container full-content-image__inner">
					<?php if ( $image ) : ?>
					<div class="hp-taste__media">
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'image',
								'v2x'   => false,
								'is'    => 'full-content-image',
								'is_2x' => 'full-content-image-2x',
							)
						);
						?>
						<a href="<?php echo esc_url( $image['url'] ); ?>" class="hp-taste__fancybox" data-fancybox="gallery">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-plus.svg' ); ?>" alt="<?php echo esc_html__( 'Open Lightbox', 'am' ); ?>" loading="lazy">
						</a>
					</div>
					<?php endif; ?>
					<div class="hp-taste__content full-content-image__content">
						<div class="hp-taste__top">
							<?php
							get_template_part_args(
								'template-parts/content-modules-text',
								array(
									'v'  => 'heading',
									't'  => 'h2',
									'tc' => 'h1 section-heading a-up',
								)
							);
							?>
						</div>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'section-copy a-up a-delay-3',
							)
						);
						?>
					</div>
				</div>
			</section>
			<?php
		elseif ( 'content_form' == get_row_layout() ) :
			?>
			<!-- Content Form -->
			<section class="content-form"<?php echo $anchor_id ? ' id="' . esc_attr( $anchor_id ) . '"' : ''; ?>>
				<div class="container">
					<div class="row">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
								't'  => 'h2',
								'tc' => 'section-heading a-up',
								'w'  => 'div',
								'wc' => 'col col-md-6',
							)
						);
						?>
						<div class="col col-md-6">
							<?php
							get_template_part_args(
								'template-parts/content-modules-shortcode',
								array(
									'v'  => 'form',
									't'  => 'div',
									'tc' => 'content-form__form a-up a-delay-1',
								)
							);
							?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<?php
	endwhile;
endif;
?>
<?php
get_footer();

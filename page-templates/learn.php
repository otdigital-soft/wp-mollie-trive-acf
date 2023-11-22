<?php
/**
 * Template Name: Learn
 * Template Post Type: page
 */

get_header();
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

<?php
$type         = get_field( 'type' );
$gallery      = get_field( 'gallery' );
$video        = get_field( 'video' );
$video_poster = get_field( 'video_poster' );
?>
<?php if ( 'gallery' == $type ) : ?>
<!-- Learn Scroll Gallery -->
<section class="learn-scroll">
	<div class="container-fluid learn-scroll__inner">
		<?php if ( $gallery ) : ?>
		<div class="learn-scroll__media">
			<?php foreach ( $gallery as $key => $image ) : ?>
				<img src="<?php echo esc_url( $image['sizes']['full-content-image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="learn-scroll__img">
				<?php if ( 0 === $key ) : ?>
					<div class="learn-scroll__content d-sm-only">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'heading',
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
								'v'  => 'content',
								't'  => 'div',
								'tc' => 'section-copy a-up a-delay-1',
								'o'  => 'f',
							)
						);
						?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<div class="learn-scroll__content d-md-only">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'heading',
					't'  => 'h2',
					'tc' => 'h3 section-heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'content',
					't'  => 'div',
					'tc' => 'section-copy a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
		</div>
	</div>
</section>
<?php else : ?>
<!-- Learn Video -->
<section class="learn-video">
	<div class="container">
		<?php if ( $video ) : ?>
			<div class="learn-video__video">
				<video class="a-up" src="<?php echo esc_url( $video ); ?>" preload="metadata"<?php echo $video_poster ? ' poster="' . $video_poster . '"' : ''; ?>>
					<source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
				</video>
				<div class="learn-video__controls">
					<button class="learn-video__play a-up a-delay-1">
						<svg class="state--play" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M12 6.5L0.0468744 12.9952L0.046875 0.00480886L12 6.5Z" fill="#58281D"/>
						</svg>
						<svg class="state--pause" width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M0 0H4V13H0V0Z" fill="#58281D"/>
							<path d="M8 0H12V13H8V0Z" fill="#58281D"/>
						</svg>
						<span class="state--play"><?php echo esc_html__( 'Play', 'am' ); ?></span>
						<span class="state--pause"><?php echo esc_html__( 'Pause', 'am' ); ?></span>
					</button>
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'video_caption',
							't'  => 'p',
							'tc' => 'learn-video__caption a-up a-delay-2',
							'o'  => 'f',
						)
					);
					?>
				</div>
			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col col-md-6"></div>
			<div class="col col-md-6">
				<div class="learn-video__content">
					<?php
					get_template_part_args(
						'template-parts/content-modules-text',
						array(
							'v'  => 'heading',
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
							'v'  => 'content',
							't'  => 'div',
							'tc' => 'section-copy a-up a-delay-1',
							'o'  => 'f',
						)
					);
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Learning Content Image -->
<section class="full-content-image learning-rest">
	<div class="container full-content-image__inner">
		<div class="full-content-image__content learning-rest__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_heading',
					't'  => 'h2',
					'tc' => 'h1 section-heading a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_sub_heading',
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
					'v'  => 's2_content',
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
					'v' => 's2_cta',
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
						'v'     => 's2_image',
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
						'v'  => 's2_caption',
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

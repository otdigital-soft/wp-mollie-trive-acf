<?php
/**
 * Template Name: Home
 * Template Post Type: page
 */
get_header();
?>
<?php
$video        = get_field( 'video' );
$poster_image = get_field( 'poster_image' );
$gallery      = get_field( 's1_gallery' );
?>
<!-- Banner -->
<section class="hp-banner">
	<div class="hp-banner__bg bg-cover">
		<?php
		if ( $gallery ) :
			// show random image base on time
			$image = $gallery[ (int) date( 's' ) % count( $gallery ) ];
			?>
			<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
			<?php
		else :
			get_template_part(
				'template-parts/content-modules',
				'media',
				array(
					'video' => $video,
					'image' => $poster_image,
				)
			);
		endif;
		?>
	</div>
	<?php
	get_template_part_args(
		'template-parts/content-modules-image',
		array(
			'v' => 'big_image',
			'c' => 'hp-banner__img hp-banner__img--big',
			'o' => 'f',
		)
	);
	?>
	<?php
	get_template_part_args(
		'template-parts/content-modules-image',
		array(
			'v' => 'small_image',
			'c' => 'hp-banner__img hp-banner__img--small',
			'o' => 'f',
		)
	);
	?>
	<div class="hp-banner__content d-md-only">
		<div class="container-fluid">
			<div class="row">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'banner_heading',
						't'  => 'h6',
						'tc' => 'hp-banner__heading a-up',
						'w'  => 'div',
						'wc' => 'col col-md-6',
						'o'  => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'banner_cite',
						't'  => 'p',
						'tc' => 'hp-banner__cite a-up a-delay-1',
						'w'  => 'div',
						'wc' => 'col col-md-6 text-right',
						'o'  => 'f',
					)
				);
				?>
			</div>
		</div>
	</div>
	<button class="btn-scroll-next d-md-only" aria-label="<?php echo esc_attr( 'Scroll More' ); ?>">
		<?php echo esc_html__( 'Scroll More', 'am' ); ?>
	</button>
</section>

<?php
$hotel_image = get_field( 's2_image' );
$hotel_video = get_field( 's2_video' );
?>
<!-- Hotel -->
<section class="hp-hotel full-content-image">
	<div class="container full-content-image__inner">
		<div class="hp-hotel__content full-content-image__content">
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
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_heading',
					't'  => 'h1',
					'tc' => 'section-heading a-up',
					'o'  => 'f',
				)
			);
			?>
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
			<div class="section-buttons a-up a-delay-3">
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's2_button',
						'c' => 'btn btn-outline',
						'w' => 'div',
						'o' => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's2_cta',
						'c' => 'link',
						'w' => 'div',
						'o' => 'f',
					)
				);
				?>
			</div>
		</div>
		<?php if ( $hotel_image || $hotel_video ) : ?>
		<div class="hp-hotel__media a-up">
			<div class="hp-hotel__video bg-cover">
				<?php
				get_template_part(
					'template-parts/content-modules',
					'media',
					array(
						'video' => $hotel_video,
						'image' => $hotel_image,
						'size'  => 'full-content-image',
					)
				);
				?>
			</div>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's2_caption',
					't'  => 'p',
					'tc' => 'hp-hotel__media-caption d-md-only a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php $gallery = get_field( 's3_gallery' ); ?>
<!-- Rooms -->
<section class="hp-rooms full-content-image">
	<div class="container full-content-image__inner">
		<div class="hp-rooms__left full-content-image__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's3_heading',
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
					'v'  => 's3_sub_heading',
					't'  => 'h6',
					'tc' => 'section-subheading a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's3_content',
					't'  => 'div',
					'tc' => 'section-copy a-up a-delay-2',
					'o'  => 'f',
				)
			);
			?>
			<div class="section-buttons a-up a-delay-3">
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's3_button',
						'c' => 'btn btn-outline',
						'w' => 'div',
						'o' => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's3_cta',
						'c' => 'link',
						'w' => 'div',
						'o' => 'f',
					)
				);
				?>
			</div>
		</div>
		<?php if ( $gallery ) : ?>
			<div class="hp-rooms__right a-op a-delay-1">
				<div class="hp-rooms__thumbnails">
					<?php foreach ( $gallery as $image ) : ?>
						<div class="hp-rooms__thumbnail bg-cover">
							<img src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
						</div>
					<?php endforeach; ?>
				</div>
				<div class="hp-rooms__carousel">
					<?php foreach ( $gallery as $image ) : ?>
						<a href="<?php echo esc_url( $image['url'] ); ?>" class="hp-rooms__slide bg-cover" data-fancybox="gallery">
							<img src="<?php echo esc_url( $image['sizes']['full-content-image'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
							<span class="hp-rooms__slide-fancybox">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-plus.svg' ); ?>" alt="<?php echo esc_html__( 'Open Lightbox', 'am' ); ?>" loading="lazy">
							</span>
						</a>
					<?php endforeach; ?>
				</div>
				<div class="hp-rooms__caption d-md-only">
					<?php foreach ( $gallery as $image ) : ?>
						<p class="text-caption">
							<?php echo esc_html( $image['caption'] ); ?>
						</p>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- Taste -->
<section class="hp-taste full-content-image" id="taste">
	<div class="container full-content-image__inner">
		<?php if ( have_rows( 'tab' ) ) : ?>
		<div class="hp-taste__media">
			<?php
			while ( have_rows( 'tab' ) ) :
				the_row();
				$image = get_sub_field( 'image' );
				if ( $image ) :
					?>
					<div class="hp-taste__slide bg-cover<?php echo 1 == get_row_index() ? ' is-active' : ''; ?>">
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
					</div>
					<?php
				endif;
			endwhile;
			?>
		</div>
		<?php endif; ?>
		<div class="hp-taste__content full-content-image__content">
			<div class="hp-taste__top">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 's4_heading',
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
						'v'  => 's4_sub_heading',
						't'  => 'h6',
						'tc' => 'section-subheading a-up a-delay-1',
						'o'  => 'f',
					)
				);
				?>
			</div>
			<?php if ( have_rows( 'tab' ) ) : ?>
				<div class="hp-taste__links a-up a-delay-2">
					<?php
					while ( have_rows( 'tab' ) ) :
						the_row();
						$link = get_sub_field( 'link' );
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
			<?php endif; ?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's4_content',
					't'  => 'div',
					'tc' => 'section-copy a-up a-delay-3',
					'o'  => 'f',
				)
			);
			?>
			<div class="section-buttons a-up a-delay-4">
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's4_button',
						'c' => 'btn btn-outline',
						'w' => 'div',
						'o' => 'f',
					)
				);
				?>
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
$full_image = get_field( 'full_image' );
$caption    = get_field( 's5_caption' );
if ( $full_image ) :
	?>
	<!-- Full Image -->
	<section class="hp-full-image">
		<a href="<?php echo esc_url( $full_image['url'] ); ?>" data-fancybox>
			<img class="hp-full-image__bg a-op" src="<?php echo esc_url( $full_image['url'] ); ?>" alt="<?php echo esc_attr( $full_image['alt'] ); ?>" loading="lazy">
		</a>
		<a href="<?php echo esc_url( $full_image['url'] ); ?>" data-fancybox>
			<span class="hp-full-image__fancybox">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-plus.svg' ); ?>" alt="<?php echo esc_html__( 'Open Lightbox', 'am' ); ?>">
			</span>
		</a>
		<?php if ( $caption ) : ?>
			<p class="hp-full-image__caption"><?php echo esc_html( $caption ); ?></p>
		<?php endif; ?>
	</section>
<?php endif; ?>

<!-- Explore -->
<section class="hp-explore full-content-image">
	<div class="container full-content-image__inner">
		<div class="hp-explore__content full-content-image__content">
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's6_heading',
					't'  => 'h2',
					'tc' => 'h1 section-heading d-md-only a-up',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's6_sub_heading',
					't'  => 'h6',
					'tc' => 'section-subheading d-md-only a-up a-delay-1',
					'o'  => 'f',
				)
			);
			?>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's6_content',
					't'  => 'div',
					'tc' => 'section-copy a-up a-delay-3',
					'o'  => 'f',
				)
			);
			?>
			<div class="section-buttons a-up a-delay-4">
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's6_button',
						'c' => 'btn btn-outline',
						'w' => 'div',
						'o' => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's6_cta',
						'c' => 'link',
						'w' => 'div',
						'o' => 'f',
					)
				);
				?>
			</div>
		</div>
		<?php if ( have_rows( 's6_tabs' ) ) : ?>
		<div class="hp-explore__media a-op">
			<div class="hp-explore__links">
				<?php
				while ( have_rows( 's6_tabs' ) ) :
					the_row();
					$link = get_sub_field( 'link' );
					if ( $link ) :
						?>
						<a class="hp-explore__link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ? $link['target'] : '_self' ); ?>">
							<?php echo esc_html( $link['title'] ); ?>
						</a>
						<?php
					endif;
				endwhile;
				?>
			</div>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 's6_heading',
					't'  => 'h2',
					'tc' => 'h1 section-heading d-sm-only',
					'o'  => 'f',
				)
			);
			?>
			<div class="hp-explore__images">
				<?php
				while ( have_rows( 's6_tabs' ) ) :
					the_row();
					$image = get_sub_field( 'image' );
					if ( $image ) :
						?>
						<div class="hp-explore__image bg-cover">
							<picture>
								<img src="<?php echo esc_url( $image['sizes']['full-content-image'] ); ?>" 
									srcset="<?php echo esc_url( $image['sizes']['full-content-image-2x'] ); ?> 2x"
									alt="<?php echo esc_attr( $image['alt'] ); ?>"
									loading="lazy">
							</picture>
						</div>
						<?php
					endif;
				endwhile;
				?>
			</div>
			<div class="hp-explore__caption d-md-only">
				<?php
				while ( have_rows( 's6_tabs' ) ) :
					the_row();
					$caption = get_sub_field( 'caption' );
					if ( $caption ) :
						?>
						<p class="text-caption">
							<?php echo esc_html( $caption ); ?>
						</p>
						<?php
					endif;
				endwhile;
				?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();

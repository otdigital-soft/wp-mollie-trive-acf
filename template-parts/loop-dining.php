<article class="loop-dining">
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="loop-dining__image bg-cover">
		<?php the_post_thumbnail( 'full' ); ?>
	</div>
	<?php endif; ?>
	<div class="loop-dining__content">
		<h5 class="loop-dining__title"><?php the_title(); ?></h5>
		<?php if ( have_rows( 'menus' ) ) : ?>
			<div class="loop-dining__menus">
				<p><?php echo esc_html__( 'Menu', 'am' ); ?></p>
				<?php
				while ( have_rows( 'menus' ) ) :
					the_row();
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v' => 'cta',
							'c' => 'underline-link',
						)
					);
				endwhile;
				?>
			</div>
		<?php endif; ?>
		<?php
		get_template_part_args(
			'template-parts/content-modules-cta',
			array(
				'v' => 'reserve_cta',
				'c' => 'btn btn-outline btn-reserve d-md-only',
				'o' => 'f',
			)
		);
		?>
	</div>
</article>

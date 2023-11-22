<?php if ( has_post_thumbnail() ) : ?>
	<!-- Base Banner -->
	<section class="full-height-banner">
		<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="" class="full-height-banner__bg">
		<div class="container">
			<h1 class="full-height-banner__heading a-up"><?php the_title(); ?></h1>
			<!-- <button class="btn-scroll-next a-op a-delay-1"><?php echo esc_html__( 'Explore', 'am' ); ?></button> -->
		</div>
	</section>
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
<?php else : ?>
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
					<h1 class="default-banner__title a-up"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<section class="page-content">
	<div class="container basic-editor">
		<?php the_content(); ?>
	</div>
</section>

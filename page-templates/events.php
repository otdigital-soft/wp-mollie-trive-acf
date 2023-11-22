<?php
/**
 * Template Name: Events
 * Template Post Type: page
 */
get_header();
?>

<section class="default-banner default-banner--images">
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
				<div class="default-banner__images a-up a-delay-1">
					<div class="default-banner__image">
						<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="default-banner__link is-active">
							<?php echo esc_html__( 'Events', 'am' ); ?>
						</a>
					</div>
					<div class="default-banner__image">
						<a href="<?php echo esc_url( home_url( '/events-calendar/' ) ); ?>" class="default-banner__link">
							<?php echo esc_html__( 'Events Calendar', 'am' ); ?>
						</a>
					</div>
				</div>
				<h1 class="default-banner__title a-up"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</section>
<!-- Navigation -->
<section class="page-navigation">
	<div class="container">
		<ul>
			<li>
				<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="page-navigation__link is-active">
					<?php echo esc_html__( 'Events', 'am' ); ?>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/events-calendar/' ) ); ?>" class="page-navigation__link">
					<?php echo esc_html__( 'Events Calendar', 'am' ); ?>
				</a>
			</li>
		</ul>
	</div>
</section>

<?php
	$events = tribe_get_events(
		array(
			'posts_per_page' => -1,
		)
	);
	if ( $events ) :
		?>
	<section class="events-list">
		<?php
		foreach ( $events as $post ) :
			setup_postdata( $post );
			get_template_part( 'template-parts/loop', 'event' );
			?>
		<?php endforeach; ?>
	</div>
		<?php
	endif;
	wp_reset_postdata();
	?>

<section class="events-calendar">
	<div class="container">
		<div class="row">
			<div class="col col-md-6">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 's2_heading',
						't'  => 'h2',
						'tc' => 'section-heading events-calendar__heading a-up',
						'o'  => 'f',
					)
				);
				?>
			</div>
			<div class="col col-md-6">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 's2_content',
						't'  => 'div',
						'tc' => 'section-copy a-up a-delay-1',
						'o'  => 'f',
					)
				);
				?>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 's2_cta',
						'c' => 'link a-up a-delay-2',
						'o' => 'f',
					)
				);
				?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();

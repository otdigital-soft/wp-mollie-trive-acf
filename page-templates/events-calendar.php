<?php
/**
 * Template Name: Events Calendar
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
						<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="default-banner__link">
							<?php echo esc_html__( 'Events', 'am' ); ?>
						</a>
					</div>
					<div class="default-banner__image">
						<a href="<?php echo esc_url( home_url( '/events-calendar/' ) ); ?>" class="default-banner__link is-active">
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
				<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="page-navigation__link">
					<?php echo esc_html__( 'Events', 'am' ); ?>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url( home_url( '/events-calendar/' ) ); ?>" class="page-navigation__link is-active">
					<?php echo esc_html__( 'Events Calendar', 'am' ); ?>
				</a>
			</li>
		</ul>
	</div>
</section>

<section class="calendar">
    <div class="container">
        <!-- Tribe event calendar shortcode -->
        <?php echo do_shortcode( '[tribe_events view="month"]' ); ?>
    </div>
</section>
<?php
get_footer();

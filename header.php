<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<?php wp_head(); ?>

	<?php
	get_template_part_args(
		'template-parts/content-modules-text',
		array(
			'v' => 'begin_head',
			'o' => 'o',
		)
	);
	?>
</head>

<body <?php body_class(); ?>>
	<?php
	get_template_part_args(
		'template-parts/content-modules-text',
		array(
			'v' => 'begin_body',
			'o' => 'o',
		)
	);
	?>
	<?php
	$address = get_field( 'address', 'option' );
	$phone   = get_field( 'phone', 'option' );
	$email   = get_field( 'email', 'option' );

	$header_theme = 'light';
	$logo         = 'logo';
	if ( is_page_template( 'page-templates/learn.php' ) || is_page_template( 'page-templates/blog.php' ) || is_page_template( 'page-templates/packages.php' ) 
		|| is_singular( 'package' ) || is_page_template( 'page-templates/events.php' ) || is_singular( 'event' ) || is_page_template( 'page-templates/events-calendar.php' ) || is_singular( 'tribe_events' )
		|| is_page_template( 'page-templates/gallery.php' ) || ( is_page() && ! is_page_template() && ! has_post_thumbnail() ) || is_category() ) {
		$header_theme = 'dark';
		$logo         = 'dark_logo';
	}
	?>
	<!-- Header -->
	<header class="header header--<?php echo esc_attr( $header_theme ); ?>">
		<div class="container-fluid">
			<div class="header-inner">
				<button class="hamburger">
					<span></span>
				</button>
				<a href="<?php echo esc_url( home_url() ); ?>" class="header-logo">
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v' => $logo,
							'c' => 'header-logo__image',
							'o' => 'o',
						)
					);
					?>
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v' => 'logo_scroll',
							'c' => 'header-logo__scroll',
							'o' => 'o',
						)
					);
					?>
				</a>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'booking_cta',
						'c' => 'btn btn-outline header-booking d-md-only',
						'o' => 'o',
					)
				);
				?>
				<!-- <button class="btn btn-outline header-booking btn-booking-popup d-md-only">
					<?php echo esc_html__( 'Book Your Stay', 'am' ); ?>
				</button> -->
			</div>
		</div>
		<div class="header-menu">
			<div class="container-fluid">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'headermenu',
						'container'      => 'nav',
						'menu_class'     => 'header-nav',
					)
				);
				?>
				<?php if ( $address || $phone || $email ) : ?>
				<div class="header-information text-lg">
					<?php
					get_template_part_args(
						'template-parts/content-modules-cta',
						array(
							'v' => 'address',
							'o' => 'o',
						)
					);
					?>
					<?php if ( $phone ) : ?>
						<a href="tel:<?php echo esc_attr( $phone ); ?>">
							<?php echo esc_html( $phone ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<a href="mailto:<?php echo esc_attr( $email ); ?>" aria-label="<?php echo esc_html__( 'Email', 'am' ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon-sms.svg' ); ?>" alt="<?php echo esc_html__( 'Email', 'am' ); ?>">
						</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</header>
	<!-- /Header -->
	<!-- Main -->
	<main class="main" role="main"<?php echo is_page_template( 'page-templates/home.php' ) ? ' id="fullpage"' : ''; ?>>

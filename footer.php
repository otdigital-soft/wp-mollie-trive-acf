	</main>
	<!-- /Main -->
	<!-- Footer -->
	<footer class="footer">
		<div class="container-fluid">
			<div class="footer-logo__wrapper d-sm-only">
				<a href="<?php echo esc_url( home_url() ); ?>" class="footer-logo a-up">
					<?php
					get_template_part_args(
						'template-parts/content-modules-image',
						array(
							'v'     => 'footer_logo',
							'v2x'   => false,
							'is'    => false,
							'is_2x' => false,
							'c'     => 'footer-logo__img',
							'o'     => 'o',
						)
					);
					?>
				</a>
			</div>
			<div class="footer-main">
				<div class="row">
					<div class="col col-md-4 footer-main__left a-op a-delay-1">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'footer_information',
								't'  => 'div',
								'tc' => 'footer-info d-sm-only',
								'o'  => 'o',
							)
						);
						?>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footermenu',
								'container'      => false,
								'menu_class'     => 'footer-menu',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'footer_image',
								'v2x'   => false,
								'is'    => false,
								'is_2x' => false,
								'c'     => 'footer-image',
								'w'     => 'div',
								'wc'    => 'd-sm-only footer-image__wrapper',
								'o'     => 'o',
							)
						);
						?>
						<!-- <div class="footer-form">
							<iframe src="https://tcgms.net/app/new/Nzc4ODU5MjA0NQ?languageCode=df"></iframe>
						</div> -->
						<?php
						get_template_part_args(
							'template-parts/content-modules-shortcode',
							array(
								'v'  => 'footer_form',
								't'  => 'div',
								'tc' => 'footer-form',
								'o'  => 'o',
							)
						);
						?>
					</div>
					<div class="col col-md-4 text-center a-op a-delay-2 d-md-only">
						<a href="<?php echo esc_url( home_url() ); ?>" class="footer-logo a-up">
							<?php
							get_template_part_args(
								'template-parts/content-modules-image',
								array(
									'v'     => 'footer_logo',
									'v2x'   => false,
									'is'    => false,
									'is_2x' => false,
									'c'     => 'footer-logo__img d-md-only',
									'o'     => 'o',
								)
							);
							?>
						</a>
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'footer_image',
								'v2x'   => false,
								'is'    => false,
								'is_2x' => false,
								'c'     => 'footer-image',
								'o'     => 'o',
							)
						);
						?>
					</div>
					<div class="col col-md-4 footer-main__right a-op a-delay-3">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'footer_information',
								't'  => 'div',
								'tc' => 'footer-info d-md-only',
								'o'  => 'o',
							)
						);
						?>
						<div class="footer-bottom">
							<?php if ( have_rows( 'footer_socials', 'options' ) ) : ?>
							<ul class="footer-bottom-menu">
								<?php
								while ( have_rows( 'footer_socials', 'options' ) ) :
									the_row();
									$icon = get_sub_field( 'icon' );
									$link = get_sub_field( 'link' );
									if ( $link ) :
										?>
										<li class="menu-item">
											<a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank">
												<?php if ( $icon ) : ?>
													<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>">
												<?php else : ?>
													<?php echo esc_html( $link['title'] ); ?>
												<?php endif; ?>
											</a>
										</li>
										<?php
									endif;
								endwhile;
								?>
							</ul>
							<?php endif; ?>
							<p class="footer-copyright"><?php echo esc_html__( 'Copyright', 'am' ); ?> &copy; <?php echo esc_html( gmdate( 'Y' ) ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /Footer -->

	<!-- Sticky Book Now Mobile Button -->
	<?php
	get_template_part_args(
		'template-parts/content-modules-cta',
		array(
			'v' => 'booking_cta',
			'c' => 'btn btn-outline sticky-booking-btn d-sm-only',
			'o' => 'o',
		)
	);
	?>
	<!-- <button class="btn btn-outline sticky-booking-btn btn-booking-popup d-sm-only">
		<?php echo esc_html__( 'Book Your Stay', 'am' ); ?>
	</button> -->
	<!-- /Sticky Book Now Mobile Button -->

	<!-- Booking Popup -->
	<?php $booking_cta = get_field( 'booking_cta', 'options' ); ?>
	<div class="booking-popup" data-default-url="<?php echo esc_url( $booking_cta['url'] ); ?>">
		<div class="booking-popup__inner">
			<div class="booking-popup__header">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'booking_heading',
						't'  => 'h6',
						'tc' => 'booking-popup__title',
						'o'  => 'o',
					)
				);
				?>
				<button class="booking-popup__close">
					<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
						<line x1="0.707107" y1="0.875901" x2="18.1238" y2="18.2926" stroke="black" stroke-width="2"/>
						<line x1="18.1241" y1="0.707107" x2="0.707433" y2="18.1238" stroke="black" stroke-width="2"/>
					</svg>
				</button>
			</div>
			<div class="booking-popup__body">
				<div class="booking-popup__calendar">
					<input type="text" class="booking-popup__calendar--range" id="booking-popup__calendar--range">
					<div class="booking-popup__calendar--calendar" id="booking-popup__calendar--calendar">
					</div>
				</div>
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'booking_cta',
						'c' => 'btn btn-outline booking-submit',
						'o' => 'o',
					)
				);
				?>
			</div>
		</div>
	</div>

	<button id="ot-sdk-btn" class="ot-sdk-show-settings">
		Cookie Settings
	</button>

	<?php wp_footer(); ?>

	<?php
	get_template_part_args(
		'template-parts/content-modules-text',
		array(
			'v' => 'end_body',
			'o' => 'o',
		)
	);
	?>
</body>
</html>

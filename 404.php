<?php
/**
 * 404 Template
 */
get_header();
?>
<section class="error-404">
	<div class="container">
		<h1 class="error-404__heading a-up">404</h1>
		<a href="<?php echo esc_url( home_url() ); ?>" class="link error-404__link a-up a-delay-1">
			<?php echo esc_html__( 'Back to Homepage', 'am' ); ?>
		</a>
	</div>
</section>
<?php
get_footer();

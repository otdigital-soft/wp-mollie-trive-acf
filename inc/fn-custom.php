<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hades
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function theme_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'theme_body_classes' );

// Styling login form
function my_login_stylesheet() {
	wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/style-login.css' );
	// wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );


// disable for post types
// add_filter('use_block_editor_for_post_type', '__return_false', 10);
// add_action('init', 'my_remove_editor_from_post_type');
// function my_remove_editor_from_post_type() {
// remove_post_type_support( 'page', 'editor' );
// }

add_post_type_support( 'page', 'excerpt' );

// ** *Enable upload for webp image files.*/
function webp_upload_mimes( $existing_mimes ) {
	$existing_mimes['webp'] = 'image/webp';
	return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

// Wp ajax init
add_action( 'wp_head', 'my_wp_ajaxurl' );
function my_wp_ajaxurl() {
	$url = parse_url( home_url() );
	if ( $url['scheme'] == 'https' ) {
		$protocol = 'https';
	} else {
		$protocol = 'http';
	}
	?>
	<?php global $wp_query; ?>
	<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', $protocol ); ?>';
	</script>
	<?php
}
/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $template_args array
 *
 * @param string $file template file url
 * @param mixed  $template_args style argument list
 * @param mixed  $cache_args cache args
 *  https://wordpress.stackexchange.com/questions/176804/passing-a-variable-to-get-template-part
 */
function get_template_part_args( $file, $template_args = array(), $cache_args = array() ) {
	$template_args = wp_parse_args( $template_args );
	$cache_args    = wp_parse_args( $cache_args );
	if ( $cache_args ) {
		foreach ( $template_args as $key => $value ) {
			if ( is_scalar( $value ) || is_array( $value ) ) {
				$cache_args[ $key ] = $value;
			} elseif ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
				$cache_args[ $key ] = call_user_func( 'get_id', $value );
			}
		}
		// phpcs:disabled WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize
		$cache = wp_cache_get( $file, serialize( $cache_args ) );
		if ( false !== $cache ) {
			if ( ! empty( $template_args['return'] ) ) {
				return $cache;
			}
			// phpcs:disabled WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $cache;
			return;
		}
	}
	$file_handle = $file;
	do_action( 'start_operation', 'hm_template_part::' . $file_handle );
	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) ) {
		$file = get_stylesheet_directory() . '/' . $file . '.php';
	} elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) ) {
		$file = get_template_directory() . '/' . $file . '.php';
	}
	ob_start();
	$return = require $file;
	$data   = ob_get_clean();
	do_action( 'end_operation', 'hm_template_part::' . $file_handle );
	if ( $cache_args ) {
		wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
	}
	if ( ! empty( $template_args['return'] ) ) {
		if ( false === $return ) {
			return false;
		} else {
			return $data;
		}
	}
	echo $data;
}

// Remove p tag wrap around images from post content
function filter_ptags_on_images( $content ) {
	return preg_replace( '/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content );
}
add_filter( 'the_content', 'filter_ptags_on_images' );


// Ajax Gallery
add_action( 'wp_ajax_loadAjaxGallery', 'loadAjaxGallery_handler' );
add_action( 'wp_ajax_nopriv_loadAjaxGallery', 'loadAjaxGallery_handler' );

function loadAjaxGallery_handler() {
	$id = $_POST['pid'];
	ob_start();
	$args  = array(
		'post_type'      => 'gallery',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	if ( 'all' != $id ) :
		$args['p'] = $id;
	endif;
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			global $post;
			get_template_part( 'template-parts/loop', 'gallery' );
		endwhile;
		wp_reset_postdata();
	else:
		?>
		<div class="lds-wrapper">
			<h2><?php echo esc_html__( 'There are no results', 'am' ); ?></h2>
		</div>
		<?php
	endif;
	$res         = new stdClass();
	$res->output = ob_get_clean();
	echo json_encode( $res );
	die;
}

// Ajax Locations
add_action( 'wp_ajax_loadAjaxLocations', 'loadAjaxLocations_handler' );
add_action( 'wp_ajax_nopriv_loadAjaxLocations', 'loadAjaxLocations_handler' );

function loadAjaxLocations_handler() {
	$cat = $_POST['cat'];
	ob_start();
	$args  = array(
		'post_type'      => 'location',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	if ( 'all' != $cat ) :
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'location_category',
				'terms'    => $cat,
			),
		);
	endif;
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			get_template_part( 'template-parts/loop', 'location' );
		endwhile;
		wp_reset_postdata();
	endif;
	$res         = new stdClass();
	$res->output = ob_get_clean();
	echo json_encode( $res );
	die;
}


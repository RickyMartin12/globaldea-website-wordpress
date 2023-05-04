<?php
/**
 * Function/hooks for infinite scroll feature.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.1.4
 */

function tg_infinite_scroll() {

	if ( ! wp_verify_nonce( $_POST['nonce'], 'infinite_scroll_nonce' ) ) {
		wp_die( esc_html__( 'Action failed! Please refresh page and try again.' ) );
	}

	$paged = $_POST['page'] + 1;
	$query = new WP_Query(
		array(
			'post_type'   => 'post',
			'post_status' => 'publish',
			'paged'       => $paged,
		)
	);

	if ( $query->have_posts() ) :

		while ( $query->have_posts() ) :
			$query->the_post();

			get_template_part( 'content', '' );
		endwhile;
	else :
		return 0;
	endif;

	wp_reset_postdata();

	die();
}

add_action( 'wp_ajax_nopriv_infinite_scroll_nonce', 'tg_infinite_scroll' ); // Ajax call with no privileges.
add_action( 'wp_ajax_infinite_scroll_nonce', 'tg_infinite_scroll' ); // Ajax call with privileges.



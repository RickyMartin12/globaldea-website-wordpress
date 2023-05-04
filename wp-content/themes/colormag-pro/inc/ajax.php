<?php
/**
 * Localize load more scripts.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Localizing the load more button text to add nonce and ajax url.
 */
function colormag_register_load_more_scripts() {
	wp_localize_script(
		'colormag-custom',
		'colormag_load_more',
		array(
			'tg_nonce' => wp_create_nonce( 'tg_nonce' ),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'colormag_register_load_more_scripts' );

/**
 * Ajax load more posts
 */
function colormag_get_ajax_results() {

	if ( ! isset( $_POST['tg_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['tg_nonce'] ), 'tg_nonce' ) ) {
		die( esc_html__( 'Permissions check failed.', 'colormag' ) );
	}

	$tg_pagenumber     = isset( $_POST['tg_pagenumber'] ) ? wp_unslash( $_POST['tg_pagenumber'] ) : 0;
	$tg_category       = isset( $_POST['tg_category'] ) ? wp_unslash( $_POST['tg_category'] ) : '-1';
	$tg_number         = isset( $_POST['tg_number'] ) ? wp_unslash( $_POST['tg_number'] ) : 0;
	$tg_random         = isset( $_POST['tg_random'] ) ? wp_unslash( $_POST['tg_random'] ) : 'false';
	$tg_child_category = isset( $_POST['tg_child_category'] ) ? wp_unslash( $_POST['tg_child_category'] ) : 'false';
	$tg_tag            = isset( $_POST['tg_tag'] ) ? wp_unslash( $_POST['tg_tag'] ) : '-1';
	$tg_author         = isset( $_POST['tg_author'] ) ? wp_unslash( $_POST['tg_author'] ) : '-1';
	$tg_type           = isset( $_POST['tg_type'] ) ? wp_unslash( $_POST['tg_type'] ) : 'latest';

	global $post;
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $tg_number,
		'paged'          => $tg_pagenumber,
		'post_status'    => 'publish',
	);

	// Display post from choosen category.
	if ( 'category' == $tg_type && '-1' != $tg_category && 1 != $tg_child_category ) {
		$args['category__in'] = $tg_category;
	}

	// Display post from choosen parent category.
	if ( 'category' == $tg_type && 1 == $tg_child_category && '-1' != $tg_category ) {
		$args['cat'] = $tg_category;
	}

	// Display random post.
	if ( 'true' == $tg_random ) {
		$args['orderby'] = 'rand';
	}

	// Display post from choosen tag.
	if ( 'tag' == $tg_type && '-1' != $tg_tag ) {
		$args['tag__in'] = $tg_tag;
	}

	// Display post from choosen author.
	if ( 'author' == $tg_type && '-1' != $tg_author ) {
		$args['author__in'] = $tg_author;
	}

	$featured_ajax_posts = new WP_Query( $args );

	if ( $featured_ajax_posts->have_posts() ) :
		?>
		<div class="following-post">
			<?php
			while ( $featured_ajax_posts->have_posts() ) :
				$featured_ajax_posts->the_post();
				?>

				<div class="single-article clearfix">
					<?php
					if ( has_post_thumbnail() ) {
						$image           = '';
						$thumbnail_id    = get_post_thumbnail_id( $post->ID );
						$image_alt_text  = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
						$title_attribute = get_the_title( $post->ID );
						$image_alt_text  = empty( $image_alt_text ) ? $title_attribute : $image_alt_text;

						$image .= '<figure>';
						$image .= '<a href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
						$image .= get_the_post_thumbnail(
							$post->ID,
							'colormag-featured-post-small',
							array(
								'title' => esc_attr( $title_attribute ),
								'alt'   => esc_attr( $image_alt_text ),
							)
						);
						$image .= '</a>';
						$image .= '</figure>';

						echo $image; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
					}
					?>

					<div class="article-content">
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>

						<?php colormag_entry_meta( false, true ); ?>
					</div>
				</div>
			<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>

	<?php
	endif;
}

add_action( 'wp_ajax_get_ajax_results', 'colormag_get_ajax_results' );        // For logged in users.
add_action( 'wp_ajax_nopriv_get_ajax_results', 'colormag_get_ajax_results' ); // For logged out users.

/**
 * Localize script for load more button.
 */
function colormag_load_scripts() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	wp_enqueue_script( 'colormag-loadmore', get_template_directory_uri() . '/js/loadmore' . $suffix . '.js', array(), COLORMAG_THEME_VERSION, true );
	wp_enqueue_script( 'colormag-infinite-scroll', get_template_directory_uri() . '/js/infinite-scroll' . $suffix . '.js', array(), COLORMAG_THEME_VERSION, true );
	wp_localize_script(
		'colormag-loadmore',
		'colormag_script_vars',
		array(
			'no_more_posts' => esc_html__( 'No more post', 'colormag' ),
		)
	);

	wp_localize_script(
		'colormag-infinite-scroll',
		'colormagInfiniteScroll',
		array(
			'nonce'   => wp_create_nonce( 'infinite_scroll_nonce' ),
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		)
	);

}

add_action( 'wp_enqueue_scripts', 'colormag_load_scripts' );


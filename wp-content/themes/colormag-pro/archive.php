<?php
/**
 * The template for displaying Archive page.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/**
 * Hook: colormag_before_body_content.
 */
do_action( 'colormag_before_body_content' );
?>

	<?php colormag_two_sidebar_select(); ?>

	<div id="primary">
		<div id="content" class="clearfix">

			<?php
			if ( have_posts() ) :

				/**
				 * Functions hooked into colormag_action_archive_header action.
				 *
				 * @hooked colormag_archive_header - 10
				 */
				do_action( 'colormag_action_archive_header' );

				/**
				 * Hook: colormag_before_archive_page_loop.
				 */
				do_action( 'colormag_before_archive_page_loop' );
				?>

				<?php if ( 'infinite_scroll' === get_theme_mod( 'colormag_post_pagination', 'default' ) ) { ?>
					<div class="article-container tg-infinite-scroll-container">
				<?php } ?>

				<?php if ( 'default' === get_theme_mod( 'colormag_post_pagination', 'default' ) ) { ?>
					<div class="article-container">
				<?php } ?>

					<?php
					while ( have_posts() ) :
						the_post();

						/**
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'content', 'archive' );
					endwhile;
					?>

				</div>

				<?php
				/**
				 * Hook: colormag_after_archive_page_loop.
				 */
				if ( 'default' === get_theme_mod( 'colormag_post_pagination', 'default' ) ) :
					/**
					 * Hook: colormag_after_archive_page_loop.
					 */
					do_action( 'colormag_after_archive_page_loop' );

					if ( true === apply_filters( 'colormag_front_page_navigation_filter', true ) ) :
						get_template_part( 'navigation', 'none' );
					endif;
				endif;

			else :

				if ( true === apply_filters( 'colormag_archive_page_no_results_filter', true ) ) :
					get_template_part( 'no-results', 'archive' );
				endif;

			endif;
			?>
		</div><!-- #content -->

			<?php if ( 'infinite_scroll' === get_theme_mod( 'colormag_post_pagination', 'default' ) ) { ?>
				<div class="infinite-scroll clearfix">
					<a href="#" onclick="return false;" class="tg-infinite-scroll tg-infinite-scroll-button" data-page="1"
					   data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>">
						<div class="infinite-scroll-text"><div class="load-more-icon display"><div class="spinner"></div></div><span class="load-more-text"> Load more </span>
						</div>
					</a>
				</div>
			<?php } ?>
	</div><!-- #primary -->

<?php
colormag_sidebar_select();

/**
 * Hook: colormag_after_body_content.
 */
do_action( 'colormag_after_body_content' );

get_footer();

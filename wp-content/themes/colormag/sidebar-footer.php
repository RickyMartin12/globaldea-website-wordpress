<?php
/**
 * The Sidebar containing the footer widget areas.
 *
 * @package ThemeGrill
 * @subpackage ColorMag
 * @since ColorMag 1.0
 */
?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if( !is_active_sidebar( 'colormag_footer_sidebar_one' ) &&
	!is_active_sidebar( 'colormag_footer_sidebar_two' ) &&
   !is_active_sidebar( 'colormag_footer_sidebar_three' ) &&
   !is_active_sidebar( 'colormag_footer_sidebar_four' ) ) {
	return;
}
?>
<div class="footer-widgets-wrapper">
	
</div>
<?php

/**
 * Search
 *
 * @package BuddyBoss\Theme
 */

?>

<form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<div>
		<label class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search Forums&hellip;', 'buddyboss' ); ?></label>
		<input type="hidden" name="action" value="bbp-search-request" />
		
		<input tabindex="<?php bbp_tab_index(); ?>" class="button" type="submit" id="bbp_search_submit" value="<?php esc_attr_e( 'Search', 'buddyboss' ); ?>" />
	</div>
</form>

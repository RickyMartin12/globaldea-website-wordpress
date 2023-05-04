<?php

/**
 * ColorMag functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 *
 * @uses       add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses       register_nav_menu() To add support for navigation menu.
 * @uses       set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */
// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Define Theme Constants.
 */
$theme = wp_get_theme( 'colormag-pro' );
define( 'COLORMAG_THEME_VERSION', $theme['Version'] );
/**
 * Define Directory Location Constants
 */
define( 'COLORMAG_PARENT_DIR', get_template_directory() );
define( 'COLORMAG_CHILD_DIR', get_stylesheet_directory() );
define( 'COLORMAG_INCLUDES_DIR', COLORMAG_PARENT_DIR . '/inc' );
define( 'COLORMAG_CSS_DIR', COLORMAG_PARENT_DIR . '/css' );
define( 'COLORMAG_JS_DIR', COLORMAG_PARENT_DIR . '/js' );
define( 'COLORMAG_LANGUAGES_DIR', COLORMAG_PARENT_DIR . '/languages' );
define( 'COLORMAG_ADMIN_DIR', COLORMAG_INCLUDES_DIR . '/admin' );
define( 'COLORMAG_WIDGETS_DIR', COLORMAG_INCLUDES_DIR . '/widgets' );
define( 'COLORMAG_CUSTOMIZER_DIR', COLORMAG_INCLUDES_DIR . '/customizer' );
define( 'COLORMAG_ELEMENTOR_DIR', COLORMAG_INCLUDES_DIR . '/elementor' );
define( 'COLORMAG_ELEMENTOR_WIDGETS_DIR', COLORMAG_ELEMENTOR_DIR . '/widgets' );
define( 'COLORMAG_ADMIN_IMAGES_DIR', COLORMAG_ADMIN_DIR . '/images' );
/**
 * Define URL Location Constants
 */
define( 'COLORMAG_PARENT_URL', get_template_directory_uri() );
define( 'COLORMAG_CHILD_URL', get_stylesheet_directory_uri() );
define( 'COLORMAG_INCLUDES_URL', COLORMAG_PARENT_URL . '/inc' );
define( 'COLORMAG_CSS_URL', COLORMAG_PARENT_URL . '/css' );
define( 'COLORMAG_JS_URL', COLORMAG_PARENT_URL . '/js' );
define( 'COLORMAG_LANGUAGES_URL', COLORMAG_PARENT_URL . '/languages' );
define( 'COLORMAG_ADMIN_URL', COLORMAG_INCLUDES_URL . '/admin' );
define( 'COLORMAG_WIDGETS_URL', COLORMAG_INCLUDES_URL . '/widgets' );
define( 'COLORMAG_CUSTOMIZER_URL', COLORMAG_INCLUDES_URL . '/customizer' );
define( 'COLORMAG_ELEMENTOR_URL', COLORMAG_INCLUDES_URL . '/elementor' );
define( 'COLORMAG_ELEMENTOR_WIDGETS_URL', COLORMAG_ELEMENTOR_URL . '/widgets' );
define( 'COLORMAG_ADMIN_IMAGES_URL', COLORMAG_ADMIN_URL . '/images' );
/** Migrating customize options */
require COLORMAG_INCLUDES_DIR . '/class-colormag-options-migrate.php';
/** ColorMag setup file, hooked for `after_setup_theme`. */
require COLORMAG_INCLUDES_DIR . '/colormag-setup.php';
/** ColorMag content width file. */
require COLORMAG_INCLUDES_DIR . '/colormag-content-width.php';
/** Schema markup file include. */
require_once COLORMAG_INCLUDES_DIR . '/schema-markup.php';
/** Helper functions. */
require COLORMAG_INCLUDES_DIR . '/helper-functions.php';
/** Template functions files. */
require COLORMAG_INCLUDES_DIR . '/template-tags.php';
require COLORMAG_INCLUDES_DIR . '/template-functions.php';
/** WP_Query functions files. */
require COLORMAG_INCLUDES_DIR . '/colormag-wp-query.php';
/** Dynamic class file include. */
require_once COLORMAG_INCLUDES_DIR . '/colormag-dynamic-classes.php';
/**
 * Load required theme hook files.
 */
require_once COLORMAG_INCLUDES_DIR . '/hooks/hooks.php';
require_once COLORMAG_INCLUDES_DIR . '/hooks/header.php';
require_once COLORMAG_INCLUDES_DIR . '/hooks/content.php';
require_once COLORMAG_INCLUDES_DIR . '/hooks/footer.php';
/** Load functions */
require_once COLORMAG_INCLUDES_DIR . '/custom-header.php';
require_once COLORMAG_INCLUDES_DIR . '/infinite-scroll.php';
require_once COLORMAG_CUSTOMIZER_DIR . '/class-colormag-customizer.php';
require_once COLORMAG_INCLUDES_DIR . '/enqueue-scripts.php';
require_once COLORMAG_INCLUDES_DIR . '/class-colormag-dynamic-css.php';
require_once COLORMAG_INCLUDES_DIR . '/ajax.php';
/** Add the JetPack plugin support */
if ( defined( 'JETPACK__VERSION' ) ) {
    require_once COLORMAG_INCLUDES_DIR . '/jetpack.php';
}
/** Add the WooCommerce plugin support */
if ( class_exists( 'WooCommerce' ) ) {
    require_once COLORMAG_INCLUDES_DIR . '/woocommerce.php';
}
/** Add the Elementor compatibility file */

if ( defined( 'ELEMENTOR_VERSION' ) ) {
    require_once COLORMAG_ELEMENTOR_DIR . '/elementor.php';
    require_once COLORMAG_ELEMENTOR_DIR . '/elementor-functions.php';
}

/** Add meta boxes. */
require_once COLORMAG_INCLUDES_DIR . '/meta-boxes/class-colormag-meta-boxes.php';
require_once COLORMAG_INCLUDES_DIR . '/meta-boxes/class-colormag-meta-box-page-settings.php';
/** Load Widgets and Widgetized Area */
require_once COLORMAG_WIDGETS_DIR . '/widgets.php';
/** Load demo import migration scripts. */
require_once COLORMAG_INCLUDES_DIR . '/demo-import-migration.php';
/** Load migration scripts. */
require_once COLORMAG_INCLUDES_DIR . '/migration.php';
/**
 * Load deprecated functions.
 */
require_once COLORMAG_INCLUDES_DIR . '/deprecated/deprecated-filters.php';
require_once COLORMAG_INCLUDES_DIR . '/deprecated/deprecated-functions.php';
require_once COLORMAG_INCLUDES_DIR . '/deprecated/deprecated-hooks.php';
/**
 * Load ColorMag Pro Demo Importer compatibility file.
 */
require get_template_directory() . '/inc/demo-importer/class-demo-importer.php';
/**
 * Detect plugin. For use on Front End only.
 */
include_once ABSPATH . 'wp-admin/includes/plugin.php';
#--------------------------------------------------------------------------------
#region Freemius
#--------------------------------------------------------------------------------
class FS_ThemeGrill
{
    /**
     * Instance.
     *
     * @var Freemius
     */
    private static  $fs ;
    /**
     * Self instance.
     *
     * @return Freemius
     */
    public static function freemius()
    {
        return self::$fs;
    }
    
    /**
     * Constructor.
     *
     * FS_ThemeGrill constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Init freemius.
     *
     * @param string $id         The id of the product.
     * @param string $slug       The slug of the product.
     * @param string $public_key The public key of the product.
     * @param string $name       The product name.
     *
     * @return \Freemius
     * @throws \Freemius_Exception Thrown when an API call returns an exception.
     */
    public static function init(
        $id,
        $slug,
        $public_key,
        $name = ''
    )
    {
        
        if ( !isset( self::$fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            self::$fs = fs_dynamic_init( array(
                'id'              => $id,
                'slug'            => $slug,
                'premium_slug'    => "{$slug}-pro",
                'type'            => 'theme',
                'public_key'      => $public_key,
                'is_premium'      => true,
                'is_premium_only' => true,
                'premium_suffix'  => 'Pro',
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'menu'            => array(
                'slug'    => 'themegrill_submenu',
                'support' => false,
                'parent'  => array(
                'slug' => 'options-general.php',
            ),
            ),
                'is_live'         => true,
            ) );
            // Signal that SDK was initiated.
            do_action( "{$slug}_fs_loaded" );
            require_once dirname( __FILE__ ) . '/inc/freemius-migration.php';
            if ( empty($name) ) {
                $name = ucwords( str_replace( '-', ' ', $slug ) );
            }
            new FS_ThemeGrill_License_Menu( $name, $slug );
            new FS_ThemeGrill_License_Migration( self::$fs, "api_manager_theme_{$slug}", $slug );
        }
        
        return self::$fs;
    }

}
FS_ThemeGrill::init(
    '4212',
    'colormag',
    'pk_414d89e1f7eda2dd7de41050ab418',
    'ColorMag'
);
#endregion
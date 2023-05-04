<?php  # -*- coding: utf-8 -*-
/**
 * Plugin Name: T5 Admin Menu Demo
 * Description: Load scripts and styles on specific admin menu pages
 * Plugin URI:  https://github.com/toscho/T5-Admin-Menu-Demo
 * Version:     2013.03.29
 * Author:      Fuxia Scholz
 * Author URI:  https://fuxia.me
 * Licence:     MIT
 * License URI: http://opensource.org/licenses/MIT
 */

/* call our code on admin pages only, not on front end requests or during
 * AJAX calls.
 * Always wait for the last possible hook to start your code.
 */
add_action( 'admin_menu', array ( 'T5_Admin_Page_Demo', 'admin_menu' ) );

/**
 * Register three admin pages and add a stylesheet and a javascript to two of
 * them only.
 */
class T5_Admin_Page_Demo
{
	public static function admin_menu()
	{
        $user_meta=get_userdata(get_current_user_id());

        $user_roles=$user_meta->roles;


		// $main is now a slug named "toplevel_page_t5-demo"
		// built with get_plugin_page_hookname( $menu_slug, '' )
		$main = add_menu_page(
			'T5 Globaldea',                         // page title
			'T5 Globaldea',                         // menu title
			// Change the capability to make the pages visible for other users.
			// See http://codex.wordpress.org/Roles_and_Capabilities
			'manage_options',                  // capability
			'dashboard',                         // menu slug
			array ( __CLASS__, 'dashboard' ),
        '',
        1// callback function
		);
		
		
		if (in_array("administrator", $user_roles))
        {
            // $sub is now a slug named "t5-demo_page_t5-demo-sub"
            // built with get_plugin_page_hookname( $menu_slug, $parent_slug)
            $sub = add_submenu_page(
                'dashboard',                         // parent slug
                'Adicionar novo Utilizador',                     // page title
                'Adicionar novo Utilizador',                     // menu title
                'manage_options',                  // capability
                'adicionar-utilizador-colaborador',                         // menu slug
                array ( __CLASS__, 'criar_utilizador' ) // callback function
            );
        }
		
		$sub = add_submenu_page(
			'dashboard',                         // parent slug
			'Perfil do Utilizador',                     // page title
			'Perfil do Utilizador',                     // menu title
			'manage_options',                  // capability
			'perfil-utilizador',                         // menu slug
			array ( __CLASS__, 'perfil_utilizador' ) // callback function
		);
		
		$sub = add_submenu_page(
            'dashboard',                         // parent slug
            'Criar novo artigo',                     // page title
            'Criar novo artigo',                     // menu title
            'manage_options',                  // capability
            'novo-post',                         // menu slug
            array(__CLASS__, 'novo_post')
        );
		
		$sub = add_submenu_page(
            null,                         // parent slug
            " Editar Artigo",
            "Editar Artigo",
            "manage_options",
            "editar-artigo",                        // menu slug
            array(__CLASS__, 'editarArtigo')                        // menu slug
        );
		
		$sub = add_submenu_page(
            'dashboard',                         // parent slug
            'Gerir Artigos',                     // page title
            'Gerir Artigos',                     // menu title
            'manage_options',                  // capability
            'gerir-posts',                         // menu slug
            array(__CLASS__, 'gerir_posts')                        // menu slug
        );
		
		
		$sub = add_submenu_page(
                'dashboard',                         // parent slug
                'Sugerir Tema',                     // page title
                'Sugerir Tema',                     // menu title
                'manage_options',                  // capability
                'sugerir-tema',                         // menu slug
                array(__CLASS__, 'sugerir_tema')                        // menu slug
            );
		
		// Listar temas

        if (!in_array("administrator", $user_roles))
        {
            $sub = add_submenu_page(
                'dashboard',                         // parent slug
                'Listar Meus Temas',                     // page title
                'Listar Meus Temas',                     // menu title
                'manage_options',                  // capability
                'listar-meus-temas',                         // menu slug
                array(__CLASS__, 'listar_meus_temas')                        // menu slug
            );

            $sub = add_submenu_page(
                'dashboard',                         // parent slug
                'Listar Temas Disponiveis',                     // page title
                'Listar Temas Disponiveis',                     // menu title
                'manage_options',                  // capability
                'listar-temas-disponiveis',                         // menu slug
                array(__CLASS__, 'listar_temas_disponiveis')                        // menu slug
            );
        }
        else
        {
            $sub = add_submenu_page(
                'dashboard',                         // parent slug
                'Listar Temas',                     // page title
                'Listar Temas',                     // menu title
                'manage_options',                  // capability
                'listar-temas',                         // menu slug
                array(__CLASS__, 'listar_temas')                        // menu slug
            );
        }
		
		$sub = add_submenu_page(
            null,                         // parent slug
            "Atribuir Tema do novo Artigo",
            "Atribuir Tema do novo Artigo",
            "manage_options",
            "atribuir-tema-novo-artigo",                        // menu slug
            array(__CLASS__, 'atribuirTemaNovoArtigo')                        // menu slug
        );
		
		$sub = add_submenu_page(
            null,                         // parent slug
            "Editar Artigo ao Tema Correspodente",
            "Editar Artigo ao Tema Correspodente",
            "manage_options",
            "editar-artigo-tema",                        // menu slug
            array(__CLASS__, 'editarArtigoTema')                        // menu slug
        );
		
		$sub = add_submenu_page(
            null,                         // parent slug
            "Atribuir Tema Disponivel do novo Artigo",
            "Atribuir Tema Disponivel do novo Artigo",
            "manage_options",
            "atribuir-tema-disponivel-novo-artigo",                        // menu slug
            array(__CLASS__, 'atribuirTemaDisponivelNovoArtigo')                        // menu slug
        );
		
		$sub = add_submenu_page(
            null,                         // parent slug
            "Editar Artigo ao Tema Disponivel",
            "Editar Artigo ao Tema Disponivel",
            "manage_options",
            "editar-artigo-tema-disponivel",                        // menu slug
            array(__CLASS__, 'editarArtigoTemaDisponivel')                        // menu slug
        );
		
		$sub = add_submenu_page(
            null,                         // parent slug
            "Atribuir Tema do Administrador do novo Artigo",
            "Atribuir Tema do Administrador do novo Artigo",
            "manage_options",
            "atribuir-tema-admin-novo-artigo",                        // menu slug
            array(__CLASS__, 'atribuirTemaAdminNovoArtigo')                        // menu slug
        );
		
		$sub = add_submenu_page(
            null,                         // parent slug
            "Editar Tema",
            "Editar Tema",
            "manage_options",
            "editar-tema",                        // menu slug
            array(__CLASS__, 'editarTema')                        // menu slug
        );

        $sub = add_submenu_page(
            null,                         // parent slug
            "Editar Artigo ao Tema Administrador",
            "Editar Artigo ao Tema Administrador",
            "manage_options",
            "editar-artigo-tema-administrador",                        // menu slug
            array(__CLASS__, 'editarArtigoTemaAdministrador')                        // menu slug
        );

        $sub = add_submenu_page(
            null,                         // parent slug
            "Avaliar Artigo ao Tema",
            "Avaliar Artigo ao Tema",
            "manage_options",
            "avaliar-artigo-tema",                        // menu slug
            array(__CLASS__, 'avaliarArtigoTema')                        // menu slug
        );
    }
	
	public static function avaliarArtigoTema()
    {
        require 'temas/avaliar_artigo_tema.php';
    }

    public static function editarArtigoTemaAdministrador()
    {
        require 'temas/editar_tema_artigo_admin.php';
    }

    public static function editarTema()
    {
        require 'temas/editar_tema.php';
    }

    public static function atribuirTemaAdminNovoArtigo()
    {
        require 'temas/atribuir_tema_artigo_admin.php';
    }
	
	public static function editarArtigoTemaDisponivel()
    {
        require 'temas/editar_tema_disponivel_artigo.php';
    }
	
	public static function atribuirTemaDisponivelNovoArtigo()
    {
        require 'temas/atribuir_tema_disponivel_artigo_novo.php';
    }
	
	
	public static function editarArtigoTema()
    {
        require 'temas/editar_tema_artigo.php';
    }
	
	
	
	public static function atribuirTemaNovoArtigo()
    {
        require 'temas/atribuir_tema_artigo_novo.php';
    }
	
	public static function listar_temas()
    {
        require 'temas/listar_temas_admin.php';
    }
	
	public static function listar_temas_disponiveis()
	{
		require 'temas/listar_temas_disponiveis.php';
	}

	public static function listar_meus_temas()
	{
		require 'temas/listar_meus_temas.php';
	}
	
	public static function dashboard()
    {
        require_once 'dashboard_init.php';
    }
	
	public static function novo_post()
    {

        require 'posts/novo-post.php';
    }
	
	public static function editarArtigo()
    {
        require 'posts/edit-post.php';
    }
	
	public static function gerir_posts()
    {
        require_once 'gerir_posts.php';
    }
	
	public static function sugerir_tema()
    {
        require 'temas/sugerir-tema.php';
    }
		
		
	public static function perfil_utilizador()
	{
		define( 'IS_PROFILE_PAGE', true );

        require_once ABSPATH . '/wp-admin/admin.php';

        wp_reset_vars( array( 'action', 'user_id', 'wp_http_referer' ) );

        $user_id      = (int) $user_id;

        $current_user = wp_get_current_user();
        if ( ! defined( 'IS_PROFILE_PAGE' ) ) {
            define( 'IS_PROFILE_PAGE', ( $user_id == $current_user->ID ) );
        }

        if ( ! $user_id && IS_PROFILE_PAGE ) {
            $user_id = $current_user->ID;
        } elseif ( ! $user_id && ! IS_PROFILE_PAGE ) {
            wp_die( __( 'Invalid user ID.' ) );
        } elseif ( ! get_userdata( $user_id ) ) {
            wp_die( __( 'Invalid user ID.' ) );
        }

        wp_enqueue_script( 'user-profile' );

        if ( wp_is_application_passwords_available_for_user( $user_id ) ) {
            wp_enqueue_script( 'application-passwords' );
        }

        if ( IS_PROFILE_PAGE ) {
            $title = __( 'Profile' );
        } else {
            /* translators: %s: User's display name. */
            $title = __( 'Edit User %s' );
        }

        if ( current_user_can( 'edit_users' ) && ! IS_PROFILE_PAGE ) {
            $submenu_file = 'users.php';
        } else {
            $submenu_file = 'profile.php';
        }

        if ( current_user_can( 'edit_users' ) && ! is_user_admin() ) {
            $parent_file = 'users.php';
        } else {
            $parent_file = 'profile.php';
        }

        $profile_help = '<p>' . __( 'Your profile contains information about you (your &#8220;account&#8221;) as well as some personal options related to using WordPress.' ) . '</p>' .
            '<p>' . __( 'You can change your password, turn on keyboard shortcuts, change the color scheme of your WordPress administration screens, and turn off the WYSIWYG (Visual) editor, among other things. You can hide the Toolbar (formerly called the Admin Bar) from the front end of your site, however it cannot be disabled on the admin screens.' ) . '</p>' .
            '<p>' . __( 'You can select the language you wish to use while using the WordPress administration screen without affecting the language site visitors see.' ) . '</p>' .
            '<p>' . __( 'Your username cannot be changed, but you can use other fields to enter your real name or a nickname, and change which name to display on your posts.' ) . '</p>' .
            '<p>' . __( 'You can log out of other devices, such as your phone or a public computer, by clicking the Log Out Everywhere Else button.' ) . '</p>' .
            '<p>' . __( 'Required fields are indicated; the rest are optional. Profile information will only be displayed if your theme is set up to do so.' ) . '</p>' .
            '<p>' . __( 'Remember to click the Update Profile button when you are finished.' ) . '</p>';

        get_current_screen()->add_help_tab(
            array(
                'id'      => 'overview',
                'title'   => __( 'Overview' ),
                'content' => $profile_help,
            )
        );

        get_current_screen()->set_help_sidebar(
            '<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
            '<p>' . __( '<a href="https://wordpress.org/support/article/users-your-profile-screen/">Documentation on User Profiles</a>' ) . '</p>' .
            '<p>' . __( '<a href="https://wordpress.org/support/">Support</a>' ) . '</p>'
        );

        $wp_http_referer = remove_query_arg( array( 'update', 'delete_count', 'user_id' ), $wp_http_referer );

        $user_can_edit = current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' );

        /**
         * Filters whether to allow administrators on Multisite to edit every user.
         *
         * Enabling the user editing form via this filter also hinges on the user holding
         * the 'manage_network_users' cap, and the logged-in user not matching the user
         * profile open for editing.
         *
         * The filter was introduced to replace the EDIT_ANY_USER constant.
         *
         * @since 3.0.0
         *
         * @param bool $allow Whether to allow editing of any user. Default true.
         */
        if ( is_multisite()
            && ! current_user_can( 'manage_network_users' )
            && $user_id != $current_user->ID
            && ! apply_filters( 'enable_edit_any_user_configuration', true )
        ) {
            wp_die( __( 'Sorry, you are not allowed to edit this user.' ) );
        }

        // Execute confirmed email change. See send_confirmation_on_profile_email().
        if ( IS_PROFILE_PAGE && isset( $_GET['newuseremail'] ) && $current_user->ID ) {
            $new_email = get_user_meta( $current_user->ID, '_new_email', true );
            if ( $new_email && hash_equals( $new_email['hash'], $_GET['newuseremail'] ) ) {
                $user             = new stdClass;
                $user->ID         = $current_user->ID;
                $user->user_email = esc_html( trim( $new_email['newemail'] ) );
                if ( is_multisite() && $wpdb->get_var( $wpdb->prepare( "SELECT user_login FROM {$wpdb->signups} WHERE user_login = %s", $current_user->user_login ) ) ) {
                    $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->signups} SET user_email = %s WHERE user_login = %s", $user->user_email, $current_user->user_login ) );
                }
                wp_update_user( $user );
                delete_user_meta( $current_user->ID, '_new_email' );
                wp_redirect( add_query_arg( array( 'updated' => 'true' ), self_admin_url( 'profile.php' ) ) );
                die();
            } else {
                wp_redirect( add_query_arg( array( 'error' => 'new-email' ), self_admin_url( 'profile.php' ) ) );
            }
        } elseif ( IS_PROFILE_PAGE && ! empty( $_GET['dismiss'] ) && $current_user->ID . '_new_email' === $_GET['dismiss'] ) {
            check_admin_referer( 'dismiss-' . $current_user->ID . '_new_email' );
            delete_user_meta( $current_user->ID, '_new_email' );
            wp_redirect( add_query_arg( array( 'updated' => 'true' ), self_admin_url( 'profile.php' ) ) );
            die();
        }

        switch ( $action ) {
            case 'update':
                check_admin_referer( 'update-user_' . $user_id );

                if ( ! current_user_can( 'edit_user', $user_id ) ) {
                    wp_die( __( 'Sorry, you are not allowed to edit this user.' ) );
                }

                if ( IS_PROFILE_PAGE ) {
                    /**
                     * Fires before the page loads on the 'Profile' editing screen.
                     *
                     * The action only fires if the current user is editing their own profile.
                     *
                     * @since 2.0.0
                     *
                     * @param int $user_id The user ID.
                     */
                    do_action( 'personal_options_update', $user_id );
                } else {
                    /**
                     * Fires before the page loads on the 'Edit User' screen.
                     *
                     * @since 2.7.0
                     *
                     * @param int $user_id The user ID.
                     */
                    do_action( 'edit_user_profile_update', $user_id );
                }

                // Update the email address in signups, if present.
                if ( is_multisite() ) {
                    $user = get_userdata( $user_id );

                    if ( $user->user_login && isset( $_POST['email'] ) && is_email( $_POST['email'] ) && $wpdb->get_var( $wpdb->prepare( "SELECT user_login FROM {$wpdb->signups} WHERE user_login = %s", $user->user_login ) ) ) {
                        $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->signups} SET user_email = %s WHERE user_login = %s", $_POST['email'], $user_login ) );
                    }
                }

                // Update the user.
                $errors = edit_user( $user_id );

                // Grant or revoke super admin status if requested.
                if ( is_multisite() && is_network_admin() && ! IS_PROFILE_PAGE && current_user_can( 'manage_network_options' ) && ! isset( $super_admins ) && empty( $_POST['super_admin'] ) == is_super_admin( $user_id ) ) {
                    empty( $_POST['super_admin'] ) ? revoke_super_admin( $user_id ) : grant_super_admin( $user_id );
                }

                if ( ! is_wp_error( $errors ) ) {
                    $redirect = add_query_arg( 'updated', true, get_edit_user_link( $user_id ) );
                    if ( $wp_http_referer ) {
                        $redirect = add_query_arg( 'wp_http_referer', urlencode( $wp_http_referer ), $redirect );
                    }
                    wp_redirect( $redirect );
                    exit;
                }

            // Intentional fall-through to display $errors.
            default:
                $profileuser = get_user_to_edit( $user_id );

                if ( ! current_user_can( 'edit_user', $user_id ) ) {
                    wp_die( __( 'Sorry, you are not allowed to edit this user.' ) );
                }

                $title    = sprintf( $title, $profileuser->display_name );
                $sessions = WP_Session_Tokens::get_instance( $profileuser->ID );

                require_once ABSPATH . 'wp-admin/admin-header.php';
                ?>

                <?php if ( ! IS_PROFILE_PAGE && is_super_admin( $profileuser->ID ) && current_user_can( 'manage_network_options' ) ) { ?>
                <div class="notice notice-info"><p><strong><?php _e( 'Important:' ); ?></strong> <?php _e( 'This user has super admin privileges.' ); ?></p></div>
            <?php } ?>
                <?php if ( isset( $_GET['updated'] ) ) : ?>
                <div id="message" class="updated notice is-dismissible">
                    <?php if ( IS_PROFILE_PAGE ) : ?>
                        <p><strong><?php _e( 'Profile updated.' ); ?></strong></p>
                    <?php else : ?>
                        <p><strong><?php _e( 'User updated.' ); ?></strong></p>
                    <?php endif; ?>
                    <?php if ( $wp_http_referer && false === strpos( $wp_http_referer, 'user-new.php' ) && ! IS_PROFILE_PAGE ) : ?>
                        <p><a href="<?php echo esc_url( wp_validate_redirect( esc_url_raw( $wp_http_referer ), self_admin_url( 'users.php' ) ) ); ?>"><?php _e( '&larr; Go to Users' ); ?></a></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
                <?php if ( isset( $_GET['error'] ) ) : ?>
                <div class="notice notice-error">
                    <?php if ( 'new-email' === $_GET['error'] ) : ?>
                        <p><?php _e( 'Error while saving the new email address. Please try again.' ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
                <?php if ( isset( $errors ) && is_wp_error( $errors ) ) : ?>
                <div class="error"><p><?php echo implode( "</p>\n<p>", $errors->get_error_messages() ); ?></p></div>
            <?php endif; ?>

                <div class="wrap" id="profile-page">
                    <h1 class="wp-heading-inline">
                        <?php
                        echo esc_html( $title );
                        ?>
                    </h1>

                    <?php
                    if ( ! IS_PROFILE_PAGE ) {
                        if ( current_user_can( 'create_users' ) ) {
                            ?>
                            <a href="user-new.php" class="page-title-action"><?php echo esc_html_x( 'Add New', 'user' ); ?></a>
                        <?php } elseif ( is_multisite() && current_user_can( 'promote_users' ) ) { ?>
                            <a href="user-new.php" class="page-title-action"><?php echo esc_html_x( 'Add Existing', 'user' ); ?></a>
                            <?php
                        }
                    }
                    ?>

                    <hr class="wp-header-end">

                    <form id="your-profile" action="<?php echo esc_url( self_admin_url( IS_PROFILE_PAGE ? 'profile.php' : 'user-edit.php' ) ); ?>" method="post" novalidate="novalidate"
                        <?php
                        /**
                         * Fires inside the your-profile form tag on the user editing screen.
                         *
                         * @since 3.0.0
                         */
                        do_action( 'user_edit_form_tag' );
                        ?>
                    >
                        <?php wp_nonce_field( 'update-user_' . $user_id ); ?>
                        <?php if ( $wp_http_referer ) : ?>
                            <input type="hidden" name="wp_http_referer" value="<?php echo esc_url( $wp_http_referer ); ?>" />
                        <?php endif; ?>
                        <p>
                            <input type="hidden" name="from" value="profile" />
                            <input type="hidden" name="checkuser_id" value="<?php echo get_current_user_id(); ?>" />
                        </p>

                        <h2><?php _e( 'Personal Options' ); ?></h2>

                        <table class="form-table" role="presentation">
                            <?php if ( ! ( IS_PROFILE_PAGE && ! $user_can_edit ) ) : ?>
                                <tr class="user-rich-editing-wrap">
                                    <th scope="row"><?php _e( 'Visual Editor' ); ?></th>
                                    <td>
                                        <label for="rich_editing"><input name="rich_editing" type="checkbox" id="rich_editing" value="false" <?php checked( 'false', $profileuser->rich_editing ); ?> />
                                            <?php _e( 'Disable the visual editor when writing' ); ?>
                                        </label>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php
                            $show_syntax_highlighting_preference = (
                                // For Custom HTML widget and Additional CSS in Customizer.
                                user_can( $profileuser, 'edit_theme_options' )
                                ||
                                // Edit plugins.
                                user_can( $profileuser, 'edit_plugins' )
                                ||
                                // Edit themes.
                                user_can( $profileuser, 'edit_themes' )
                            );
                            ?>

                            <?php if ( $show_syntax_highlighting_preference ) : ?>
                                <tr class="user-syntax-highlighting-wrap">
                                    <th scope="row"><?php _e( 'Syntax Highlighting' ); ?></th>
                                    <td>
                                        <label for="syntax_highlighting"><input name="syntax_highlighting" type="checkbox" id="syntax_highlighting" value="false" <?php checked( 'false', $profileuser->syntax_highlighting ); ?> />
                                            <?php _e( 'Disable syntax highlighting when editing code' ); ?>
                                        </label>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if ( count( $_wp_admin_css_colors ) > 1 && has_action( 'admin_color_scheme_picker' ) ) : ?>
                                <tr class="user-admin-color-wrap">
                                    <th scope="row"><?php _e( 'Admin Color Scheme' ); ?></th>
                                    <td>
                                        <?php
                                        /**
                                         * Fires in the 'Admin Color Scheme' section of the user editing screen.
                                         *
                                         * The section is only enabled if a callback is hooked to the action,
                                         * and if there is more than one defined color scheme for the admin.
                                         *
                                         * @since 3.0.0
                                         * @since 3.8.1 Added `$user_id` parameter.
                                         *
                                         * @param int $user_id The user ID.
                                         */
                                        do_action( 'admin_color_scheme_picker', $user_id );
                                        ?>
                                    </td>
                                </tr>
                            <?php endif; // End if count ( $_wp_admin_css_colors ) > 1 ?>

                            <?php if ( ! ( IS_PROFILE_PAGE && ! $user_can_edit ) ) : ?>
                                <tr class="user-comment-shortcuts-wrap">
                                    <th scope="row"><?php _e( 'Keyboard Shortcuts' ); ?></th>
                                    <td>
                                        <label for="comment_shortcuts">
                                            <input type="checkbox" name="comment_shortcuts" id="comment_shortcuts" value="true" <?php checked( 'true', $profileuser->comment_shortcuts ); ?> />
                                            <?php _e( 'Enable keyboard shortcuts for comment moderation.' ); ?>
                                        </label>
                                        <?php _e( '<a href="https://wordpress.org/support/article/keyboard-shortcuts/" target="_blank">More information</a>' ); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <tr class="show-admin-bar user-admin-bar-front-wrap">
                                <th scope="row"><?php _e( 'Toolbar' ); ?></th>
                                <td>
                                    <label for="admin_bar_front">
                                        <input name="admin_bar_front" type="checkbox" id="admin_bar_front" value="1"<?php checked( _get_admin_bar_pref( 'front', $profileuser->ID ) ); ?> />
                                        <?php _e( 'Show Toolbar when viewing site' ); ?>
                                    </label><br />
                                </td>
                            </tr>

                            <?php
                            $languages = get_available_languages();
                            if ( $languages ) :
                                ?>
                                <tr class="user-language-wrap">
                                    <th scope="row">
                                        <?php /* translators: The user language selection field label. */ ?>
                                        <label for="locale"><?php _e( 'Language' ); ?><span class="dashicons dashicons-translation" aria-hidden="true"></span></label>
                                    </th>
                                    <td>
                                        <?php
                                        $user_locale = $profileuser->locale;

                                        if ( 'en_US' === $user_locale ) {
                                            $user_locale = '';
                                        } elseif ( '' === $user_locale || ! in_array( $user_locale, $languages, true ) ) {
                                            $user_locale = 'site-default';
                                        }

                                        wp_dropdown_languages(
                                            array(
                                                'name'                        => 'locale',
                                                'id'                          => 'locale',
                                                'selected'                    => $user_locale,
                                                'languages'                   => $languages,
                                                'show_available_translations' => false,
                                                'show_option_site_default'    => true,
                                            )
                                        );
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            endif;
                            ?>

                            <?php
                            /**
                             * Fires at the end of the 'Personal Options' settings table on the user editing screen.
                             *
                             * @since 2.7.0
                             *
                             * @param WP_User $profileuser The current WP_User object.
                             */
                            do_action( 'personal_options', $profileuser );
                            ?>

                        </table>
                        <?php
                        if ( IS_PROFILE_PAGE ) {
                            /**
                             * Fires after the 'Personal Options' settings table on the 'Profile' editing screen.
                             *
                             * The action only fires if the current user is editing their own profile.
                             *
                             * @since 2.0.0
                             *
                             * @param WP_User $profileuser The current WP_User object.
                             */
                            do_action( 'profile_personal_options', $profileuser );
                        }
                        ?>

                        <h2><?php _e( 'Name' ); ?></h2>

                        <table class="form-table" role="presentation">
                            <tr class="user-user-login-wrap">
                                <th><label for="user_login"><?php _e( 'Username' ); ?></label></th>
                                <td><input type="text" name="user_login" id="user_login" value="<?php echo esc_attr( $profileuser->user_login ); ?>" disabled="disabled" class="regular-text" /> <span class="description"><?php _e( 'Usernames cannot be changed.' ); ?></span></td>
                            </tr>

                            <?php if ( IS_PROFILE_PAGE  ) : ?>
                                <tr class="user-role-wrap"><th><label for="role"><?php _e( 'Role' ); ?></label></th>
                                    <td><select name="role" id="role">
                                            <?php
                                            // Compare user role against currently editable roles.
                                            $user_roles = array_intersect( array_values( $profileuser->roles ), array_keys( get_editable_roles() ) );
                                            $user_role  = reset( $user_roles );

                                            // Print the full list of roles with the primary one selected.
                                            wp_dropdown_roles( $user_role );

                                            // Print the 'no role' option. Make it selected if the user has no role yet.
                                            if ( $user_role ) {
                                                echo '<option value="">' . __( '&mdash; No role for this site &mdash;' ) . '</option>';
                                            } else {
                                                echo '<option value="" selected="selected">' . __( '&mdash; No role for this site &mdash;' ) . '</option>';
                                            }
                                            ?>
                                        </select></td></tr>
                            <?php
                            endif; // End if ! IS_PROFILE_PAGE.

                            if ( is_multisite() && is_network_admin() && ! IS_PROFILE_PAGE && current_user_can( 'manage_network_options' ) && ! isset( $super_admins ) ) {
                                ?>
                                <tr class="user-super-admin-wrap"><th><?php _e( 'Super Admin' ); ?></th>
                                    <td>
                                        <?php if ( 0 !== strcasecmp( $profileuser->user_email, get_site_option( 'admin_email' ) ) || ! is_super_admin( $profileuser->ID ) ) : ?>
                                            <p><label><input type="checkbox" id="super_admin" name="super_admin"<?php checked( is_super_admin( $profileuser->ID ) ); ?> /> <?php _e( 'Grant this user super admin privileges for the Network.' ); ?></label></p>
                                        <?php else : ?>
                                            <p><?php _e( 'Super admin privileges cannot be removed because this user has the network admin email.' ); ?></p>
                                        <?php endif; ?>
                                    </td></tr>
                            <?php } ?>

                            <tr class="user-first-name-wrap">
                                <th><label for="first_name"><?php _e( 'First Name' ); ?></label></th>
                                <td><input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $profileuser->first_name ); ?>" class="regular-text" /></td>
                            </tr>

                            <tr class="user-last-name-wrap">
                                <th><label for="last_name"><?php _e( 'Last Name' ); ?></label></th>
                                <td><input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text" /></td>
                            </tr>

                            <tr class="user-nickname-wrap">
                                <th><label for="nickname"><?php _e( 'Nickname' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
                                <td><input type="text" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" class="regular-text" /></td>
                            </tr>

                            <tr class="user-display-name-wrap">
                                <th><label for="display_name"><?php _e( 'Display name publicly as' ); ?></label></th>
                                <td>
                                    <select name="display_name" id="display_name">
                                        <?php
                                        $public_display                     = array();
                                        $public_display['display_nickname'] = $profileuser->nickname;
                                        $public_display['display_username'] = $profileuser->user_login;

                                        if ( ! empty( $profileuser->first_name ) ) {
                                            $public_display['display_firstname'] = $profileuser->first_name;
                                        }

                                        if ( ! empty( $profileuser->last_name ) ) {
                                            $public_display['display_lastname'] = $profileuser->last_name;
                                        }

                                        if ( ! empty( $profileuser->first_name ) && ! empty( $profileuser->last_name ) ) {
                                            $public_display['display_firstlast'] = $profileuser->first_name . ' ' . $profileuser->last_name;
                                            $public_display['display_lastfirst'] = $profileuser->last_name . ' ' . $profileuser->first_name;
                                        }

                                        if ( ! in_array( $profileuser->display_name, $public_display, true ) ) { // Only add this if it isn't duplicated elsewhere.
                                            $public_display = array( 'display_displayname' => $profileuser->display_name ) + $public_display;
                                        }

                                        $public_display = array_map( 'trim', $public_display );
                                        $public_display = array_unique( $public_display );

                                        foreach ( $public_display as $id => $item ) {
                                            ?>
                                            <option <?php selected( $profileuser->display_name, $item ); ?>><?php echo $item; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <h2><?php _e( 'Contact Info' ); ?></h2>

                        <table class="form-table" role="presentation">
                            <tr class="user-email-wrap">
                                <th><label for="email"><?php _e( 'Email' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
                                <td><input type="email" name="email" id="email" aria-describedby="email-description" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text ltr" />
                                    <?php
                                    if ( $profileuser->ID == $current_user->ID ) :
                                        ?>
                                        <p class="description" id="email-description">
                                            <?php _e( 'If you change this, we will send you an email at your new address to confirm it. <strong>The new address will not become active until confirmed.</strong>' ); ?>
                                        </p>
                                    <?php
                                    endif;

                                    $new_email = get_user_meta( $current_user->ID, '_new_email', true );
                                    if ( $new_email && $new_email['newemail'] != $current_user->user_email && $profileuser->ID == $current_user->ID ) :
                                        ?>
                                        <div class="updated inline">
                                            <p>
                                                <?php
                                                printf(
                                                /* translators: %s: New email. */
                                                    __( 'There is a pending change of your email to %s.' ),
                                                    '<code>' . esc_html( $new_email['newemail'] ) . '</code>'
                                                );
                                                printf(
                                                    ' <a href="%1$s">%2$s</a>',
                                                    esc_url( wp_nonce_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ), 'dismiss-' . $current_user->ID . '_new_email' ) ),
                                                    __( 'Cancel' )
                                                );
                                                ?>
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr class="user-url-wrap">
                                <th><label for="url"><?php _e( 'Website' ); ?></label></th>
                                <td><input type="url" name="url" id="url" value="<?php echo esc_attr( $profileuser->user_url ); ?>" class="regular-text code" /></td>
                            </tr>

                            <?php
                            foreach ( wp_get_user_contact_methods( $profileuser ) as $name => $desc ) {
                                ?>
                                <tr class="user-<?php echo $name; ?>-wrap">
                                    <th><label for="<?php echo $name; ?>">
                                            <?php
                                            /**
                                             * Filters a user contactmethod label.
                                             *
                                             * The dynamic portion of the filter hook, `$name`, refers to
                                             * each of the keys in the contactmethods array.
                                             *
                                             * @since 2.9.0
                                             *
                                             * @param string $desc The translatable label for the contactmethod.
                                             */
                                            echo apply_filters( "user_{$name}_label", $desc );
                                            ?>
                                        </label></th>
                                    <td><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_attr( $profileuser->$name ); ?>" class="regular-text" /></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>

                        <h2><?php IS_PROFILE_PAGE ? _e( 'About Yourself' ) : _e( 'About the user' ); ?></h2>

                        <table class="form-table" role="presentation">
                            <tr class="user-description-wrap">
                                <th><label for="description"><?php _e( 'Biographical Info' ); ?></label></th>
                                <td><textarea name="description" id="description" rows="5" cols="30"><?php echo $profileuser->description; // textarea_escaped ?></textarea>
                                    <p class="description"><?php _e( 'Share a little biographical information to fill out your profile. This may be shown publicly.' ); ?></p></td>
                            </tr>

                            <?php if ( get_option( 'show_avatars' ) ) : ?>
                                <tr class="user-profile-picture">
                                    <th><?php _e( 'Profile Picture' ); ?></th>
                                    <td>
                                        <?php echo get_avatar( $user_id ); ?>
                                        <p class="description">
                                            <?php
                                            if ( IS_PROFILE_PAGE ) {
                                                $description = sprintf(
                                                /* translators: %s: Gravatar URL. */
                                                    __( '<a href="%s">You can change your profile picture on Gravatar</a>.' ),
                                                    __( 'https://en.gravatar.com/' )
                                                );
                                            } else {
                                                $description = '';
                                            }

                                            /**
                                             * Filters the user profile picture description displayed under the Gravatar.
                                             *
                                             * @since 4.4.0
                                             * @since 4.7.0 Added the `$profileuser` parameter.
                                             *
                                             * @param string  $description The description that will be printed.
                                             * @param WP_User $profileuser The current WP_User object.
                                             */
                                            echo apply_filters( 'user_profile_picture_description', $description, $profileuser );
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php
                            /**
                             * Filters the display of the password fields.
                             *
                             * @since 1.5.1
                             * @since 2.8.0 Added the `$profileuser` parameter.
                             * @since 4.4.0 Now evaluated only in user-edit.php.
                             *
                             * @param bool    $show        Whether to show the password fields. Default true.
                             * @param WP_User $profileuser User object for the current user to edit.
                             */
                            $show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
                            if ( $show_password_fields ) :
                            ?>
                        </table>

                        <h2><?php _e( 'Account Management' ); ?></h2>
                        <table class="form-table" role="presentation">
                            <tr id="password" class="user-pass1-wrap">
                                <th><label for="pass1"><?php _e( 'New Password' ); ?></label></th>
                                <td>
                                    <input class="hidden" value=" " /><!-- #24364 workaround -->
                                    <button type="button" class="button wp-generate-pw hide-if-no-js" aria-expanded="false"><?php _e( 'Set New Password' ); ?></button>
                                    <div class="wp-pwd hide-if-js">
			<span class="password-input-wrapper">
				<input type="password" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="<?php echo esc_attr( wp_generate_password( 24 ) ); ?>" aria-describedby="pass-strength-result" />
			</span>
                                        <button type="button" class="button wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password' ); ?>">
                                            <span class="dashicons dashicons-hidden" aria-hidden="true"></span>
                                            <span class="text"><?php _e( 'Hide' ); ?></span>
                                        </button>
                                        <button type="button" class="button wp-cancel-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Cancel password change' ); ?>">
                                            <span class="dashicons dashicons-no" aria-hidden="true"></span>
                                            <span class="text"><?php _e( 'Cancel' ); ?></span>
                                        </button>
                                        <div style="display:none" id="pass-strength-result" aria-live="polite"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="user-pass2-wrap hide-if-js">
                                <th scope="row"><label for="pass2"><?php _e( 'Repeat New Password' ); ?></label></th>
                                <td>
                                    <input name="pass2" type="password" id="pass2" class="regular-text" value="" autocomplete="off" aria-describedby="pass2-desc" />
                                    <?php if ( IS_PROFILE_PAGE ) : ?>
                                        <p class="description" id="pass2-desc"><?php _e( 'Type your new password again.' ); ?></p>
                                    <?php else : ?>
                                        <p class="description" id="pass2-desc"><?php _e( 'Type the new password again.' ); ?></p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr class="pw-weak">
                                <th><?php _e( 'Confirm Password' ); ?></th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="pw_weak" class="pw-checkbox" />
                                        <span id="pw-weak-text-label"><?php _e( 'Confirm use of weak password' ); ?></span>
                                    </label>
                                </td>
                            </tr>
                            <?php endif; ?>

                            <?php
                            // Allow admins to send reset password link.
                            if ( ! IS_PROFILE_PAGE ) :
                                ?>
                                <tr class="user-generate-reset-link-wrap hide-if-no-js">
                                    <th><?php _e( 'Password Reset' ); ?></th>
                                    <td>
                                        <div class="generate-reset-link">
                                            <button type="button" class="button button-secondary" id="generate-reset-link">
                                                <?php _e( 'Send Reset Link' ); ?>
                                            </button>
                                        </div>
                                        <p class="description">
                                            <?php
                                            /* translators: %s: User's display name. */
                                            printf( __( 'Send %s a link to reset their password. This will not change their password, nor will it force a change.' ), esc_html( $profileuser->display_name ) );
                                            ?>
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>



                        </table>


                        <?php if ( wp_is_application_passwords_available_for_user( $user_id ) ) : ?>
                            <div class="application-passwords hide-if-no-js" id="application-passwords-section">
                                <h2><?php _e( 'Application Passwords' ); ?></h2>
                                <p><?php _e( 'Application passwords allow authentication via non-interactive systems, such as XML-RPC or the REST API, without providing your actual password. Application passwords can be easily revoked. They cannot be used for traditional logins to your website.' ); ?></p>
                                <?php
                                if ( is_multisite() ) {
                                    $blogs       = get_blogs_of_user( $user_id, true );
                                    $blogs_count = count( $blogs );
                                    if ( $blogs_count > 1 ) {
                                        ?>
                                        <p>
                                            <?php
                                            printf(
                                            /* translators: 1: URL to my-sites.php, 2: Number of blogs the user has. */
                                                _n(
                                                    'Application passwords grant access to <a href="%1$s">the %2$s blog in this installation that you have permissions on</a>.',
                                                    'Application passwords grant access to <a href="%1$s">all %2$s blogs in this installation that you have permissions on</a>.',
                                                    $blogs_count
                                                ),
                                                admin_url( 'my-sites.php' ),
                                                number_format_i18n( $blogs_count )
                                            );
                                            ?>
                                        </p>
                                        <?php
                                    }
                                }

                                if ( ! wp_is_site_protected_by_basic_auth( 'front' ) ) {
                                    ?>
                                    <div class="create-application-password form-wrap">
                                        <div class="form-field">
                                            <label for="new_application_password_name"><?php _e( 'New Application Password Name' ); ?></label>
                                            <input type="text" size="30" id="new_application_password_name" name="new_application_password_name" placeholder="<?php esc_attr_e( 'WordPress App on My Phone' ); ?>" class="input" aria-required="true" aria-describedby="new_application_password_name_desc" />
                                            <p class="description" id="new_application_password_name_desc"><?php _e( 'Required to create an Application Password, but not to update the user.' ); ?></p>
                                        </div>

                                        <?php
                                        /**
                                         * Fires in the create Application Passwords form.
                                         *
                                         * @since 5.6.0
                                         *
                                         * @param WP_User $profileuser The current WP_User object.
                                         */
                                        do_action( 'wp_create_application_password_form', $profileuser );
                                        ?>

                                        <?php submit_button( __( 'Add New Application Password' ), 'secondary', 'do_new_application_password' ); ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="notice notice-error inline">
                                        <p><?php _e( 'Your website appears to use Basic Authentication, which is not currently compatible with Application Passwords.' ); ?></p>
                                    </div>
                                <?php } ?>

                                <div class="application-passwords-list-table-wrapper">
                                    <?php
                                    $application_passwords_list_table = _get_list_table( 'WP_Application_Passwords_List_Table', array( 'screen' => 'application-passwords-user' ) );
                                    $application_passwords_list_table->prepare_items();
                                    $application_passwords_list_table->display();
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <input type="hidden" name="action" value="update" />
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $user_id ); ?>" />

                        <?php submit_button( IS_PROFILE_PAGE ? __( 'Update Profile' ) : __( 'Update User' ) ); ?>

                    </form>
                </div>
                <?php
                break;
        }
        ?>
        <script type="text/javascript">
            if (window.location.hash == '#password') {
                document.getElementById('pass1').focus();
            }
        </script>

        <?php if ( isset( $application_passwords_list_table ) ) : ?>
        <script type="text/html" id="tmpl-new-application-password">
            <div class="notice notice-success is-dismissible new-application-password-notice" role="alert" tabindex="-1">
                <p class="application-password-display">
                    <label for="new-application-password-value">
                        <?php
                        printf(
                        /* translators: %s: Application name. */
                            __( 'Your new password for %s is:' ),
                            '<strong>{{ data.name }}</strong>'
                        );
                        ?>
                    </label>
                    <input id="new-application-password-value" type="text" class="code" readonly="readonly" value="{{ data.password }}" />
                </p>
                <p><?php _e( 'Be sure to save this in a safe location. You will not be able to retrieve it.' ); ?></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text"><?php _e( 'Dismiss this notice.' ); ?></span>
                </button>
            </div>
        </script>

        <script type="text/html" id="tmpl-application-password-row">
            <?php $application_passwords_list_table->print_js_template_row(); ?>
        </script>
    <?php endif; ?>
        <?php
        require_once ABSPATH . 'wp-admin/admin-footer.php';

	}
	
	public static function criar_utilizador()
	{
			if ( is_multisite() ) {
		if ( ! current_user_can( 'create_users' ) && ! current_user_can( 'promote_users' ) ) {
			wp_die(
				'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
				'<p>' . __( 'Sorry, you are not allowed to add users to this network.' ) . '</p>',
				403
			);
		}
	} elseif ( ! current_user_can( 'create_users' ) ) {
		wp_die(
			'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
			'<p>' . __( 'Sorry, you are not allowed to create users.' ) . '</p>',
			403
		);
	}

	if ( is_multisite() ) {
		add_filter( 'wpmu_signup_user_notification_email', 'admin_created_user_email' );
	}

	if ( isset( $_REQUEST['action'] ) && 'adduser' === $_REQUEST['action'] ) {
		check_admin_referer( 'add-user', '_wpnonce_add-user' );

		$user_details = null;
		$user_email   = wp_unslash( $_REQUEST['email'] );
		if ( false !== strpos( $user_email, '@' ) ) {
			$user_details = get_user_by( 'email', $user_email );
		} else {
			if ( current_user_can( 'manage_network_users' ) ) {
				$user_details = get_user_by( 'login', $user_email );
			} else {
				wp_redirect( add_query_arg( array( 'update' => 'enter_email' ), 'user-new.php' ) );
				die();
			}
		}

		if ( ! $user_details ) {
			wp_redirect( add_query_arg( array( 'update' => 'does_not_exist' ), 'user-new.php' ) );
			die();
		}

		if ( ! current_user_can( 'promote_user', $user_details->ID ) ) {
			wp_die(
				'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
				'<p>' . __( 'Sorry, you are not allowed to add users to this network.' ) . '</p>',
				403
			);
		}

		// Adding an existing user to this blog.
		$new_user_email = array();
		$redirect       = 'user-new.php';
		$username       = $user_details->user_login;
		$user_id        = $user_details->ID;
		if ( null != $username && array_key_exists( $blog_id, get_blogs_of_user( $user_id ) ) ) {
			$redirect = add_query_arg( array( 'update' => 'addexisting' ), 'user-new.php' );
		} else {
			if ( isset( $_POST['noconfirmation'] ) && current_user_can( 'manage_network_users' ) ) {
				$result = add_existing_user_to_blog(
					array(
						'user_id' => $user_id,
						'role'    => $_REQUEST['role'],
					)
				);

				if ( ! is_wp_error( $result ) ) {
					$redirect = add_query_arg(
						array(
							'update'  => 'addnoconfirmation',
							'user_id' => $user_id,
						),
						'user-new.php'
					);
				} else {
					$redirect = add_query_arg( array( 'update' => 'could_not_add' ), 'user-new.php' );
				}
			} else {
				$newuser_key = wp_generate_password( 20, false );
				add_option(
					'new_user_' . $newuser_key,
					array(
						'user_id' => $user_id,
						'email'   => $user_details->user_email,
						'role'    => $_REQUEST['role'],
					)
				);

				$roles = get_editable_roles();
				$role  = $roles[ $_REQUEST['role'] ];

				/**
				 * Fires immediately after an existing user is invited to join the site, but before the notification is sent.
				 *
				 * @since 4.4.0
				 *
				 * @param int    $user_id     The invited user's ID.
				 * @param array  $role        Array containing role information for the invited user.
				 * @param string $newuser_key The key of the invitation.
				 */
				do_action( 'invite_user', $user_id, $role, $newuser_key );

				$switched_locale = switch_to_locale( get_user_locale( $user_details ) );

				/* translators: 1: Site title, 2: Site URL, 3: User role, 4: Activation URL. */
				$message = __(
					'Hi,

	You\'ve been invited to join \'%1$s\' at
	%2$s with the role of %3$s.

	Please click the following link to confirm the invite:
	%4$s'
				);

				$new_user_email['to']      = $user_details->user_email;
				$new_user_email['subject'] = sprintf(
					/* translators: Joining confirmation notification email subject. %s: Site title. */
					__( '[%s] Joining Confirmation' ),
					wp_specialchars_decode( get_option( 'blogname' ) )
				);
				$new_user_email['message'] = sprintf(
					$message,
					get_option( 'blogname' ),
					home_url(),
					wp_specialchars_decode( translate_user_role( $role['name'] ) ),
					home_url( "/newbloguser/$newuser_key/" )
				);
				$new_user_email['headers'] = '';

				/**
				 * Filters the contents of the email sent when an existing user is invited to join the site.
				 *
				 * @since 5.6.0
				 *
				 * @param array $new_user_email {
				 *     Used to build wp_mail().
				 *
				 *     @type string $to      The email address of the invited user.
				 *     @type string $subject The subject of the email.
				 *     @type string $message The content of the email.
				 *     @type string $headers Headers.
				 * }
				 * @param int    $user_id     The invited user's ID.
				 * @param array  $role        Array containing role information for the invited user.
				 * @param string $newuser_key The key of the invitation.
				 *
				 */
				$new_user_email = apply_filters( 'invited_user_email', $new_user_email, $user_id, $role, $newuser_key );

				wp_mail(
					$new_user_email['to'],
					$new_user_email['subject'],
					$new_user_email['message'],
					$new_user_email['headers']
				);

				if ( $switched_locale ) {
					restore_previous_locale();
				}

				$redirect = add_query_arg( array( 'update' => 'add' ), 'user-new.php' );
			}
		}
		wp_redirect( $redirect );
		die();
	} elseif ( isset( $_REQUEST['action'] ) && 'createuser' === $_REQUEST['action'] ) {
		check_admin_referer( 'create-user', '_wpnonce_create-user' );

		if ( ! current_user_can( 'create_users' ) ) {
			wp_die(
				'<h1>' . __( 'You need a higher level of permission.' ) . '</h1>' .
				'<p>' . __( 'Sorry, you are not allowed to create users.' ) . '</p>',
				403
			);
		}

		if ( ! is_multisite() ) {
			$user_id = edit_user();

			if ( is_wp_error( $user_id ) ) {
				$add_user_errors = $user_id;
			} else {
				if ( current_user_can( 'list_users' ) ) {
					$redirect = 'users.php?update=add&id=' . $user_id;
				} else {
					$redirect = add_query_arg( 'update', 'add', 'user-new.php' );
				}
				wp_redirect( $redirect );
				die();
			}
		} else {
			// Adding a new user to this site.
			$new_user_email = wp_unslash( $_REQUEST['email'] );
			$user_details   = wpmu_validate_user_signup( $_REQUEST['user_login'], $new_user_email );
			if ( is_wp_error( $user_details['errors'] ) && $user_details['errors']->has_errors() ) {
				$add_user_errors = $user_details['errors'];
			} else {
				/** This filter is documented in wp-includes/user.php */
				$new_user_login = apply_filters( 'pre_user_login', sanitize_user( wp_unslash( $_REQUEST['user_login'] ), true ) );
				if ( isset( $_POST['noconfirmation'] ) && current_user_can( 'manage_network_users' ) ) {
					add_filter( 'wpmu_signup_user_notification', '__return_false' );  // Disable confirmation email.
					add_filter( 'wpmu_welcome_user_notification', '__return_false' ); // Disable welcome email.
				}
				wpmu_signup_user(
					$new_user_login,
					$new_user_email,
					array(
						'add_to_blog' => get_current_blog_id(),
						'new_role'    => $_REQUEST['role'],
					)
				);
				if ( isset( $_POST['noconfirmation'] ) && current_user_can( 'manage_network_users' ) ) {
					$key      = $wpdb->get_var( $wpdb->prepare( "SELECT activation_key FROM {$wpdb->signups} WHERE user_login = %s AND user_email = %s", $new_user_login, $new_user_email ) );
					$new_user = wpmu_activate_signup( $key );
					if ( is_wp_error( $new_user ) ) {
						$redirect = add_query_arg( array( 'update' => 'addnoconfirmation' ), 'user-new.php' );
					} elseif ( ! is_user_member_of_blog( $new_user['user_id'] ) ) {
						$redirect = add_query_arg( array( 'update' => 'created_could_not_add' ), 'user-new.php' );
					} else {
						$redirect = add_query_arg(
							array(
								'update'  => 'addnoconfirmation',
								'user_id' => $new_user['user_id'],
							),
							'user-new.php'
						);
					}
				} else {
					$redirect = add_query_arg( array( 'update' => 'newuserconfirmation' ), 'user-new.php' );
				}
				wp_redirect( $redirect );
				die();
			}
		}
	}

	$title       = __( 'Add New User' );
	$parent_file = 'users.php';

	$do_both = false;
	if ( is_multisite() && current_user_can( 'promote_users' ) && current_user_can( 'create_users' ) ) {
		$do_both = true;
	}

	$help = '<p>' . __( 'To add a new user to your site, fill in the form on this screen and click the Add New User button at the bottom.' ) . '</p>';

	if ( is_multisite() ) {
		$help .= '<p>' . __( 'Because this is a multisite installation, you may add accounts that already exist on the Network by specifying a username or email, and defining a role. For more options, such as specifying a password, you have to be a Network Administrator and use the hover link under an existing user&#8217;s name to Edit the user profile under Network Admin > All Users.' ) . '</p>' .
		'<p>' . __( 'New users will receive an email letting them know they&#8217;ve been added as a user for your site. This email will also contain their password. Check the box if you don&#8217;t want the user to receive a welcome email.' ) . '</p>';
	} else {
		$help .= '<p>' . __( 'New users are automatically assigned a password, which they can change after logging in. You can view or edit the assigned password by clicking the Show Password button. The username cannot be changed once the user has been added.' ) . '</p>' .

		'<p>' . __( 'By default, new users will receive an email letting them know they&#8217;ve been added as a user for your site. This email will also contain a password reset link. Uncheck the box if you don&#8217;t want to send the new user a welcome email.' ) . '</p>';
	}

	$help .= '<p>' . __( 'Remember to click the Add New User button at the bottom of this screen when you are finished.' ) . '</p>';

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'overview',
			'title'   => __( 'Overview' ),
			'content' => $help,
		)
	);

	get_current_screen()->add_help_tab(
		array(
			'id'      => 'user-roles',
			'title'   => __( 'User Roles' ),
			'content' => '<p>' . __( 'Here is a basic overview of the different user roles and the permissions associated with each one:' ) . '</p>' .
								'<ul>' .
								'<li>' . __( 'Subscribers can read comments/comment/receive newsletters, etc. but cannot create regular site content.' ) . '</li>' .
								'<li>' . __( 'Contributors can write and manage their posts but not publish posts or upload media files.' ) . '</li>' .
								'<li>' . __( 'Authors can publish and manage their own posts, and are able to upload files.' ) . '</li>' .
								'<li>' . __( 'Editors can publish posts, manage posts as well as manage other people&#8217;s posts, etc.' ) . '</li>' .
								'<li>' . __( 'Administrators have access to all the administration features.' ) . '</li>' .
								'</ul>',
		)
	);

	get_current_screen()->set_help_sidebar(
		'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
		'<p>' . __( '<a href="https://wordpress.org/support/article/users-add-new-screen/">Documentation on Adding New Users</a>' ) . '</p>' .
		'<p>' . __( '<a href="https://wordpress.org/support/">Support</a>' ) . '</p>'
	);

	wp_enqueue_script( 'wp-ajax-response' );
	wp_enqueue_script( 'user-profile' );

	/**
	 * Filters whether to enable user auto-complete for non-super admins in Multisite.
	 *
	 * @since 3.4.0
	 *
	 * @param bool $enable Whether to enable auto-complete for non-super admins. Default false.
	 */
	if ( is_multisite() && current_user_can( 'promote_users' ) && ! wp_is_large_network( 'users' )
		&& ( current_user_can( 'manage_network_users' ) || apply_filters( 'autocomplete_users_for_site_admins', false ) )
	) {
		wp_enqueue_script( 'user-suggest' );
	}

	require_once ABSPATH . 'wp-admin/admin-header.php';

	if ( isset( $_GET['update'] ) ) {
		$messages = array();
		if ( is_multisite() ) {
			$edit_link = '';
			if ( ( isset( $_GET['user_id'] ) ) ) {
				$user_id_new = absint( $_GET['user_id'] );
				if ( $user_id_new ) {
					$edit_link = esc_url( add_query_arg( 'wp_http_referer', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), get_edit_user_link( $user_id_new ) ) );
				}
			}

			switch ( $_GET['update'] ) {
				case 'newuserconfirmation':
					$messages[] = __( 'Invitation email sent to new user. A confirmation link must be clicked before their account is created.' );
					break;
				case 'add':
					$messages[] = __( 'Invitation email sent to user. A confirmation link must be clicked for them to be added to your site.' );
					break;
				case 'addnoconfirmation':
					$message = __( 'User has been added to your site.' );

					if ( $edit_link ) {
						$message .= sprintf( ' <a href="%s">%s</a>', $edit_link, __( 'Edit user' ) );
					}

					$messages[] = $message;
					break;
				case 'addexisting':
					$messages[] = __( 'That user is already a member of this site.' );
					break;
				case 'could_not_add':
					$add_user_errors = new WP_Error( 'could_not_add', __( 'That user could not be added to this site.' ) );
					break;
				case 'created_could_not_add':
					$add_user_errors = new WP_Error( 'created_could_not_add', __( 'User has been created, but could not be added to this site.' ) );
					break;
				case 'does_not_exist':
					$add_user_errors = new WP_Error( 'does_not_exist', __( 'The requested user does not exist.' ) );
					break;
				case 'enter_email':
					$add_user_errors = new WP_Error( 'enter_email', __( 'Please enter a valid email address.' ) );
					break;
			}
		} else {
			if ( 'add' === $_GET['update'] ) {
				$messages[] = __( 'User added.' );
			}
		}
	}
	?>
	<div class="wrap">
	<h1 id="add-new-user">
	<?php
	if ( current_user_can( 'create_users' ) ) {
		_e( 'Add New User' );
	} elseif ( current_user_can( 'promote_users' ) ) {
		_e( 'Add Existing User' );
	}
	?>
	</h1>

	<?php if ( isset( $errors ) && is_wp_error( $errors ) ) : ?>
		<div class="error">
			<ul>
			<?php
			foreach ( $errors->get_error_messages() as $err ) {
				echo "<li>$err</li>\n";
			}
			?>
			</ul>
		</div>
		<?php
	endif;

	if ( ! empty( $messages ) ) {
		foreach ( $messages as $msg ) {
			echo '<div id="message" class="updated notice is-dismissible"><p>' . $msg . '</p></div>';
		}
	}
	?>

	<?php if ( isset( $add_user_errors ) && is_wp_error( $add_user_errors ) ) : ?>
		<div class="error">
			<?php
			foreach ( $add_user_errors->get_error_messages() as $message ) {
				echo "<p>$message</p>";
			}
			?>
		</div>
	<?php endif; ?>
	<div id="ajax-response"></div>

	<?php
	if ( is_multisite() && current_user_can( 'promote_users' ) ) {
		if ( $do_both ) {
			echo '<h2 id="add-existing-user">' . __( 'Add Existing User' ) . '</h2>';
		}
		if ( ! current_user_can( 'manage_network_users' ) ) {
			echo '<p>' . __( 'Enter the email address of an existing user on this network to invite them to this site. That person will be sent an email asking them to confirm the invite.' ) . '</p>';
			$label = __( 'Email' );
			$type  = 'email';
		} else {
			echo '<p>' . __( 'Enter the email address or username of an existing user on this network to invite them to this site. That person will be sent an email asking them to confirm the invite.' ) . '</p>';
			$label = __( 'Email or Username' );
			$type  = 'text';
		}
		?>
	<form method="post" name="adduser" id="adduser" class="validate" novalidate="novalidate"
		<?php
		/**
		 * Fires inside the adduser form tag.
		 *
		 * @since 3.0.0
		 */
		do_action( 'user_new_form_tag' );
		?>
	>
	<input name="action" type="hidden" value="adduser" />
		<?php wp_nonce_field( 'add-user', '_wpnonce_add-user' ); ?>

	<table class="form-table" role="presentation">
		<tr class="form-field form-required">
			<th scope="row"><label for="adduser-email"><?php echo $label; ?></label></th>
			<td><input name="email" type="<?php echo $type; ?>" id="adduser-email" class="wp-suggest-user" value="" /></td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="adduser-role"><?php _e( 'Role' ); ?></label></th>
			<td><select name="role" id="adduser-role">
				<?php wp_dropdown_roles( get_option( 'default_role' ) ); ?>
				</select>
			</td>
		</tr>
		<?php if ( current_user_can( 'manage_network_users' ) ) { ?>
		<tr>
			<th scope="row"><?php _e( 'Skip Confirmation Email' ); ?></th>
			<td>
				<input type="checkbox" name="noconfirmation" id="adduser-noconfirmation" value="1" />
				<label for="adduser-noconfirmation"><?php _e( 'Add the user without sending an email that requires their confirmation.' ); ?></label>
			</td>
		</tr>
		<?php } ?>
	</table>
		<?php
		/**
		 * Fires at the end of the new user form.
		 *
		 * Passes a contextual string to make both types of new user forms
		 * uniquely targetable. Contexts are 'add-existing-user' (Multisite),
		 * and 'add-new-user' (single site and network admin).
		 *
		 * @since 3.7.0
		 *
		 * @param string $type A contextual string specifying which type of new user form the hook follows.
		 */
		do_action( 'user_new_form', 'add-existing-user' );
		?>
		<?php submit_button( __( 'Add Existing User' ), 'primary', 'adduser', true, array( 'id' => 'addusersub' ) ); ?>
	</form>
		<?php
	} // End if is_multisite().

	if ( current_user_can( 'create_users' ) ) {
		if ( $do_both ) {
			echo '<h2 id="create-new-user">' . __( 'Add New User' ) . '</h2>';
		}
		?>
	<p><?php _e( 'Create a brand new user and add them to this site.' ); ?></p>
	<form method="post" name="createuser" id="createuser" class="validate" novalidate="novalidate"
		<?php
		/** This action is documented in wp-admin/user-new.php */
		do_action( 'user_new_form_tag' );
		?>
	>
	<input name="action" type="hidden" value="createuser" />
		<?php wp_nonce_field( 'create-user', '_wpnonce_create-user' ); ?>
		<?php
		// Load up the passed data, else set to a default.
		$creating = isset( $_POST['createuser'] );

		$new_user_login             = $creating && isset( $_POST['user_login'] ) ? wp_unslash( $_POST['user_login'] ) : '';
		$new_user_firstname         = $creating && isset( $_POST['first_name'] ) ? wp_unslash( $_POST['first_name'] ) : '';
		$new_user_lastname          = $creating && isset( $_POST['last_name'] ) ? wp_unslash( $_POST['last_name'] ) : '';
		$new_user_email             = $creating && isset( $_POST['email'] ) ? wp_unslash( $_POST['email'] ) : '';
		$new_user_uri               = $creating && isset( $_POST['url'] ) ? wp_unslash( $_POST['url'] ) : '';
		$new_user_role              = $creating && isset( $_POST['role'] ) ? wp_unslash( $_POST['role'] ) : '';
		$new_user_send_notification = $creating && ! isset( $_POST['send_user_notification'] ) ? false : true;
		$new_user_ignore_pass       = $creating && isset( $_POST['noconfirmation'] ) ? wp_unslash( $_POST['noconfirmation'] ) : '';

		?>
	<table class="form-table" role="presentation">
		<tr class="form-field form-required">
			<th scope="row"><label for="user_login"><?php _e( 'Username' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
			<td><input name="user_login" type="text" id="user_login" value="<?php echo esc_attr( $new_user_login ); ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" /></td>
		</tr>
		<tr class="form-field form-required">
			<th scope="row"><label for="email"><?php _e( 'Email' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
			<td><input name="email" type="email" id="email" value="<?php echo esc_attr( $new_user_email ); ?>" /></td>
		</tr>
		<?php if ( ! is_multisite() ) { ?>
		<tr class="form-field">
			<th scope="row"><label for="first_name"><?php _e( 'First Name' ); ?> </label></th>
			<td><input name="first_name" type="text" id="first_name" value="<?php echo esc_attr( $new_user_firstname ); ?>" /></td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="last_name"><?php _e( 'Last Name' ); ?> </label></th>
			<td><input name="last_name" type="text" id="last_name" value="<?php echo esc_attr( $new_user_lastname ); ?>" /></td>
		</tr>
		<tr class="form-field">
			<th scope="row"><label for="url"><?php _e( 'Website' ); ?></label></th>
			<td><input name="url" type="url" id="url" class="code" value="<?php echo esc_attr( $new_user_uri ); ?>" /></td>
		</tr>
			<?php
			$languages = get_available_languages();
			if ( $languages ) :
				?>
			<tr class="form-field user-language-wrap">
				<th scope="row">
					<label for="locale">
						<?php /* translators: The user language selection field label. */ ?>
						<?php _e( 'Language' ); ?><span class="dashicons dashicons-translation" aria-hidden="true"></span>
					</label>
				</th>
				<td>
					<?php
					wp_dropdown_languages(
						array(
							'name'                        => 'locale',
							'id'                          => 'locale',
							'selected'                    => 'site-default',
							'languages'                   => $languages,
							'show_available_translations' => false,
							'show_option_site_default'    => true,
						)
					);
					?>
				</td>
			</tr>
			<?php endif; ?>
		<tr class="form-field form-required user-pass1-wrap">
			<th scope="row">
				<label for="pass1">
					<?php _e( 'Password' ); ?>
					<span class="description hide-if-js"><?php _e( '(required)' ); ?></span>
				</label>
			</th>
			<td>
				<input class="hidden" value=" " /><!-- #24364 workaround -->
				<button type="button" class="button wp-generate-pw hide-if-no-js"><?php _e( 'Generate password' ); ?></button>
				<div class="wp-pwd">
					<?php $initial_password = wp_generate_password( 24 ); ?>
					<span class="password-input-wrapper">
						<input type="password" name="pass1" id="pass1" class="regular-text" autocomplete="off" data-reveal="1" data-pw="<?php echo esc_attr( $initial_password ); ?>" aria-describedby="pass-strength-result" />
					</span>
					<button type="button" class="button wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password' ); ?>">
						<span class="dashicons dashicons-hidden" aria-hidden="true"></span>
						<span class="text"><?php _e( 'Hide' ); ?></span>
					</button>
					<div style="display:none" id="pass-strength-result" aria-live="polite"></div>
				</div>
			</td>
		</tr>
		<tr class="form-field form-required user-pass2-wrap hide-if-js">
			<th scope="row"><label for="pass2"><?php _e( 'Repeat Password' ); ?> <span class="description"><?php _e( '(required)' ); ?></span></label></th>
			<td>
			<input name="pass2" type="password" id="pass2" autocomplete="off" aria-describedby="pass2-desc" />
			<p class="description" id="pass2-desc"><?php _e( 'Type the password again.' ); ?></p>
			</td>
		</tr>
		<tr class="pw-weak">
			<th><?php _e( 'Confirm Password' ); ?></th>
			<td>
				<label>
					<input type="checkbox" name="pw_weak" class="pw-checkbox" />
					<?php _e( 'Confirm use of weak password' ); ?>
				</label>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e( 'Send User Notification' ); ?></th>
			<td>
				<input type="checkbox" name="send_user_notification" id="send_user_notification" value="1" <?php checked( $new_user_send_notification ); ?> />
				<label for="send_user_notification"><?php _e( 'Send the new user an email about their account.' ); ?></label>
			</td>
		</tr>
		<?php } // End if ! is_multisite(). ?>
		<?php if ( current_user_can( 'promote_users' ) ) { ?>
		<tr class="form-field">
			<th scope="row"><label for="role"><?php _e( 'Role' ); ?></label></th>
			<td><select name="role" id="role">
				<?php
				if ( ! $new_user_role ) {
					$new_user_role = get_option( 'default_role' );
				}
				wp_dropdown_roles( $new_user_role );
				?>
				</select>
			</td>
		</tr>
		<?php } ?>
		<?php if ( is_multisite() && current_user_can( 'manage_network_users' ) ) { ?>
		<tr>
			<th scope="row"><?php _e( 'Skip Confirmation Email' ); ?></th>
			<td>
				<input type="checkbox" name="noconfirmation" id="noconfirmation" value="1" <?php checked( $new_user_ignore_pass ); ?> />
				<label for="noconfirmation"><?php _e( 'Add the user without sending an email that requires their confirmation.' ); ?></label>
			</td>
		</tr>
		<?php } ?>
	</table>

		<?php
		/** This action is documented in wp-admin/user-new.php */
		do_action( 'user_new_form', 'add-new-user' );
		?>

		<?php submit_button( __( 'Add New User' ), 'primary', 'createuser', true, array( 'id' => 'createusersub' ) ); ?>

	</form>
	<?php } // End if current_user_can( 'create_users' ). ?>
	<?php
	}
	
	
	



}

?>

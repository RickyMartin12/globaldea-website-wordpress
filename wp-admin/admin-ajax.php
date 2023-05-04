<?php
/**
 * WordPress Ajax Process Execution
 *
 * @package WordPress
 * @subpackage Administration
 *
 * @link https://codex.wordpress.org/AJAX_in_Plugins
 */

/**
 * Executing Ajax process.
 *
 * @since 2.1.0
 */
define( 'DOING_AJAX', true );
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}

/** Load WordPress Bootstrap */
require_once dirname( __DIR__ ) . '/wp-load.php';

/** Allow for cross-domain requests (from the front end). */
send_origin_headers();

header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
header( 'X-Robots-Tag: noindex' );

// Require a valid action parameter.
if ( empty( $_REQUEST['action'] ) || ! is_scalar( $_REQUEST['action'] ) ) {
	wp_die( '0', 400 );
}

/** Load WordPress Administration APIs */
require_once ABSPATH . 'wp-admin/includes/admin.php';

/** Load Ajax Handlers for WordPress Core */
require_once ABSPATH . 'wp-admin/includes/ajax-actions.php';

send_nosniff_header();
nocache_headers();

/** This action is documented in wp-admin/admin.php */
do_action( 'admin_init' );

$core_actions_get = array(
	'fetch-list',
	'ajax-tag-search',
	'wp-compression-test',
	'imgedit-preview',
	'oembed-cache',
	'autocomplete-user',
	'dashboard-widgets',
	'logged-in',
	'rest-nonce',
);

$core_actions_post = array(
	'oembed-cache',
	'image-editor',
	'delete-comment',
	'delete-tag',
	'delete-link',
	'delete-meta',
	'delete-post',
	'trash-post',
	'untrash-post',
	'delete-page',
	'dim-comment',
	'add-link-category',
	'add-tag',
	'get-tagcloud',
	'get-comments',
	'replyto-comment',
	'edit-comment',
	'add-menu-item',
	'add-meta',
	'add-user',
	'closed-postboxes',
	'hidden-columns',
	'update-welcome-panel',
	'menu-get-metabox',
	'wp-link-ajax',
	'menu-locations-save',
	'menu-quick-search',
	'meta-box-order',
	'get-permalink',
	'sample-permalink',
	'inline-save',
	'inline-save-tax',
	'find_posts',
	'widgets-order',
	'save-widget',
	'delete-inactive-widgets',
	'set-post-thumbnail',
	'date_format',
	'time_format',
	'wp-remove-post-lock',
	'dismiss-wp-pointer',
	'upload-attachment',
	'get-attachment',
	'query-attachments',
	'save-attachment',
	'save-attachment-compat',
	'send-link-to-editor',
	'send-attachment-to-editor',
	'save-attachment-order',
	'media-create-image-subsizes',
	'heartbeat',
	'get-revision-diffs',
	'save-user-color-scheme',
	'update-widget',
	'query-themes',
	'parse-embed',
	'set-attachment-thumbnail',
	'parse-media-shortcode',
	'destroy-sessions',
	'install-plugin',
	'update-plugin',
	'crop-image',
	'generate-password',
	'save-wporg-username',
	'delete-plugin',
	'search-plugins',
	'search-install-plugins',
	'activate-plugin',
	'update-theme',
	'delete-theme',
	'install-theme',
	'get-post-thumbnail-html',
	'get-community-events',
	'edit-theme-plugin-file',
	'wp-privacy-export-personal-data',
	'wp-privacy-erase-personal-data',
	'health-check-site-status-result',
	'health-check-dotorg-communication',
	'health-check-is-in-debug-mode',
	'health-check-background-updates',
	'health-check-loopback-requests',
	'health-check-get-sizes',
	'toggle-auto-updates',
	'send-password-reset',
);

// Deprecated.
$core_actions_post_deprecated = array(
	'wp-fullscreen-save-post',
	'press-this-save-post',
	'press-this-add-category',
	'health-check-dotorg-communication',
	'health-check-is-in-debug-mode',
	'health-check-background-updates',
	'health-check-loopback-requests',
);

$core_actions_post = array_merge( $core_actions_post, $core_actions_post_deprecated );

// Register core Ajax calls.
if ( ! empty( $_GET['action'] ) && in_array( $_GET['action'], $core_actions_get, true ) ) {
	add_action( 'wp_ajax_' . $_GET['action'], 'wp_ajax_' . str_replace( '-', '_', $_GET['action'] ), 1 );
}

if ( ! empty( $_POST['action'] ) && in_array( $_POST['action'], $core_actions_post, true ) ) {
	add_action( 'wp_ajax_' . $_POST['action'], 'wp_ajax_' . str_replace( '-', '_', $_POST['action'] ), 1 );
}

add_action( 'wp_ajax_nopriv_generate-password', 'wp_ajax_nopriv_generate_password' );

add_action( 'wp_ajax_nopriv_heartbeat', 'wp_ajax_nopriv_heartbeat', 1 );

$action = $_REQUEST['action'];

date_default_timezone_set('Europe/Lisbon');

// Submeter a avaliacao do artigo ao tema correspondente

add_action('wp_ajax_nopriv_edit_post_temas_form_submission_avaliar_dados', 'edit_post_temas_form_submission_avaliar_dados');
add_action('wp_ajax_edit_post_temas_form_submission_avaliar_dados', 'edit_post_temas_form_submission_avaliar_dados');

// Administrador --> Utilizador Normal
function edit_post_temas_form_submission_avaliar_dados(  ) {
    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];

    $status = $_REQUEST['status'];

    $tema_id = $_REQUEST['tema_id'];

    if ($title != "")
    {

        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true,
        );

        wp_update_post ($my_post);

        foreach ($files as $file)
        {
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $mensagem = 'Edição do Post '.$post_id.' foi editado com sucesso.';
        $mensagem .= '<br>';
        $email_author = get_the_author_meta('user_email', $user_id);
        $autor = get_the_author_meta( 'display_name', $user_id);
        $username = get_the_author_meta( 'user_login', $user_id);
        $display_name = '';

        if ($status === 'pending')
        {
            $mensagem .= 'O artigo tem que fazer algumas retificações para ser aprovado o artigo '.$post_id;
            $mensagem .= '<br>';
            $mensagem .= 'O Administrador vai enviar um comentario ao utilizador sobre o artigo número '.$post_id;
            $to = 'info@globaldea.com';
            $subject = "Dados do Artigo ".$post_id." publicado com sucesso";
            $headers = array('Content-Type: text/html; charset=UTF-8');

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }



                }
            }

            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {
                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }
            }


            $l = 'admin.php?page=listar-temas-disponiveis&s='.$title;

            $p = 'admin.php?page=listar-temas';
            $url = admin_url( $l );

            $link = "<a href='".$url."'>Link do Tema do artigo $post_id</a>";


            $body_client_p = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Username: </b> $username<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                 <b>Status: </b> $status<br /><br/>
				 <b>Link: </b> $link<br /><br/>
                 </div>";

            wp_mail($to, $subject, $body_client_p, $headers);

            wp_mail($email_author, $subject, $body_client_p, $headers);

            $url_admin = admin_url($p);

        }
        else if ($status === 'trash')
        {
            $mensagem .= 'O artigo foi reprovado pelo administrador';
            $to = 'info@globaldea.com';

            $subject = "Dados do Artigo ".$post_id." publicado com sucesso";
            $headers = array('Content-Type: text/html; charset=UTF-8');

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }



                }
            }

            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {
                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }
            }

            $l = 'admin.php?editar-artigo-tema-disponivel&post_id='.$post_id.'&tema_id='.$tema_id;

            $p = 'admin.php?page=listar-temas';
            $url = admin_url( $l );

            $link = "<a href='".$url."'>Link do Tema do artigo $post_id</a>";

            $body_client_p = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Username: </b> $username<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                 <b>Status: </b> $status<br /><br/>
				 <b>Link: </b> $link<br /><br/>
                 </div>";

            wp_mail($to, $subject, $body_client_p, $headers);

            wp_mail($email_author, $subject, $body_client_p, $headers);

            $url_admin = admin_url($p);






        }
        else if ($status === 'publish')
        {
            $mensagem .= 'O artigo foi publicado no plataforma globaldea';
            $to = 'info@globaldea.com';
            $subject = "Dados do Artigo ".$post_id." publicado com sucesso";
            $headers = array('Content-Type: text/html; charset=UTF-8');

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }



                }
            }

            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {
                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }
            }


            $l = 'admin.php?page=listar-temas-disponiveis&s='.$title;

            $p = 'admin.php?page=gerir-posts&s='.$title;
            $url = admin_url( $p );

            $link = "<a href='".$url."'>Link do Tema do artigo $post_id</a>";


            $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                 <b>Status: </b> $status<br />
				 <b>Link: </b> $link<br />
                 </div>";


            wp_mail($to, $subject, $body_client, $headers);

            wp_mail($email_author, $subject, $body_client, $headers);

            $url_admin = admin_url($l);

        }

        $display = get_the_author_meta( 'display_name', get_current_user_id());


        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'status' => $status, 'title' => $title, 'username' => $display, 'url' => $url_admin);
    }
    else
    {

        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1);
    }

    wp_send_json_success($r);
}

// Submeter um comentario do tema do artigo - Administrador

add_action('wp_ajax_nopriv_add_comment_article_admin', 'add_comment_article_admin');
add_action('wp_ajax_add_comment_article_admin', 'add_comment_article_admin');

function add_comment_article_admin()
{
    $comment = $_REQUEST['comment'];
    $post_id = $_REQUEST['post_id'];
    $user_id = $_REQUEST['id'];




    if($comment != null)
    {



        $valor_erro = 0;
        $comments_array = get_comments(array(
            'post_id' => $post_id));
        foreach($comments_array as $comment_array) {
            if($comment_array->comment_content === $comment)
            {
                $valor_erro = 1;
                break;
            }
        }

        if ($valor_erro == 0)
        {
            $mensagem = 'O Comentario do artigo '.$post_id. ' foi adicionado com sucesso';

            $url = admin_url( 'admin.php?page=listar-temas' );

            $commentdata = array(
                'comment_post_ID'      => $post_id,
                'comment_content'      => $comment, // Fixed value - can be dynamic.
                'user_id'              => $user_id,     // Passing current user ID or any predefined as per the demand.
            );

            // Insert new comment and get the comment ID.
            $comment_id = wp_new_comment( $commentdata );

            $r = array('mensagem' => $mensagem, 'err' => 0, 'comment' => $comment_id, 'url' => $url);
        }
        else
        {
            $mensagem = 'O Comentario duplicado. Coloca outro texto por favor';
            $r = array('mensagem' => $mensagem, 'err' => 2);
        }

    }
    else
    {
        $mensagem = ' O Comentário tem que que ser preenchido';
        $r = array('mensagem' => $mensagem, 'err' => 1, 'comment' => '', 'url' => '');
    }

    wp_send_json_success($r);
}

// Submissão da Edicao do Artigo ao Tema Correspondente - Administrador

add_action('wp_ajax_nopriv_edit_post_temas_form_submission_admin', 'edit_post_temas_form_submission_admin');
add_action('wp_ajax_edit_post_temas_form_submission_admin', 'edit_post_temas_form_submission_admin');


function edit_post_temas_form_submission_admin(  ) {
    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];

    $status = $_REQUEST['status'];

    $tema_id = $_REQUEST['tema_id'];

    if ($title != "")
    {

        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true,
        );

        wp_update_post ($my_post);

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $mensagem = 'Edição do Post '.$post_id.' foi editado com sucesso.';
        $mensagem .= '<br>';

        $display_name = '';




            $email_author = get_the_author_meta('user_email', $user_id);
            $autor = get_the_author_meta( 'display_name', $user_id);

            $mensagem .= 'Iremos enviar um email com os dados editados do email '.$email_author.' do utilizador '.$autor;

            $to = $email_author;
            $subject = "Dados do Artigo ".$post_id." para a serem avaliados para o utilizador";
            $headers = array('Content-Type: text/html; charset=UTF-8');

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }



                }
            }


            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {

                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }



            }

            $l = 'admin.php?page=editar-artigo-tema-administrador&tema_id='.$tema_id.'&post_id='.$post_id;

            $url = admin_url( $l );

            $link = "<a href='".$url."'>Link do Tema do artigo $post_id</a>";


            $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                     <b>Status: </b> $status<br />
					 <b>Link: </b> $link<br />
                 </div>";


            wp_mail($to, $subject, $body_client, $headers);

            if($status === 'pending' && $user_id != get_current_user_id())
            {
                $mensagem .= ' O Administrador vai enviar um Comentário para este artigo';

                $display_name = get_the_author_meta('display_name', get_current_user_id());

                $url_admin = '';
            }
            else
            {
                $url_admin = admin_url('admin.php?page=listar-temas');
            }






        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'status' => $status, 'title' => $title, 'username' => $display_name, 'url' => $url_admin);
    }
    else
    {

        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1);
    }

    wp_send_json_success($r);
}

// -- Upload de ficheiros do artigo ao tema no administrador

add_action( 'wp_ajax_file_upload_edit_temas_artigos_admin', 'file_upload_edit_temas_artigos_admin_callback' );
add_action( 'wp_ajax_nopriv_file_upload_edit_temas_artigos_admin', 'file_upload_edit_temas_artigos_admin_callback' );

function file_upload_edit_temas_artigos_admin_callback() {

    $r = array();
    $file_temas_edit = $_FILES["file_temas_edit"];
    foreach ( $file_temas_edit['name'] as $key => $value ) {
        if ( $file_temas_edit['name'][ $key ] ) {
            $file = array(
                'name' => $file_temas_edit['name'][ $key ],
                'type' => $file_temas_edit['type'][ $key ],
                'tmp_name' => $file_temas_edit['tmp_name'][ $key ],
                'error' => $file_temas_edit['error'][ $key ],
                'size' => $file_temas_edit['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);




            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);

}

// -- Adicionar comentario ao artigo

add_action('wp_ajax_nopriv_add_comment_artigo_tema', 'add_comment_artigo_tema');
add_action('wp_ajax_add_comment_artigo_tema', 'add_comment_artigo_tema');

function add_comment_artigo_tema()
{
    $comment = $_REQUEST['comment'];
    $post_id = $_REQUEST['post_id'];
    $user_id = $_REQUEST['id'];




    if($comment != null)
    {



        $valor_erro = 0;
        $comments_array = get_comments(array(
            'post_id' => $post_id));
        foreach($comments_array as $comment_array) {
            if($comment_array->comment_content === $comment)
            {
                $valor_erro = 1;
                break;
            }
        }

        if ($valor_erro == 0)
        {
            $mensagem = 'O Comentario do artigo '.$post_id. ' foi adicionado com sucesso';

            $commentdata = array(
                'comment_post_ID'      => $post_id,
                'comment_content'      => $comment, // Fixed value - can be dynamic.
                'user_id'              => $user_id,     // Passing current user ID or any predefined as per the demand.
            );

            // Insert new comment and get the comment ID.
            $comment_id = wp_new_comment( $commentdata );

            $r = array('mensagem' => $mensagem, 'err' => 0, 'comment' => $comment_id);
        }
        else
        {
            $mensagem = 'O Comentario duplicado. Coloca outro texto por favor';
            $r = array('mensagem' => $mensagem, 'err' => 2);
        }

    }
    else
    {
        $mensagem = ' O Comentário tem que que ser preenchido';
        $r = array('mensagem' => $mensagem, 'err' => 1, 'comment' => '');
    }

    wp_send_json_success($r);
}

// -- Editar o estado do tema

add_action('wp_ajax_nopriv_edit_tema', 'edit_tema');
add_action('wp_ajax_edit_tema', 'edit_tema');

function edit_tema()
{
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $title = $_REQUEST['title_tema'];
    $status = $_REQUEST['status'];
    $user_id = $_REQUEST['user_id'];
    $tipo_pub = $_REQUEST['tipo_publicaco_formulario'];
    $tema_id = $_REQUEST['tema_id'];

    $err = '';

    if ($content === "")
    {
        $err .= 1;
    }

    if ($title === "")
    {
        $err .= 1;
    }

    if ($err != '')
    {
        if($err == 11)
        {
            $msg = array('O Titulo do Tema tem que ser preenchido', 'O Conteudo do tema não pode estar vazio');

        }
        else if($title === "" && $err == 1)
        {
            $msg = "O Titulo do Tema tem que ser preenchido";
        }
        else if($content === "" && $err == 1)
        {
            $msg = "O Conteudo do tema não pode estar vazio";
        }

        $r = array ('erros' => $err, 'mensagem' => $msg, 'title' => $title, 'content' => $content);
    }
    else
    {
        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        $my_post = array(
            'ID' => $tema_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names
        );

        wp_update_post ($my_post);

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $tema_id
            );

            wp_update_post( $post_file );
        }

        $msg = 'O tema '.$tema_id.' foi actualizado com sucesso <br>';

        if($status === 'publish')
        {
            $msg .= 'O tema esta disponivel para ser atribuido um novo artigo';
        }

        $url = admin_url( 'admin.php?page=listar-temas' );
        $r = array ('erros' => 0, 'mensagem' => $msg, 'id' => $tema_id, 'url' => $url);
    }



    wp_send_json_success($r);
}



// -- Upload do Ficheiros de edição de temas

add_action( 'wp_ajax_file_temas_upload_edit', 'file_temas_upload_edit_callback' );
add_action( 'wp_ajax_nopriv_file_temas_upload_edit', 'file_temas_upload_edit_callback' );

function file_temas_upload_edit_callback() {

    $r = array();
    $files_edit = $_FILES["file_temas_edit"];
    foreach ( $files_edit['name'] as $key => $value ) {
        if ( $files_edit['name'][ $key ] ) {
            $file = array(
                'name' => $files_edit['name'][ $key ],
                'type' => $files_edit['type'][ $key ],
                'tmp_name' => $files_edit['tmp_name'][ $key ],
                'error' => $files_edit['error'][ $key ],
                'size' => $files_edit['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);




            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);

}

// -- Listagem de Remoção de Ficheiros de acordo com o tema correspondente

add_action('wp_ajax_nopriv_delete_tema_files', 'delete_tema_files');
add_action('wp_ajax_delete_tema_files', 'delete_tema_files');

function delete_tema_files(  ) {
    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';

    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);


}

// -- Listagem de Ficheiros de acordo com o tema correspondente

add_action('wp_ajax_nopriv_list_files_temas', 'list_files_temas');
add_action('wp_ajax_list_files_temas', 'list_files_temas');

function list_files_temas(  )
{
    $tema_id = $_REQUEST['tema_id'];
    $r = array();
    $args = array('post_type' => 'attachment', 'posts_per_page' => -1, 'post_parent' => $tema_id);
    $attachments = get_posts($args);
    if ($attachments) {
        foreach ($attachments as $attachment) {
            $url = wp_get_attachment_url($attachment->ID);

            $id = $attachment->ID;
            $name = basename(get_attached_file($attachment->ID));
            //echo '<input type="button" name="insert" value="'.$id.'" onclick="delete_file_post_id('.$id.');" />'
            $r[] = array('name' => $name, 'id' => $id, 'url' => $url);

        }
    }

    wp_send_json_success($r);
}


// -- Submissao do Artigo criado ao tema correspondente

add_action('wp_ajax_nopriv_inserir_post_tema_atr_admin', 'inserir_post_tema_atr_admin');
add_action('wp_ajax_inserir_post_tema_atr_admin', 'inserir_post_tema_atr_admin');

function inserir_post_tema_atr_admin(  ) {

    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];
    $tema_id = $_REQUEST['tema_id'];

    $status = $_REQUEST['status'];

    if($title != "")
    {
        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true,
        );

        wp_update_post ($my_post);



        $mensagem = 'O post '.$post_id.' do tema '.$tema_id.' foi criado com sucesso <br>';


        if($status === 'pending')
        {
            $mensagem .= 'Iremos enviar um email com os dados editados que vai ser avaliado pelo administardor.';



            $email_author = get_the_author_meta('user_email', $user_id);
            $autor = get_the_author_meta( 'display_name', $user_id);

            $to = 'info@globaldea.com';
            $subject = "Dados do Artigo ".$post_id." para a serem avaliados para o utilizador";
            $headers = 'From: '. $email_author . "\r\n" .
                'Reply-To: ' . $email_author . "\r\n";

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }



                }
            }


            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {

                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }



            }


            $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                     <b>Status: </b> $status<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Gerir Artigos) , Globaldea
                 </div>";
            wp_mail($to, $subject, strip_tags($body_client), $headers);

        }
        $url = admin_url( 'admin.php?page=listar-temas' );
        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'url' => $url);
    }
    else
    {
        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1, 'url' => '');
    }

    wp_send_json_success($r);
}


// -- Remover o Upload do Ficgeiro do post do tema correspondente

add_action('wp_ajax_nopriv_remove_file_post_temas_admins', 'remove_file_post_temas_admins');
add_action('wp_ajax_remove_file_post_temas_admins', 'remove_file_post_temas_admins');

function remove_file_post_temas_admins()
{
    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);
}


add_action( 'wp_ajax_file_upload_artigo_tema_admins_posts', 'file_upload_artigo_tema_admins_posts_callback' );
add_action( 'wp_ajax_nopriv_file_upload_artigo_tema_admins_posts', 'file_upload_artigo_tema_admins_posts_callback' );

function file_upload_artigo_tema_admins_posts_callback() {

    $r = array();
    $files_edit = $_FILES["file_posts_temas_adm"];

    foreach ( $files_edit['name'] as $key => $value ) {
        if ( $files_edit['name'][ $key ] ) {
            $file = array(
                'name' => $files_edit['name'][ $key ],
                'type' => $files_edit['type'][ $key ],
                'tmp_name' => $files_edit['tmp_name'][ $key ],
                'error' => $files_edit['error'][ $key ],
                'size' => $files_edit['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);

            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);

}

add_action('wp_ajax_nopriv_url_page_get_temas_atr', 'url_page_get_temas_atr');
add_action('wp_ajax_url_page_get_temas_atr', 'url_page_get_temas_atr');

function url_page_get_temas_atr()
{
    $tema_id = $_REQUEST['tema_id'];
    $tema_title = $_REQUEST['tema_title'];
    $user_id = $_REQUEST['user_id'];
    $curr_id = $_REQUEST['curr_id'];
    $url_page = $_REQUEST['url_page'];

    $url = admin_url( 'admin.php?page='.$url_page.'&user_id='.$user_id.'&post_tema_id='.$tema_id.'&post_tile_tema='.$tema_title );

    $r = array('url' => $url, 'tema_id' => $tema_id, 'titulo_tema' => $tema_title, 'user_id' => $user_id, 'curr_id' => $curr_id);

    wp_send_json_success($r);
}

// -- Listar os temas criados

// -- Acesso a Adicao de um novo artigo através do tema escolhido

add_action('wp_ajax_nopriv_inserir_post_temas_admin', 'inserir_post_temas_admin');
add_action('wp_ajax_inserir_post_temas_admin', 'inserir_post_temas_admin');

function inserir_post_temas_admin()
{

    $post_tema_id = $_REQUEST['post_tema_id'];
    $user_id = $_REQUEST['user_id'];

    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);

    $full_name = $first_name.' '.$last_name;

    $url = admin_url( 'admin.php?page=atribuir-tema-admin-novo-artigo&user_id='.$user_id.'&post_tema_id='.$post_tema_id.'&post_tile_tema='.$_REQUEST['post_title'] );


    global $wpdb;

    $r = $wpdb->prepare("SELECT post_id FROM `posts_rel_temas` where tema_id = $post_tema_id");

    $values = $wpdb->get_col( $r );

    if($values[0] != 0)
    {
        $post = get_post($values[0], 'OBJECT' );

        $time = $post->post_date;

        $my_post = array(
            'ID' => $values[0],
            'post_title'    => wp_strip_all_tags( $post->post_title ),
            'post_content'  => $post->post_content,
            'post_status'   => $post->post_status,
            'post_author'   => $user_id
        );

        wp_update_post( $my_post );

        $data_post_publicacao = get_post_field('post_date', $values[0]);
    }
    else
    {
        // NO caso de submeter uma vez

        $new_post = array(
            'post_title' => '',
            'post_author'   => $user_id,
            'post_type' => 'post',
            'post_status' => 'auto-draft',
            'post_content' => '....',
            'post_excerpt' => '....'
        );

        $post_id = wp_insert_post( $new_post );




        $wpdb->query("INSERT INTO posts_rel_temas(post_id, tema_id) VALUES('$post_id', '$post_tema_id')");

        $data_post_publicacao = get_post_field('post_date', $post_id);
    }


    $r = array('url' => $url, 'tema_id' => $post_tema_id, 'user_id' => $user_id, 'post_title' => $_REQUEST['post_title'], 'post_id' => $post_id, 'username' => $full_name);

    wp_send_json_success($r);


}

// -- Listar os temas disponiveis

// -- Alteração do estado do tema

//avaliar_tema_status

add_action('wp_ajax_nopriv_avaliar_tema_status', 'avaliar_tema_status');
add_action('wp_ajax_avaliar_tema_status', 'avaliar_tema_status');


function avaliar_tema_status(  ) {
    $tema_id = $_REQUEST['tema_id'];
    $status = $_REQUEST['status'];

    $my_post = array(
        'ID' => $tema_id,
        'post_status'   => $status,
        'post_type' => 'temas'
    );

    wp_update_post ($my_post);

    $mensagem = 'O tema '.$tema_id.' foi actualizado com sucesso';

    $url = admin_url( 'admin.php?page=listar-temas' );

    $r = array('id' => $tema_id, 'mensagem' => $mensagem, 'url' => $url);

    wp_send_json_success($r);
}


// -- Edição do Artigo os Temas Disponibilizados

add_action('wp_ajax_nopriv_edit_post_temas_disponiveis_form_submission', 'edit_post_temas_disponiveis_form_submission');
add_action('wp_ajax_edit_post_temas_disponiveis_form_submission', 'edit_post_temas_disponiveis_form_submission');


function edit_post_temas_disponiveis_form_submission(  ) {
    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];

    $status = $_REQUEST['status'];

    if ($title != "")
    {

        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true
        );

        wp_update_post ($my_post);

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $mensagem = 'Edição do Post '.$post_id.' foi editado com sucesso.';
        $mensagem .= '<br>';

        $display_name = '';

        $admin = '';

        if($status === 'pending')
        {
            $mensagem .= 'Iremos enviar um email com os dados editados que vai ser avaliado pelo administardor.';



            $email_author = get_the_author_meta('user_email', $user_id);
            $autor = get_the_author_meta( 'display_name', $user_id);

            $to = 'info@globaldea.com';
            $subject = "Dados do Artigo ".$post_id." para a serem avaliados para o utilizador";
            $headers = 'From: '. $email_author . "\r\n" .
                'Reply-To: ' . $email_author . "\r\n";

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }



                }
            }


            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {

                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }



            }


            $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                     <b>Status: </b> $mensagem<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Lista Temas Disponiveis) , Globaldea
                 </div>";
//Here put your Validation and send mail
            wp_mail($to, $subject, strip_tags($body_client), $headers);

        }
        $url = admin_url( 'admin.php?page=listar-temas-disponiveis' );



        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'status' => $status, 'title' => $title, 'admin' => $admin, 'username' => $display_name, 'url' => $url);
		
		var_dump($r);
    }
    else
    {

        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1);
    }

    wp_send_json_success($r);
}

// -- Insercao do Artigo do Tema Disponivel

add_action('wp_ajax_nopriv_inserir_post_tema_disponivel_artigo', 'inserir_post_tema_disponivel_artigo');
add_action('wp_ajax_inserir_post_tema_disponivel_artigo', 'inserir_post_tema_disponivel_artigo');

function inserir_post_tema_disponivel_artigo(  ) {

    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];
    $tema_id = $_REQUEST['tema_id'];

    $status = $_REQUEST['status'];

    if($title != "")
    {
        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true,
        );

        wp_update_post ($my_post);



        $mensagem = 'O post '.$post_id.' do tema '.$tema_id.' foi criado com sucesso <br>';

        if($status === 'pending')
        {
            $mensagem .= 'Iremos enviar um email com os dados inseridos que vai ser avaliado pelo administardor.';



            $email_author = get_the_author_meta('user_email', $user_id);
            $autor = get_the_author_meta( 'display_name', $user_id );

            $to = 'info@globaldea.com';
            $subject = "Dados do Artigo ".$post_id." para a serem avaliados para o utilizador";
            $headers = 'From: '. $email_author . "\r\n" .
                'Reply-To: ' . $email_author . "\r\n";

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }

                }
            }


            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {

                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }
            }


            $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                 <b>Status: </b> $mensagem<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Gerir Artigos) , Globaldea
                 </div>";
//Here put your Validation and send mail
            wp_mail($to, $subject, strip_tags($body_client), $headers);
        }


        $url = admin_url( 'admin.php?page=listar-temas-disponiveis' );
        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'url' => $url);
    }
    else
    {
        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1, 'url' => '');
    }

    wp_send_json_success($r);
}

// -- Disponibilizar Artigo

add_action('wp_ajax_nopriv_inserir_post_temas_disponiveis_assumidos_autor_tempo', 'inserir_post_temas_disponiveis_assumidos_autor_tempo');
add_action('wp_ajax_inserir_post_temas_disponiveis_assumidos_autor_tempo', 'inserir_post_temas_disponiveis_assumidos_autor_tempo');

function inserir_post_temas_disponiveis_assumidos_autor_tempo()
{

    $post_tema_id = $_REQUEST['post_tema_id'];
    $user_id = $_REQUEST['user_id'];

    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);

    $full_name = $first_name.' '.$last_name;

    $url = admin_url( 'admin.php?page=atribuir-tema-disponivel-novo-artigo&user_id='.$user_id.'&post_tema_id='.$post_tema_id.'&post_tile_tema='.$_REQUEST['post_title'] );

    global $wpdb;

    $r = $wpdb->prepare("SELECT post_id FROM `posts_rel_temas` where tema_id = $post_tema_id");

    $values = $wpdb->get_col( $r );

    if($values[0] != 0)
    {
        $post = get_post($values[0], 'OBJECT' );

        $time = $post->post_date;

        $my_post = array(
            'ID' => $values[0],
            'post_title'    => wp_strip_all_tags( $post->post_title ),
            'post_content'  => $post->post_content,
            'post_status'   => $post->post_status,
            'post_author'   => $user_id,
            'post_date' => $time,
            'edit_date' => true,
        );

        wp_update_post( $my_post );

        $data_post_publicacao = get_post_field('post_date', $values[0]);
    }
    else
    {
        // NO caso de submeter uma vez

        $new_post = array(
            'post_title' => '',
            'post_author'   => $user_id,
            'post_type' => 'post',
            'post_status' => 'auto-draft',
            'post_content' => '....',
            'post_excerpt' => '....'
        );

        $post_id = wp_insert_post( $new_post );




        $wpdb->query("INSERT INTO posts_rel_temas(post_id, tema_id) VALUES('$post_id', '$post_tema_id')");

        $data_post_publicacao = get_post_field('post_date', $post_id);
    }



    $time_ago_pub = strtotime($data_post_publicacao);
    $horaspub_article_vis = date('Y-m-d H:i:s', strtotime("+5 minutes", $time_ago_pub));
    $actual_data_article = date('Y-m-d H:i:s', time());

    $hr_art_vis = strtotime("+5 minutes", $time_ago_pub);
    $act_data_art = time();

    $date1 = date_create($horaspub_article_vis);

    $date2 = date_create($actual_data_article);

    $diff = date_diff($date1,$date2);

    $minutes = ($diff->days * 24 * 60) +
        ($diff->h * 60) + $diff->i;


    $r = array('url' => $url, 'tema_id' => $post_tema_id, 'user_id' => $user_id, 'post_title' => $_REQUEST['post_title'], 'p' => convertToHoursMins($minutes), 'hora_agora' => $act_data_art, 'hora_entre_pub' => $hr_art_vis, 'post_id' => $post_id, 'username' => $full_name);

    wp_send_json_success($r);


}



// Submissão da Edicao do Artigo ao Tema Correspondente - Utilizador Normal

add_action('wp_ajax_nopriv_edit_post_temas_form_submission', 'edit_post_temas_form_submission');
add_action('wp_ajax_edit_post_temas_form_submission', 'edit_post_temas_form_submission');


function edit_post_temas_form_submission(  ) {
    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];

    $status = $_REQUEST['status'];

    if ($title != "")
    {

        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true,
        );

        wp_update_post ($my_post);

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $mensagem = 'Edição do Post '.$post_id.' foi editado com sucesso.';
        $mensagem .= '<br>';

        $display_name = '';

        $admin = '';

            if($status === 'pending')
            {
                $mensagem .= 'Iremos enviar um email com os dados editados que vai ser avaliado pelo administardor.';



                $email_author = get_the_author_meta('user_email', $user_id);
                $autor = get_the_author_meta( 'display_name', $user_id);

                $to = 'info@globaldea.com';
                $subject = "Dados do Artigo ".$post_id." para a serem avaliados para o utilizador";
                $headers = 'From: '. $email_author . "\r\n" .
                    'Reply-To: ' . $email_author . "\r\n";

                $tags_n = '';

                $posttags = get_the_tags($post_id);
                $last_key = end(array_keys($posttags));
                if ($posttags) {
                    foreach($posttags as $tag => $value) {

                        if ($tag == $last_key) {
                            $tags_n .= $value->name ;
                        } else {
                            $tags_n .= $value->name . ', ';
                        }



                    }
                }


                $category_detail=get_the_category($post_id);//$post->ID
                $last_key_categoria = end(array_keys($category_detail));

                $cat_n = '';

                foreach($category_detail as $cat => $value) {

                    if ($cat == $last_key_categoria) {
                        $cat_n .= $value->cat_name ;
                    } else {
                        $cat_n .= $value->cat_name . ', ';
                    }



                }


                $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                     <b>Status: </b> $status<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Lista Temas Disponiveis) , Globaldea
                 </div>";
                wp_mail($to, $subject, strip_tags($body_client), $headers);

            }
            $url = admin_url( 'admin.php?page=listar-meus-temas' );



        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'status' => $status, 'title' => $title, 'admin' => $admin, 'username' => $display_name, 'url' => $url);
    }
    else
    {

        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1);
    }

    wp_send_json_success($r);
}

// Remoção da Edição do artigo de acordo a seleccao do tema correspodente

add_action('wp_ajax_nopriv_delete_file_post_tema_form_editor_up', 'delete_file_post_tema_form_editor_up');
add_action('wp_ajax_delete_file_post_tema_form_editor_up', 'delete_file_post_tema_form_editor_up');

function delete_file_post_tema_form_editor_up()
{
    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);
}


// Edição do artigo de acordo a seleccao do tema correspodente

add_action( 'wp_ajax_file_upload_edit_temas_artigos', 'file_upload_edit_temas_artigos_callback' );
add_action( 'wp_ajax_nopriv_file_upload_edit_temas_artigos', 'file_upload_edit_temas_artigos_callback' );

function file_upload_edit_temas_artigos_callback() {

    $r = array();
    $file_temas_edit = $_FILES["file_temas_edit"];
    foreach ( $file_temas_edit['name'] as $key => $value ) {
        if ( $file_temas_edit['name'][ $key ] ) {
            $file = array(
                'name' => $file_temas_edit['name'][ $key ],
                'type' => $file_temas_edit['type'][ $key ],
                'tmp_name' => $file_temas_edit['tmp_name'][ $key ],
                'error' => $file_temas_edit['error'][ $key ],
                'size' => $file_temas_edit['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);




            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);

}

// -- Remocao do Fichiero existente no artigo do tema correspondente

add_action('wp_ajax_nopriv_delete_file_edit_post_tema', 'delete_file_edit_post_tema');
add_action('wp_ajax_delete_file_edit_post_tema', 'delete_file_edit_post_tema');

function delete_file_edit_post_tema(  ) {


    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);



}

// -- Seleccao de Ficheiro do Post do tema correspondente

add_action('wp_ajax_nopriv_list_files_post_temas', 'list_files_post_temas');
add_action('wp_ajax_list_files_post_temas', 'list_files_post_temas');

function list_files_post_temas(  ) {
    $post_id = $_REQUEST['post_id'];
    $r = array();
    $args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_parent' => $post_id );
    $attachments = get_posts( $args );
    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
            $url = wp_get_attachment_url( $attachment->ID );

            $id= $attachment->ID;
            $name = basename ( get_attached_file( $attachment->ID ));
            //echo '<input type="button" name="insert" value="'.$id.'" onclick="delete_file_post_id('.$id.');" />'
            $r[] = array('name' => $name, 'id' => $id, 'url' => $url);

        }
    }

    wp_send_json_success($r);

}

// Inserção de um novo artigo de acordo a seleccao do tema correspodente

// -- Insercao do Artigo pelo tema correspodente

add_action('wp_ajax_nopriv_inserir_post_tema_atr', 'inserir_post_tema_atr');
add_action('wp_ajax_inserir_post_tema_atr', 'inserir_post_tema_atr');

function inserir_post_tema_atr(  ) {

    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];
    $tema_id = $_REQUEST['tema_id'];

    $status = $_REQUEST['status'];

    if($title != "")
    {
        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true,
        );

        wp_update_post ($my_post);



        $mensagem = 'O post '.$post_id.' do tema '.$tema_id.' foi criado com sucesso <br>';

        if($status === 'pending')
        {
            $mensagem .= 'Iremos enviar um email com os dados inseridos que vai ser avaliado pelo administardor.';



            $email_author = get_the_author_meta('user_email', $user_id);
            $autor = get_the_author_meta( 'display_name', $user_id );

            $to = 'info@globaldea.com';
            $subject = "Dados do Artigo ".$post_id." para a serem avaliados para o utilizador";
            $headers = 'From: '. $email_author . "\r\n" .
                'Reply-To: ' . $email_author . "\r\n";

            $tags_n = '';

            $posttags = get_the_tags($post_id);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }

                }
            }


            $category_detail=get_the_category($post_id);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {

                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }
            }


            $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                 <b>Status: </b> $mensagem<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Gerir Artigos) , Globaldea
                 </div>";
//Here put your Validation and send mail
            wp_mail($to, $subject, strip_tags($body_client), $headers);
        }


        $url = admin_url( 'admin.php?page=listar-meus-temas' );
        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'url' => $url);
    }
    else
    {
        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1, 'url' => '');
    }

    wp_send_json_success($r);
}

// -- Remover o Upload do Ficgeiro do post do tema correspondente

add_action('wp_ajax_nopriv_remove_file_post_temas', 'remove_file_post_temas');
add_action('wp_ajax_remove_file_post_temas', 'remove_file_post_temas');

function remove_file_post_temas()
{
    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);
}

// -- Upload de Ficheiros do post do tema correspodente

add_action( 'wp_ajax_file_upload_artigo_tema', 'file_upload_artigo_tema_callback' );
add_action( 'wp_ajax_nopriv_file_upload_artigo_tema', 'file_upload_artigo_tema_callback' );

function file_upload_artigo_tema_callback() {

    $r = array();
    $files_edit = $_FILES["file_posts_temas"];

    foreach ( $files_edit['name'] as $key => $value ) {
        if ( $files_edit['name'][ $key ] ) {
            $file = array(
                'name' => $files_edit['name'][ $key ],
                'type' => $files_edit['type'][ $key ],
                'tmp_name' => $files_edit['tmp_name'][ $key ],
                'error' => $files_edit['error'][ $key ],
                'size' => $files_edit['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);

            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);

}


// Listagem de Temas

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

// -- Disponibilizar Artigo

add_action('wp_ajax_nopriv_assumirTema', 'assumirTema');
add_action('wp_ajax_assumirTema', 'assumirTema');

function assumirTema()
{
    $post_tema_id = $_REQUEST['post_tema_id'];
    $user_id = $_REQUEST['user_id'];
    $post_title = "'".$_REQUEST['post_title']."'";

    $url = admin_url( 'admin.php?page=atribuir-tema-novo-artigo&user_id='.$user_id.'&post_tema_id='.$post_tema_id.'&post_tile='.$post_title );

    $r = array('url' => $url, 'tema_id' => $post_tema_id, 'user_id' => $user_id, 'post_title' => $post_title);

    wp_send_json_success($r);
}

// -- Disponibilizar Artigo Novamente

// -- Remover Artigo e relacao entre temas e artigos que foi submetidos e foram ultrapados na submissao do limite

add_action('wp_ajax_nopriv_remove_rel_post_tema', 'remove_rel_post_tema');
add_action('wp_ajax_remove_rel_post_tema', 'remove_rel_post_tema');

function remove_rel_post_tema()
{
    $post_id = $_REQUEST['post_id'];
    $tema_id = $_REQUEST['tema_id'];

    // Apagar post_id e tema_id da relacao

    global $post, $wpdb;

    $wpdb->query( $wpdb->prepare("DELETE FROM `posts_rel_temas` where tema_id = ".$tema_id." and post_id = ".$post_id));

    //$wpdb->query( $wpdb->prepare("DELETE FROM wp_posts where ID = ".$post_id));

    $url = admin_url( 'admin.php?page=listar-meus-temas');

    $r = array('url' => $url);

    wp_send_json_success($r);




}

// -- Disponibilizar Artigo

add_action('wp_ajax_nopriv_inserir_post_temas', 'inserir_post_temas');
add_action('wp_ajax_inserir_post_temas', 'inserir_post_temas');

function inserir_post_temas()
{

    $post_tema_id = $_REQUEST['post_tema_id'];
    $user_id = $_REQUEST['user_id'];

    $url = admin_url( 'admin.php?page=atribuir-tema-novo-artigo&user_id='.$user_id.'&post_tema_id='.$post_tema_id.'&post_tile_tema='.$_REQUEST['post_title'] );


    global $wpdb;

    $r = $wpdb->prepare("SELECT post_id FROM `posts_rel_temas` where tema_id = $post_tema_id");

    $values = $wpdb->get_col( $r );

    if($values[0] != 0)
    {
        $post = get_post($values[0], 'OBJECT' );

        $time = $post->post_date;

        $my_post = array(
            'ID' => $values[0],
            'post_title'    => wp_strip_all_tags( $post->post_title ),
            'post_content'  => $post->post_content,
            'post_status'   => $post->post_status,
            'post_author'   => $user_id,
            'post_date' => $time,
            'edit_date' => true,
        );

        wp_update_post( $my_post );

        $data_post_publicacao = get_post_field('post_date', $values[0]);
    }
    else
    {
        // NO caso de submeter uma vez

        $new_post = array(
            'post_title' => '',
            'post_author'   => $user_id,
            'post_type' => 'post',
            'post_status' => 'auto-draft',
            'post_content' => '....',
            'post_excerpt' => '....'
        );

        $post_id = wp_insert_post( $new_post );




        $wpdb->query("INSERT INTO posts_rel_temas(post_id, tema_id) VALUES('$post_id', '$post_tema_id')");

        $data_post_publicacao = get_post_field('post_date', $post_id);
    }





    $time_ago_pub = strtotime($data_post_publicacao);
    $horaspub_article_vis = date('Y-m-d H:i:s', strtotime("+5 minutes", $time_ago_pub));
    $actual_data_article = date('Y-m-d H:i:s', time());

    $hr_art_vis = strtotime("+5 minutes", $time_ago_pub);
    $act_data_art = time();

    $date1 = date_create($horaspub_article_vis);

    $date2 = date_create($actual_data_article);

    $diff = date_diff($date1,$date2);

    $minutes = ($diff->days * 24 * 60) +
        ($diff->h * 60) + $diff->i;


    $r = array('url' => $url, 'tema_id' => $post_tema_id, 'user_id' => $user_id, 'post_title' => $_REQUEST['post_title'], 'p' => convertToHoursMins($minutes), 'hora_agora' => $act_data_art, 'hora_entre_pub' => $hr_art_vis, 'post_id' => $post_id);

    wp_send_json_success($r);


}



// Sugestao de Temas

// -- Adicionar Tema

add_action('wp_ajax_nopriv_add_tema', 'add_tema');
add_action('wp_ajax_add_tema', 'add_tema');

function add_tema()
{


    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $title = $_REQUEST['title_tema'];
    $status = $_REQUEST['status'];
    $user_id = $_REQUEST['user_id'];
    $tipo_pub = $_REQUEST['tipo_publicaco_formulario'];
	
	$user_roles = $_REQUEST['user_roles'];
	
	$user_meta=get_userdata($user_roles);

	$user_roles=$user_meta->roles;
	
	//var_dump($user_roles);
	
	$err = '';
	
	if ($content === "")
    {
        $err .= 1;
    }

    if ($title === "")
    {
        $err .= 1;
    }
	
	if ($err != '')
    {
        if($err == 11)
        {
            $msg = array('O Titulo do Tema tem que ser preenchido', 'O Conteudo do tema não pode estar vazio');

        }
        else if($title === "" && $err == 1)
        {
            $msg = "O Titulo do Tema tem que ser preenchido";
        }
        else if($content === "" && $err == 1)
        {
            $msg = "O Conteudo do tema não pode estar vazio";
        }

        $r = array ('erros' => $err, 'mensagem' => $msg, 'title' => $title, 'content' => $content);
    }
	else
	{
		$tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        $my_post = array(
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_author'   => $user_id,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_type' => $tipo_pub
        );
		
		$postId = wp_insert_post( $my_post );

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $postId
            );

            wp_update_post( $post_file );
        }
		
		$msg = 'O tema '.$postId.' foi criado com sucesso <br>';

		$msg .= 'Iremos enviar um email com os dados inseridos que vai ser avaliado pelo administardor.';
		$tags_n = '';

		$posttags = get_the_tags($postId);
		if ($posttags) {
				foreach($posttags as $tag) {
					$tags_n .= $tag->name . ' ';
				}
		}
		
		$cat_n = '';
		foreach (get_the_category($postId) as $c) {
				$cat = get_category($c);
				$cat_n .= $cat->name . ' ';
		}
		
		if (!in_array("administrator", $user_roles)) {
			$url = admin_url( 'admin.php?page=listar-meus-temas' );
		}
		else
		{
			$url = admin_url( 'admin.php?page=listar-temas' );
		}
		
		
		$email_author = get_the_author_meta('user_email', get_current_user_id());
        $autor = get_the_author_meta( 'display_name', get_current_user_id() );

        $to = 'r.peleira@hotmail.com';
        $subject = "Dados do Artigo ".$postId." para a serem avaliados para o utilizador";
        $headers = 'From: '. $email_author . "\r\n" .
            'Reply-To: ' . $email_author . "\r\n";
			
			
		$body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$postId." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                 <b>Status: </b> Aprovado pelo Administrador<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Gerir Artigos) , Globaldea
                 </div>";
//Here put your Validation and send mail
        wp_mail($to, $subject, strip_tags($body_client), $headers);
		
		
		
		
		$r = array ('erros' => 0, 'mensagem' => $msg, 'id' => $postId, 'tags' => $tags_n, 'cats' => $cat_n, 'url' => $url);
		
	}
	
	wp_send_json_success($r);
}

// -- Remover Ficheiros

add_action('wp_ajax_nopriv_remove_file_tema', 'remove_file_tema');
add_action('wp_ajax_remove_file_tema', 'remove_file_tema');

function remove_file_tema()
{
    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Tema '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);
}

// -- Upload Ficheiros

add_action( 'wp_ajax_file_tema_upload', 'file_tema_upload_callback' );
add_action( 'wp_ajax_nopriv_file_tema_upload', 'file_tema_upload_callback' );

function file_tema_upload_callback() {

    $r = array();
    $files = $_FILES["file_temas"];
    foreach ( $files['name'] as $key => $value ) {
        if ( $files['name'][ $key ] ) {
            $file = array(
                'name' => $files['name'][ $key ],
                'type' => $files['type'][ $key ],
                'tmp_name' => $files['tmp_name'][ $key ],
                'error' => $files['error'][ $key ],
                'size' => $files['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);




            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);
}

// Gerir Posts

// --- Adicionar Comentario ao Post

add_action('wp_ajax_nopriv_add_comment_by_post', 'add_comment_by_post');
add_action('wp_ajax_add_comment_by_post', 'add_comment_by_post');

function add_comment_by_post()
{
    $user_id = $_REQUEST['id'];
    $comment = $_REQUEST['comment'];
    $post_id = $_REQUEST['post_id'];

    if($comment != null)
    {
        $valor_erro = 0;
        $comments_array = get_comments(array(
            'post_id' => $post_id));
        foreach($comments_array as $comment_array) {
            if($comment_array->comment_content === $comment)
            {
                $valor_erro = 1;
                break;
            }
        }

        if ($valor_erro == 0)
        {
            $mensagem = 'O Comentario do artigo '.$post_id. ' foi adicionado com sucesso';

            $url = admin_url( 'admin.php?page=gerir-posts' );

            $commentdata = array(
                'comment_post_ID'      => $post_id,
                'comment_content'      => $comment, // Fixed value - can be dynamic.
                'user_id'              => $user_id,     // Passing current user ID or any predefined as per the demand.
            );

            // Insert new comment and get the comment ID.
            $comment_id = wp_new_comment( $commentdata );

            $r = array('mensagem' => $mensagem, 'err' => 0, 'comment' => $comment_id, 'url' => $url);
        }
        else
        {
            $mensagem = 'O Comentario duplicado. Coloca outro texto por favor';
            $r = array('mensagem' => $mensagem, 'err' => 2);
        }




    }
    else
    {
        $mensagem = ' O Comentário tem que que ser preenchido';
        $r = array('mensagem' => $mensagem, 'err' => 1, 'comment' => '', 'url' => '');
    }

    wp_send_json_success($r);
}

// --- Listagem de Comentários

add_action('wp_ajax_nopriv_list_comments_post', 'list_comments_post');
add_action('wp_ajax_list_comments_post', 'list_comments_post');

function list_comments_post()
{
    $c = array();
    $post_id = $_REQUEST['post_id'];
    $nested_args = array(
        'post_id' => $post_id
    );
    $count_args = array(
        'post_id' => $post_id,
        'count'   => true
    );


    $comments_count = get_comments( $count_args );
    //$r = array('count' => $comments_count);
    $comment[] = array();
    $comments_query = new WP_Comment_Query;
    $comments = $comments_query->query( $nested_args );
    if ( $comments ) {
        foreach ( $comments as $comment ) {
            $revisor = get_the_author_meta('display_name', $comment->user_id);
            $img = get_avatar( $comment->user_id, 32 );
            $c[] = array('post_id' => $post_id, 'content' => $comment->comment_content, 'user_id' => $comment->user_id, 'revisor' => $revisor, 'id' => $comment->comment_ID, 'image' => $img, 'date' => date('d/m/Y',strtotime($comment->comment_date)));
        }
    }

    $c += [ "count" => $comments_count ];
    wp_send_json_success($c);


}

// -- Salvar Comentários

add_action('wp_ajax_nopriv_save_comment_edit', 'save_comment_edit');
add_action('wp_ajax_save_comment_edit', 'save_comment_edit');

function save_comment_edit()
{
    $post_id = $_REQUEST['post_id'];
    $comment_id = $_REQUEST['comment_id'];
    $comment = $_REQUEST['comment'];

    if($comment != "")
    {

        $valor_erro = 0;
        $comments_array = get_comments(array(
            'post_id' => $post_id));
        foreach($comments_array as $comment_array) {
            if($comment_array->comment_content === $comment)
            {
                $valor_erro = 1;
                break;
            }
        }

        if ($valor_erro == 0)
        {
            $array_comments_up = array(
                'comment_ID' => $comment_id,
                'comment_post_ID'      => $post_id,
                'comment_content'      => $comment, // Fixed value - can be dynamic.
            );

            wp_update_comment( $array_comments_up );

            $mensagem = 'O comentário número '.$comment_id.' do post '.$post_id.' foi alterado com sucesso';

            $r = array('mensagem' => $mensagem, 'err' => 0, 'comment' => $comment_id, 'coment' => $comment);
        }
        else
        {
            $mensagem = 'O Comentario duplicado. Coloca outro texto por favor';
            $r = array('mensagem' => $mensagem, 'err' => 2);
        }





    }
    else
    {
        $mensagem = 'O comentário número '.$comment_id.' do post '.$post_id.' tem que ser preenchido';

        $r = array('mensagem' => $mensagem, 'err' => 1, 'comment' => $comment_id, 'coment' => '');
    }

    wp_send_json_success($r);


}

// Editar Post



add_action('wp_ajax_nopriv_remove_file_edit_up', 'remove_file_edit_up');
add_action('wp_ajax_remove_file_edit_up', 'remove_file_edit_up');

function remove_file_edit_up()
{
    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);
}


add_action('wp_ajax_nopriv_add_comment_article', 'add_comment_article');
add_action('wp_ajax_add_comment_article', 'add_comment_article');

function add_comment_article()
{
    $comment = $_REQUEST['comment'];
    $post_id = $_REQUEST['post_id'];
    $user_id = $_REQUEST['id'];




    if($comment != null)
    {



        $valor_erro = 0;
        $comments_array = get_comments(array(
            'post_id' => $post_id));
        foreach($comments_array as $comment_array) {
            if($comment_array->comment_content === $comment)
            {
                $valor_erro = 1;
                break;
            }
        }

        if ($valor_erro == 0)
        {
            $mensagem = 'O Comentario do artigo '.$post_id. ' foi adicionado com sucesso';

            $url = admin_url( 'admin.php?page=gerir-posts' );

            $commentdata = array(
                'comment_post_ID'      => $post_id,
                'comment_content'      => $comment, // Fixed value - can be dynamic.
                'user_id'              => $user_id,     // Passing current user ID or any predefined as per the demand.
            );

            // Insert new comment and get the comment ID.
            $comment_id = wp_new_comment( $commentdata );

            $r = array('mensagem' => $mensagem, 'err' => 0, 'comment' => $comment_id, 'url' => $url);
        }
        else
        {
            $mensagem = 'O Comentario duplicado. Coloca outro texto por favor';
            $r = array('mensagem' => $mensagem, 'err' => 2);
        }

    }
    else
    {
        $mensagem = ' O Comentário tem que que ser preenchido';
        $r = array('mensagem' => $mensagem, 'err' => 1, 'comment' => '', 'url' => '');
    }

    wp_send_json_success($r);
}



add_action('wp_ajax_nopriv_edita_post', 'edita_post');
add_action('wp_ajax_edita_post', 'edita_post');


function edita_post(  ) {
    $post_id = $_REQUEST['post_id'];
    $title = $_REQUEST['title_post'];
    $content = $_REQUEST['content'];
    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];
    $files = $_REQUEST['files'];
    $user_id = $_REQUEST['user_id'];

    $status = $_REQUEST['status'];

    if ($title != "")
    {

        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }

        $my_post = array(
            'ID' => $post_id,
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_category' => $categorias,
            'tags_input' => $tags_names,
            'post_date' => $_REQUEST['da'],
            'edit_date' => true,
        );

        wp_update_post ($my_post);

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $post_id
            );

            wp_update_post( $post_file );
        }


        $mensagem = 'Edição do Post '.$post_id.' foi editado com sucesso.';
        $mensagem .= '<br>';

        $user_meta_edit=get_userdata(get_current_user_id());

        $user_role_edit=$user_meta_edit->roles;

        $display_name = '';

        $admin = '';

        if(in_array("administrator", $user_role_edit) )
        {
            if($status === 'pending')
            {
                $mensagem .= ' O Administrador vai enviar um Comentário para este artigo';

                $display_name = get_the_author_meta('display_name', get_current_user_id());

                $admin = 'admin';

                $url = '';
            }
            else
            {
                $url = admin_url( 'admin.php?page=gerir-posts' );
            }

        }
        else
        {
            if($status === 'pending')
            {
                $mensagem .= 'Iremos enviar um email com os dados editados que vai ser avaliado pelo administardor.';



                $email_author = get_the_author_meta('user_email', $user_id);
                $autor = get_the_author_meta( 'display_name', $user_id);

                $to = 'info@globaldea.com';
                $subject = "Dados do Artigo ".$post_id." para a serem avaliados para o utilizador";
                $headers = 'From: '. $email_author . "\r\n" .
                    'Reply-To: ' . $email_author . "\r\n";

                $tags_n = '';

                $posttags = get_the_tags($post_id);
                $last_key = end(array_keys($posttags));
                if ($posttags) {
                    foreach($posttags as $tag => $value) {

                        if ($tag == $last_key) {
                            $tags_n .= $value->name ;
                        } else {
                            $tags_n .= $value->name . ', ';
                        }



                    }
                }


                $category_detail=get_the_category($post_id);//$post->ID
                $last_key_categoria = end(array_keys($category_detail));

                $cat_n = '';

                foreach($category_detail as $cat => $value) {

                    if ($cat == $last_key_categoria) {
                        $cat_n .= $value->cat_name ;
                    } else {
                        $cat_n .= $value->cat_name . ', ';
                    }



                }


                $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$post_id." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                     <b>Status: </b> $mensagem<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Gerir Artigos) , Globaldea
                 </div>";
//Here put your Validation and send mail
                wp_mail($to, $subject, strip_tags($body_client), $headers);

            }
            $url = admin_url( 'admin.php?page=gerir-posts' );
        }



        $r = array('id' => $post_id, 'mensagem' => $mensagem, 'error' => 0, 'status' => $status, 'title' => $title, 'admin' => $admin, 'username' => $display_name, 'url' => $url);
    }
    else
    {

        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1);
    }

    wp_send_json_success($r);
}

add_action('wp_ajax_nopriv_front_delete', 'front_delete');
add_action('wp_ajax_front_delete', 'front_delete');

function front_delete(  ) {


    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);

}


add_action('wp_ajax_nopriv_list_files_post', 'list_files_post');
add_action('wp_ajax_list_files_post', 'list_files_post');

function list_files_post(  ) {
    $post_id = $_REQUEST['post_id'];
    $r = array();
    $args = array( 'post_type' => 'attachment', 'posts_per_page' => -1, 'post_parent' => $post_id );
    $attachments = get_posts( $args );
    if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
            $url = wp_get_attachment_url( $attachment->ID );

            $id= $attachment->ID;
            $name = basename ( get_attached_file( $attachment->ID ));
            //echo '<input type="button" name="insert" value="'.$id.'" onclick="delete_file_post_id('.$id.');" />'
            $r[] = array('name' => $name, 'id' => $id, 'url' => $url);

        }
    }

    wp_send_json_success($r);




}


add_action( 'wp_ajax_file_upload_edit', 'file_upload_edit_callback' );
add_action( 'wp_ajax_nopriv_file_upload_edit', 'file_upload_edit_callback' );

function file_upload_edit_callback() {

    $r = array();
    $files_edit = $_FILES["file_edit"];
    foreach ( $files_edit['name'] as $key => $value ) {
        if ( $files_edit['name'][ $key ] ) {
            $file = array(
                'name' => $files_edit['name'][ $key ],
                'type' => $files_edit['type'][ $key ],
                'tmp_name' => $files_edit['tmp_name'][ $key ],
                'error' => $files_edit['error'][ $key ],
                'size' => $files_edit['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);




            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);

}



// Menu - Adicionar Post


add_action('wp_ajax_nopriv_add_post', 'add_post');
add_action('wp_ajax_add_post', 'add_post');

function add_post(  ) {
    $content = $_REQUEST['content'];



    $categorias = $_REQUEST['categorias'];
    $tags = $_REQUEST['tags'];

    $title = $_REQUEST['title_post'];

    $status = $_REQUEST['status'];

    if($title != "")
    {
        $tags_names = array();

        foreach ($tags as $tag)
        {
            $tag_name = get_tag($tag);
            $tags_names[] = $tag_name->name;
        }




        $files = $_REQUEST['files'];

        $my_post = array(
            'post_title'    => wp_strip_all_tags( $title ),
            'post_content'  => $content,
            'post_status'   => $status,
            'post_author'   => get_current_user_id(),
            'post_category' => $categorias,
            'tags_input' => $tags_names
        );

        $postId = wp_insert_post( $my_post );

        foreach ($files as $file)
        {
            //echo $file;
            $post_file = array(
                'ID' => $file,
                'post_parent' => $postId
            );

            wp_update_post( $post_file );
        }

        $mensagem = 'O post '.$postId.' foi criado com sucesso <br>';

        if($status === 'pending')
        {
            $mensagem .= 'Iremos enviar um email com os dados inseridos que vai ser avaliado pelo administardor.';



            $email_author = get_the_author_meta('user_email', get_current_user_id());
            $autor = get_the_author_meta( 'display_name', get_current_user_id() );

            $to = 'info@globaldea.com';
            $subject = "Dados do Artigo ".$postId." para a serem avaliados para o utilizador";
            $headers = 'From: '. $email_author . "\r\n" .
                'Reply-To: ' . $email_author . "\r\n";

            $tags_n = '';

            $posttags = get_the_tags($postId);
            $last_key = end(array_keys($posttags));
            if ($posttags) {
                foreach($posttags as $tag => $value) {

                    if ($tag == $last_key) {
                        $tags_n .= $value->name ;
                    } else {
                        $tags_n .= $value->name . ', ';
                    }



                }
            }


            $category_detail=get_the_category($postId);//$post->ID
            $last_key_categoria = end(array_keys($category_detail));

            $cat_n = '';

            foreach($category_detail as $cat => $value) {

                if ($cat == $last_key_categoria) {
                    $cat_n .= $value->cat_name ;
                } else {
                    $cat_n .= $value->cat_name . ', ';
                }



            }


            $body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Dados do Artigo ".$postId." para a serem avaliados para o utilizador</h4>
                 <hr><b>Autor: </b> $autor<br /><br />
                 <b>Email: </b> $email_author<br /><br/>
                 <b>Titulo do Artigo: </b> $title<br /><br/>
                 <b>Categoria(s): </b> $cat_n<br /><br/>
                 <b>Tag(s): </b> $tags_n<br /><br/>
                 <b>Status: </b> $mensagem<br />
                 <hr>
                 <br>Enviaremos mensagens ao Administrador (T5 Globaldea --> Gerir Artigos) , Globaldea
                 </div>";
//Here put your Validation and send mail
            wp_mail($to, $subject, strip_tags($body_client), $headers);


        }


        $url = admin_url( 'admin.php?page=gerir-posts' );



        $r = array('id' => $postId, 'mensagem' => $mensagem, 'error' => 0, 'url' => $url);
    }
    else
    {
        $mensagem = 'O Campo Titulo do post é obrigatório';
        $r = array('id' => '', 'mensagem' => $mensagem, 'error' => 1, 'url' => '');
    }







    wp_send_json_success($r);
}

add_action( 'wp_ajax_file_upload', 'file_upload_callback' );
add_action( 'wp_ajax_nopriv_file_upload', 'file_upload_callback' );

function file_upload_callback() {

    $r = array();
    $files = $_FILES["file"];
    foreach ( $files['name'] as $key => $value ) {
        if ( $files['name'][ $key ] ) {
            $file = array(
                'name' => $files['name'][ $key ],
                'type' => $files['type'][ $key ],
                'tmp_name' => $files['tmp_name'][ $key ],
                'error' => $files['error'][ $key ],
                'size' => $files['size'][ $key ]
            );


            $_FILES = array("upload_file" => $file);
            $attachment_id = media_handle_upload("upload_file",null );

            if(!is_wp_error($attachment_id))
            {
                $url = wp_get_attachment_url($attachment_id);
                $mensagem = ' O Ficheiro '.$attachment_id.' foi submetido com sucesso';
                //$movefile = wp_handle_upload( $file, $upload_overrides );
                $r[] = array('id_file' => $attachment_id,'file_url' => $url, 'tipo' => $file['type'], 'name' => $file['name'], 'mensagem' => $mensagem, 'erro' => 0);




            }
            else
            {
                $mensagem = ' Erro ao Submeter o Ficheiro';
                $r[] = array('id_file' => '','file_url' => '', 'tipo' => '', 'name' => '' , 'mensagem' => $mensagem, 'erro' => 1);
            }


        }
    }


    wp_send_json_success($r);
}




//remove_file_post

add_action( 'wp_ajax_remove_file_post', 'remove_file_post' );
add_action( 'wp_ajax_nopriv_remove_file_post', 'remove_file_post' );

function remove_file_post()
{
    //wp_send_json_success($_REQUEST);

    $post_id = $_REQUEST['id'];

    $mensagem = 'O Ficheiro do Post '.$post_id. ' foi eliminado com sucesso';



    $del = wp_delete_attachment( $post_id, 'true' );

    $r = array('id_file' => $post_id, 'mensagem' => $mensagem);
    wp_send_json_success($r);

}


if ( is_user_logged_in() ) {
	// If no action is registered, return a Bad Request response.
	if ( ! has_action( "wp_ajax_{$action}" ) ) {
		wp_die( '0', 400 );
	}

	/**
	 * Fires authenticated Ajax actions for logged-in users.
	 *
	 * The dynamic portion of the hook name, `$action`, refers
	 * to the name of the Ajax action callback being fired.
	 *
	 * @since 2.1.0
	 */
	do_action( "wp_ajax_{$action}" );
} else {
	// If no action is registered, return a Bad Request response.
	if ( ! has_action( "wp_ajax_nopriv_{$action}" ) ) {
		wp_die( '0', 400 );
	}

	/**
	 * Fires non-authenticated Ajax actions for logged-out users.
	 *
	 * The dynamic portion of the hook name, `$action`, refers
	 * to the name of the Ajax action callback being fired.
	 *
	 * @since 2.8.0
	 */
	do_action( "wp_ajax_nopriv_{$action}" );
}

// Default status.
wp_die( '0' );

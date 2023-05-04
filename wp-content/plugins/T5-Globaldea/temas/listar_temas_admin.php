<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    function removerPostRelTemaOutTimeExecution(post_id, tema_id) {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {action: 'remove_rel_post_tema', post_id: post_id, tema_id: tema_id},
            success: function (response) {
                console.log(response);


            }
        });
    }
</script>


<?php
include plugin_dir_path( __DIR__).'modals.php';
?>


<?php

if(! empty($_GET['paged']) && is_numeric($_GET['paged']) ){
    $paged = $_GET['paged'];
}else {
    $paged = 1;
}

function time_Ago($time) {


    // Calculate difference between current
    // time and given timestamp in seconds
    $diff     = time() - $time;

    // Time difference in seconds
    $sec     = $diff;

    // Convert time difference in minutes
    $min     = round($diff / 60 );

    // Convert time difference in hours
    $hrs     = round($diff / 3600);

    // Convert time difference in days
    $days     = round($diff / 86400 );

    // Convert time difference in weeks
    $weeks     = round($diff / 604800);

    // Convert time difference in months
    $mnths     = round($diff / 2600640 );

    // Convert time difference in years
    $yrs     = round($diff / 31207680 );

    // Check for seconds
    if($sec <= 60) {
        echo "$sec segundos depois";
    }

    // Check for minutes
    else if($min <= 60) {
        if($min==1) {
            echo "1 minuto depois";
        }
        else {
            echo "$min minutos depois";
        }
    }

    // Check for hours
    else {
        if($hrs == 1) {
            echo "1 hora depois";
        }
        else {
            echo "$hrs horas depois";
        }
    }
}

?>

<style>
    .update-nag.notice.notice-warning.inline, .sendwp-notice, .jpum-notice {
        display: none;
    }
    .text-title-posts-list
    {
        margin: 0 auto;
    }

    #table_temas>tbody>tr>td, #table_temas>tbody>tr>th, #table_temas>tfoot>tr>td, #table_temas>tfoot>tr>th, #table_temas>thead>tr>td, #table_temas>thead>tr>th {
        min-width: 250px;
        text-align: center;
    }
    /* Bootstrap 4 text input with search icon */

    .has-search .form-control {
        padding-left: 2.375rem;
    }

    .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 1.65rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }
    .table-responsive {
        min-height: .01%!important;
        overflow-x: auto!important;
    }
    .marginer
    {
        margin-top: 50px;
    }

    .pagination {
        margin: 30px 0px;
    }
    .pagination ul {
        display: block;
        list-style-type: none;
        margin: 0 auto;
        padding: 0px;
    }
    .pagination ul li {
        display: inline-block;
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .pagination ul li a, .pagination ul li span {
        display: inline-block;
        font-size: 14px;
        width: auto;
        min-width: 26px;
        height: 26px;
        line-height: 26px;
        border: 1px solid #dddddd;
        border-right: 0px;
        background: #FFFFFF;
        color: #0275d8;
        text-align: center;
    }
    .pagination ul li a:hover, .pagination ul li span:hover {
        cursor: pointer;
        text-decoration: none;
    }
    .pagination ul li a.first, .pagination ul li span.first {
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
    }
    .pagination ul li a.last, .pagination ul li span.last {
        border-top-right-radius: 3px;
        border-bottom-right-radius: 3px;
    }
    .pagination ul li span.last, .pagination ul li span.first {
        color: #0275d8;
    }
    .pagination ul li span.last:hover, .pagination ul li span.first:hover {
        cursor: default;
    }
    .pagination ul li a:hover, .pagination ul li.active a, .pagination ul li .current {
        background: #0275d8;
        color: #ffffff;
        border-color: #0275d8;
    }
    .pagination ul li:last-child a, .pagination ul li:last-child span {
        border-right: 1px solid #dddddd;
    }
    .pagination ul li:last-child a:hover {
        border-color: #0275d8;
    }

    #assumirTemaAviso > .modal-dialog > .modal-content {
        border: none;
    }

    #assumirTemaAviso > .modal-dialog > .modal-content > .modal-header {
        background: #52668d;
        color: #fff;
        border: none;
    }

    #assumirTemaAviso > .modal-dialog > .modal-content > .modal-footer {
        background: #52668d;
    }

    #margin-center-title-assumir-tema, #center_body_assumir_tema
    {
        margin: 0 auto;
    }

    #insert_title_tema
    {
        font-style: italic;
        color: #52668d;

    }

    .btn-primary
    {
        color: #fff!important;
        cursor: pointer;
    }

    .btn-primary.disabled {
        pointer-events: none;
        cursor: default;
    }

    #table_temas>thead>tr>th.accoes_buutoes {
        min-width: 700px;
        text-align: center;
    }



    #avaliarTemaAviso > .modal-dialog > .modal-content {
        border: none;
    }

    #avaliarTemaAviso > .modal-dialog > .modal-content > .modal-header {
        background: #52668d;
        color: #fff;
        border: none;
    }

    #avaliarTemaAviso > .modal-dialog > .modal-content > .modal-footer {
        background: #52668d;
    }

    .text-higher
    {
        font-size: 20px;
    }

    #tema_card
    {
        min-width: 100%;
        padding: 0;
    }
    #tema_post
    {
        padding: 20px;
    }

    .text-sizer-text
    {
        font-size: 18px;
    }

    #enviar_comentarios_admin
    {
        cursor: pointer;
    }


    .comment_link_list
    {
        cursor: pointer;
        color: #0275d8!important;
        text-decoration: none!important;
    }

    .comment_link_list:focus, .comment_link_list:hover {
        color: #014c8c!important;
    }

    #post_comment
    {
        min-width: 100%;
        padding: 0;
    }
    #body_comment
    {
        padding: 20px;
    }

    #revisor_comment
    {
        float: left;
        text-align: left;
        width: 100%;
    }

    .is-invalid-comment, .is-invalid-comment-edit{
        border-color: #dc3545!important;
        padding-right: calc(1.5em + .75rem)!important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) top calc(0.1rem + 0.1rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .invalid-feedback-comment-edit, .invalid-feedback-comment
    {
        color: #dc3545!important;
    }
	
	.btn-primary
    {
        color: #fff!important;
        cursor: pointer;
    }

    .btn-primary.disabled {
        pointer-events: none;
        cursor: default;
    }



</style>

<!-- Modal -->
<div class="modal fade" id="assumirTemaAviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="margin-center-title-assumir-tema" >Confirmar a sua Escolha</h4>
            </div>
            <div class="modal-body" id="center_body_assumir_tema">
                <p class="text-center text-sizer-text">Você quer atribuir tema ao artigo:</p>

                <input type="hidden" id="poster_tema_identification">
                <input type="hidden" id="user_ident">
                <input type="hidden" id="tema_titulo">

                <h5 id="insert_title_tema" class="text-center"></h5>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Cancelar</font></button>
                <button type="button" class="btn btn-success" onclick="inserirPostTema(jQuery('#user_ident').val(), jQuery('#poster_tema_identification').val(), jQuery('#tema_titulo').val())"> <i class="fa fa-check-circle"></i> <font class="d-none d-sm-inline-block"> Confirmar </font></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="avaliarTemaAviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="margin-center-title-assumir-tema" >Confirmar a sua Escolha do Estado do Tema "<span id="titulo_tema_avaliar" style="font-weight: bold"></span>" </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="center_body_assumir_tema">
                <p class="text-center text-higher">Deseja avaliar o tema para <strong>Aprovado</strong> ou <strong>Reprovado</strong></p>

                <input type="hidden" id="tema_id_avaliar">

                <p class="text-center">
                    <button type="button" class="btn btn-danger" value="trash" onclick="avaliaTemaConfSave(this.value, jQuery('#tema_id_avaliar').val());"><i class="fa fa-times-circle" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">&nbsp; Reprovar Tema</font></button>
                    <button type="button" class="btn btn-success" value="publish" onclick="avaliaTemaConfSave(this.value, jQuery('#tema_id_avaliar').val());"><i class="fa fa-check-circle-o" aria-hidden="true"></i><font class="d-none d-sm-inline-block">&nbsp; Aprovar Tema</font></button>

                </p>




            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="list_comments" tabindex="-1" role="dialog" aria-labelledby="list_comments_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_warn_title"><i class="fa fa-list-alt"></i> Lista de Comentários do post numero <span id="post_id_comments"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="list_comments_by_user"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>






<div class="marginer"></div>


<div class="container-fluid">
    <div class="row">
        <div class="text-title-posts-list">
            <h2 class="text-center">Listar Temas</h2>
        </div>
    </div>

</div>

<div class="marginer"></div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" id="tema_card">
                <div class="card-header card-theme">
                    <h5 class="card-title"><i class="fa fa-info" aria-hidden="true"></i>
                        &nbsp; Pendençias</h5>
                </div>
                <div class="card-body" id="tema_post">

                    <?php
                    // Posts Aguardados pela Aprovação
                    $args_all_posts_pending = array(
                        'post_type' => 'temas',

                    );

                    $query_temas_pending = new WP_Query($args_all_posts_pending);

                    $count_pend = 0;

                    while ( $query_temas_pending->have_posts() ): $query_temas_pending->the_post();
                        global $post, $wpdb;

                        //echo $post->ID.' ';

                        $r = $wpdb->prepare("SELECT post_id FROM `posts_rel_temas` where tema_id = $post->ID");

                        $values = $wpdb->get_col( $r );

                        if ($values[0] != 0)
                        {
                            $current_status_post_count_p = get_post_status($values[0]);



                            if($current_status_post_count_p === 'pending')
                            {
                                $count_pend++;
                            }

                        }





                    endwhile;


                    ?>

                    <p class="text-sizer-text">
                        <strong>Artigos para Avaliar aos temas correspondentes: </strong> <?php echo $count_pend; ?>
                        <br>
                        <strong>Temas para Avaliar: </strong> <?php echo $query_temas_pending->found_posts; ?>
                    </p>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="marginer"></div>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-4">
            <form action="" method="get">
                <input type="hidden" name="page" value="listar-temas" >
                <input type="hidden" name="s" value="<?php echo $_GET['s']; ?>">
                <div class="form-group">
                    <select class="form-control" name="lines" id="lines" onchange="this.form.submit()">
                        <option value="">Seleccione linha...</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col-md-4 ">

        </div>
        <div class="col-md-4 ">
            <form method="get" action="" >
                <input type="hidden" name="page" value="listar-temas">

                <div class="form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" placeholder="Procurar" name="s">
                </div>
                <input type="hidden" name="lines" value="<?php echo $_GET['lines']; ?>">
                </span>
            </form>

        </div>
    </div>
</div>

<div class="marginer"></div>

<?php

$url_back = admin_url( 'admin.php?page=listar-temas');

if ($_GET['lines'] != '')
{
    $posts_per_page = $_GET['lines'];
}
else
{
    $posts_per_page = 10;
}


$args = array(
    'posts_per_page' => $posts_per_page,
    'post_type'        => 'temas',
    'post_status' => array('publish', 'pending', 'draft', 'trash'),
    'paged' => $paged,
    's' => $_GET['s']
);


//let's first get ALL of the possible posts
$args_dados = array(
    'posts_per_page'   => -1,
    'post_type'        => 'temas',
    'post_status' => array('publish', 'pending', 'draft', 'trash'),
    's' => $_GET['s']
);

$all_posts = get_posts($args_dados);

//how many total posts are there?
$post_count = count($all_posts);


//how many pages do we need to display all those posts?
$num_pages = ceil($post_count / $posts_per_page);



//let's make sure we don't have a page number that is higher than we have posts for
if($paged > $num_pages || $paged < 1){
    $paged = $num_pages;
}


$query = new WP_Query($args);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php if ( $query->have_posts() ): ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="table_temas">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo do Tema</th>
                        <th scope="col">Categorias</th>
                        <th scope="col">Tags</th>

                        <th scope="col">Data do Tema Criado</th>
                        <th scope="col">Assumida por</th>
                        <th scope="col">Prazo Final para Publicar o Artigo (Para Utilizadores Normais)</th>
                        <th scope="col">Estado do Tema</th>
                        <th scope="col">Comentários do artigo do tema correspondente</th>
                        <th scope="col" class="accoes_buutoes">Acções</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php while ( $query->have_posts() ): $query->the_post();
                    global $post;


                    $taxonomy = 'category';
                    $post_terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );
                    $separator = ', ';

                    $tags = 'post_tag';
                    $post_tags = wp_get_object_terms( $post->ID, $tags, array( 'fields' => 'ids' ) );

                    global $post, $wpdb;

                    $r = $wpdb->prepare("SELECT post_id FROM `posts_rel_temas` where tema_id = $post->ID");

                    $values = $wpdb->get_col( $r );


                    // Tema Disponivel (Aprovado pelo Administrador)
                    $current_status = get_post_status ( $post->ID );






                    ?>

                    <tr id="act_tema_id_<?php echo $post->ID; ?>">

                        <td><?php echo $post->ID ?> <input type="hidden" id="post_id_com" value="<?php echo $post->ID ?>"></td>
                        <td id="link_post_attr_tarefa_tema_<?php echo $post->ID; ?>"><?php echo $post->post_title ?></td>
                        <?php
                        // Categorias
                        if (!empty($post_terms) && !is_wp_error($post_terms)) {

                            $term_ids = implode(',', $post_terms);

                            $terms = wp_list_categories(array(
                                'taxonomy' => 'category',
											'show_count' => false,
											'hide_empty' => false,
											'echo'     => false,
											'title_li' => '',
											'style'    => 'none',
											'include'  => $term_ids
                            ));

                            $terms = rtrim(trim(str_replace('<br />', $separator, $terms)), $separator);

                            // Display post categories.
                            ?>
                            <td><?php echo $terms ?></td>
                            <?php
                        } else {
                            ?>
                            <td>Sem Categoria(s)</td>
                            <?php
                        }

                        // Tags
                        ?>


                        <?php

                        if (!empty($post_tags) && !is_wp_error($post_tags)) {

                            $tags_id = implode(',', $post_tags);

                            $tags_list = wp_list_categories(array(
                                            'taxonomy' => 'post_tag',
											'show_count' => false,
											'hide_empty' => false,
											'echo'     => false,
											'title_li' => '',
											'style'    => 'none',
											'include'  => $tags_id
                            ));

                            $tags_list = rtrim(trim(str_replace('<br />', $separator, $tags_list)), $separator);

                            // Display post categories.
                            ?>
                            <td><?php echo $tags_list ?></td>
                            <?php
                        } else {
                            ?>
                            <td>Sem Keyword(s)</td>
                            <?php
                        }
                        ?>

                        <td><?php echo $post->post_modified; ?></td>
                        <?php
                        date_default_timezone_set('Europe/Lisbon');
                        $curr_time = $post->post_date;
                        $time_ago = strtotime($curr_time);
                        ?>

                        <?php
                        $current_status = get_post_status($post->ID);


                        switch ($current_status) {
                            case 'draft':
                                $estado = 'Pendente Revisão';
                                $alert = 'warning';
                                break;
                            case 'trash':
                                $estado = 'Tema Reprovado';
                                $alert = 'danger';
                                break;
                            case 'pending':
                                $estado = 'Aguardando Aprovação';
                                $alert = 'info';
                                break;
                            case 'publish':
                                $estado = 'Aprovado';
                                $alert = 'success';
                                break;
                        }

                        ?>

                        <script>
                            function assumirTema(user_id, post_tema_id, post_title) {

                                var assumTemaWarn = jQuery("#assumirTemaAviso");

                                jQuery("#insert_title_tema").html('"'+post_title+'"');

                                var pos_til = "'"+post_title+"'";

                                jQuery("#poster_tema_identification").val(post_tema_id);
                                jQuery("#user_ident").val(user_id);
                                jQuery("#tema_titulo").val(post_title);


                                assumTemaWarn.appendTo("body").modal('show');

                            }
                            function inserirPostTema(user_id, post_tema_id, post_title) {
                                var assumTemaWarn = jQuery("#assumirTemaAviso");


                                jQuery.ajax({
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    type: 'POST',
                                    data: {
                                        action: 'inserir_post_temas_admin',
                                        post_tema_id: post_tema_id,
                                        user_id: user_id,
                                        post_title: post_title
                                    },
                                    success: function (response) {
                                        jQuery("#link_post_attr_tarefa_tema_" + post_tema_id).html('<a href="' + response.data.url + '">' + response.data.post_title + '</a>');
                                        jQuery("#assumida_por_autor_"+post_tema_id).html(response.data.username);
                                        window.location.href = response.data.url;
                                        assumTemaWarn.modal('hide');
                                    }
                                });
                            }
                        </script>

                        <?php

                        // Se possuir o artigo do tema referido
                        if ($values[0] != 0) {
                            $author_id = get_post_field('post_author', $values[0]);
                            $t_t = get_post_field('post_title', $values[0]);
                            $st = get_post_field('post_status', $values[0]);

                            $first_n = get_user_meta($author_id, 'first_name', true);
                            $last_n = get_user_meta($author_id, 'last_name', true);

                            $full_n = $first_n.' '.$last_n;

                            $user_meta=get_userdata($author_id);

                            $user_roles=$user_meta->roles;


                            if (!in_array("administrator", $user_roles))
                            {
                                // Posts que ja foram atribuidos pelos temas
                                if ($author_id == get_current_user_id() && ($st === 'pending' || $st === 'publish')) {
                                    $a = '1';
                                    $d = '<div class="alert alert-info" role="alert"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Artigo foi atribuido pelo tema</div>';
                                    $e = $full_n;
                                }
                                else if ($author_id != get_current_user_id() && ($st === 'pending' || $st === 'publish'))
                                {
                                    $a = '0';
                                    $d = '<div class="alert alert-warning" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Aviso. O artigo foi atribuido pelo tema por outro utilizador</div>';
                                    $e = $full_n;
                                }
                                else if(!($st === 'pending') && !($st === 'publish'))
                                {
                                    $data_post_publicacao = get_post_field('post_date', $values[0]);
                                    $time_ago_pub = strtotime($data_post_publicacao);
                                    // condicao
                                    $horaspub_article_vis = date('Y-m-d H:i:s', strtotime("+48 hours", $time_ago_pub));
                                    $actual_data_article = date('Y-m-d H:i:s', time());

                                    // clock time
                                    $hr_art_vis = strtotime("+48 hours", $time_ago_pub);
                                    $act_data_art = time();
                                    //Data de Limite de Submissão do Artigo
                                    if($horaspub_article_vis >= $actual_data_article)
                                    {
                                        $url = admin_url( 'admin.php?page=atribuir-tema-admin-novo-artigo&user_id='.$author_id.'&post_tema_id='.$post->ID.'&post_tile_tema='.$post->post_title );
                                        $first_name = get_user_meta($author_id, 'first_name', true);
                                        $last_name = get_user_meta($author_id, 'last_name', true);

                                        $full_name = $first_name.' '.$last_name;

                                        ?>

                                        <script>
                                            var p_tema_iden = '<?php echo $post->ID; ?>';
                                            var url = '<?php echo $url; ?>';

                                            var full_n = '<?php echo $full_name; ?>';


                                            var s_tr = "#act_tema_id_"+p_tema_iden;
                                            jQuery("#act_tema_id_"+p_tema_iden).each(function () {
                                                var countDownDate = '<?php echo $hr_art_vis; ?>' * 1000;
                                                var now = '<?php echo $act_data_art; ?>' * 1000;
                                                var title_te = '<?php echo $post->post_title; ?>';

                                                var id_po = "prazo_final_artigo_"+p_tema_iden;
                                                var act_temm = 'actions_list_temas_'+p_tema_iden;

                                                var assu_autor = 'assumida_por_autor_'+p_tema_iden;


                                                var t = setInterval(function() {
                                                    now = now + 1000;

                                                    var distance = countDownDate - now;


                                                    // Time calculations for days, hours, minutes and seconds
                                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                    //console.log(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");


                                                    document.getElementById(id_po).innerHTML = days + "d " + hours + "h " +
                                                        minutes + "m " + seconds + "s ";

                                                    var user_id = "<?php echo $author_id; ?>";
                                                    var curr_id = "<?php echo get_current_user_id(); ?>";

                                                    var ij = "<?php echo $post->ID; ?>";
                                                    var pos_title_ij = "<?php echo $post->post_title; ?>";

                                                    urlGetTemas(ij, pos_title_ij, user_id, curr_id, 'atribuir-tema-disponivel-novo-artigo');

                                                    jQuery("#assumida_por_autor_"+ij).html(full_n);


                                                    // If the count down is over, write some text
                                                    if (distance <= 0) {
                                                        clearInterval(t);
                                                        document.getElementById(id_po).innerHTML = '<div class="alert alert-success" role="alert"><i class="fa fa-check-circle" aria-hidden="true"></i> Tema Disponivel</div>';
                                                        document.getElementById(assu_autor).innerHTML = '<div class="alert alert-success" role="alert"><i class="fa fa-check-circle" aria-hidden="true"></i> Tema Disponivel</div>';

                                                        var pos_title = "<?php echo $post->post_title; ?>";
                                                        var i = "<?php echo $post->ID; ?>";
                                                        var p_til = "'"+pos_title+"'";

                                                        var post_ident = "<?php echo $values[0]; ?>";

                                                        removerPostRelTemaOutTimeExecution(post_ident, i);

                                                        setTimeout(function(){
                                                            var ikj = "link_post_attr_tarefa_tema_"+i;
                                                            document.getElementById(act_temm).innerHTML = '<button type="button" class="btn btn-primary" id="botao_assumir_tema_'+i+'" onclick="assumirTema('+curr_id+','+i+','+p_til+');"><i class="fa fa-plus-square" aria-hidden="true"></i> Assumir Tema</button>';
                                                            document.getElementById(ikj).innerHTML = pos_title;
                                                            var back_url = '<?php echo $url_back; ?>';
                                                            window.location.href = back_url;
                                                        }, 2000);

                                                    }
                                                }, 1000);

                                            });
                                        </script>

                                        <?php
                                        $a = '122'; // Limite de Submissão do Artigo Não se pode executar o botao (disabled);
                                        $enabled = 'enabled';

                                    }

                                    else
                                    {
                                        $d = '<div class="alert alert-success" role="alert"><i class="fa fa-check-circle" aria-hidden="true"></i> Tema Disponivel</div>';
                                        $e = '<div class="alert alert-success" role="alert"><i class="fa fa-check-circle" aria-hidden="true"></i> Tema Disponivel</div>';
                                        $a = '322'; // Fora do Limite de Submissão do Artigo

                                        $url_dest = admin_url( 'admin.php?page=listar-temas');
                                        ?>
                                        <script>
                                            var temas_identification = '<?php echo $post->ID; ?>';
                                            var poster_identification = '<?php echo $values[0]; ?>';
                                            var url_dest = '<?php echo $url_dest; ?>';
                                            console.log(temas_identification, poster_identification);

                                            removerPostRelTemaOutTimeExecution(poster_identification, temas_identification);

                                            setInterval(function() { window.location.href = url_dest}, 4000);


                                        </script>
                                        <?php
                                    }
                                }
                            }
                            else
                            {
                                if ($author_id == get_current_user_id()) {
                                    $a = '10';
                                    $d = '<div class="alert alert-info" role="alert"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Artigo foi atribuido pelo tema</div>';
                                    $e = $full_n;
                                }
                                else if ($author_id != get_current_user_id())
                                {
                                    $a = '11';
                                    $d = '<div class="alert alert-warning" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Aviso. O artigo foi atribuido pelo tema por outro utilizador</div>';
                                    $e = $full_n;
                                }
                                if ($author_id == get_current_user_id() && $st === 'auto-draft') {
                                    $a = '101';
                                    $d = '<div class="alert alert-info" role="alert"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Artigo foi atribuido pelo tema</div>';
                                    $e = $full_n;
                                }
                            }


                        }
                        else {
                            if($current_status !== 'publish')
                            {
                                $d = '<div class="alert alert-danger" role="alert"><i class="fa fa-times-circle" aria-hidden="true"></i> Este tema <strong>'.$post->ID.'</strong> não foi aprovado pelo administrador</div>';

                                $first = get_user_meta($post->post_author, 'first_name', true);
                                $last = get_user_meta($post->post_author, 'last_name', true);

                                $full = $first.' '.$last;

                                $e = '<div class="alert alert-danger" role="alert"><i class="fa fa-times-circle" aria-hidden="true"></i> Este tema <strong>'.$post->ID.'</strong> não foi aprovado pelo administrador</div>';
                                $a = '111';
                            }
                            else
                            {
                                $d = '<div class="alert alert-success" role="alert"><i class="fa fa-check-circle" aria-hidden="true"></i> Tema Disponivel</div>';
                                $e = '<div class="alert alert-success" role="alert"><i class="fa fa-check-circle" aria-hidden="true"></i> Tema Disponivel</div>';
                                $a = '22';
                            }
                        }

                        ?>

                        <td id="assumida_por_autor_<?php echo $post->ID; ?>"><?php echo $e; ?></td>



                        <td id="prazo_final_artigo_<?php echo $post->ID; ?>" class="clock_timer"><?php echo $d ?></td>


                        <td>
                            <div class="alert alert-<?php echo $alert; ?>" role="alert">
                                <?php echo $estado; ?>
                            </div>
                        </td>

                        <?php
                        if ($values[0] != 0)
                        {
                            $args_count_comment = array(
                                'post_id' => $values[0],   // Use post_id, not post_ID
                                'count'   => true // Return only the count
                            );
                            $comments_count = get_comments( $args_count_comment );
                            if ($comments_count == 0)
                            {
                                $c = 'Nenhum comentário';
                            }
                            else
                            {
                                $c = '<a onclick="showcomments('.$values[0].')" class="link-primary comment_link_list">'.$comments_count.'</a>';

                            }
                        }
                        else
                        {
                            $c = 'Não se pode fazer comentário sem ter artigos criados';
                        }
						
						
						if ($current_status === 'trash' || $current_status === 'pending' || $current_status === 'draft')
						{
							$en_tema = 'disabled';
						}
						else
						{
							$en_tema = 'enabled';
						}

                        ?>

                        <td>
                            <?php echo $c; ?>
                        </td>

                        <td id="actions_list_temas_<?php echo $post->ID; ?>" class="accoes_buutoes">
                            <?php
                                if($a == 22)
                                {
                                    ?>
                                    <a class="btn btn-info" href="admin.php?page=editar-tema&tema_id=<?php echo $post->ID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Tema</font></a>
                                    <button type="button" class="btn btn-primary" id="botao_assumir_tema_<?php echo $post->ID?>" onclick="assumirTema('<?php echo get_current_user_id(); ?>','<?php echo $post->ID; ?>', '<?php echo $post->post_title; ?>');"><i class="fa fa-plus-square" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Assumir Tema ao Artigo</font></button>
                                    <button type="button" class="btn btn-success" onclick="avaliarTema(<?php echo $post->ID; ?>,'<?php echo $post->post_title; ?>')"> <i class="fa fa-check-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Tema</font></button>
                                    <?php
                                }

                                else if($a == 322)
                                {
                                    ?>
                                    <a class="btn btn-info" href="admin.php?page=editar-tema&tema_id=<?php echo $post->ID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Tema</font></a>
                                    <button type="button" class="btn btn-primary" id="botao_assumir_tema_<?php echo $post->ID?>" onclick="assumirTema('<?php echo get_current_user_id(); ?>','<?php echo $post->ID; ?>', '<?php echo $post->post_title; ?>');"><i class="fa fa-plus-square" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Tema já atribuido</font></button>
                                    <button type="button" class="btn btn-success" onclick="avaliarTema(<?php echo $post->ID; ?>,'<?php echo $post->post_title; ?>')"> <i class="fa fa-check-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Tema</font></button>
                                    <?php
                                }
                                else if($a == 122)
                                {
                                    if ($author_id == get_current_user_id())
                                    {
                                        $enabled = 'enabled';
                                    }
                                    else
                                    {
                                        $enabled = 'disabled';
                                    }
                                    ?>
                                    <a class="btn btn-info <?php echo $enabled; ?>" href="admin.php?page=editar-tema&tema_id=<?php echo $post->ID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Tema</font></a>
                                    <button type="button" class="btn btn-primary" id="botao_assumir_tema_<?php echo $post->ID?>" onclick="assumirTema('<?php echo get_current_user_id(); ?>','<?php echo $post->ID; ?>', '<?php echo $post->post_title; ?>');" <?php echo $enabled; ?>><i class="fa fa-plus-square" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Tema em atribuição</font></button>
                                    <button type="button" class="btn btn-success" onclick="avaliarTema(<?php echo $post->ID; ?>,'<?php echo $post->post_title; ?>')" <?php echo $enabled; ?>> <i class="fa fa-check-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Tema</font></button>


                                    <?php
                                }
                                else if($a == 111)
                                {
                                    ?>
                                    <a class="btn btn-info" href="admin.php?page=editar-tema&tema_id=<?php echo $post->ID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Tema</font></a>
                                    <button type="button" class="btn btn-success" onclick="avaliarTema(<?php echo $post->ID; ?>,'<?php echo $post->post_title; ?>')"> <i class="fa fa-check-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Tema</font></button>
                                    <?php
                                }
                                else if($a == 0 || $a == 1)
                                {
                                    ?>
                                    <a class="btn btn-info" href="admin.php?page=editar-tema&tema_id=<?php echo $post->ID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Tema</font></a>
                                    <a class="btn btn-primary <?php echo $en_tema;?>" href="admin.php?page=avaliar-artigo-tema&tema_id=<?php echo $post->ID; ?>&post_id=<?php echo $values[0]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Artigo ao Tema <?php echo $post->ID; ?></font></a>
                                    <button type="button" class="btn btn-success" onclick="avaliarTema(<?php echo $post->ID; ?>,'<?php echo $post->post_title; ?>')"> <i class="fa fa-check-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Tema</font></button>
                                    <?php
                                }
                                else if($a == 10 || $a == 11)
                                {
                                    ?>
                                    <a class="btn btn-info" href="admin.php?page=editar-tema&tema_id=<?php echo $post->ID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Tema</font></a>
                                    <a class="btn btn-primary <?php echo $en_tema;?>" href="admin.php?page=editar-artigo-tema-administrador&tema_id=<?php echo $post->ID; ?>&post_id=<?php echo $values[0]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Artigo ao Tema <?php echo $post->ID; ?></font></a>
									<button type="button" class="btn btn-success" onclick="avaliarTema(<?php echo $post->ID; ?>,'<?php echo $post->post_title; ?>')"> <i class="fa fa-check-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Tema</font></button>
                                    <?php
                                }
                                else if($a == 101)
                                {
                                    ?>
                                    <a class="btn btn-info" href="admin.php?page=editar-tema&tema_id=<?php echo $post->ID; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Editar Tema</font></a>
                                    <button type="button" class="btn btn-primary" id="botao_assumir_tema_<?php echo $post->ID?>" onclick="assumirTema('<?php echo get_current_user_id(); ?>','<?php echo $post->ID; ?>', '<?php echo $post->post_title; ?>');"><i class="fa fa-plus-square" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Assumir Tema ao Artigo</font></button>
                                    <button type="button" class="btn btn-success" onclick="avaliarTema(<?php echo $post->ID; ?>,'<?php echo $post->post_title; ?>')"> <i class="fa fa-check-square-o" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Avaliar Tema</font></button>
                                    <?php
                                }

                            ?>

                        </td>


                    </tr>

                    <?php endwhile; ?>

                    </tbody>
                </table>
            </div>

                <?php
                //we need to display some pagination if there are more total posts than the posts displayed per page
                if($post_count > $posts_per_page ){

                    echo '<div class="pagination">
                    <ul>';

                    if($paged > 1){
                        echo '<li><a class="first" href="?page=listar-temas&paged=1&s='.$_GET['s'].'&lines='.$_GET['lines'].'">&laquo;</a></li>';
                    }else{
                        echo '<li><span class="first">&laquo;</span></li>';
                    }

                    for($p = 1; $p <= $num_pages; $p++){
                        if ($paged == $p) {
                            echo '<li><span class="current">'.$p.'</span></li>';
                        }else{
                            echo '<li><a href="?page=listar-temas&paged='.$p.'&s='.$_GET['s'].'&lines='.$_GET['lines'].'">'.$p.'</a></li>';
                        }
                    }

                    if($paged < $num_pages){
                        echo '<li><a class="last" href="?page=listar-temas&paged='.$num_pages.'&s='.$_GET['s'].'&lines='.$_GET['lines'].'">&raquo;</a></li>';
                    }else{
                        echo '<li><span class="last">&raquo;</span></li>';
                    }

                    echo '</ul></div>';
                }
                ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<script>
    function avaliarTema(id, titulo) {

        var avaliarTemaAviso = jQuery("#avaliarTemaAviso");

        jQuery("#titulo_tema_avaliar").html(titulo);

        jQuery("#tema_id_avaliar").val(id);

        avaliarTemaAviso.appendTo("body").modal('show');
        console.log(id);
    }

    function avaliaTemaConfSave(status, id) {
        console.log(status, id);

        var avaliarTemaAviso = jQuery("#avaliarTemaAviso");

        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'avaliar_tema_status',
                tema_id: id,
                status: status
            },
            success: function (response) {
                avaliarTemaAviso.modal('hide');

                jQuery("#modal_warn_title").css('color','#5cb85c');
                jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao editar o post numero '+response.data.id);
                jQuery('.text_warn').html(response.data.mensagem);
                jQuery("#modal_warn").appendTo("body").modal('show');

                jQuery('#modal_warn').on('hidden.bs.modal', function () {
                    window.location.href = response.data.url;
                });

            }
        });
    }

    function urlGetTemas(tema_id, tema_title, user_id, curr_id, url_page) {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {action: 'url_page_get_temas_atr', tema_id: tema_id, tema_title: tema_title, user_id: user_id, curr_id: curr_id, url_page: url_page},
            success: function (response) {
                console.log(response);
                if (response.data.user_id == response.data.curr_id)
                {
                    jQuery("#link_post_attr_tarefa_tema_"+response.data.tema_id).html('<a href="'+response.data.url+'">'+response.data.titulo_tema+'</a>');
                }
                else
                {
                    jQuery("#link_post_attr_tarefa_tema_"+response.data.tema_id).html(response.data.titulo_tema);
                }


            }
        });
    }

    function showcomments(post_id) {
        var list_comments = jQuery("#list_comments");

        jQuery("#post_id_comments").html(post_id);

        var user_id_act = "<?php echo get_current_user_id() ?>";
        var list_comment = '';
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {action: 'list_comments_post', post_id: post_id},
            success: function (response) {
                console.log(response.data);

                for(var i=0; i<response.data.count; i++)
                {
                    var id = response.data[i].id;
                    var image = response.data[i].image;
                    var date = response.data[i].date;
                    var content = "'"+response.data[i].content+"'";
                    var co = content.replaceAll(/\n/g, '\\n');
                    var post_id = response.data[i].post_id;
                    var revisor = response.data[i].revisor;
                    list_comment += '<div class="container-fluid" id="novo_post_form">\n' +
                        '          <div class="card" id="post_comment">\n' +
                        '              <div class="card-header">\n' +
                        '                  <h5 class="card-title" style="float: left">'+image+'\n' +
                        '                      &nbsp; '+revisor+' - Comentario '+id+'</h5>\n' +
                        '                       &nbsp;  <button onclick="toggleEffectComment('+id+')" class="btn btn-link"><i class="fa fa-chevron-down" id="toggle_comment_article_'+id+'"></i></button>' +
                        '              <input type="hidden" id="count_point_'+id+'" value="0"></div>\n' +
                        '              <div class="card-body slider-content-'+id+'" id="body_comment">\n' +
                        '           <label for="comment"><i class="fa fa-comment"></i> Comentário:</label>\n                 ' +
                        '<textarea class="form-control" rows="5" id="edit_comment_article_'+id+'" disabled></textarea>\n' +
                        '                  <div id="sucess_feedback_comment_'+id+'"></div>' +
                        '                  <div class="invalid-feedback-comment-edit" id="comment_feedback_'+id+'"></div>\n' +
                        '              </div>\n' +
                        '\t\t\t  <div class="card-footer">\n' +
                        '\t\t\t\t <div id="revisor_comment">\n' +
                        '                    <strong>Publicado:</strong> '+date+
                        '          </div> ' +
                        '\t\t\t\t <div id="action-'+id+'">\n' +
                        '\t\t\t\t\t                <button type="button" class="btn btn-info" id="ed-comment-'+id+'" onclick="showEditaComment('+id+','+co+','+post_id+');"> <i class="fa fa-edit"></i> <font class="d-none d-sm-inline-block"> Editar </font></button>\n' +
                        '\n' +
                        '\t\t\t\t </div>\n' +
                        '\t\t\t  </div>\n' +
                        '          </div>\n' +
                        '</div>\n' +
                        '\n' +
                        '<div style="margin-top: 50px;"></div>';

                }
                jQuery("#list_comments_by_user").html(list_comment);

                for(j=0; j<response.data.count; j++)
                {
                    var id = response.data[j].id;
                    var user_id = response.data[j].user_id;
                    var content = response.data[j].content;
                    jQuery("#edit_comment_article_"+id).val(content);
                    if(user_id === user_id_act)
                    {
                        jQuery("#ed-comment-"+id).prop('disabled', false);
                    }
                    else
                    {
                        jQuery("#ed-comment-"+id).prop('disabled', true);
                    }

                }
                list_comments.appendTo("body").modal('show');
            }
        });
    }

    function showEditaComment(id, comment, post_id)
    {

        var con = "'"+comment+"'";
        var co = con.replaceAll(/\n/g, '\\n');
        jQuery("#edit_comment_article_"+id).prop('disabled', false);
        jQuery("#action-"+id).html('<button type="button" class="btn btn-default" onclick="cancelEditComment('+id+', '+co+', '+post_id+')"><i class="fa fa-times-circle" aria-hidden="true"> </i> <font class="d-none d-sm-inline-block"> Cancelar </font></button> <button type="button" class="btn btn-success" onclick="saveComment('+id+', '+post_id+')"> <i class="fa fa-save"></i> <font class="d-none d-sm-inline-block"> Salvar </font></button>');
    }

    function cancelEditComment(id, comment, post_id)
    {
        var con = "'"+comment+"'";
        var co = con.replaceAll(/\n/g, '\\n');
        jQuery("#edit_comment_article_"+id).prop('disabled', true);
        jQuery("#action-"+id).html('<button type="button" class="btn btn-info" id="ed-comment-'+id+'" onclick="showEditaComment('+id+','+co+','+post_id+');"> <i class="fa fa-edit"></i> <font class="d-none d-sm-inline-block"> Editar </font></button>');

    }

    function saveComment(id, post_id)
    {
        var con = jQuery("#edit_comment_article_"+id).val();
        console.log(id, con, post_id);

        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {action: 'save_comment_edit', post_id: post_id, comment_id: id, comment: con},
            success: function (response) {
                console.log(response.data);

                if(response.data.err === 0)
                {
                    jQuery("#edit_comment_article_"+id).removeClass('is-invalid-comment-edit');
                    jQuery("#comment_feedback_"+id).html('');
                    jQuery("#sucess_feedback_comment_"+id).html('<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                        '  <strong>'+response.data.mensagem+'</strong>\n' +
                        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '    <span aria-hidden="true">&times;</span>\n' +
                        '  </button>\n' +
                        '</div>');
                    jQuery("#edit_comment_article_"+id).val(response.data.coment);
                    var con = "'"+ jQuery("#edit_comment_article_"+id).val()+"'";
                    var co = con.replaceAll(/\n/g, '\\n');
                    jQuery("#edit_comment_article_"+id).prop('disabled', true);
                    jQuery("#action-"+id).html('<button type="button" class="btn btn-info" id="ed-comment-'+id+'" onclick="showEditaComment('+id+','+co+','+post_id+');"> <i class="fa fa-edit"></i> <font class="d-none d-sm-inline-block"> Editar </font></button>');


                }
                else if (response.data.err === 1)
                {
                    jQuery("#edit_comment_article_"+id).addClass('is-invalid-comment-edit');
                    jQuery("#comment_feedback_"+id).html(response.data.mensagem);
                    jQuery("#sucess_feedback_comment_"+id).html('');
                }
                else
                {
                    jQuery("#edit_comment_article_"+id).addClass('is-invalid-comment-edit');
                    jQuery("#comment_feedback_"+id).html(response.data.mensagem);
                    jQuery("#sucess_feedback_comment_"+id).html('');
                }
            }
        });
    }

    function toggleEffectComment(id) {
        jQuery( ".slider-content-"+id ).slideToggle( "slow" );
        var count_button_toggle = jQuery("#count_point_"+id).val();
        count_button_toggle++;
        jQuery("#count_point_"+id).val(count_button_toggle);
        if(jQuery("#count_point_"+id).val() % 2 === 1)
        {
            jQuery("#toggle_comment_article_"+id).removeClass('fa-chevron-down');
            jQuery("#toggle_comment_article_"+id).addClass('fa-chevron-right');

        }
        else
        {
            jQuery("#toggle_comment_article_"+id).removeClass('fa-chevron-right');
            jQuery("#toggle_comment_article_"+id).addClass('fa-chevron-down');

        }

    }

</script>
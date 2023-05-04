

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


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


    <div class="modal fade" id="modal_warn_comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_warn_title_comment"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text_warn_comment"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="add_coment" tabindex="-1" role="dialog" aria-labelledby="add_coment_title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_coment_title">Adicionar um novo comentário ao artigo <span id="title_post_comment"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comment"><i class="fa fa-comment"></i> Comentário:</label>
                                    <textarea class="form-control" rows="5" id="edit_comm_article"></textarea>
                                    <div class="invalid-feedback-comment"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="revisor_comment">
                        <strong>Revisor:</strong> <?php echo get_the_author_meta('display_name', get_current_user_id());?>
                    </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> <font class="d-none d-sm-inline-block">Fechar</font></button>
                    <button type="button" class="btn btn-success" onclick="addSaveComment(jQuery('#title_post_comment').html(), jQuery('#edit_comm_article').val());"> <i class="fa fa-save"></i> <font class="d-none d-sm-inline-block"> Salvar </font></button>
                </div>
            </div>
        </div>
    </div>


    <?php


    include plugin_dir_path( __FILE__ ).'modals.php';

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
		#wpfooter {
			display: none;
		}
        .update-nag.notice.notice-warning.inline, .sendwp-notice, .jpum-notice {
            display: none;
        }
        .table-responsive {
            min-height: .01%!important;
            overflow-x: auto!important;
        }

        #table_posts>tbody>tr>td, #table_posts>tbody>tr>th, #table_posts>tfoot>tr>td, #table_posts>tfoot>tr>th, #table_posts>thead>tr>td, #table_posts>thead>tr>th {
            min-width: 250px;
            text-align: center;
        }

        #enviar_comentarios_admin
        {
            cursor: pointer;
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
        .marginer
        {
            margin-top: 50px;
        }
        .text-title-posts-list
        {
            margin: 0 auto;
        }

        /* Styles for wrapping the search box */

        .main {
            width: 50%;
            margin: 50px auto;
        }

        /* Bootstrap 4 text input with search icon */

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        #lines
        {
            min-width: 100%;
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

    </style>

    <?php
    $user_meta=get_userdata(get_current_user_id());

    $user_roles=$user_meta->roles;
    ?>


    <div class="marginer"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="text-title-posts-list">
                <?php
                if (in_array("administrator", $user_roles))
                {
                    ?>
                    <h2 class="text-center">Artigos Submetidos</h2>
                <?php  } else {  ?>
                    <h2 class="text-center">Meus Artigos Submetidos</h2>
                <?php } ?>
                </div>
            </div>

        </div>

    <div class="marginer"></div>





    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <form action="" method="get">
                    <input type="hidden" name="page" value="gerir-posts" >
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
                    <input type="hidden" name="page" value="gerir-posts">

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

    if ($_GET['lines'] != '')
    {
        $posts_per_page = $_GET['lines'];
    }
    else
    {
        $posts_per_page = 10;
    }





    if (in_array("administrator", $user_roles))
    {
        $args = array(
            'posts_per_page' => $posts_per_page,
            'post_type'        => 'post',
            'post_status' => array('publish', 'pending', 'draft', 'trash'),
            'paged' => $paged,
            's' => $_GET['s']
        );
        //let's first get ALL of the possible posts
        $args_dados = array(
            'posts_per_page'   => -1,
            'post_type'        => 'post',
            'post_status' => array('publish', 'pending', 'draft', 'trash'),
            's' => $_GET['s']
        );

        $disabled = '';

        //$disabled = 'disabled';


    }
    else
    {
        $args = array(
            'posts_per_page' => $posts_per_page,
            'post_type'        => 'post',
            'author'        => get_current_user_id(),
            'post_status' => array('publish', 'pending', 'draft', 'trash'),
            'paged' => $paged,
            's' => $_GET['s']
        );


        //let's first get ALL of the possible posts
        $args_dados = array(
            'posts_per_page'   => -1,
            'post_type'        => 'post',
            'author'        => get_current_user_id(),
            'post_status' => array('publish', 'pending', 'draft', 'trash'),
            's' => $_GET['s']
        );


    }





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
                <table class="table table-bordered" id="table_posts">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo do Post</th>
                        <?php
                        if (in_array("administrator", $user_roles)) {
                            ?>
                            <th scope="col">Nome do Autor</th>
                            <?php
                        }
                        ?>
                        <th scope="col">Categorias</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Estado do Post</th>
                        <th scope="col">Comentários</th>
                        <th scope="col">Duração da Publicação</th>
                        <th scope="col">Visualizações</th>
                        <th scope="col">Acções</th>
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
						



                        ?>


                        <tr>
                            <td><?php echo $post->ID?> <input type="hidden" id="post_id_com" value="<?php echo $post->ID?>"> </td>
                            <td><?php echo $post->post_title?></td>


                            <?php
                            if (in_array("administrator", $user_roles)) {
                                ?>
                                <td>
                                    <?php
                                    $display_name = get_the_author_meta('display_name', $post->post_author);
                                    echo $display_name; ?>
                                </td>
                                <?php
                            }
                            ?>

                            <?php
                            // Categorias
                            if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {

                                $term_ids = implode( ',' , $post_terms );

                                $terms = wp_list_categories( array(
                                    'taxonomy' => 'category',
									'show_count' => false,
									'hide_empty' => false,
									'echo'     => false,
									'title_li' => '',
									'style'    => 'none',
									'include'  => $term_ids
                                ) );

                                $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );

                                // Display post categories.
                                ?>
                                <td><?php echo $terms?></td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td>Sem Categoria(s)</td>
                                <?php
                            }

                            // Tags
                            ?>
							

                            <?php

                            if ( ! empty( $post_tags ) && ! is_wp_error( $post_tags ) ) {

                                $tags_id = implode( ',' , $post_tags );
								

                                $tags_list = wp_list_categories( array(
                                    'taxonomy' => 'post_tag',
									'show_count' => false,
									'hide_empty' => false,
									'echo'     => false,
									'title_li' => '',
									'style'    => 'none',
									'include'  => $tags_id
                                ) );
								

                                $tags_list = rtrim( trim( str_replace( '<br />',  $separator, $tags_list ) ), $separator );

                                // Display post categories.
                                ?>
                                <td><?php echo $tags_list; ?></td>
                                <?php
                            }
                            else
                            {
                                ?>
                                <td>Sem Keyword(s)</td>
                                <?php
                            }
                            ?>

                            <?php
                            $current_status = get_post_status ( $post->ID );


                            switch($current_status)
                            {
                                case 'draft':
                                    $estado = 'Rascunho';
                                    $alert = 'warning';
                                    break;
                                case 'trash':
                                    $estado = 'Reprovado';
                                    $alert = 'danger';
                                    break;
                                case 'pending':
                                    $estado = 'Pendente para Revisão';
                                    $alert = 'info';
                                    break;
                                case 'publish':
                                    $estado = 'Publicado';
                                    $alert = 'success';
                                    break;
                            }



                            ?>

                            <td>
                                <div class="alert alert-<?php echo $alert; ?>" role="alert">
                                    <?php echo $estado; ?>
                                </div>
                            </td>

                            <?php
                            $args = array(
                                'post_id' => $post->ID,   // Use post_id, not post_ID
                                'count'   => true // Return only the count
                            );
                            $comments_count = get_comments( $args );
                            ?>

                            <td>
                                <?php
                                    if ($comments_count == 0)
                                    {
                                        echo 'Nenhum comentário';
                                    }
                                    else
                                    {
                                        ?>

                                        <a onclick="showcomments(<?php echo $post->ID; ?>);" class="link-primary comment_link_list"><?php echo $comments_count; ?></a>
                                        <?php
                                    }
                                ?>
                            </td>

                            <?php
                            date_default_timezone_set('Europe/Lisbon');
                            $curr_time = $post->post_modified;
                            $time_ago = strtotime($curr_time);
                            ?>

                            <td><?php echo time_Ago($time_ago); ?></td>



                            <td><?php echo do_shortcode('[epvc_views id="'.$post->ID.'"]'); ?>
                            </td>

                            <td>
                                <?php
                                // Administrador do Sistema

                                $disabled_edit = '';

                                if (in_array("administrator", $user_roles)) {
                                        if ($estado === 'Reprovado' || $estado === 'Publicado') {
                                            $disabled = 'disabled';
                                        }
                                        if ($estado === 'Pendente para Revisão' || $estado === 'Rascunho')
                                        {
                                            $disabled = '';
                                        }
                                        /*if (get_current_user_id() == $post->post_author)
                                        {
                                            $disabled = 'disabled';
                                        }*/
                                }
                                if (!(in_array("administrator", $user_roles))) {
                                        if ($estado === 'Publicado') {
                                            $disabled = '';
                                            $disabled_edit = 'disabled';
                                        }
                                        if($estado === 'Reprovado')
                                        {
                                            $disabled = 'disabled';
                                        }
                                        if($estado === 'Pendente para Revisão')
                                        {
                                            $disabled = '';
                                            $disabled_edit = '';
                                        }
                                        if ($estado === 'Rascunho')
                                        {
                                            $disabled = '';
                                            $disabled_edit = '';
                                        }
                                }
                                ?>
                                <!-- Editar -->
                                <a href="admin.php?page=editar-artigo&post_id=<?php echo $post->ID; ?>" class="btn btn-primary <?php echo $disabled_edit; ?>" title="Editar Artigo - <?php echo $post->ID; ?>" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                &nbsp;
                                <!-- Inserir Comentarios -->


                                <button id="enviar_comentarios_admin" class="btn btn-info" type="button" <?php echo $disabled; ?> onclick="addComentPost(<?php echo $post->ID ?>);"><i class="fa fa-comment" aria-hidden="true" ></i>
                                </button>
                            </td>




                        </tr>


                    <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    <?php
                    //we need to display some pagination if there are more total posts than the posts displayed per page
                    if($post_count > $posts_per_page ){

                        echo '<div class="pagination">
                    <ul>';

                        if($paged > 1){
                            echo '<li><a class="first" href="?page=gerir-posts&paged=1&s='.$_GET['s'].'&lines='.$_GET['lines'].'">&laquo;</a></li>';
                        }else{
                            echo '<li><span class="first">&laquo;</span></li>';
                        }

                        for($p = 1; $p <= $num_pages; $p++){
                            if ($paged == $p) {
                                echo '<li><span class="current">'.$p.'</span></li>';
                            }else{
                                echo '<li><a href="?page=gerir-posts&paged='.$p.'&s='.$_GET['s'].'&lines='.$_GET['lines'].'">'.$p.'</a></li>';
                            }
                        }

                        if($paged < $num_pages){
                            echo '<li><a class="last" href="?page=gerir-posts&paged='.$num_pages.'&s='.$_GET['s'].'&lines='.$_GET['lines'].'">&raquo;</a></li>';
                        }else{
                            echo '<li><span class="last">&raquo;</span></li>';
                        }

                        echo '</ul></div>';
                    }
                    ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
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

        jQuery(".epvc-label").css('display', 'none');

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


        function addComentPost(post_id) {
            var add_coment = jQuery("#add_coment");
            jQuery("#title_post_comment").html(post_id);
            add_coment.appendTo("body").modal('show');



        }

        function addSaveComment(post_id, comment) {
            var user_id = "<?php echo get_current_user_id(); ?>";
            var comment_blog = jQuery("#add_coment");

            jQuery.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {action: 'add_comment_by_post', id: user_id, comment: comment, post_id: post_id},
                success: function(response){

                    console.log(response);

                    if (response.data.err === 0)
                    {
                        comment_blog.modal('hide');
                        jQuery("#modal_warn_title_comment").css('color','#5cb85c');
                        jQuery("#modal_warn_title_comment").html('<i class="fa fa-check"></i> Sucesso ao criar o comentário numero '+response.data.comment+' do post '+ post_id);
                        jQuery('.text_warn_comment').html(response.data.mensagem);
                        jQuery("#modal_warn_comment").appendTo("body").modal('show');
                        jQuery("#edit_comm_article").removeClass('is-invalid');
                        jQuery(".invalid-feedback-comment").html('');
                        jQuery('#modal_warn_comment').on('hidden.bs.modal', function () {
                            window.location.href = response.data.url;
                        });
                    }
                    else if (response.data.err === 1)
                    {
                        jQuery("#edit_comm_article").addClass('is-invalid-comment');
                        jQuery(".invalid-feedback-comment").html(response.data.mensagem);
                    }
                    else
                    {
                        jQuery("#edit_comm_article").addClass('is-invalid-comment');
                        jQuery(".invalid-feedback-comment").html(response.data.mensagem);
                    }
                }
            });
        }
    </script>


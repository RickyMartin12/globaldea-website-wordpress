<?php

//echo $_GET['user_id'].' '.$_GET['post_tema_id'].' '.$_GET['post_tile_tema'];

global $post, $wpdb;

$r = $wpdb->prepare("SELECT post_id FROM `posts_rel_temas` where tema_id = ".$_GET['post_tema_id']);

$values = $wpdb->get_col( $r );

//echo $values[0];

$author_id = get_post_field('post_author', $values[0]);

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<style>
    .update-nag.notice.notice-warning.inline, .sendwp-notice, .jpum-notice {
        display: none;
    }

    .topper, #detalhe_tema
    {
        margin-top: 20px;
    }

    #submit_limite_horas
    {
        font-weight: bold;
        float: right;
        margin: 0 auto;
    }

    .div_center_text
    {
        margin: 0 auto;
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
    .card-theme
    {
        background: #52668d;
        color: #fff;
    }
    li
    {
        list-style: none!important;
    }
    #button_actions_posts {
        text-align: center;
    }
    .list_files_post_temas
    {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        width: 100%;
    }
    #button_right
    {
        margin-left: auto;
        font-size: small;
        padding: 0 0 4px 20px;
    }
    .list_files_post_temas
    {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        width: 100%;
    }
    .list-group-item, #list_files_id_post_temas {
        margin-bottom: 20px;
    }
	@media only screen and (max-width: 600px)
	{
		#files_posts_temas
		{
			width: 80%;
		}
	}
</style>

<script>

       function removerPostRelTemaOutTimeExecution(post_id, tema_id) {
           jQuery.ajax({
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               type: 'POST',
               data: {action: 'remove_rel_post_tema', post_id: post_id, tema_id: tema_id},
               success: function (response) {
                   console.log(response);

                   setTimeout(function(){ window.location.href = response.data.url; }, 2000);
               }
           });
       }

</script>


<?php

include plugin_dir_path( __DIR__).'modals.php';

date_default_timezone_set('Europe/Lisbon');

$data_post_publicacao = get_post_field('post_date', $values[0]);

$time_ago_pub = strtotime($data_post_publicacao);
// condicao
$horaspub_article_vis = date('Y-m-d H:i:s', strtotime("+48 hours", $time_ago_pub));
$actual_data_article = date('Y-m-d H:i:s', time());

// clock time
$hr_art_vis = strtotime("+48 hours", $time_ago_pub);
$act_data_art = time();

//echo $horaspub_article_vis.' '.$actual_data_article;



?>

<?php

//Data de Limite de Submissão do Artigo
if($horaspub_article_vis >= $actual_data_article)
{
    $url_return = admin_url( 'admin.php?page=listar-meus-temas');

    $tema = get_post( $_GET['post_tema_id'], 'OBJECT' );


    global $wpdb;

    //echo $post->ID.' ';

    $r = $wpdb->prepare("SELECT post_id FROM `posts_rel_temas` where tema_id = $tema->ID");

    $values = $wpdb->get_col( $r );

    $conteudo = '';
    $status = '';
    if($values[0] != 0)
    {
        $post = get_post( $values[0], 'OBJECT' );
        $conteudo = $post->post_content;
        $status = $post->post_status;
        $post_id = $post->ID;
    }

?>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-sticky-note-o" aria-hidden="true"></i> Submissão do Novo Post através do tema número <?php echo $_GET['post_tema_id']; ?></h2>
            </div>
        </div>
    </div>

    <div class="topper"></div>

<div class="container-fluid">
    <div class="row">
        <div class="alert alert-danger div_center_text" role="alert">
            Seu prazo para submeter este artigo a aprovação termina em: <div id="submit_limite_horas"></div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card" id="tema_card">
        <div class="card-header card-theme">
            <h5 class="card-title"><i class="fa fa-info" aria-hidden="true"></i>
                &nbsp; Tema "<?php echo $tema->post_title;?>"</h5>
        </div>
        <div class="card-body" id="tema_post">

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>
                        &nbsp; Detalhe do Tema</h5>
                </div>
                <div class="card-body" id="tema_post">

                    <strong><i class="fa fa-file-text" aria-hidden="true"></i> Detalhe do Conteudo do Tema (Resumo)</strong>
                    <div class="form-group" id="detalhe_tema">
                        <textarea disabled class="form-control" rows="10" id="resumo_tema" value="<?php echo $tema->post_content; ?>"><?php echo $tema->post_content; ?></textarea>
                    </div>
                </div>
            </div>


        </div>
    </div>

</div>


<div class="container-fluid">
    <div class="card" id="tema_card">
        <div class="card-header card-theme">
            <h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                &nbsp; Novo Artigo</h5>
        </div>
        <div class="card-body" id="tema_post">

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-file-text" aria-hidden="true"></i>
                        &nbsp; Titulo do Artigo</h5>
                </div>
                <div class="card-body" id="tema_post">
                    <input type="text" class="form-control" id="title_post" name="title_post" value="<?php echo $tema->post_title; ?>" disabled>
                </div>
            </div>

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>
                        &nbsp; Conteudo</h5>
                </div>
                <div class="card-body" id="tema_post">
                    <?php
                    $settings = array(
                        'tinymce'       => array(
                            'setup' => 'function (ed) {
                tinymce.documentBaseURL = "' . get_admin_url() . '";
            }',
                        ),
                        'quicktags'     => TRUE,
                        'editor_class'  => 'frontend-article-editor',
                        'textarea_rows' => 25,
                        'media_buttons' => TRUE,
                    );
                    wp_editor( $conteudo, 'post_content_theme_art', $settings );
                    ?>
                </div>
            </div>

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-bookmark" aria-hidden="true"></i>
                        &nbsp; Categorias</h5>
                </div>
                <div class="card-body" id="tema_post">
                    <?php
                    $post_categories = wp_get_post_categories( $_GET['post_tema_id'] );
                    $cats = array();

                    foreach($post_categories as $c){
                        $cat = get_category( $c );
                        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                    }

                    echo wp_category_checklist( $_GET['post_tema_id']  );

                    ?>

                    <script>
                        jQuery("[name='post_category[]']").prop('disabled', true);
                    </script>
                </div>
            </div>

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-tags" aria-hidden="true"></i>
                        &nbsp; Keywords</h5>
                </div>
                <div class="card-body" id="tema_post">
                    <?php





                    $post_tags = wp_get_post_tags( $_GET['post_tema_id'] );
                    $cats = array();

                    foreach($post_tags as $tag){
                        $tag_id = get_tags( $tag );
                        $tags[] = $tag->term_id ;
                    }

                    ?>


                    <br>



                    <?php

                    $args = array(
                        'descendants_and_self' => 0,
                        'selected_cats' => $tags,
                        'popular_cats' => false,
                        'walker' => '',
                        'taxonomy' => 'post_tag',
                        'checked_ontop' => false
                    );
                    wp_terms_checklist($_GET['post_tema_id'], $args);

                    ?>

                    <script>
                        jQuery("[name='tax_input[post_tag][]']").prop('disabled', true);
                    </script>
                </div>
            </div>

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-files-o" aria-hidden="true"></i>
                        &nbsp; Ficheiros</h5>
                </div>
                <div class="card-body" id="tema_post">
                    <div id="file_cont">
                        <div id="list_files_id_post_temas">

                        </div>
                        <div id="content_fil_posts_load_temas">

                        </div>


                    </div>
                </div>

                <div class="card-body">
                    <hr/>
                        <input id="files_posts_temas" name="file" type="file" class="btn-primary btn col-xs-12" multiple="multiple" style="margin: 0 auto;
    display: block;">
                    <br>
                </div>

            </div>





        </div>
    </div>
</div>


<div class="topper"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="button_actions_posts">
                        <button type="button" class="btn btn-info" id="aprovado_post" name="Aprovacao" value="pending" onclick="submit_post(this.value, '<?php echo $values[0]; ?>');">Enviar para Aprovação</button>
                        <button type="button" class="btn btn-primary" id="rascundo_post" name="Rascunho" value="draft" onclick="submit_post(this.value, '<?php echo $values[0]; ?>');">Salvar como Rascunho</button>
                        <button type="button" class="btn btn-danger" id="reprovado_post" name="Descartar" value="trash" onclick="submit_post(this.value, '<?php echo $values[0]; ?>');">Descartar</button>
            </div>
        </div>
    </div>

</div>



   <script>

       var countDownDate = '<?php echo $hr_art_vis; ?>' * 1000;
       var now = '<?php echo $act_data_art; ?>' * 1000;

       //console.log(countDownDate, now);

       var t = setInterval(function() {
           now = now + 1000;

           var distance = countDownDate - now;


           // Time calculations for days, hours, minutes and seconds
           var days = Math.floor(distance / (1000 * 60 * 60 * 24));
           var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
           var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
           var seconds = Math.floor((distance % (1000 * 60)) / 1000);

           document.getElementById('submit_limite_horas').innerHTML = ' &nbsp;' + days + "d " + hours + "h " +
               minutes + "m " + seconds + "s ";




           // If the count down is over, write some text
           if (distance <= 0) {
               clearInterval(t);
               var i = "<?php echo $_GET['post_tema_id']; ?>";

               var post_ident = "<?php echo $values[0]; ?>";
               removerPostRelTemaOutTimeExecution(post_ident, i);





           }
       }, 1000);



       jQuery("#files_posts_temas").change(function(e) {
            e.preventDefault();
           var myfiles = document.getElementById("files_posts_temas");

           var files = myfiles.files;
           var data = new FormData();

           for (i = 0; i < files.length; i++) {
               //data.append('file' + i, files[i]);
               data.append('file_posts_temas[]', files[i]);
           }

           data.append('action', 'file_upload_artigo_tema');


           var list_files = '<ul class="list-group">';

           jQuery.ajax({
               type: 'POST',
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               processData: false,
               contentType: false,
               data: data,
               success: function (response) {
                   for(i=0; i<response.data.length; i++)
                   {
                       if (response.data[i].erro === 0)
                       {
                           var id = response.data[i].id_file;
                           var extension = response.data[i].name.substr( (response.data[i].name.lastIndexOf('.') +1) );
                           s = '';
                           switch(extension)
                           {
                               case 'jpg':
                               case 'png':
                               case 'gif':
                                   s += "<i class='fa fa-image'></i><span>&nbsp; " + response.data[i].name + "</span>";
                                   break;
                               case 'zip':
                               case 'rar':
                                   s += "<i class='fa fa-file-archive-o'></i><span>&nbsp; " + response.data[i].name + "</span>";
                                   break;
                               case 'pdf':
                                   s += "<i class='fa fa-file-pdf-o'></i><span>&nbsp; " + response.data[i].name + "</span>";
                                   break;
                               default:
                                   s += "<i class='fa fa-file'></i><span>&nbsp; " + response.data[i].name + "</span>";
                           }

                           var url = "'"+response.data[i].file_url+"'";
                           var names = "'"+response.data[i].name+"'";
                           list_files += '<li class="list-group-item" id="file_post_temas_'+id+'">' +
                               '<div id="cont_fil_'+id+'" class="list_files_post_temas">' + '<font id="fil_blog">' + s +'</font> ' +
                               '<div id="button_right">' +
                               '<button id="btn_file_rem" class="btn btn-danger" onclick="removeFilePostsTemas('+url+', '+names+', '+id+');"> ' +
                               '<i class="fa fa-trash"></i>' +
                               '</button>' +
                               '&nbsp; <a href="'+response.data[i].file_url+'" class="btn btn-info">' +
                               '<i class="fa fa-link"></i>' +
                               '</a>' +
                               '<input type="hidden" name="files_posts_temas_form[]" id="image_file_'+id+'" value="'+id+'">' +
                               ''+
                               '</div>' +
                               '</div>' +
                               '</li>';

                           jQuery("#modal_warn_title").css('color','#5cb85c');
                           jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao fazer o upload do ficheiro numero '+id);
                           jQuery('.text_warn').html(response.data[0].mensagem);
                           jQuery("#modal_warn").appendTo("body").modal('show');

                       }
                       else
                       {
                           jQuery("#modal_warn_title").css('color','#d9534f');
                           jQuery("#modal_warn_title").html('<i class="fa fa-times-circle"></i>Erro ao Submeter o Ficheiro');
                           jQuery('.text_warn').html(response.data[0].mensagem);
                           jQuery("#modal_warn").appendTo("body").modal('show');

                       }

                   }

                   list_files += '</ul>';


                   jQuery("#content_fil_posts_load_temas").append(list_files);
               }
           });
       });
       
       function removeFilePostsTemas(url, names, i) {
           jQuery.ajax({
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               type: 'POST',
               data: {path: url, action: 'remove_file_post_temas', id: i},
               success: function(response){
                   var id = response.data.id_file;

                   jQuery("#modal_warn_title").css('color','#5cb85c');
                   jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao remover o ficheiro numero '+id);
                   jQuery('.text_warn').html(response.data.mensagem);
                   jQuery("#modal_warn").appendTo("body").modal('show');

                   jQuery('#file_post_temas_'+id).remove();
               }
           });
       }

       function get_tinymce_content(id) {
           var content;
           var inputid = id;
           var editor = tinyMCE.get(inputid);
           var textArea = jQuery('textarea#' + inputid);
           if (textArea.length>0 && textArea.is(':visible')) {
               content = textArea.val();
           } else {
               content = editor.getContent();
           }
           return content;
       }

       function submit_post(status, post_id) {
           console.log(status, post_id);

           var user_id = '<?php echo $author_id; ?>';

           var tema_id = '<?php echo $_GET['post_tema_id']; ?>';

           // Titulo
           var titulo = jQuery("#title_post").val();

           var d = '<?php echo $data_post_publicacao; ?>';


           // Conteudo do Post
           var content = get_tinymce_content('post_content_theme_art');

           var cats = [];
           var tags = [];
           var files = [];

           jQuery("input[name='post_category[]']:checked").each(function () {
               cats.push(jQuery(this).val());
           });
           jQuery("input[name='tax_input[post_tag][]']:checked").each(function () {
               tags.push(jQuery(this).val());
           });

           files = jQuery('input[name="files_posts_temas_form[]"]').map(function () {
               return this.value; // $(this).val()
           }).get();


           console.log(files, tags, cats, post_id);

           /**/

           jQuery.ajax({
               type: 'POST',
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               data: {
                   action: 'inserir_post_tema_atr',
                   post_id: post_id,
                   content: content,
                   categorias: cats,
                   tags: tags,
                   files: files,
                   title_post: titulo,
                   status: status,
                   user_id: user_id,
                   tema_id: tema_id,
                   da: d
               },
               success: function (response) {
                   if (response.data.error === 0)
                   {
                       jQuery("#modal_warn_title").css('color','#5cb85c');
                       jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao criar o post numero '+response.data.id);
                       jQuery('.text_warn').html(response.data.mensagem);
                       jQuery("#modal_warn").appendTo("body").modal('show');


                       jQuery("#title_post").removeClass('is-invalid');
                       jQuery(".invalid-feedback").html('');

                       jQuery('#modal_warn').on('hidden.bs.modal', function () {
                           window.location.href = response.data.url;
                       });


                   }
                   else
                   {
                       jQuery("#modal_warn_title").css('color','#d9534f');
                       jQuery("#modal_warn_title").html('<i class="fa fa-times-circle"></i>Erro ao Submeter o Post número '+response.data.id);
                       jQuery('.text_warn').html(response.data.mensagem);
                       jQuery("#modal_warn").modal('show');

                       jQuery("#title_post").addClass('is-invalid');
                       jQuery(".invalid-feedback").html(response.data.mensagem);

                       jQuery('html, body').animate({
                           scrollTop: jQuery("#novo_post_form").offset().top
                       }, 2000);




                   }
               }
           });


           
           
       }

       var post_id = '<?php echo $post_id; ?>';

       list_files_posts_by_id(post_id);

       function list_files_posts_by_id(post_id) {
           jQuery.ajax({
               type: 'POST',
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               data: {action: 'list_files_post_temas', post_id: post_id},
               success: function (response) {
                   console.log(response);
                   var list_files = '<ul class="list-group">';
                   for(i=0; i<response.data.length; i++)
                   {
                       var id = response.data[i].id;
                       var extension = response.data[i].name.substr( (response.data[i].name.lastIndexOf('.') +1) );
                       s = '';
                       switch(extension)
                       {
                           case 'jpg':
                           case 'png':
                           case 'gif':
                               s += "<i class='fa fa-image'></i><span>&nbsp; " + response.data[i].name + "</span>";
                               break;
                           case 'zip':
                           case 'rar':
                               s += "<i class='fa fa-file-archive-o'></i><span>&nbsp; " + response.data[i].name + "</span>";
                               break;
                           case 'pdf':
                               s += "<i class='fa fa-file-pdf-o'></i><span>&nbsp; " + response.data[i].name + "</span>";
                               break;
                           default:
                               s += "<i class='fa fa-file'></i><span>&nbsp; " + response.data[i].name + "</span>";
                       }

                       var url = "'"+response.data[i].url+"'";
                       var names = "'"+response.data[i].name+"'";


                       list_files += '<li class="list-group-item" id="file_post_edit_temas_'+id+'">' +
                           '<div id="cont_fil_edit_'+id+'" class="list_files_post_temas">' + '<font id="fil_blog_edit">' + s +'</font> ' +
                           '<div id="button_right">' +
                           '<button id="btn_file_rem" class="btn btn-danger" onclick="removeFileEditPostTemas('+url+', '+names+', '+id+');"> ' +
                           '<i class="fa fa-trash"></i>' +
                           '</button>' +
                           '&nbsp; <a href="'+response.data[i].url+'" class="btn btn-info">' +
                           '<i class="fa fa-link"></i>' +
                           '</a>' +
                           '<input type="hidden" name="files_posts_temas_edit[]" id="image_file_edit_temas_'+id+'" value="'+id+'">' +
                           ''+
                           '</div>' +
                           '</div>' +
                           '</li>';
                   }
                   list_files += '</ul>';
                   jQuery("#list_files_id_post_temas").append(list_files);
               }
           });
       }

       function removeFileEditPostTemas(url, names, i)
       {
           jQuery.ajax({
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               type: 'POST',
               data: {path: url, action: 'delete_file_edit_post_tema', id: i},
               success: function(response){
                   var id = response.data.id_file;

                   jQuery("#modal_warn_title").css('color','#5cb85c');
                   jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao remover o ficheiro numero '+id);
                   jQuery('.text_warn').html(response.data.mensagem);
                   jQuery("#modal_warn").appendTo("body").modal('show');
                   jQuery('#file_post_edit_temas_'+id).remove();
               }
           });


       }

       function removeFileEditTemas(url, names, i)
       {
           jQuery.ajax({
               url: '<?php echo admin_url('admin-ajax.php'); ?>',
               type: 'POST',
               data: {path: url, action: 'delete_file_post_tema_form_editor_up', id: i},
               success: function (response) {
                   //console.log(response);

                   var id = response.data.id_file;

                   jQuery("#modal_warn_title").css('color', '#5cb85c');
                   jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao remover o ficheiro numero ' + id);
                   jQuery('.text_warn').html(response.data.mensagem);
                   jQuery("#modal_warn").appendTo("body").modal('show');

                   jQuery('#file_post_edit_form_temas_' + id).remove();
               }
           });
       }

   </script>






<?php






}
else
{
    $url_dest = admin_url( 'admin.php?page=listar-meus-temas');
    ?>
    <script>
        var url_dest = '<?php echo $url_dest; ?>';
        var temas_identification = '<?php echo $_GET['post_tema_id']; ?>';
        var poster_identification = '<?php echo $post_id; ?>';

        removerPostRelTemaOutTimeExecution(poster_identification, temas_identification);

        setInterval(function() { window.location.href = url_dest}, 2000);

    </script>
    <?php
}
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php
include plugin_dir_path( __DIR__).'modals.php';
date_default_timezone_set('Europe/Lisbon');
$tema = get_post( $_GET['tema_id'], 'OBJECT' );

$post = get_post( $_GET['post_id'], 'OBJECT' );

//echo $post->post_author.' '.get_current_user_id();

if($post->post_author === get_current_user_id() )
{
    $enabled = 'enabled';
}
else
{
    $enabled = 'disabled';
}

$data_post_publicacao = date('Y-m-d H:i:s');
?>

<style>
    .update-nag.notice.notice-warning.inline, .sendwp-notice, .jpum-notice {
        display: none;
    }
    .topper, #detalhe_tema
    {
        margin-top: 20px;
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
    #files_posts_temas_edit_form {
        text-align: center;
        margin: 0 auto;
        display: block;
    }

    .list-group-item, #list_files_id_post_temas_admin {
        margin-bottom: 20px;
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
    #button_actions_posts_temas_user
    {
        text-align: center;
    }

    .is-invalid{
        border-color: #dc3545!important;
        padding-right: calc(1.5em + .75rem)!important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .is-invalid-comment{
        border-color: #dc3545!important;
        padding-right: calc(1.5em + .75rem)!important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) top calc(0.1rem + 0.1rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .invalid-feedback, .invalid-feedback-comment, .invalid-feedback-content-black
    {
        color: #dc3545!important;
    }
	
	@media screen and (max-width: 600px) {
        #files_posts_temas_edit_form {
            width: 80%;
        }
    }
</style>

<script>
        var post_id = "<?php echo $post->ID; ?>";
</script>


<div class="modal fade" id="add_coment" tabindex="-1" role="dialog" aria-labelledby="add_coment_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_coment_title">Adicionar um novo comentário ao artigo <span id="title_post_comment"></span></h5>
                <input type="hidden" id="add_comment_by_post_id">
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
                    <strong>Revisor:</strong> <span id="user_name_editor_admin"></span>
                </div>
                <button type="button" class="btn btn-success" onclick="saveComment(jQuery('#add_comment_by_post_id').val(), jQuery('#edit_comm_article').val());"> <i class="fa fa-save"></i> <font class="d-none d-sm-inline-block"> Salvar </font></button>
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


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edição Post número <?php echo $post->ID; ?> através do tema número <?php echo $_GET['tema_id']; ?></h2>
        </div>
    </div>
</div>

<div class="topper"></div>

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
            <h5 class="card-title"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                &nbsp; Edição do Artigo número <?php echo $post->ID; ?></h5>
        </div>
        <div class="card-body" id="tema_post">

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-file-text" aria-hidden="true"></i>
                        &nbsp; Titulo do Artigo</h5>
                </div>
                <div class="card-body" id="tema_post">
                    <input type="text" class="form-control" id="title_post_edit" name="title_post_edit" value="<?php echo $post->post_title; ?>" disabled>
                </div>
            </div>

            <div class="card" id="tema_card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>
                        &nbsp; Conteudo</h5>
                </div>
                <div class="card-body" id="tema_post">
                    <?php
                    wp_editor(  $post->post_content , 'post_content_theme_art_edit', $settings );
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
                    $post_categories = wp_get_post_categories( $tema->ID );
                    $cats = array();

                    foreach($post_categories as $c){
                        $cat = get_category( $c );
                        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                    }

                    echo wp_category_checklist( $tema->ID  );

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





                    $post_tags = wp_get_post_tags( $post->ID );
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
                    wp_terms_checklist($post->ID, $args);

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
                        <div id="list_files_posts_temas">
                            <div id="list_files_id_post_temas_admin">

                            </div>

                            <div id="content_fil_posts_temas_admin_load">

                            </div>
                        </div>


                    </div>
                </div>

                <div class="card-body">
                    <hr/>
                    <input id="files_posts_temas_edit_form" name="file" type="file" class="btn-primary btn col-xs-12" multiple="multiple" style="margin: 0 auto;">
                    <br>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="topper"></div>

<!--<div class="container-fluid">
    <div class="card" id="tema_card">
        <div class="card-header card-theme">
            <h5 class="card-title"><i class="fa fa-comment" aria-hidden="true"></i>
                &nbsp; Comentários do Artigo número <?php echo $post->ID; ?></h5>
        </div>
        <div class="card-body" id="tema_post">
            <textarea class="form-control" rows="10" id="insert_comentario_post_tema" <?php echo $enabled; ?>></textarea>
            <div class="invalid-feedback-content-black"></div>
        </div>
        <div class="card-header card-theme">
            <button type="button" class="btn btn-info" onclick="submterComentario(jQuery('#insert_comentario_post_tema').val(), <?php echo $post->ID; ?>);" <?php echo $enabled; ?>><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                 Enviar Comentário</button>

        </div>
    </div>
</div>-->

<div class="topper"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="button_actions_posts_temas_user">
                <button type="button" class="btn btn-info" name="melhoria" value="pending" onclick="editPostTemasSubmit(this.value, <?php echo $post->ID; ?>);">Devolver para Revisão</button>
                <button type="button" class="btn btn-danger" name="reprovado" value="trash" onclick="editPostTemasSubmit(this.value, <?php echo $post->ID; ?>);">Reprovar</button>
                <button type="button" class="btn btn-success" name="aprovado" value="publish" onclick="editPostTemasSubmit(this.value, <?php echo $post->ID; ?>);">Aprovar/Publicar</button>
            </div>
        </div>
    </div>
</div>


<script>

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
                jQuery("#list_files_id_post_temas_admin").append(list_files);
            }
        });
    }

    jQuery("#files_posts_temas_edit_form").change(function(e) {
        e.preventDefault();

        var list_files_add = '';

        var myfiles_edit = document.getElementById("files_posts_temas_edit_form");

        var files_edit = myfiles_edit.files;
        var data = new FormData();

        for (i = 0; i < files_edit.length; i++) {
            //data.append('file' + i, files[i]);
            data.append('file_temas_edit[]', files_edit[i]);
        }

        data.append('action', 'file_upload_edit_temas_artigos_admin');

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {

                console.log(response);
                var list_files = '<ul class="list-group">';

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
                        list_files_add += '<li class="list-group-item" id="file_post_edit_form_temas_'+id+'">' +
                            '<div id="cont_fil_edit_form_temas_'+id+'" class="list_files_post_temas">' + '<font id="fil_blog_edit_form">' + s +'</font> ' +
                            '<div id="button_right">' +
                            '<button id="btn_file_rem" class="btn btn-danger" onclick="removeFileEditTemas('+url+', '+names+', '+id+');"> ' +
                            '<i class="fa fa-trash"></i>' +
                            '</button>' +
                            '&nbsp; <a href="'+response.data[i].file_url+'" class="btn btn-info">' +
                            '<i class="fa fa-link"></i>' +
                            '</a>' +
                            '<input type="hidden" name="files_posts_edit_form_temas[]" id="image_file_edit_form_temas_'+id+'" value="'+id+'">' +
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

                list_files_add += '</ul>';
                jQuery("#content_fil_posts_temas_admin_load").append(list_files_add);




            }
        });
    });

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

    function editPostTemasSubmit(status, post_id) {
        console.log(status, post_id);

        var title = jQuery("#title_post_edit").val();

        var content = get_tinymce_content('post_content_theme_art_edit');
        var cats = [];
        var tags = [];
        var files = [];

        jQuery("input[name='post_category[]']:checked").each(function () {
            cats.push(jQuery(this).val());
        });
        jQuery("input[name='tax_input[post_tag][]']:checked").each(function () {
            tags.push(jQuery(this).val());
        });

        files = jQuery('input[name="files_posts_edit_form_temas[]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var user_id = "<?php echo $post->post_author; ?>";

        var curr_user = "<?php echo get_current_user_id(); ?>";

        var d = '<?php echo $data_post_publicacao; ?>';

        var tema_id = "<?php echo $tema->ID; ?>";

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'edit_post_temas_form_submission_admin',
                post_id: post_id,
                content: content,
                categorias: cats,
                tags: tags,
                files: files,
                title_post: title,
                status: status,
                user_id: user_id,
                da: d,
                tema_id: tema_id
            },
            success: function (response) {
                console.log(response);
                if (response.data.error === 0)
                {
                    jQuery("#modal_warn_title").css('color','#5cb85c');
                    jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao editar o post numero '+response.data.id);
                    jQuery('.text_warn').html(response.data.mensagem);
                    jQuery("#modal_warn").appendTo("body").modal('show');

                    if(response.data.status === 'pending')
                    {
                        console.log(curr_user, user_id);
                        if(curr_user !== user_id)
                        {
                            var post_id = response.data.id;

                            var title = response.data.title;

                            var username = response.data.username;


                            jQuery('#modal_warn').on('hidden.bs.modal', function () {
                                AddComment(post_id, title, username);
                            });
                        }
                        else
                        {
                            jQuery('#modal_warn').on('hidden.bs.modal', function () {
                                window.location.href = response.data.url;
                            });
                        }


                    }
                    else
                    {
                        jQuery('#modal_warn').on('hidden.bs.modal', function () {
                            window.location.href = response.data.url;
                        });
                    }

                }
                else
                {
                    jQuery("#modal_warn_title").css('color','#d9534f');
                    jQuery("#modal_warn_title").html('<i class="fa fa-times-circle"></i>Erro ao editar o Post número '+response.data.id);
                    jQuery('.text_warn').html(response.data.mensagem);
                    jQuery("#modal_warn").appendTo("body").modal('show');
                }
            }
        });
    }

    function AddComment(post_id, title, username) {
        var content = jQuery("#add_coment");
        jQuery("#add_comment_by_post_id").val(post_id);
        jQuery("#title_post_comment").html(title);
        jQuery("#user_name_editor_admin").html(username);
        content.appendTo("body").modal('show');
    }

    function saveComment(post_id, comment) {

        var user_id = "<?php echo get_current_user_id(); ?>";

        var comment_blog = jQuery("#add_coment");


        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {action: 'add_comment_article_admin', id: user_id, comment: comment, post_id: post_id},
            success: function(response){

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
                    jQuery("#edit_comm_article").addClass('is-invalid');
                    jQuery(".invalid-feedback-comment").html(response.data.mensagem);
                }
                else
                {
                    jQuery("#edit_comm_article").addClass('is-invalid');
                    jQuery(".invalid-feedback-comment").html(response.data.mensagem);
                }
            }
        });
    }


    function submterComentario(coment, post_id) {

        var user_id_current = '<?php echo get_current_user_id(); ?>';
        //console.log(coment, post_id);
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {action: 'add_comment_artigo_tema', id: user_id_current, comment: coment, post_id: post_id},
            success: function (response) {
                console.log(response);
                if (response.data.err === 0)
                {

                    jQuery("#modal_warn_title").css('color','#5cb85c');
                    jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao criar o comentário numero '+response.data.comment+' do post '+ post_id);
                    jQuery('.text_warn').html(response.data.mensagem);
                    jQuery("#modal_warn").appendTo("body").modal('show');
                    jQuery("#insert_comentario_post_tema").removeClass('is-invalid-comment');
                    jQuery(".invalid-feedback-content-black").html('');
                    jQuery("#insert_comentario_post_tema").val('');


                }
                else if (response.data.err === 1)
                {
                    jQuery("#insert_comentario_post_tema").addClass('is-invalid-comment');
                    jQuery(".invalid-feedback-content-black").html(response.data.mensagem);
                }
                else
                {
                    jQuery("#insert_comentario_post_tema").addClass('is-invalid-comment');
                    jQuery(".invalid-feedback-content-black").html(response.data.mensagem);
                }
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
</script>


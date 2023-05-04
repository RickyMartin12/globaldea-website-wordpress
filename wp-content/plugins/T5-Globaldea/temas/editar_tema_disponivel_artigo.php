<?php
include plugin_dir_path( __DIR__).'modals.php';
date_default_timezone_set('Europe/Lisbon');
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

    .list-group-item, #list_files_id_post_temas {
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
	@media only screen and (max-width: 600px)
	{
		#files_posts_temas_edit_form
		{
			width: 80%;
		}
	}
</style>

<?php
$tema = get_post( $_GET['tema_id'], 'OBJECT' );

$post = get_post( $_GET['post_id'], 'OBJECT' );


$user_meta=get_userdata(get_current_user_id());

$user_roles=$user_meta->roles;

$data_post_publicacao = date('Y-m-d H:i:s');

?>

<script>
    var post_id = "<?php echo $post->ID; ?>";
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edição Post número <?php echo $_GET['post_id']; ?> através do tema número <?php echo $_GET['tema_id']; ?></h2>
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
                    $post_categories = wp_get_post_categories( $post->ID );
                    $cats = array();

                    foreach($post_categories as $c){
                        $cat = get_category( $c );
                        $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                    }

                    echo wp_category_checklist( $post->ID  );

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
                            <div id="list_files_id_post_temas">

                            </div>

                            <div id="content_fil_posts_temas_load">

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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="button_actions_posts_temas_user">
            </div>
        </div>
    </div>
</div>

    <script>
        jQuery("#button_actions_posts_temas_user").html('<button type="button" class="btn btn-primary" name="Rascunho" value="draft" onclick="editPostTemasSubmit(this.value,'+post_id+')">Salvar como Rascunho</button>\n' +
            '    <button type="button" class="btn btn-info" name="Aprovacao" value="pending" onclick="editPostTemasSubmit(this.value,'+post_id+');">Enviar para Aprovação</button>\n' +
            '    <button type="button" class="btn btn-danger" name="Descartar" value="trash" onclick="editPostTemasSubmit(this.value,'+post_id+');">Descartar</button>');
    </script>

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

        data.append('action', 'file_upload_edit_temas_artigos');



        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {

                console.log(response);
                var list_files = '<ul class="list-group">';

                // content_fil_posts_temas_load


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
                jQuery("#content_fil_posts_temas_load").append(list_files_add);




            }
        });
    });

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

        var d = '<?php echo $data_post_publicacao; ?>';

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'edit_post_temas_disponiveis_form_submission',
                post_id: post_id,
                content: content,
                categorias: cats,
                tags: tags,
                files: files,
                title_post: title,
                status: status,
                user_id: user_id,
                da: d
            },
            success: function (response) {
                console.log(response);
                if (response.data.error === 0)
                {
                    jQuery("#modal_warn_title").css('color','#5cb85c');
                    jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao editar o post numero '+response.data.id);
                    jQuery('.text_warn').html(response.data.mensagem);
                    jQuery("#modal_warn").appendTo("body").modal('show');

                    jQuery('#modal_warn').on('hidden.bs.modal', function () {
                        window.location.href = response.data.url;
                    });
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




</script>
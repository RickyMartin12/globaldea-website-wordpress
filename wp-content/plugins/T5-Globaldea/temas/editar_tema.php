<?php
include plugin_dir_path( __DIR__).'modals.php';
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php $tema_id = $_GET['tema_id']; ?>

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
    li
    {
        list-style: none!important;
    }
    .list_files_post
    {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        width: 100%;
    }

    #fil_blog
    {
        margin: 0;
    }

    #button_right
    {
        margin-left: auto;
        font-size: small;
        padding: 0 0 4px 20px;
    }

    #button_actions_temas
    {
        text-align: center;
    }

    .invalid-feedback-resumo-tema{
        border-color: #dc3545!important;
        padding-right: calc(1.5em + .75rem)!important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) top calc(0.1rem + 0.1rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .invalid-feedback-titulo-tema{
        border-color: #dc3545!important;
        padding-right: calc(1.5em + .75rem)!important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .invalid-feedback-content, .invalid-feedback-titulo
    {
        color: #dc3545!important;
    }
	
	@media screen and (max-width: 600px) {
        #files_temas_edit {
            width: 80%;
        }
    }
</style>

<?php

$tema = get_post( $tema_id, 'OBJECT' );
?>

<div class="container-fluid">
    <div class="row">
        <h2><i class="fa fa-id-card" aria-hidden="true"></i> Editar Tema Número <?php echo $tema->ID; ?></h2>
    </div>
</div>

<div class="container-fluid" id="novo_tema_form">
    <div class="card" id="tema_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-file-text" aria-hidden="true"></i>
                &nbsp; Titulo</h5>
        </div>
        <div class="card-body" id="tema_post">
            <input type="text" class="form-control" placeholder="Insere o Titulo do Tema" id="title_post" name="title_post" value="<?php echo $tema->post_title; ?>">
            <div class="invalid-feedback-titulo order-last ">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card" id="tema_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>
                &nbsp; Resumo</h5>
        </div>
        <div class="card-body" id="tema_post">
            <div class="form-group">
                <textarea class="form-control" rows="10" id="resumo_tema_pub"></textarea>
                <div class="invalid-feedback-content"></div>
            </div>
        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="card" id="tema_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-bookmark" aria-hidden="true"></i>
                &nbsp; Categorias</h5>
        </div>
        <div class="card-body" id="tema_post">
            <?php
            $post_categories = wp_get_post_categories( $post_id );
            $cats = array();

            foreach($post_categories as $c){
                $cat = get_category( $c );
                $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
            }

            echo wp_category_checklist( $tema_id  );

            ?>
        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="card" id="tema_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-tags" aria-hidden="true"></i>
                &nbsp; Keywords</h5>
        </div>
        <div class="card-body" id="tema_post">
            <?php





            $post_tags = wp_get_post_tags( $tema_id );
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
            wp_terms_checklist($tema_id, $args);

            ?>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="card" id="tema_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-files-o" aria-hidden="true"></i>
                &nbsp; Ficheiros</h5>
        </div>
        <div class="card-body" id="tema_post">
            <div id="file_cont">

                <div id="list_files_id_tema">

                </div>


                <div id="content_fil_temas_load">

                </div>


            </div>
        </div>

        <div class="card-body">
            <hr/>
            <input id="files_temas_edit" name="file" type="file" class="btn-primary btn col-xs-12" multiple="multiple" style="margin: 0 auto;
    display: block;">
            <br>
        </div>

    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="button_actions_temas">
                <button type="button" class="btn btn-success" name="aprovado" value="publish" onclick="editarTema(this.value, <?php echo $tema_id; ?>);">Aprovar o Tema</button>
                <button type="button" class="btn btn-info" name="melhoria" value="pending" onclick="editarTema(this.value, <?php echo $tema_id; ?>);">Melhorar o Tema</button>
                <button type="button" class="btn btn-danger" name="reprovado" value="trash" onclick="editarTema(this.value, <?php echo $tema_id; ?>);">Reprovar o Tema</button>
            </div>
        </div>
    </div>

</div>

<script>

    var resumo_content_tema = '<?php echo $tema->post_content; ?>';
    jQuery("#resumo_tema_pub").val(resumo_content_tema);

    function editarTema(status, tema_id) {
        console.log(status, tema_id);

        var title = jQuery("#title_post").val();

        var content = jQuery("#resumo_tema_pub").val();
        var cats = [];
        var tags = [];
        var files = [];
        jQuery("input[name='post_category[]']:checked").each(function () {
            cats.push(jQuery(this).val());
        });
        jQuery("input[name='tax_input[post_tag][]']:checked").each(function () {
            tags.push(jQuery(this).val());
        });

        files = jQuery('input[name="files_posts_edit_form[]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var user_id = "<?php echo $tema->post_author; ?>";

        console.log(title, content, cats, tags, files, user_id);

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'edit_tema',
                tema_id: tema_id,
                content: content,
                categorias: cats,
                tags: tags,
                files: files,
                title_tema: title,
                status: status,
                user_id: user_id,
                tipo_publicaco_formulario: 'temas',
            },
            success: function (response) {
                console.log(response);

                if(response.data.erros == 11)
                {
                    // Titulo
                    jQuery("#title_post").addClass('invalid-feedback-titulo-tema');
                    jQuery(".invalid-feedback-titulo").html(response.data.mensagem[0]);

                    // Resumo
                    jQuery("#resumo_tema_pub").addClass('invalid-feedback-resumo-tema');
                    jQuery(".invalid-feedback-content").html(response.data.mensagem[1]);

                    jQuery('html, body').animate({
                        scrollTop: jQuery("#novo_tema_form").offset().top
                    }, 2000);
                }
                else if (response.data.erros == 1 && response.data.title === "")
                {
                    // Titulo

                    jQuery("#resumo_tema_pub").removeClass('invalid-feedback-resumo-tema');
                    jQuery(".invalid-feedback-content").html('');


                    jQuery("#title_post").addClass('invalid-feedback-titulo-tema');
                    jQuery(".invalid-feedback-titulo").html(response.data.mensagem);

                    jQuery('html, body').animate({
                        scrollTop: jQuery("#novo_tema_form").offset().top
                    }, 2000);
                }

                else if (response.data.erros == 1 && response.data.content === "")
                {
                    // Titulo

                    jQuery("#title_post").removeClass('invalid-feedback-titulo-tema');
                    jQuery(".invalid-feedback-titulo").html('');

                    jQuery("#resumo_tema_pub").addClass('invalid-feedback-resumo-tema');
                    jQuery(".invalid-feedback-content").html(response.data.mensagem);

                    jQuery('html, body').animate({
                        scrollTop: jQuery("#tema_card").offset().top
                    }, 2000);
                }

                else if(response.data.erros == 0)
                {
                    jQuery("#modal_warn_title").css('color','#5cb85c');
                    jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao criar o tema numero '+response.data.id);
                    jQuery('.text_warn').html(response.data.mensagem);
                    jQuery("#modal_warn").appendTo("body").modal('show');

                    jQuery("#title_post").removeClass('is-invalid');
                    jQuery(".invalid-feedback").html('');

                    jQuery('#modal_warn').on('hidden.bs.modal', function () {
                        window.location.href = response.data.url;
                    });

                }

            }
        });
    }





    var tema_id = '<?php echo $tema_id; ?>';

    list_files_temas_by_id(tema_id);

    function list_files_temas_by_id(tema_id) {
        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {action: 'list_files_temas', tema_id: tema_id},
            success: function (response) {
                console.log(response);
                var list_files = '<ul class="list-group">';
                for (i = 0; i < response.data.length; i++) {
                    var id = response.data[i].id;
                    var extension = response.data[i].name.substr((response.data[i].name.lastIndexOf('.') + 1));
                    s = '';
                    switch (extension) {
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

                    var url = "'" + response.data[i].url + "'";
                    var names = "'" + response.data[i].name + "'";


                    list_files += '<li class="list-group-item" id="file_post_edit_' + id + '">' +
                        '<div id="cont_fil_edit_' + id + '" class="list_files_post">' + '<font id="fil_blog_edit">' + s + '</font> ' +
                        '<div id="button_right">' +
                        '<button id="btn_file_rem" class="btn btn-danger" onclick="removeFileEditTema(' + url + ', ' + names + ', ' + id + ');"> ' +
                        '<i class="fa fa-trash"></i>' +
                        '</button>' +
                        '&nbsp; <a href="' + response.data[i].url + '" class="btn btn-info">' +
                        '<i class="fa fa-link"></i>' +
                        '</a>' +
                        '<input type="hidden" name="files_posts_edit[]" id="image_file_edit_' + id + '" value="' + id + '">' +
                        '' +
                        '</div>' +
                        '</div>' +
                        '</li>';
                }
                list_files += '</ul>';
                jQuery("#list_files_id_tema").append(list_files);
            }
        });
    }

    function removeFileEditTema(url, names, i)
    {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {path: url, action: 'delete_tema_files', id: i},
            success: function(response){
                //console.log(response);

                var id = response.data.id_file;

                jQuery("#modal_warn_title").css('color','#5cb85c');
                jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao remover o ficheiro numero '+id);
                jQuery('.text_warn').html(response.data.mensagem);
                jQuery("#modal_warn").appendTo("body").modal('show');
                jQuery('#file_post_edit_'+id).remove();
            }
        });


    }

    jQuery("#files_temas_edit").change(function(e) {
        e.preventDefault();
        var list_files_add = '';

        var myfiles_edit = document.getElementById("files_temas_edit");

        var files_edit = myfiles_edit.files;
        var data = new FormData();

        for (i = 0; i < files_edit.length; i++) {
            //data.append('file' + i, files[i]);
            data.append('file_temas_edit[]', files_edit[i]);
        }

        data.append('action', 'file_temas_upload_edit');

        jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {

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
                        list_files_add += '<li class="list-group-item" id="file_post_edit_form_'+id+'">' +
                            '<div id="cont_fil_edit_form_'+id+'" class="list_files_post">' + '<font id="fil_blog_edit_form">' + s +'</font> ' +
                            '<div id="button_right">' +
                            '<button id="btn_file_rem" class="btn btn-danger" onclick="removeFileEdit('+url+', '+names+', '+id+');"> ' +
                            '<i class="fa fa-trash"></i>' +
                            '</button>' +
                            '&nbsp; <a href="'+response.data[i].file_url+'" class="btn btn-info">' +
                            '<i class="fa fa-link"></i>' +
                            '</a>' +
                            '<input type="hidden" name="files_posts_edit_form[]" id="image_file_edit_form_'+id+'" value="'+id+'">' +
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
                jQuery("#content_fil_temas_load").append(list_files_add);


            }
        });
    });
	
	function removeFileEdit(url, names, i)
    {
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {path: url, action: 'remove_file_edit_up', id: i},
            success: function (response) {
                //console.log(response);

                var id = response.data.id_file;

                jQuery("#modal_warn_title").css('color', '#5cb85c');
                jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao remover o ficheiro numero ' + id);
                jQuery('.text_warn').html(response.data.mensagem);
                jQuery("#modal_warn").appendTo("body").modal('show');
                jQuery('#file_post_edit_form_' + id).remove();
            }
        });
    }
</script>
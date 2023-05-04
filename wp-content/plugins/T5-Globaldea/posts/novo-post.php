<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<style>
    .update-nag.notice.notice-warning.inline, .sendwp-notice, .jpum-notice {
        display: none;
    }

    .list-group-item
    {
        margin-bottom: 20px;
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
    .uploadFile {
        visibility : hidden;
    }
    #post_card
    {
        min-width: 100%;
        padding: 0;
    }
    #body_post
    {
        padding: 20px;
    }
    .is-invalid{
        border-color: #dc3545!important;
        padding-right: calc(1.5em + .75rem)!important;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .invalid-feedback
    {
        color: #dc3545!important;
    }

    .topper
    {
        margin-top: 20px;
    }

    #button_actions_posts
    {
        text-align: center;
    }
	@media only screen and (max-width: 600px)
	{
		#files_posts
		{
			width: 80%;
		}
	}
	
	.modal {
		z-index: 1000000!important;
	}
</style>

<?php
$user_meta=get_userdata(get_current_user_id());

$user_roles=$user_meta->roles;

include plugin_dir_path( __DIR__).'modals.php';
?>


<div class="container-fluid">
    <div class="row">
        <h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp; Criar Novo Artigo</h2>


    </div>
</div>

<div class="container-fluid" id="novo_post_form">
          <div class="card" id="post_card">
              <div class="card-header">
                  <h5 class="card-title"><i class="fa fa-file-text" aria-hidden="true"></i>
                      &nbsp; Titulo do Artigo</h5>
              </div>
              <div class="card-body" id="body_post">
                   <input type="text" class="form-control" placeholder="Insere o Titulo do Artigo" id="title_post" name="title_post">
                  <div class="invalid-feedback order-last ">
                  </div>
              </div>
          </div>
</div>

<div class="container-fluid">
    <div class="card" id="post_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>
                &nbsp; Conteudo</h5>
        </div>
        <div class="card-body" id="body_post">
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
                wp_editor( $content, 'article_content', $settings );
            ?>
        </div>
    </div>

</div>


<div class="container-fluid">
    <div class="card" id="post_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-bookmark" aria-hidden="true"></i>
                &nbsp; Categorias</h5>
        </div>
        <div class="card-body" id="body_post">
            <?php
            $args = array(
                'child_of' => 0,
                'current_category' => 0,
                'depth' => 0,
                'echo' => 1,
                'exclude' => '',
                'exclude_tree' => '',
                'feed' => '',
                'feed_image' => '',
                'feed_type' => '',
                'hide_empty' => 0,
                'hide_title_if_empty' => false,
                'hierarchical' => true,
                'order' => 'ASC',
                'orderby' => 'name',
                'separator' => '<br />',
                'show_count' => 0,
                'show_option_all' => '',
                'show_option_none' => __('No categories'),
                'style' => 'list',
                'taxonomy' => 'category',
                'title_li' => __('Categories'),
                'use_desc_for_title' => 1,
            );

            $categories = get_categories($args);
            $wp_cats = array();


            foreach($categories as $category)
            {     echo "<input type='checkbox' name='categorias[]' value='$category->term_id' /> ";    echo $category->cat_name;
                  echo "<br>";
            }

            ?>
        </div>
    </div>

</div>


<div class="container-fluid">
    <div class="card" id="post_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-tags" aria-hidden="true"></i>
                &nbsp; Keywords</h5>
        </div>
        <div class="card-body" id="body_post">
            <?php $tags = get_tags(array(
				  'taxonomy' => 'post_tag',
				  'orderby' => 'name',
				  'hide_empty' => false // for development
				)); ?>
            <div class="tags">
                <?php
                foreach ( $tags as $tag ) {
                    echo "<input type='checkbox' name='tags[]' value='$tag->term_id' /> ";
                    echo $tag->name;
                    echo "<br>";
                }
                ?>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="card" id="post_card">
        <div class="card-header">
            <h5 class="card-title"><i class="fa fa-files-o" aria-hidden="true"></i>
                &nbsp; Ficheiros</h5>
        </div>
        <div class="card-body" id="body_post">
            <div id="file_cont">
                <div id="content_fil_posts_load">

                </div>


            </div>
        </div>

        <div class="card-body">
                <hr/>
                <input id="files_posts" name="file" type="file" class="btn-primary btn col-xs-12" multiple="multiple" style="margin: 0 auto;
    display: block;">
                <input id="files_posts_content" type="hidden" />
                <input id="list_f_posts" type="hidden" />
            <br>
        </div>

    </div>
</div>







    <!--<input type="file" name="my_file_upload[]" multiple="multiple" class = "files-data form-control" id="file_upload_post">-->

<div class="topper"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="button_actions_posts">

            </div>
        </div>
    </div>

</div>

<script>
    var draft = 'draft';
    var pending = 'pending';
    var trash = 'trash';
    var publish = 'publish';

    jQuery("#button_actions_posts").html('<button type="button" class="btn btn-primary" id="rascundo_post" name="Rascunho" value="Rascunho" onclick="submit_post('+draft+');">Salvar como Rascunho</button>\n' +
        '    <button type="button" class="btn btn-info" id="aprovado_post" name="Aprovacao" value="Aprovacao" onclick="submit_post('+pending+');">Enviar para Aprovação</button>\n' +
        '    <button type="button" class="btn btn-danger" id="reprovado_post" name="Descartar" value="Descartar" onclick="submit_post('+trash+');">Descartar</button>');
</script>

<?php

if (in_array("administrator", $user_roles))
{
    ?>
    <script>
        jQuery("#button_actions_posts").append(' <button type="button" class="btn btn-success" id="publicado_post" name="Publicado" value="Publicado" onclick="submit_post('+publish+');">Publicar o Artigo</button>');
    </script>
<?php }  ?>


<script>

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

    function submit_post(status)
    {
        var cats = [];
        var tags = [];
        var files = [];
        jQuery("input[name='categorias[]']:checked").each(function () {
            cats.push(jQuery(this).val());
        });
        jQuery("input[name='tags[]']:checked").each(function () {
            tags.push(jQuery(this).val());
        });

        files = jQuery('input[name="files_posts[]"]').map(function () {
            return this.value; // $(this).val()
        }).get();

        var title = jQuery("#title_post").val();

        jQuery.ajax({
            type        : 'POST',
            url         : '<?php echo admin_url('admin-ajax.php'); ?>',
            data        : { action : 'add_post', content: get_tinymce_content('article_content'), categorias: cats, tags: tags, files: files, title_post: title, status: status },
            success     : function(response) {
                if (response.data.error === 0)
                {
                    jQuery("#modal_warn_title").css('color','#5cb85c');
                    jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao criar o post numero '+response.data.id);
                    jQuery('.text_warn').html(response.data.mensagem);
					
					jQuery('#modal_warn').appendTo("body").modal('show');

                    jQuery("#title_post").removeClass('is-invalid');
                    jQuery(".invalid-feedback").html('');


                    setTimeout(function(){ window.location.href = response.data.url; }, 5000);



                }
                else
                {
                    jQuery("#modal_warn_title").css('color','#d9534f');
                    jQuery("#modal_warn_title").html('<i class="fa fa-times-circle"></i>Erro ao Submeter o Post número '+response.data.id);
                    jQuery('.text_warn').html(response.data.mensagem);
                    jQuery('#modal_warn').appendTo("body").modal('show');

                    jQuery("#title_post").addClass('is-invalid');
                    jQuery(".invalid-feedback").html(response.data.mensagem);

                    jQuery('html, body').animate({
                        scrollTop: jQuery("#novo_post_form").offset().top
                    }, 2000);




                }
            }
        });
    }





    jQuery("#files_posts").change(function(e) {
		
        e.preventDefault();

        var myfiles = document.getElementById("files_posts");

        var files = myfiles.files;
        var data = new FormData();

        for (i = 0; i < files.length; i++) {
            //data.append('file' + i, files[i]);
            data.append('file[]', files[i]);
        }

        data.append('action', 'file_upload');
        var list_files = '<ul class="list-group">';

        jQuery.ajax({
            type        : 'POST',
            url         : '<?php echo admin_url('admin-ajax.php'); ?>',
            processData: false,
            contentType: false,
            data        : data,
            success     : function(response) {

                console.log(response, response.data.length, response.data);

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
                        list_files += '<li class="list-group-item" id="file_post_'+id+'">' +
                            '<div id="cont_fil_'+id+'" class="list_files_post">' + '<font id="fil_blog">' + s +'</font> ' +
                            '<div id="button_right">' +
                            '<button id="btn_file_rem" class="btn btn-danger" onclick="removeFile('+url+', '+names+', '+id+');"> ' +
                            '<i class="fa fa-trash"></i>' +
                            '</button>' +
                            '&nbsp; <a href="'+response.data[i].file_url+'" class="btn btn-info">' +
                            '<i class="fa fa-link"></i>' +
                            '</a>' +
                            '<input type="hidden" name="files_posts[]" id="image_file_'+id+'" value="'+id+'">' +
                            ''+
                            '</div>' +
                            '</div>' +
                            '</li>';

                        jQuery("#modal_warn_title").css('color','#5cb85c');
                        jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao fazer o upload do ficheiro numero '+id);
                        jQuery('.text_warn').html(response.data[0].mensagem);
                        jQuery('#modal_warn').appendTo("body").modal('show');
                    }
                    else
                    {
                        jQuery("#modal_warn_title").css('color','#d9534f');
                        jQuery("#modal_warn_title").html('<i class="fa fa-times-circle"></i>Erro ao Submeter o Ficheiro');
                        jQuery('.text_warn').html(response.data[0].mensagem);
                        jQuery('#modal_warn').appendTo("body").modal('show');
                    }

                }

                list_files += '</ul>';


                jQuery("#content_fil_posts_load").append(list_files);



            }
        });



    });


    function removeFile(url, names, i)
    {
        var conf_blog = jQuery("#cont_fil_"+i+" > #fil_blog > span").html();
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {path: url, action: 'remove_file_post', id: i},
            success: function(response){
                //console.log(response);

                var id = response.data.id_file;

                jQuery("#modal_warn_title").css('color','#5cb85c');
                jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao remover o ficheiro numero '+id);
                jQuery('.text_warn').html(response.data.mensagem);
                jQuery('#modal_warn').appendTo("body").modal('show');
                jQuery('#file_post_'+id).remove();
            }
        });



    }











</script>



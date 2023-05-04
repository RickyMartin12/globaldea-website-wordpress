<?php

include 'modals.php';

// Todos os Posts
$args_all_posts = array(
    'post_type' => 'post',

);

$query_all_posts = new WP_Query($args_all_posts);


// Posts Publicados
$args_all_posts_published = array(
    'post_type' => 'post',
    'post_status' => 'publish'

);




$query_posts_published = new WP_Query($args_all_posts_published);

// Posts Reprovados
$args_all_posts_draft = array(
    'post_type' => 'post',
    'post_status' => 'draft'

);

$query_posts_draft = new WP_Query($args_all_posts_draft);


// Posts Aguardados pela Aprovação
$args_all_posts_pending = array(
    'post_type' => 'post',
    'post_status' => 'pending'

);

$query_posts_pending = new WP_Query($args_all_posts_pending);


?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<style>
    .update-nag.notice.notice-warning.inline, .sendwp-notice, .jpum-notice {
        display: none;
    }
    </style>
<div class="container-fluid">

    <?php global $current_user;
    wp_get_current_user();
    ?>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bem vindo <b><?php echo $current_user->user_login; ?></b></h1>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Artigos Submetidos</div>
                            <a href="<?php echo admin_url( 'edit.php?post_type=post' ) ; ?>">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $query_all_posts->found_posts; ?></div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-files-o fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Artigos Aprovados</div>
                                <a href="<?php echo admin_url( 'edit.php?post_status=publish&post_type=post' ) ; ?>">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $query_posts_published->found_posts; ?></div>
                                </a>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Artigos Reprovados
                            </div>
                            <a href="<?php echo admin_url( 'edit.php?post_status=draft&post_type=post' ) ; ?>">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $query_posts_draft->found_posts; ?></div>
                            </a>

                        </div>
                        <div class="col-auto">
                            <i class="fa fa-remove fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Artigos Aguardando pela Aprovação</div>
                            <a href="<?php echo admin_url( 'edit.php?post_status=pending&post_type=post' ) ; ?>">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $query_posts_pending->found_posts; ?></div>
                            </a>

                        </div>
                        <div class="col-auto">
                            <i class="fa fa-arrow-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 col-md-12">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">Fala com o Suporte</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <form id="info_contact">
                                    <div class="row">
                                        <div class="container">
                                            <div class="row ">
                                                <div class="col-lg-12 mx-auto">
                                                    <div class="card mt-2 mx-auto p-4 bg-light col-md-12">
                                                        <div class="card-body bg-light">
                                                            <div class="container">
                                                                <form id="contact-form" role="form">
                                                                    <div class="controls">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group"> <label for="form_name">Primeiro Nome *</label> <input id="nome" type="text" name="nome" class="form-control" placeholder="Insira o seu Primeiro Nome *" required="required" data-error="Insira o seu primeiro nome"> </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group"> <label for="form_lastname">Ultimo Nome *</label> <input id="ultimo_nome" type="text" name="ultimo_nome" class="form-control" placeholder="Insira o seu Último Nome *" required="required" data-error="Insira o seu último nome"> </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group"> <label for="form_email">Email *</label> <input id="email" type="email" name="email" class="form-control" placeholder="Insira o seu email *" required="required" data-error="O Email tem que ser válido."> </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="form_lastname">Assunto *</label> <input id="assunto" type="text" name="assunto" class="form-control" placeholder="Insira o Assunto *" required="required" data-error="O Assunto é obrigatório"> </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group"> <label for="form_message">Mensagem *</label> <textarea id="mensagem" name="mensagem" class="form-control" placeholder="Escreve o seu conteudo da mensagem" rows="4" required="required" data-error="Insira a sua mensagem"></textarea> </div>
                                                                            </div>
                                                                            <div class="col-md-12"> <button type="submit" id="form_button_id" class="btn btn-success btn-send pt-2 btn-block " name="form_button_id"><i class="fa fa-envelope-o"></i> Enviar</button> </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> <!-- /.8 -->
                                                </div> <!-- /.row-->
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	
	
</div>


<?php

$p = plugins_url()."/".explode("/", plugin_basename( __file__ ))[0];

$var = $p . '/info/resp.php';


?>

<script>


        var test = "<?php echo $var; ?>";

        jQuery("#form_button_id").on('submit', function(e){
            e.preventDefault();
            dataValue = "nome="+jQuery("#nome").val()+"&ultimo_nome="+jQuery("#ultimo_nome").val()+"&email="+jQuery("#email").val()+"&assunto="+jQuery("#assunto").val()+"&mensagem="+jQuery("#mensagem").val();
            console.log(dataValue);
            jQuery.ajax({ url:test,
                data:dataValue,
                type:'POST',
                cache: false,
                success:function(data){
                console.log(data);
                    if(data == 0)
                    {
                        jQuery("#modal_warn_title").css('color','#5cb85c');
                        jQuery("#modal_warn_title").html('<i class="fa fa-check"></i> Sucesso ao contactar ao Suporte Técnico');
                        jQuery('.text_warn').html("A Mensagem enviada para o suporte ténico foi enviada com sucesso");
                        jQuery("#nome").val('');
                        jQuery("#ultimo_nome").val('');
                        jQuery("#email").val('');
                        jQuery("#assunto").val('');
                        jQuery("#mensagem").val('');
                        jQuery("#modal_warn").appendTo("body").modal('show');
                        setTimeout(function(){
                            jQuery('#modal_warn').modal('hide');},8000);
                    }
                    else
                    {
                        jQuery("#modal_warn_title").css('color','#d9534f');
                        jQuery("#modal_warn_title").html('<i class="fa fa-times-circle"></i> Suporte não enviado');
                        jQuery('.text_warn').html("Existe problema de envio de Ajuda ao Suporte Téncico. Por favor envia um email para suporte_tecnico@globaldea.com ");
                        jQuery("#modal_warn").appendTo("body").modal('show');
                        setTimeout(function(){
                            jQuery('#modal_warn').modal('hide');},8000);
                    }

                },
                error:function(error){
                    console.log(error);
                    jQuery('.text_warn').html("Erro ao enviar a mensagem ao Suporte Técnico. Verifique a ligação Wi-Fi e tente novamente.");
                    jQuery("#modal_warn_title").css('color','#d9534f');
                    jQuery("#modal_warn_title").html('<i class="fa fa-times-circle"></i> Erro do Envio ao Suporte');
                    jQuery('#modal_warn').modal();
                }
            });


        });
		
    </script>


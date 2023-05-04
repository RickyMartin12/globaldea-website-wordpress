<?php
require_once( '../../../../wp-load.php' );

//user posted variables
    $nome = $_POST['nome'];
    $ultimo_nome = $_POST['ultimo_nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];



//php mailer variables
    $to = 'suporte_tecnico@globaldea.com';
    $subject = $_POST['assunto'];
    $headers = 'From: '. $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n";

$body_client = "<div style='width:95%; margin-left:2.5%;'>
                 <h4>Pedido de Informações ".$nome."</h4>
                 <hr><b>Nome: </b> $nome $ultimo_nome<br /><br />
                 <b>Email: </b> $email<br /><br/>
                 <b>Mensagem: </b> $mensagem<br />
                 <hr>
                 <br>Obrigado $nome, Globaldea
                 </div>";
//Here put your Validation and send mail
    $sent = wp_mail($to, $subject, strip_tags($body_client), $headers);
    if($sent) {
        echo 0;
    }//mail sent!
    else  {
        echo 1;
    }//message wasn't sent
?>

<?php
require_once '../../../start.php' ;
$pdo = $bd->conectar();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
            
require '../../../vendor/autoload.php';

if(!empty($_POST) && ($_SERVER['REQUEST_METHOD']) == 'POST'){

    if(isset($_POST['email']) && !empty($_POST['email'])){

        $email = htmlspecialchars($_POST['email'], ENT_QUOTES);

        $sql = "SELECT * FROM usuarios WHERE email = :EMAIL";
        $smtp = $pdo->prepare($sql);
        $smtp->execute(array(':EMAIL' => $email));

        if($smtp->rowCount() > 0){
            $usuario = $smtp->fetch();

            $nome = $usuario['nome'];
            $id_usuario = $usuario['id'];
            
            $token = bin2hex(random_bytes(16));
            $resetLink = "https://ikdmeupet.com.br/redefinir_senha.php?token=$token";
            
            $mail = new PHPMailer(true);
            $mail->setFrom('l2code@ikdmeupet.com.br','Kdmeupet');
            $mail->addAddress("$email","$nome");
            $mail->Subject = "Redefinir senha";
            $mail->Body = 'Para redefinir sua senha, clique no seguinte link: ' . $resetLink;

            if(!$mail->send()){
                $dados = array(
                    'success' => false
                );
            }else{
                $data = date("Y-m-d H:i:s");
                $sql = "INSERT INTO redefinir_senha (id, id_usuario, email, token, data) VALUES (NULL, ?, ?, ?, ?)";
                $smtp = $pdo->prepare($sql);
                
                $smtp->execute(array("$id_usuario", "$email", "$token", "$data"));

                $dados = array(
                    'success' => true
                );
            }

        }else{
            $dados = array(
                'success' => false
            );
        }
    }else{
        $dados = array(
            'success' => false
        );
    }

}else{
    $dados = array(
        'success' => false
    );
}

echo json_encode($dados);

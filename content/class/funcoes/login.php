<?php
require_once '../../../start.php' ;
$pdo = $bd->conectar();

if (isset($_POST)) {

    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);

    $senha = htmlspecialchars($_POST['senha'], ENT_QUOTES);

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $smtp = $pdo->prepare($sql);

    if($smtp->execute(array("$email"))){
        $usuario = $smtp->fetch();
        $hash = $usuario['senha'];
        if(password_verify($senha, $hash)){
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['identificador']   = $usuario['id'];
            header("Location: ../../../".$_SESSION['pagina_anterior']."");
        }
    }else{
        // header("Location: ../../../cadastro.php");
    }

}

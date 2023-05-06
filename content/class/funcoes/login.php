<?php
require_once '../../../start.php' ;
$pdo = $bd->conectar();

if (isset($_POST)) {

    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);

    $senha = htmlspecialchars($_POST['senha'], ENT_QUOTES);

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $smtp = $pdo->prepare($sql);
    $smtp->execute(array("$email"));

    if($smtp->rowCount() > 0){
       
        $usuario = $smtp->fetch();
        $hash = $usuario['senha'];
        if(password_verify($senha, $hash)){
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['identificador']   = $usuario['id'];
            header("Location: ../../../".$_SESSION['pagina_anterior']."");
        }else{
            $_SESSION['MSG_TENTATIVA_LOGIN'] = "e-mail ou senha errados!";
            $_SESSION['MSG_TENTATIVA_LOGIN_2'] = "Por favor tente novamente.";
            echo "<script>window.location.href='" . PL_PATH_ADMIN . "/login.php'</script>";
        }
    }else{
        
        $_SESSION['MSG_TENTATIVA_LOGIN'] = "e-mail não encontrado!";
        $_SESSION['MSG_TENTATIVA_LOGIN_2'] = "Por favor faça um cadastro.";
        echo "<script>window.location.href='" . PL_PATH_ADMIN . "/login.php'</script>";
    }

}

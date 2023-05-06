<?php
require_once '../../../start.php' ;
$pdo = $bd->conectar();

if (isset($_POST)) {

    $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    if(isset($_POST['telefone']) && !empty($_POST['telefone'])){
        $telefone = htmlspecialchars($_POST['telefone'], ENT_QUOTES);
    }else{
        $telefone = '';
    }
    
    $senha = password_hash(htmlspecialchars($_POST['senha'], ENT_QUOTES), PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (id, nome, email, telefone, senha, status, excluido) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
    $smtp = $pdo->prepare($sql);

    if($smtp->execute(array("$nome", "$email", "$telefone", "$senha", 1, 0))){
        // session_start();
        $_SESSION['nome'] = $nome;
        header("Location: ../../../index.php");
    }else{
        header("Location: ../../../cadastro.php");
    }

}

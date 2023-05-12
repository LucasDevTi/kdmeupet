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

    $ip = $_SERVER['REMOTE_ADDR'];
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
    $cidade = $geo['geoplugin_city'];
    $uf     = $geo['geoplugin_regionCode'];

    if(isset($cidade) && !empty($cidade)){
        $cidade = strtolower($cidade);
    }else{
        $cidade = "";

    }

    if(isset($uf) && !empty($uf)){
        $uf = strtolower($uf);
    }else{
        $uf = "";

    }

    $sql = "INSERT INTO usuarios (id, nome, email, telefone, senha, cidade, uf, ip, status, excluido) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $smtp = $pdo->prepare($sql);

    if($smtp->execute(array("$nome", "$email", "$telefone", "$senha", "$cidade", "$uf", "$ip", 1, 0))){
        // session_start();
        $_SESSION['nome'] = $nome;
        $_SESSION['identificador'] = $pdo->lastInsertId();
        header("Location: ../../../index.php");
    }else{
        header("Location: ../../../cadastro.php");
    }

}

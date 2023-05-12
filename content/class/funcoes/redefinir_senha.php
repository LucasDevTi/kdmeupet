<?php
require_once '../../../start.php';
$pdo = $bd->conectar();

if (isset($_POST)) {

    $token = htmlspecialchars($_POST['token'], ENT_QUOTES);

    $sql = "SELECT * FROM redefinir_senha WHERE token = ?";
    $smtp = $pdo->prepare($sql);
    $smtp->execute(array("$token"));

    if ($smtp->rowCount() > 0) {
        $id_usuario = $smtp->fetch()['id_usuario'];

        $senha = password_hash(htmlspecialchars($_POST['senha'], ENT_QUOTES), PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET senha = :SENHA WHERE id = :ID_USUARIO";
        $smtp = $pdo->prepare($sql);

        $smtp->bindValue(':SENHA', $senha, PDO::PARAM_STR);
        $smtp->bindValue(':ID_USUARIO', $id_usuario, PDO::PARAM_INT);

        if ($smtp->execute()) {
            // $_SESSION['nome'] = $nome;
            // $_SESSION['identificador'] = $pdo->lastInsertId();
            header("Location: ../../../login.php");
        } else {
            header("Location: ../../../redefinir_senha.php");
        }
    }
}

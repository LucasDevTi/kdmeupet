<?php
require_once '../../../start.php';
$pdo = $bd->conectar();

if (isset($_POST)) {

    $nome_arquivo = $_FILES['foto']['name'];

    // Caminho temporário do arquivo enviado
    $caminho_temporario = $_FILES['foto']['tmp_name'];

    // Verifica se o arquivo é uma imagem
    $tipo_arquivo = $_FILES['foto']['type'];
    if ($tipo_arquivo == 'image/jpeg' || $tipo_arquivo == 'image/png') {

        // Abre a imagem original
        if ($tipo_arquivo == 'image/jpeg') {
            $imagem = imagecreatefromjpeg($caminho_temporario);
        } else {
            $imagem = imagecreatefrompng($caminho_temporario);
        }

        // Define o tamanho da nova imagem
        $largura_nova = 150;
        $altura_nova = 150;

        // Obtém as dimensões da imagem original
        $largura_original = imagesx($imagem);
        $altura_original = imagesy($imagem);

        // Calcula as proporções da nova imagem
        $proporcao = $largura_original / $altura_original;
        if ($largura_nova / $altura_nova > $proporcao) {
            $largura_nova = $altura_nova * $proporcao;
        } else {
            $altura_nova = $largura_nova / $proporcao;
        }

        // Cria a nova imagem redimensionada
        $imagem_nova = imagecreatetruecolor($largura_nova, $altura_nova);
        imagecopyresampled($imagem_nova, $imagem, 0, 0, 0, 0, $largura_nova, $altura_nova, $largura_original, $altura_original);

        // Salva a nova imagem
        $nome_novo_arquivo = 'foto_150x150_' . time() . '_' . $nome_arquivo;
        $caminho_novo_arquivo = '../../../uploads/' . $nome_novo_arquivo;
        if ($tipo_arquivo == 'image/jpeg') {
            imagejpeg($imagem_nova, $caminho_novo_arquivo, 100);
        } else {
            imagepng($imagem_nova, $caminho_novo_arquivo, 0);
        }

        // Salva a imagem original
        $nome_original_arquivo = 'foto_original_' . time() . '_' . $nome_arquivo;
        $caminho_original_arquivo = '../../../uploads/' . $nome_original_arquivo;
        move_uploaded_file($caminho_temporario, $caminho_original_arquivo);

        $ip = $_SERVER['REMOTE_ADDR'];
        $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
        $cidade = $geo['geoplugin_city'];
        $uf     = $geo['geoplugin_regionCode'];

        if (isset($cidade) && !empty($cidade)) {
            $cidade = strtolower($cidade);
        } else {
            $cidade = "";
        }

        if (isset($uf) && !empty($uf)) {
            $uf = strtolower($uf);
        } else {
            $uf = "";
        }

        $sql = "INSERT INTO perdidos (id, nome_pet, descricao, foto, foto_original, recompensa, valor, id_usuario, hash, tipo_animal, cidade, uf, status, excluido) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $smtp = $pdo->prepare($sql);

        $hash = rand() . uniqid();

        $nome_pet = htmlspecialchars($_POST['nome'], ENT_QUOTES);

        $descricao = htmlspecialchars($_POST['descricao'], ENT_QUOTES);

        $recompensa = htmlspecialchars($_POST['opcao'], ENT_QUOTES);

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES);
        $valor = (empty($valor)) ? 0 : $valor;

        $caminho_novo_arquivo = str_replace("../", "", $caminho_novo_arquivo);

        $caminho_original_arquivo = str_replace("../", "", $caminho_original_arquivo);

        $tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES);


        if ($smtp->execute(array("$nome_pet", "$descricao", "$caminho_novo_arquivo", "$caminho_original_arquivo", "$recompensa", "$valor", $_SESSION['identificador'], "$hash", $tipo, 1, 0))) {

            header('Location: ../../../index.php');
        } else {
        }
    } else {
        // Arquivo enviado não é uma imagem
        echo "Arquivo enviado não é uma imagem";
    }
}

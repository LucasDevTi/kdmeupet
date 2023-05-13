<?php
require_once __DIR__ . '/app/init.php';
require_once __DIR__ . '/app/end.php';
require_once __DIR__ . '/app/menu.php';

use App\End;
use App\Head;
use App\Menu;

$Init = new Head();
$End = new End();
$Menu = new Menu();

echo $Init->cabecalho();
if (!isset($_SESSION['nome'])) {
    header('Location: login.php');
    $_SESSION['pagina_anterior'] = 'animal_perdido.php';
}
$pdo = $bd->conectar();
$_GET['get'] = array_keys($_GET);
$hash = $_GET['get'][0];

$sql = "SELECT * FROM perdidos WHERE hash = ?";
$smtp = $pdo->prepare($sql);

if ($smtp->execute(array("$hash"))) {
    $perdido = $smtp->fetch();
    $foto = $perdido['foto_original'];

    $id_dono = $perdido['id_usuario'];
    $sql = "SELECT telefone FROM usuarios WHERE id = ?";
    $smtp = $pdo->prepare($sql);

    if ($smtp->execute(array("$id_dono"))) {
        $user = $smtp->fetch();
    }
} else {
    $foto = "";
}

$num_wpp = preg_replace('/[^0-9]/', '', $user['telefone']);

$user_agent = $_SERVER['HTTP_USER_AGENT'];

$is_mobile = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $user_agent);

if ($is_mobile) {
    $urlWpp = 'https://api.whatsapp.com/send?phone=55' . $num_wpp . '&text= Olá, acho que vi seu pet.  ';
} else {
    $urlWpp = 'https://web.whatsapp.com/send?phone=55' . $num_wpp . '&text= Olá, acho que vi seu pet.';
}

?>

<body>
    <?php echo $Menu->nav(); ?>
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $foto ?>" class="img-fluid rounded">
                <div class="redes_kdmeupet">
                    <a href="https://www.instagram.com/ikdmeupet/" target="_blank"><i class="fa fa-instagram insta_kdmeupet icons_meupet"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100092463728182" target="_blank"><i class="fa fa-facebook face_kdmeupet icons_meupet"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <h2>Sobre o pet</h2>
                <p><?php echo $perdido['descricao']; ?></p>
                <a href="<?php echo $urlWpp ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i> Achou? Entre em contato</a>
            </div>
        </div>
    </section>

</body>
<style>
    .img-animal {
        max-width: 600px;
        max-height: 600px;
    }
</style>
<?php
echo $End->final();
?>
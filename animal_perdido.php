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

if($smtp->execute(array("$hash"))){
    $perdido = $smtp->fetch();
    $foto = $perdido['foto_original'];
}else{
    $foto = "";
}

?>

<body>
    <?php echo $Menu->nav(); ?>
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $foto ?>" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2>Sobre o pet</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet risus sed magna sagittis sodales. Vivamus volutpat leo nec nibh eleifend, in ultrices justo tristique. Maecenas malesuada fringilla tellus at efficitur. Fusce rutrum tempor nunc sed hendrerit. Integer tristique libero eget arcu pellentesque, eu sagittis metus maximus. Suspendisse potenti. Nam quis magna eu nulla suscipit tempus.</p>
                <a href="https://api.whatsapp.com/send?phone=SEU_NUMERO" class="btn btn-success"><i class="fab fa-whatsapp"></i> Achou? Entre em contato</a>
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
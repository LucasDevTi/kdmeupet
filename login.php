<?php
require_once __DIR__ . '/app/init.php';
require_once __DIR__ . '/app/end.php';
require_once __DIR__ . '/app/menu.php';
require_once __DIR__ . '/app/footer.php';

use App\End;
use App\Head;
use App\Menu;
use App\Footer;

$Init = new Head();
$End = new End();
$Menu = new Menu();
$Footer = new Footer();

echo $Init->cabecalho();
$pdo = $bd->conectar();

$flag_alerta = false;

if (isset($_SESSION['MSG_TENTATIVA_LOGIN']) && isset($_SESSION['MSG_TENTATIVA_LOGIN_2'])) {

    $flag_alerta = true;

    $msg = $_SESSION['MSG_TENTATIVA_LOGIN'];
    $msg_2 = $_SESSION['MSG_TENTATIVA_LOGIN_2'];

    unset($_SESSION['MSG_TENTATIVA_LOGIN']);
    unset($_SESSION['MSG_TENTATIVA_LOGIN_2']);
}

?>

<body>

    <?php echo $Menu->nav(); ?>

    <section class="my-5 d-flex flex-column justify-content-center align-items-center">
        <?php if ($flag_alerta) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $msg ?></strong> <?php echo $msg_2 ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form method="POST" action="/content/class/funcoes/login.php" class="p-4 border rounded-3 d-flex justify-content-end flex-wrap" style="max-width: 400px;">
            <!-- <h2 class="text-center mb-4">Login</h2> -->
            <div class="mb-3 flex-fill">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
            </div>
            <div class="mb-3 flex-fill">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary me-3">Entrar</button>
                <a href="cadastro.php" class="btn btn-outline-secondary">Cadastre-se</a>
            </div>
        </form>
    </section>

    <?php echo $Footer->rodape(); ?>
    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);
    </script>



</body>
<?php
echo $End->final();
?>
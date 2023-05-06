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
$pdo = $bd->conectar();
?>

<body>

    <?php echo $Menu->nav(); ?>
    
    <section class="my-5 d-flex justify-content-center align-items-center">
        <form method="POST" action="/content/class/funcoes/login.php" class="p-4 border rounded-3 d-flex justify-content-end flex-wrap" style="max-width: 400px;">
            <!-- <h2 class="text-center mb-4">Login</h2> -->
            <div class="mb-3 flex-fill">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu email">
            </div>
            <div class="mb-3 flex-fill">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary me-3">Entrar</button>
                <a href="cadastro.php" class="btn btn-outline-secondary">Cadastre-se</a>
            </div>
        </form>
    </section>

</body>
<?php
echo $End->final();
?>
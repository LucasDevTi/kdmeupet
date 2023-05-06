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
        <form method="POST" action="/content/class/funcoes/cadastro.php" class="p-4 border rounded-3 d-flex justify-content-between flex-column" style="max-width: 400px;">
            <h2 class="text-center mb-4">Cadastro</h2>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome*</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" class="form-control phone-mask" id="telefone" name="telefone" placeholder="Seu telefone">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha*</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
            </div>
            <div class="mt-auto d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.phone-mask').inputmask('(99) 99999-9999');
        });
    </script>

</body>
<?php
echo $End->final();
?>
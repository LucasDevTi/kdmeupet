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
if (!isset($_SESSION['nome'])) {
    echo "<script>window.location.href='" . PL_PATH_ADMIN . "/login.php'</script>";
    $_SESSION['pagina_anterior'] = 'perdi.php';
}
$pdo = $bd->conectar();
?>
<style>
    .footer {
        position: static !important;
    }
</style>

<body>
    <?php echo $Menu->nav(); ?>
    <section class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h2 class="text-center mb-4">Cadastro de pet perdido</h2>
                <form method="POST" action="content/class/funcoes/perdi.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Pet:</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo da espécie:</label>
                        <select id="tipo" name="tipo" class="form-select">
                            <option value="1">Gato</option>
                            <option value="2">Cachorro</option>
                            <option value="3">Passáro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <textarea id="descricao" name="descricao" class="form-control"></textarea>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="descricao" class="form-label">Tags: <small>*escreva as tags separadas por virgulas: </small></label>
                        <textarea id="descricao" name="descricao" class="form-control"></textarea>
                    </div> -->
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto do Pet:</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="opcao" class="form-label">Recompensa:</label>
                        <select id="opcao" name="opcao" class="form-select">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                        <input type="text" id="valor" name="valor" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </section>
    <?php echo $Footer->rodape(); ?>

    <script>
        $(document).ready(function() {
            $('#opcao').change(function() {
                if ($(this).val() == '1') {
                    $('#valor').show();
                } else {
                    $('#valor').hide();
                }
            });
        });
    </script>
</body>
<?php
echo $End->final();
?>
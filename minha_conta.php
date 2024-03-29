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
    header('Location: login.php');
    $_SESSION['pagina_anterior'] = 'minha_conta.php';
}
$pdo = $bd->conectar();

$sql = "SELECT * FROM usuarios WHERE id = ?";
$smtp = $pdo->prepare($sql);

if ($smtp->execute(array($_SESSION['identificador']))) {
    $usuario = $smtp->fetch();
}
?>
<style>
    .footer {
        position: fixed;
    }
</style>

<body>
    <?php echo $Menu->nav(); ?>
    <section class="container mt-5">
        <div class="row">

            <div class="col-md-8">
                <h3>Informações pessoais</h3>
                <form method="POST" action="/content/class/funcoes/edita_cadastro.php">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome" value="<?php echo (isset($usuario['nome'])) ? $usuario['nome'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" id="telefone" name="telefone" class="form-control" value="<?php echo (isset($usuario['telefone'])) ? $usuario['telefone'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo (isset($usuario['email'])) ? $usuario['email'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <textarea id="endereco" name="endereco" class="form-control">Rua exemplo, 123 - Bairro exemplo, Cidade - Estado</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </form>
            </div>
        </div>
    </section>
    <?php echo $Footer->rodape(); ?>

</body>
<?php
echo $End->final();
?>
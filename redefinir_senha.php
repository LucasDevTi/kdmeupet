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
$token = $_GET['token'];
?>

<style>
    .footer {
        position: fixed;
    }
</style>

<body>

    <?php echo $Menu->nav(); ?>

    <section class="my-5 d-flex flex-column justify-content-center align-items-center">

        <div class="alert alert-info alert-dismissible fade show" id="msg_email" style="display:none;" role="alert">
            <strong>Um e-mail foi enviado para você redefinir sua senha!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <form method="POST" id="form_redefinir_senha" action="/content/class/funcoes/redefinir_senha.php" class="p-4 border rounded-3 d-flex justify-content-end flex-wrap" style="max-width: 400px;">
            <div class="mb-3 flex-fill">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required>
                    <button class="btn btn-outline-secondary" type="button" id="mostrar-senha">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-3 flex-fill">
                <label for="confirma_senha" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" placeholder="Sua senha" required>
                <small id="info_confirma_senha" style="display:none;"></small>
            </div>
            <input type="hidden" name="token" value ='<?php echo $token ?>'>
            <div class="mb-3">
                <input type="button" class="btn btn-success me-3" style="color:white; font-weight:600;" onclick="enviarSenha()" value="Redefinir senha">
            </div>
        </form>
    </section>

    <?php echo $Footer->rodape(); ?>
    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);

        const senhaInput = document.querySelector('#senha');
        const mostrarSenha = document.querySelector('#mostrar-senha')

        mostrarSenha.addEventListener('click', function() {
            if (senhaInput.type === 'password') {
                senhaInput.type = 'text'
                mostrarSenha.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                senhaInput.type = 'password';
                mostrarSenha.innerHTML = '<i class="fa fa-eye"></i>';
            }
        })

        $(document).ready(function() {
            $('#senha').blur(function() {
                if ($('#senha').val()) {
                    $('#senha').css('box-shadow', 'none')
                } else {
                    $('#senha').css('box-shadow', '0.1em 0.1em 0.8em red');
                    $('#senha').focus();
                }

                if ($('#confirma_senha').val()) {
                    $('#confirma_senha').css('box-shadow', 'none')
                } else {
                    $('#confirma_senha').css('box-shadow', '0.1em 0.1em 0.8em red');
                    $('#confirma_senha').focus();
                }
            })
        })

        function enviarSenha() {
            const senha = $('#senha').val();
            const confirmacao = $('#confirma_senha').val();

            if ($('#senha').val()) {
                $('#senha').css('box-shadow', 'none')
            } else {
                $('#senha').css('box-shadow', '0.1em 0.1em 0.8em red');
                $('#senha').focus();
            }

            if ($('#confirma_senha').val()) {
                $('#confirma_senha').css('box-shadow', 'none')
            } else {
                $('#confirma_senha').css('box-shadow', '0.1em 0.1em 0.8em red');
                $('#confirma_senha').focus();
            }

            if (senha != confirmacao) {
                $('#info_confirma_senha').text('As senhas devem ser iguais');
                $('#info_confirma_senha').css('color', 'red');
                $('#info_confirma_senha').css('font-weight', '600');
                $('#info_confirma_senha').show();

            } else {
                document.getElementById('form_redefinir_senha').submit();
            }
        }
    </script>



</body>
<?php
echo $End->final();
?>
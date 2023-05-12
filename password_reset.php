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
<style>
    .footer {
        position: fixed;
    }
</style>

<body>

    <?php echo $Menu->nav(); ?>

    <section class="my-5 d-flex flex-column justify-content-center align-items-center">
        <div class="alert alert-info alert-dismissible fade show" id="msg_email" style="display:none;" role="alert">
            <p id="alert_email"><strong>Um e-mail foi enviado para você redefinir sua senha!</strong></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <form method="POST" action="/content/class/funcoes/login.php" class="p-4 border rounded-3 d-flex justify-content-end flex-wrap" style="max-width: 400px;">
            <!-- <h2 class="text-center mb-4">Login</h2> -->
            <div class="mb-3 flex-fill">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
            </div>
            <div class="mb-3">
                <input type="button" onclick="redefinirSenha()" id="bt_email" class="btn btn-success me-3" value="Enviar email de redefinição">
            </div>
        </form>
    </section>

    <?php echo $Footer->rodape(); ?>
    <script>
        setTimeout(function() {
            $(".alert").alert('close');
        }, 5000);

        function redefinirSenha(link) {
            var email = $('#email').val()
            console.log(email)
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/content/class/funcoes/sendEmail.php',
                async: true,
                data: {
                    email: email
                },

                success: function(response) {
                    try {
                        if (response.success) {
                            $('#alert_email').text("");
                            $('#alert_email').text("enviado");
                            $('#msg_email').show("slow");

                            document.getElementById("bt_email").disabled = true;
                        } else {
                            $('#alert_email').text("");
                            $('#alert_email').text("não enviado");
                            $('#msg_email').show("slow");
                        }

                    } catch (err) {
                        $('#alert_email').text("");
                        $('#alert_email').text("não enviado");
                        $('#msg_email').show("slow");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("erou")
                }
            });


        }
    </script>


    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

</body>
<?php
echo $End->final();
?>
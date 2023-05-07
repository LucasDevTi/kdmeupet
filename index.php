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

$stmt = $pdo->prepare("SELECT * FROM `perdidos` ORDER BY `id` DESC LIMIT 30");
$stmt->execute();
$animais = $stmt->fetchAll();
?>

<body>
    <!-- <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '2111522289033309',
                xfbml: true,
                version: 'v16.0'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script> -->

    <?php echo $Menu->nav(); ?>
    <!-- <div class="fb-like" data-share="true" data-width="450" data-show-faces="true">
    </div> -->
    <section class="container my-5">
        <?php
        $contador = 0;
        foreach ($animais as $key => $animal) {

            $contador = $contador + 1;

            // É o primeiro produto da linha? então escreve a div de linha
            if ($contador == 1) { ?>
                <div class="row justify-content-center"> <?php
                                                        } ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="<?php echo $animal['foto']; ?>" class="card-img-top" alt="Foto animal <?php echo $animal['nome_pet']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $animal['nome_pet']; ?></h5>
                            <a href="animal_perdido.php?<?php echo $animal['hash']; ?>"><input class="btn btn-success" type="button" value="Eu vi!!"></a>
                            <!-- <button class="btn btn-success">Eu vi!!</button> -->
                        </div>
                    </div>
                </div>
                <?php if ($contador == 4) { // É o ultimo produto da linha? se sim fecha a div linha. e reinicia o contador
                    $contador = 0; ?>
                </div>
            <?php } ?>

        <?php } ?>
    </section>
    <?php echo $Footer->rodape(); ?>
</body>

<?php
echo $End->final();
?>
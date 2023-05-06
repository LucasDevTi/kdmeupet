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

$stmt = $pdo->prepare("SELECT * FROM `perdidos` WHERE tipo_animal = 3 ORDER BY `id` DESC LIMIT 30");
$stmt->execute();
$animais = $stmt->fetchAll();

?>

<body>

    <?php echo $Menu->nav(); ?>

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
</body>

<?php
echo $End->final();
?>
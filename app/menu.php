<?php

namespace App;

require_once __DIR__ . '../../start.php';

class Menu
{
    public static function nav()
    {   
        if (isset($_SESSION['nome']) && !empty($_SESSION['nome'])) {
            $mensagem = "Olá ".$_SESSION['nome']."";
            $pagina = "minha_conta.php";
        }else{
            $mensagem = "Login";
            $pagina = "login.php";
        }
        // COR VERDE 04D395
        // azul  #07ABE0
        // laranja #ffae01
        return '
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #BC8958; padding:1em;">
                <a class="navbar-brand" href="index.php">
                    <img src="kdmeupetlogo.png" width="130" height="auto" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="caes.php">Cachorro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gatos.php">Gato</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="passaros.php">Pássaro</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="perdi.php">Perdi meu Pet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="'.$pagina.'">'.$mensagem.'</a>
                        </li>
                    </ul>
                </div>
            </nav>';
    }
}

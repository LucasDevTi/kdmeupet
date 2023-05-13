<?php

namespace App;

require_once __DIR__ . '../../start.php';

class Footer
{
    public static function rodape()
    {
        return '
                <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="uploads/src/L2D.png" class="card-img-top" alt="Foto animal TOm" style="border-radius:100em;width: 2.5em;" whidth="50">
                            <h4>Desenvolvido por Lucas Duarte</h4>
                            <p>L2DCode 2023</p>
                            <p>Todos os direitos reservados</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Sobre</h4>
                            <p>Texto sobre a empresa</p>
                        </div>
                        <div class="col-lg-4">
                            <h4>Redes sociais</h4>
                            <ul class="list-unstyled">
                                <li><a class="redes_sociais" href="https://www.facebook.com/profile.php?id=100092220143784"> <i class="fab fa-facebook-f icon_footer"></i> Facebook</a></li>
                                <li><a class="redes_sociais" href="https://www.instagram.com/l2.code/"><i class="fab fa-instagram icon_footer"></i> Instagram</a></li>
                                <li><a class="redes_sociais" href="https://github.com/LucasDevTi"><i class="fab fa-github icon_footer"></i> Github</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>';
    }
}

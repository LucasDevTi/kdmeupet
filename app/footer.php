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
                            <h4>Desenvolvido por L2Code</h4>
                            <p>---</p>
                            <p>---</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Sobre</h4>
                            <p>Texto sobre a empresa</p>
                        </div>
                        <div class="col-lg-4">
                            <h4>Redes sociais</h4>
                            <ul class="list-unstyled">
                                <li><a href="https://www.facebook.com/profile.php?id=100092220143784"> <i class="fab fa-facebook-f"></i> Facebook</a></li>
                                <li><a href="https://www.instagram.com/l2.code/"><i class="fab fa-instagram"></i> Instagram</a></li>
                                <li><a href="https://github.com/LucasDevTi"><i class="fab fa-github"></i> Github</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>';
    }
}

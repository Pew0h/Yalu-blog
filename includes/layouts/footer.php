<div class="footer-dark">
    <footer>
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-3 item" style="margin-left: 50px">
                    <h3>Navigation</h3>
                    <ul>

                        <li><a href="./index.php">Accueil</a></li>
                        <?php if (isset($_SESSION['user_id']))
                        {
                            echo '<li><a href="./my_account.php">Mon compte</a></li>';
                            if (Role::getUserRole($_SESSION['user_id']) == 'Administrateur')
                            {
                                echo '<li><a href="./admin/index.php">Administration</a></li>';
                            }
                            echo '<li><a href="?logout">Se déconnecter</a></li>';
                        }
                        else{

                            echo '<li><a href="./login.php">Se connecter</a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-md-6 item text">
                    <h3>Yalu Blog</h3>
                    <p> La rencontre entre 2 géants du web! L'un d'eux, Lucas, célèbre webmaster et administrateur serveur pour Cs:Go et Garry's Mod, s'est allié au jeune prodige d'Apex, Yann. Cette fusion à donné naissance à ce blog, Yalu Blog.</p>
                </div>

            </div>
            <p class="copyright">Yalu Blog © 2021 - Tous droits réservés - Mentions légales</p>
        </div>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
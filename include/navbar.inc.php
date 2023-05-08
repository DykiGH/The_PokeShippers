<header class="sticky-top p-3 text-white" style="background-color: #3F6F9C">

    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <?php
            if ($_SESSION['login']) {
            ?>
                <span class="text-white">
                    <?php
                    echo $_SESSION['Credit'];

                    ?>
                    &nbsp;</span>
                <img src="./image/ressources/PokeCoin.png" style="width:25px;height:25px;">
            <?php
            }
            ?>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="./index.php" class="nav-link px-4 text-white">Accueil</a></li>
                <li><a href="./espaceCollectionneurs.php" class="nav-link px-4 text-white">Espace Perso</a></li>
                <li><a href="./achatBoosters.php" class="nav-link px-4 text-white">Achat Boosters</a></li>
                <li><a href="./achatCredits.php" class="nav-link px-4 text-white">Achat Crédits</a></li>
                <li><a href="./echangeCarte.php" class="nav-link px-4 text-white">Echanger</a></li>
                <li><a href="./livraison.php" class="nav-link px-4 text-white">Livraison</a></li>
            </ul>

            <div class="text-end">
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == False) {
                ?>
                    <a href='./connexionUtilisateur.php' class="btn btn-warning">Se connecter</a>
                    <a href='./inscription.php' class="btn btn-outline-light me-2">S'inscrire</a>
                <?php
                } else {
                ?>
                    <a onclick="window.location.href='./deconnexion.php';" type="button" class="btn btn-warning">Déconnexion</a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    </form>
    </nav>
</header>
<?php
include("include/header.inc.php");

if (!isset($_SESSION['role']) || empty($_SESSION['role']) || $_SESSION['role'] != "Admin" && $_SESSION['role'] != "Collectionneur") {

    if ($_SESSION['role'] == "Admin") {
        header('Location: ./connexionUtilisateur.php?err=1006.5');
        die();
    }
    header('Location: ./connexionUtilisateur.php?err=1006');
    die();
}

date_default_timezone_set("Europe/Paris");
$tomorrowFormatSQL = date("Y-m-d", strtotime("+1 day"));
$tomorrow = date("d-m-y", strtotime("+1 day"));

//en dehors du if car on veut afficher les cartes
$cartesUser = $PosséderManager->getCarteUtilisateur($_SESSION['IdCollectionneur']);


if (isset($_POST['valider'])) {
    //! on vérifie la date d'envoi pour éviter les changements de date dans le code source (on sécurise)
    if ($_POST['DateEnvoiColis'] != $tomorrow) {
        header('Location:./connexionUtilisateur.php?err=1008');
    }
    if (
        isset($_POST['IdCarte'], $_POST['SeriePaquet'], $_POST['LieuLivraison'], $_POST['DateEnvoiColis'])
        && !empty($_POST['IdCarte']) && !empty($_POST['SeriePaquet']) && !empty($_POST['LieuLivraison']) && !empty($_POST['DateEnvoiColis'])
    ) {
        $LieuLivraison = $_POST['LieuLivraison'];
        $IdCarte = $_POST['IdCarte'];
        $SeriePaquet = $_POST['SeriePaquet'];

        $colis = new Colis(['IdCollectionneur' => $_SESSION['IdCollectionneur'], 'DateEnvoiColis' => $tomorrowFormatSQL, 'LieuLivraison' => $LieuLivraison]);
        $ColisManager->addColis($colis);

        $contenir = new Contenir(['IdCarte' => $IdCarte, 'SeriePaquet' => $SeriePaquet, 'IdLivraison' => $colis->getIdLivraison()]);
        $ContenirManager->addContenir($contenir);
    }
}

?>
<div class="container">
    <?php echo generationEntete("Livraison", "Choisissez les cartes que vous voulez vous faire livrer, chaque colis vous coûtera 5 €, un colis met ~ 1 semaine à arriver") ?>
    <div class="text-center mt-3">
        <img src="./image/ressources/colis.png" alt="colis">
    </div>
    <form method="POST" novalidate>
        <div class="col-lg-5 mx-auto">
            <div class="text-center">
                <div class="mb-3">
                    <input id="IdCarte" type="number" class="form-control mt-2 text-center" placeholder="Sélectionnez une carte pour la soumettre à l'échange" name="IdCarte" readonly>
                    <input id="SeriePaquet" type="text" class="form-control mt-1 text-center" id="SeriePaquet" placeholder="Sélectionnez une carte afin d'avoir la série de son paquet" name="SeriePaquet" readonly>
                    <input type="text" class="form-control mt-1 text-center" placeholder="Veuillez indiquer un lieu de livraison" name="LieuLivraison">
                    <label>Votre colis sera expédié le :</label>
                    <input type="text" class="form-control mt-1 text-center" name="DateEnvoiColis" value="<?= $tomorrow ?>" readonly>

                </div>
                <hr class="sep-2">
                <div class="mb-3 text-center">
                    <input type="submit" value="Valider" class="btn btn-primary" name="valider">
                </div>
                <hr class="sep-2">
            </div>
        </div>
</div>

<div class="container ">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center d-flex">
        <!-- INVENTAIRE du collectionneur -->
        <?php foreach ($cartesUser as $valCarte) { ?>
            <div class="col-lg-4 col-md-4 col-sm-4 zoom" id="divCartePkmEchange">
                <div class="card shadow-sm">

                    <img onclick="remplirFormulaire('<?php echo $valCarte->getIdCarte(); ?>', '<?php echo $valCarte->getSeriePaquet(); ?>' ,'IdCarte', 'SeriePaquet')" id="cartePkmEchange" src='./image/<?= $valCarte->getSeriePaquet() . '/' . $valCarte->getSeriePaquet() . '_' . $valCarte->getIdCarte() . '.jpg' ?>'>
                </div>
            </div>
        <?php
        } ?>
    </div>
</div>

</div>
<?php
include("include/footer.inc.php");

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

echo generationEntete("Page perso", "Bonjour " . $_SESSION['pseudo'] . ", Voici Votre Album de Cartes");

$cartesUser = $PosséderManager->getCarteUtilisateur($_SESSION['IdCollectionneur']);
?>
<div class="container ">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center d-flex">
        <!-- INVENTAIRE du collectionneur -->
        <?php foreach ($cartesUser as $valCarte) { ?>
            <div class="col-lg-4 col-md-4 col-sm-4 zoom" id="divCartePkmEchange">
                <div class="card shadow-sm">

                    <img onclick="zoomImage(this)" id="cartePkmEchange" src='./image/<?= $valCarte->getSeriePaquet() . '/' . $valCarte->getSeriePaquet() . '_' . $valCarte->getIdCarte() . '.jpg' ?>'>
                </div>
            </div>
        <?php
        } ?>
    </div>
</div>
<?php
include("include/footer.inc.php");

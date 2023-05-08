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


if (isset($_GET["err"]) && !empty($_GET["err"])) {

    $err = htmlspecialchars($_GET["err"]);
    switch ($err) {
        case '1012':
?>
            <div class="alert alert-danger text-center" role="alert">
                <strong>Erreur :</strong> Nombre de Crédits trop faible
            </div>
        <?php
            break;
    }
}

if (isset($_GET['selection']) && $_GET['selection'] == 'acheter') {
    if (isset($_GET['trier']) && !empty($_GET['trier'])) {
        ?>

        <?php
        $user = $CollectionneurManager->getCollectionneur($_SESSION['IdCollectionneur']);

        $idColl = $_SESSION['IdCollectionneur'];

        $tabPkm = $PokemonManager->selectAllPkmByPacket($_GET['trier']);
        $tabEnergie = $EnergieManager->selectAllEnergies($_GET['trier']);
        $tabDresseur = $DresseurManager->selectAllTrainers($_GET['trier']);

        $cartesObtenues = array();
        $cartesObtenues = array_merge($tabPkm, $tabEnergie, $tabDresseur);
        shuffle($cartesObtenues);
        ?>
        <div class="container">
            <br>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                if ($user->getCredit() >= 20) {
                    $_SESSION['Credit']  =  $_SESSION['Credit'] - 20;
                    $currentCred = $user->setCredit($user->getCredit() - 20);
                    $CollectionneurManager->updateCreditCollectionneur($currentCred);
                ?>
                    <?php foreach ($cartesObtenues as $valCarte) { ?>
                        <div class="col" id="divCartePkm" style="position: relative;">
                            <img class="zoom" id="cartePkm" onclick="zoomImage(this)" src='./image/<?= $valCarte->getSeriePaquet() . '/' . $valCarte->getSeriePaquet() . '_' . $valCarte->getIdCarte() . '.jpg' ?> '>
                        </div>
                <?php
                        $verif = $PosséderManager->verifMultipleCopies($idColl, $valCarte);
                        $PosséderManager->addCardsToUser($verif, $idColl, $valCarte);
                    }
                } else {
                    header('Location:./achatBoosters.php?err=1012');
                    die();
                } ?>
            </div>
            <br>
            <div class="alert alert-danger text-center" role="alert">
                <div>Note : Si vous actualisez la page, vous allez redépenser vos crédits pour acheter des cartes</div>
            </div>
            <br>
            <a href="./achatBoosters.php" class="btn btn-primary mb-3">Retour</a>

        </div>
<?php
    }
}
?>

<?php

if (!isset($_GET['selection']) && empty($_GET['selection'])) {
    echo generationEntete("Achetez des boosters d'anciennes générations !", "Le prix d'un paquet est de 20 Crédits");
?>

    <form method="GET" class="text-center">
        <img id="boosterImage" src="./image/ressources/rubysaphirBooster.png" alt="Booster Rubis & Saphir">
        <br>
        <select name="trier" class="styleButton2" id="boosterSelect" onchange="changeImage()">
            <option value="rubissaphir">EX Rubis & Saphir</option>
            <option value="tempete">Tempête</option>
        </select>
        <br>
        <input type="submit" value="acheter" name="selection" class="btn btn-primary mt-2"></th>
    </form>
<?php
}
include("include/footer.inc.php");
?>
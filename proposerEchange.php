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

if (!isset($_GET['Coll']) || empty($_GET['Coll'])) {

    header("Location: ./connexionUtilisateur.php?err=1005");
}

//on veut le pseudo du l'utilisateur à qui on veut échanger
$choisirCollEchanger = htmlspecialchars($_GET['Coll']);
$user2 = $CollectionneurManager->getCollectionneur($choisirCollEchanger);

$cartesUser1 = $PosséderManager->getCarteUtilisateur($_SESSION['IdCollectionneur']);
$cartesUser2 = $PosséderManager->getCarteUtilisateur($_GET['Coll']);

//check formulaire
if (isset($_POST['valider'])) {
    if (
        isset($_POST['IdCarte1'], $_POST['IdCarte2'], $_POST['SeriePaquet1'], $_POST['SeriePaquet2']) &&
        !empty($_POST['IdCarte1']) && !empty($_POST['IdCarte2']) && !empty($_POST['SeriePaquet1']) && !empty($_POST['SeriePaquet2'])
    ) {

        $IdCarte1 = htmlspecialchars($_POST['IdCarte1']);
        $SeriePaquet1 = htmlspecialchars($_POST['SeriePaquet1']);

        $IdCarte2 = htmlspecialchars($_POST['IdCarte2']);
        $SeriePaquet2 = htmlspecialchars($_POST['SeriePaquet2']);

        //!on vérifie les doublons des collectionneurs
        $verifUser1 = $PosséderManager->verifMultipleCopiesEchange($_SESSION['IdCollectionneur'], $IdCarte2, $SeriePaquet2);
        $verifUser2 = $PosséderManager->verifMultipleCopiesEchange($choisirCollEchanger, $IdCarte1, $SeriePaquet1);
        //!on vérifie le nombre d'exemplaire(s) de carte(s) pour voir si on update ou delete
        $verifUser1Exchange = $PosséderManager->verifMultipleCopiesEchange($_SESSION['IdCollectionneur'], $IdCarte1, $SeriePaquet1);
        $verifUser2Exchange = $PosséderManager->verifMultipleCopiesEchange($choisirCollEchanger, $IdCarte2, $SeriePaquet2);

        //!echange des cartes entre les utilisateurs, VOIR méthode pour plus d'infos
        $PosséderManager->echangeCarteUtilisateur($verifUser1, $verifUser2, $verifUser1Exchange, $verifUser2Exchange, $_SESSION['IdCollectionneur'], $choisirCollEchanger, $IdCarte1, $IdCarte2, $SeriePaquet1, $SeriePaquet2);
        header('Location:./proposerEchange.php?Coll=' . $choisirCollEchanger . '&val=2101');
    } else {
        header('Location:./proposerEchange.php?Coll=' . $choisirCollEchanger . '&err=1004');
    }
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="overflow-auto">
                <div class="album py-5 bg-light">

                    <p class="text-center fs-3 fw-bolder">Votre Inventaire</p>

                    <div class="container ">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center d-flex">
                            <!-- VOTRE INVENTAIRE -->
                            <?php foreach ($cartesUser1 as $valCarte1) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 zoom" id="divCartePkmEchange">
                                    <div class="card shadow-sm">
                                        <img onclick="remplirFormulaire('<?php echo $valCarte1->getIdCarte(); ?>', '<?php echo $valCarte1->getSeriePaquet(); ?>' ,'IdCarte1', 'SeriePaquet1') " id="cartePkmEchange" src='./image/<?= $valCarte1->getSeriePaquet() . '/' . $valCarte1->getSeriePaquet() . '_' . $valCarte1->getIdCarte() . '.jpg' ?>'>
                                    </div>
                                </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div><?php
                    if (isset($_GET["err"]) && !empty($_GET["err"])) {

                        $err = htmlspecialchars($_GET["err"]);

                        switch ($err) {
                            case '1004':
                    ?>
                            <div class="alert alert-danger text-center mt-3" role="alert">
                                <strong>Erreur :</strong> Veuillez remplir tous les champs
                            </div>
                        <?php
                                break;
                        }
                    }
                    if (isset($_GET["val"]) && !empty($_GET["val"])) {

                        $val = htmlspecialchars($_GET["val"]);
                        switch ($val) {
                            case '2101':
                        ?>
                            <div class="alert alert-success text-center mt-3" role="alert">
                                Vous avez envoyé la demande d'échange à <?= $user2->getPseudo(); ?>
                            </div>
                <?php
                                break;
                        }
                    }

                ?>
                <form method="POST" novalidate>
                    <div>
                        <div class="mb-3">
                            <label for="IdCarte1" class="form-label mt-3">Id de votre Carte</label>
                            <input id="IdCarte1" type="number" class="form-control" placeholder="Sélectionnez une carte pour la soumettre à l'échange" name="IdCarte1" readonly>
                            <label for="SeriePaquet1" class="form-label">Serie de paquet de votre Carte</label>
                            <input id="SeriePaquet1" type="text" class="form-control" id="SeriePaquet" placeholder="Sélectionnez une carte afin d'avoir la série de son paquet" name="SeriePaquet1" readonly>
                        </div>
                        <hr class="sep-2">
                        <div class="mb-3">
                            <label for="IdCarte2" class="form-label">Id de la Carte de <?= $user2->getPseudo(); ?></label>
                            <input type="number" class="form-control" id="IdCarte2" placeholder="Sélectionnez une carte que vous voulez" name="IdCarte2" readonly>
                            <label for="SeriePaquet2" class="form-label">Serie de paquet de votre Carte</label>
                            <input type="text" class="form-control mb-2" id="SeriePaquet2" placeholder="Sélectionnez une carte afin d'avoir la série de son paquet" name="SeriePaquet2" readonly>
                            <hr class="sep-2">
                        </div>
                        <div class="mb-3 text-center">
                            <input type="submit" value="Valider" class="btn btn-primary" name="valider" readonly>
                        </div>

                    </div>
                </form>
            </div>
            <hr class="sep-2">
            <div class="alert alert-danger text-center" role="alert">
                <strong>Note : </strong> Votre échange sera effectué seulement si l'utilisateur <?= $user2->getPseudo(); ?> accepte la demande lors de sa prochaine connexion
            </div>

            <hr class="sep-2">
        </div>

        <div class="col-md-4">
            <div class="overflow-auto">
                <div class="album py-5 bg-light">


                    <p class="text-center fs-3 fw-bolder">Inventaire de <?= $user2->getPseudo(); ?></p>

                    <div class="container ">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center d-flex">
                            <!-- INVENTAIRE de $user2-->
                            <?php foreach ($cartesUser2 as $valCarte2) { ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 zoom" id="divCartePkmEchange">
                                    <div class="card shadow-sm">
                                        <!-- on passe nos valeurs dans les parametres de la fonction js pour pouvoir compléter le parametre qd on clique sur une carte -->
                                        <img onclick="remplirFormulaire('<?php echo $valCarte2->getIdCarte(); ?>', '<?php echo $valCarte2->getSeriePaquet(); ?>' ,'IdCarte2', 'SeriePaquet2') " id="cartePkmEchange" src='./image/<?= $valCarte2->getSeriePaquet() . '/' . $valCarte2->getSeriePaquet() . '_' . $valCarte2->getIdCarte() . '.jpg' ?>'>
                                    </div>
                                </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
include("include/footer.inc.php");
?>
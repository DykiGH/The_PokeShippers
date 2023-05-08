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

if (!empty($_POST['payer']) && $_POST['payer'] < 5) {
    header('Location:./achatCredits.php?etat=error');
} elseif (!empty($_POST['payer']) && $_POST['payer'] >= 5) {
    header('Location:./achatCredits.php?etat=success');
}

if (isset($_POST['valider'])) {
    if (isset($_POST['payer']) && !empty($_POST['payer'])) {

        $payer = htmlspecialchars($_POST['payer']);
        $user = $CollectionneurManager->getCollectionneur($_SESSION['IdCollectionneur']);
        echo $user->getCredit();

        $_SESSION['Credit'] += $payer * 4;
        $user->setCredit($user->getCredit() + $payer * 4);
        $CollectionneurManager->updateCreditCollectionneur($user);
    }
}


echo generationEntete("Acheter des Crédits", "");
?>
<div class="margetab">
    <?php
    if (isset($_GET['etat'])) {
        $etat = $_GET['etat'];

        switch ($etat) {
            case 'error':
    ?>
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Erreur :</strong> Vous devez effectuer une transaction d'au moins 5 €
                </div>
            <?php
                break;

            case 'success':
            ?>
                <div class="alert alert-success text-center" role="alert">
                    <strong>Succès :</strong> Votre Transaction a été effectuée !
                </div>
    <?php
                break;
        }
    }
    ?>
</div>


<form class="row" method="POST" novalidate>

    <div class="col-lg-3 mx-auto">
        <div class="text-start">
            <div class="input-group mb-3">
                <input oninput="refreshValueInput(this.value)" id="nbrInput" name="payer" type="number" class="form-control" aria-label="Euros" placeholder="Acheter des Crédits avec des €">
                <!-- on change sa valeur avec la fonction js refreshValueInput(this.value) value=>valeur de l'input -->
                <span class="input-group-text"><img style="width:25px; height:25px;" src="./image/ressources/PokeCoin.png"></a></span>
                <span id="eurosToPokeCoins" class="input-group-text">0</span>
            </div>
            <input type="submit" value="Valider" class="btn btn-primary" name="valider">
        </div>
    </div>


</form>
<?php
include("include/footer.inc.php");
?>
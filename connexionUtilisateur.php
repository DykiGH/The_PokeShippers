<?php
include("include/header.inc.php");
if (isset($_POST['identifier'])) {
    if (isset($_POST['mail'], $_POST['mdp']) && !empty($_POST['mail']) && !empty($_POST['mdp'])) {

        if ($utilisateur = $CollectionneurManager->getConnexionCollectionneur($_POST['mail'])) {


            if (password_verify($_POST['mdp'], $utilisateur->getMdp())) {

                var_dump($utilisateur);

                $_SESSION['login'] = true;
                $_SESSION['IdCollectionneur'] = $utilisateur->getIdCollectionneur();
                $_SESSION['pseudo'] = $utilisateur->getPseudo();
                $_SESSION['Credit'] = $utilisateur->getCredit();
                $_SESSION['role'] = 'Collectionneur';
                header('Location: espaceCollectionneurs.php');
                // var_dump($_SESSION);
            } else {
                header('Location: connexionUtilisateur.php?err=1003');
            }
        }
    } else {
        header('Location: ./pageConnexion.php?err=1004');
        die(); //? bootstrap s'en charge (il oblige à remplir les champs) mais on laisse cette partie en cas de pbm

    }
}

?>
<div class="container">
    <?php echo generationEntete("Connexion", "Merci de vous identifier") ?>
    <?php
    if (isset($_GET["err"]) && !empty($_GET["err"])) {

        $err = htmlspecialchars($_GET["err"]);

        switch ($err) {

            case '1003':
    ?>
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Erreur :</strong> Veuillez resaisir vos informations afin de vous connecter
                </div>
            <?php
                break;


            case '1004':    //? cas obligatoire : bootstrap se charge d'éviter cette erreur mais traitement client donc pas sécurisé
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Erreur :</strong> Veuillez remplir tous les champs
                </div>
            <?php
                break;

            case '1005':    //? cas qui ne devrait jamais arriver : l'utilisateur (visiteur) a directement écrit dans l'url de la page pour accéder à des infos
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Erreur :</strong> Vous n'avez pas les droits suffisants pour accéder à cette page
                </div>
            <?php
                break;

            case '1006':
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Erreur :</strong> Vous devez être connecté pour avoir accès à cette page
                </div>
            <?php
                break;

            case '1006.5':
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Erreur :</strong> Les administrateurs n'ont pas accès à cette page
                </div>
            <?php
                break;

            case '1007':
            ?>
                <div class="alert text-center" role="alert">
                    Vous avez été déconnecté
                </div>
            <?php
                break;

            case '1008':
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    Vous ne pouvez pas faire cela !
                </div>
    <?php
                break;
        }
    }
    ?>

    <div class="jumbotron">
        <form method="post" id="formId" novalidate>
            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="email">Adresse électronique : </label>
                    <input type="email" class="form-control" <?php if (isset($_POST['identifier'])) {
                                                                    if (!$CollectionneurManager->getConnexionCollectionneur($_POST['mail'])) {
                                                                        echo " is-invalid";
                                                                    } else {
                                                                        echo " is-valid";
                                                                    }
                                                                } else {
                                                                    echo " is-valid";
                                                                }
                                                                ?> name="mail" id="email" placeholder="E-mail" required>
                    <div class="invalid-feedback">
                        <?php
                        if (isset($_POST['identifier']) && (!$CollectionneurManager->getConnexionCollectionneur($_POST['mail']))) {
                            echo " Le mail n'existe pas dans la base";
                        } elseif (!isset($_POST['identifier'])) {
                            echo " Vous devez fournir un mail valide";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="motdepasse1">Mot de passe :</label>
                    <input type="password" class="form-control" name="mdp" required>
                </div>
                <div class="invalid-feedback">
                    Vous devez fournir un mot de passe.
                </div>
            </div>
            <input type="submit" value="Valider" class="btn btn-primary" name="identifier" />
        </form>
    </div>
</div>
<script>
    (function() {
        "use strict"
        window.addEventListener("load", function() {
            var form = document.getElementById("formId")
            form.addEventListener("submit", function(event) {
                if (form.checkValidity() == false) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add("was-validated")
            }, false)
        }, false)
    }())
</script>

<?php
include("include/footer.inc.php");
?>
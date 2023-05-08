<?php
include("include/header.inc.php");

if (isset($_POST['valider'])) {
    if (
        isset($_POST['pseudo'], $_POST['mail'], $_POST['motdepasse1'], $_POST['motdepasse2'])
        && !empty($_POST['pseudo']) && !empty($_POST['mail']) && !empty($_POST['motdepasse1']) && !empty($_POST['motdepasse2'])
    ) {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars($_POST['motdepasse1']);
        $mdp2 = htmlspecialchars($_POST['motdepasse2']);

        if (!passwordCheck($mdp)) {
            header('Location: ./inscription.php?err=1001');
            die();
        }

        //on fait un traitement coté serveur pour sécuriser le site
        //! On hash le mot de passe avec Bcrypt, le sel est généré automatiquement (à partir de PHP 8.0.0)
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
            if ($mdp2 == $mdp) {
                $mdp = password_hash($mdp, PASSWORD_BCRYPT);
            }
        }

        //tableau associatif pour alimenter le hydrate
        $user = new Collectionneur(['Pseudo' => $pseudo, 'Mail' => $mail, 'Mdp' => $mdp, 'Role' => 'collectionneur']);
        $CollectionneurManager->addCollectionneur($user);
        header('Location: inscriptionOK.php');
    }
}

?>

<div class="container">

    <?php echo generationEntete("Inscription", "Merci de remplir ce formulaire d'inscription.") ?>
    <?php
    if (isset($_GET["err"]) && !empty($_GET["err"])) {

        $err = htmlspecialchars($_GET["err"]);

        switch ($err) {
            case '1001':
    ?>
                <div class="alert alert-danger text-center" role="alert">
                    <strong>Erreur :</strong> Mot de passe trop faible, il doit contenir au moins 1 lettre en miniscule, <br> 1 lettre en majuscule
                    , 1 chiffre, 1 caractère spécial et doit faire au minimum 12 caractères &nbsp;
                </div>
    <?php
                break;
        }
    }
    ?>
    <div class="jumbotron">
        <!-- oninput permet d'appeler une fonction lorsque qqc est écrit dans un input -->
        <form method="post" oninput='motdepasse2.setCustomValidity(motdepasse2.value != motdepasse1.value ?  "Mot de passe non identique" : "")' id="form" novalidate>
            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre pseudo" required>
                    <div class="invalid-feedback">
                        Le champ pseudo est obligatoire
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="email">Adresse électronique</label>
                    <input type="email" class="form-control" name="mail" id="email" placeholder="E-mail" required>
                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons pas votre email.</small>
                    <div class="invalid-feedback">
                        Vous devez fournir un email valide.
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="motDePasse1">Votre mot de passe</label>
                    <input type="password" class="form-control" name="motdepasse1" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="motDePasse2">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" name="motdepasse2" required>
                    <div name="message" class="invalid-feedback">
                        Mot de passe invalide
                    </div>
                </div>
            </div>

            <input type="submit" value="Valider" class="btn btn-primary" name="valider" />
        </form>

    </div>
</div>


<script>
    (function() {
        "use strict"
        window.addEventListener("load", function() {
            var form = document.getElementById("form")
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

</body>

</html>
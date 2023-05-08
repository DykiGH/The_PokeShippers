<?php include("include/header.inc.php"); ?>
<?php echo generationEntete("Cartes pokémon en ligne", "Collectionnez-les toutes !") ?>

<?php
if (isset($_GET["err"]) && !empty($_GET["err"])) {

    $err = htmlspecialchars($_GET['err']);
    switch ($err) {

        case '1010':
?>
            <div class="alert alert-danger text-center" role="alert">
                <strong>Erreur :</strong> Veuillez réessayer
            </div>
<?php
            break;
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto py-4 text-center">
            <h4 class="mb-4">The PokéShippers Company</h4>
            <p class="lead mb-4">
                Bienvenue sur notre site, vous pouvez acheter des paquets, échanger vos cartes avec d'autres collectionneurs
                et même recevoir les cartes qui appartiennent à votre compte chez vous !
                Nous avons un grand stock d'anciennes cartes pokémons, elles sont toutes entreposées avec précaution.
                Qui n'a pas rêvé de replonger dans son enfance et de collectionnier d'anciennes cartes Pokémon ?
                Lorsque vous achetez des paquets et recevez des cartes, vous pouvez utiliser la fonction Livraison du site afin de recevoir en colis les cartes obtenues.<br>
                Que la chance soit avec vous lors de l'ouverture des paquets.
            </p>
            <img src="./image/ressources/red-pkm.jpg" alt="red & starters">
        </div>
    </div>
</div>

<?php include("include/footer.inc.php"); ?>
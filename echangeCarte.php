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

echo generationEntete("Echangez vos cartes avec d'autres collectionneurs !", "");

?>
<div class="margetab">

    <table class="table table-bleu text-center">
        <thead>
            <tr>
                <th scope="col">Pseudo</th>
                <th scope="col">Voir détails</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $lstColl = $CollectionneurManager->getLstCollectionneur($_SESSION['IdCollectionneur']);
            foreach ($lstColl as $valColl) {
            ?>

                <tr>
                    <td><?= $valColl->getPseudo(); ?></td>
                    <td>
                        <a class="btn btn-dark" title="Choix du Collectionneur" href="proposerEchange.php?Coll=<?= $valColl->getIdCollectionneur() ?>" role="button">
                            <i class="bi bi-file-person-fill"></i></a>
                    </td>
                    <?php
                    ?>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php

//aff lst des collectionneurs => leur pseudo et aff détail qd on clique sur détails

include("include/footer.inc.php");

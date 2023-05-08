<?php

function generationEntete(string $titre, string $sous_titre): string
{
    $titre = htmlspecialchars($titre);
    $sous_titre = htmlspecialchars($sous_titre);
    return '<div class="text-center mt-5 text-decoration-underline">
                <img class="d-block mx-auto mb-2" src="image/ressources/logo_pkm.png" alt="Pokémon">
                <h1 class="display-5 fw-bolder">' . $titre . '</h1>
            </div>
            <div class="text-center">
                <p class="lead fw-bolder">' . $sous_titre . '</p>
            </div>';
}

function passwordCheck($mdp): bool
{

    $nbPoints = 10;
    $nbChar = strlen($mdp);
    $pointsNbChar = 0;
    $pointsComplex = 0;

    if ($nbChar >= 12) {
        $pointsNbChar = 1;
    }

    if (preg_match("/[a-z]/", $mdp)) {
        $pointsComplex += 1;
    }

    if (preg_match("/[A-Z]/", $mdp)) {
        $pointsComplex += 2;
    }

    if (preg_match("/[0-9]/", $mdp)) {
        $pointsComplex += 3;
    }

    if (preg_match("/\W/", $mdp)) {
        $pointsComplex += 4;
    }

    $res = $pointsNbChar * $pointsComplex;

    return ($nbPoints == $res);
}

function getRandomRarete()
{
    $randomNumber = rand(1, 20); // Génère un nombre aléatoire entre 1 et 20
    if ($randomNumber == 20) {
        return "EX"; // 1 chance sur 20 de retourner "EX"
    } else {
        return "rare"; // 19 chances sur 20 de retourner "rare"
    }
}

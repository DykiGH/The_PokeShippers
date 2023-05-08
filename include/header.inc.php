<?php
include_once './include/connection.inc.php';
include_once("./include/functions.inc.php");

// Gestion de la session
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = False;
}

// Pour le chargement automatique des classes
function chargerClasse($classname)
{
    require 'classes/' . $classname . '.class.php';
}
spl_autoload_register('chargerClasse');

$CollectionneurManager = new CollectionneurManager($db);
$PokemonManager = new PokemonManager($db);
$EnergieManager = new EnergieManager($db);
$DresseurManager = new DresseurManager($db);
$PosséderManager = new PosséderManager($db);
$ColisManager = new ColisManager($db);
$ContenirManager = new ContenirManager($db);

if (isset($_POST['deconnexion'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
}
?>

<!doctype html>
<html>

<head>
    <title>PokéShippers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"> <!-- bootstrap svg -->
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./javascript/functions.js"></script>
</head>

<body style="min-height: 100vh; display: flex; flex-direction: column;">
    <?php

    include_once("./include/navbar.inc.php");

    ?>
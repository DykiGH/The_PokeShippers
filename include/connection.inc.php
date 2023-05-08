<?php

//connexion pr mariaDB
$host = "127.0.0.1";
$port = 3306; //port changé pour co au lycée
$database = "the_pokeshippers_projet";
$user = "root";
$pw = "";
//connection à la base de données avec test si il y a une erreur
try {
	$db = new PDO('mysql:host=' . $host . ';port=' . $port . ';dbname=' . $database, $user, $pw);
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

include_once("./include/functions.inc.php");

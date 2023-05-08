<?php
session_start(); // demarrage de la session car si pas démarée on ne peut pas la détruire
session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
header('Location: ./connexionUtilisateur.php?err=1007'); // On redirige
die();

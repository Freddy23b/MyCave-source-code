<?php

// ouverture de la session à terminer
session_start();

// Suppression des variables de session (affectation d'un array vide) et suppression de la session elle-même :
$_SESSION = array();
session_destroy();

// message de déconnexion :
$delogMsg = 'Vous êtes bien déconnecté.';
header('Location: index.php?delogmsg=' . $delogMsg);

?>
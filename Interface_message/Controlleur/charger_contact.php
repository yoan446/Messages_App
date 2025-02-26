<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection a la BDD
include('../Modele/connection.php');

$sql="";
?>
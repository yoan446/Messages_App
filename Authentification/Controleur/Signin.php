<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../Modele/Connection.php");

if(isset($_POST['submit'])){

    //recuperation des valeurs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try{

    }
    catch(PDOException $e){
        echo "<script>alert('Erreur lors de l\'inscription : " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
?>
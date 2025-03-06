<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connection à la base de données
include('../Modele/connection.php');

// ID de l'utilisateur actuel
$idUtilisateur = 2; // Remplacez par la façon dont vous stockez l'ID utilisateur

// Requête pour récupérer les contacts
$sql = "SELECT * FROM dbo.charger_contact(:idUtilisateur)";
$stmt = $conn->prepare($sql);

// Liaison des paramètres pour éviter les injections SQL
$stmt->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);

try {
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Gestion des erreurs
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    exit();
}
?>

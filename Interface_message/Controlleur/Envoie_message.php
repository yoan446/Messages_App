<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
include('../Modele/connection.php');

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $contenu = isset($_POST['message']) ? trim($_POST['message']) : '';
    $id_envoyeur = 2; // Remplacez ceci par l'ID de l'utilisateur connecté
    $id_receveur = isset($_POST['copie_id']) ? trim($_POST['copie_id']) : '';

    // Vérification des données
    if (!empty($contenu) && !empty($id_receveur)) {
        try {
            // Préparation de l'appel à la procédure stockée
            $sql = "EXEC Ajouter_message @Contenu = ?, @ID_envoyeur = ?, @ID_receveur = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $contenu, PDO::PARAM_STR);
            $stmt->bindParam(2, $id_envoyeur, PDO::PARAM_INT);
            $stmt->bindParam(3, $id_receveur, PDO::PARAM_INT);

            // Exécution de la procédure stockée
            if ($stmt->execute()) {
                //ne rienmettre ici sinon le code ne fonctionnne pas !!!!!
            } else {
                echo "<script>alert('Erreur lors de l\'envoi du message');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
        }
    } else {
        echo "<script>alert('Veuillez remplir tous les champs requis.');</script>";
    }
}
?>
<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
include('../Modele/connection.php');

if(isset($_POST['submit_m'])) {

    // Récupération des infos du formulaire
    $contenu = trim($_POST['ecrire']); // Message sous forme de texte
    $Id_receveur = trim($_POST['id_rf']); // ID du receveur
    $id_envoyeur = 2; // ID de l'envoyeur (à changer plus tard dans le main)
    $url = "../Images/";
    $fichier = isset($_FILES['fichier']) ? $_FILES['fichier']['name'] : "";
    $fichier = $url . $fichier; // Concaténation des chaînes de caractères

    // Vérifier qu'au moins un des champs (contenu, images, vidéos) est non nul
    if (!empty($contenu) || !empty($fichier)) {
        try {
            // Préparation de l'appel à la procédure stockée
            $sql = "EXEC Ajouter_message @Contenu = ?, @Medias = ?, @ID_envoyeur = ?, @ID_receveur = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $contenu, PDO::PARAM_STR);
            $stmt->bindParam(2, $fichier, PDO::PARAM_STR);
            $stmt->bindParam(3, $id_envoyeur, PDO::PARAM_INT);
            $stmt->bindParam(4, $Id_receveur, PDO::PARAM_INT);

            // Exécution de la procédure stockée
            $stmt->execute();
            echo "<script>alert('Message envoyé avec succès!');</script>";
        } catch(PDOException $e) {
            echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
        }

        // Déplacer le fichier téléchargé vers un dossier de destination
        if (!empty($fichier)) {
            $target_dir = "../Images/";
            $target_file = $target_dir . basename($_FILES["fichier"]["name"]);
            move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file);
        }
    } else {
        echo "<script>alert('Vous devez entrer un contenu ou télécharger une image/vidéo.');</script>";
    }
}
?>

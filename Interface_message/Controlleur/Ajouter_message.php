<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
include('../Modele/connection.php');

// Vérification de l'envoi du formulaire
if(isset($_POST['envoie'])) {
    // Récupération des informations du formulaire
    $contenu = trim($_POST['ecrire']); // Message sous forme de texte
    $Id_receveur = trim($_POST['id_rf']); // ID du receveur
    
    // Vérification de l'ID receveur
    if(empty($Id_receveur)) {
        echo "<script>alert('Aucun destinataire sélectionné');</script>";
        exit;
    }
    
    $id_envoyeur = 2; // ID de l'envoyeur (à changer plus tard dans le main)
    
    // Gestion du fichier
    $url = "../Images/";
    if(!empty($_FILES['fichier']['name'])) {
        $fichier = $_FILES['fichier']['name'];
        $extension = pathinfo($fichier, PATHINFO_EXTENSION);
        $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm'];
        
        if(!in_array(strtolower($extension), $extensionsAutorisees)) {
            echo "<script>alert('Format de fichier non supporté');</script>";
            exit;
        }
        
        // Déplacer le fichier téléchargé vers un dossier de destination
        $target_dir = $url;
        $target_file = $target_dir . basename($fichier);
        
        if(move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file)) {
            $fichier = $url . $fichier; // Concaténation des chaînes de caractères
        } else {
            echo "<script>alert('Erreur lors du téléchargement du fichier');</script>";
            exit;
        }
    } else {
        $fichier = "";
    }
    
    // Vérifier qu'au moins un des champs (contenu, images, vidéos) est non nul
    if (empty($contenu) && empty($fichier)) {
        echo "<script>alert('Vous devez entrer un contenu ou télécharger une image/vidéo.');</script>";
        exit;
    }
    
    try {
        // Préparation de l'appel à la procédure stockée
        $sql = "EXEC Ajouter_message @Contenu = ?, @Medias = ?, @ID_envoyeur = ?, @ID_receveur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, htmlspecialchars($contenu), PDO::PARAM_STR);
        $stmt->bindParam(2, $fichier, PDO::PARAM_STR);
        $stmt->bindParam(3, $id_envoyeur, PDO::PARAM_INT);
        $stmt->bindParam(4, $Id_receveur, PDO::PARAM_INT);
        
        // Exécution de la procédure stockée
        if($stmt->execute()) {
            echo "<script>alert('Message envoyé avec succès!');</script>";
        } else {
            echo "<script>alert('Erreur lors de l\'envoi du message');</script>";
        }
    } catch(PDOException $e) {
        echo "<script>alert('Erreur: " . $e->getMessage() . "');</script>";
    }
}
else{
    echo "<script>alert('le isset ne marche pas!!!!!!!!!!!!!!!!!');</script>";
}
?>

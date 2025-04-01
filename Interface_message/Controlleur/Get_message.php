<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
include('../Modele/connection.php');

// Supposons que vous avez déjà l'ID de l'utilisateur connecté dans une variable de session
$id_envoyeur = 2; // Remplacez par la méthode appropriée pour obtenir l'ID de l'utilisateur connecté
$id_receveur = isset($_POST['receveur_id']) ? intval($_POST['receveur_id']) : 0; // ID du receveur passé via POST

if ($id_receveur > 0) {
    try {
        // Préparation de l'appel à la procédure stockée
        $sql = "EXEC GetMessages @ID_Envoyeur = ?, @ID_Receveur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id_envoyeur, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_receveur, PDO::PARAM_INT);

        // Exécution de la procédure stockée
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des messages
        foreach ($messages as $message) {
            echo '<div class="chat">';
            echo '<div class="envoyeur"><span>'. htmlspecialchars($message['MessageContenu']) . '</span></div>';
            echo '<div class="receveur"><span>' . htmlspecialchars($message['ReceveurNom']) . '</span></div>';
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
?>
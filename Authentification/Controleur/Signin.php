<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../Modele/Connection.php");

if(isset($_POST['submit'])){

    // Récupération des valeurs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try{
        // Assurez-vous que la fonction SQL renvoie bien les données attendues
        $sql = "SELECT * FROM dbo.verifer_email(:Email_utilisateur)";
        $stmt = $conn->prepare($sql);
        // Liaison des paramètres
        $stmt->bindParam(':Email_utilisateur', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result && password_verify($password, $result[0]['Mot_de_passe'])){

            if($result[0]['Role_utilisateur'] == 'Client' && $result[0]['Statut_utilisateur'] == 'Actif'){
                $_SESSION['ID_users'] = $result[0]['ID_utilisateur'];
                $_SESSION['nom'] = $result[0]['Nom_utilisateur'];
                $_SESSION['prenom'] = $result[0]['Prenom_utilisateur'];
                echo "<script>alert('Connexion réussie!!!!');</script>";
                // Redirection après connexion réussie
                echo "Client";
            }
            else if($result[0]['Role_utilisateur'] == 'Administrateur' && $result[0]['Statut_utilisateur'] == 'Actif'){
                $_SESSION['ID_users'] = $result[0]['ID_utilisateur'];
                $_SESSION['nom'] = $result[0]['Nom_utilisateur'];
                $_SESSION['prenom'] = $result[0]['Prenom_utilisateur'];
                echo "<script>alert('Connexion réussie!!!!');</script>";
                // Redirection après connexion réussie
                echo "Administrateur";
            }
            else{
                echo "<script>alert('L'utilisateur a ete suspendu !!!!!');</script>";
                // Redirection après échec
                echo "<script>window.location.href = 'http://localhost/Messagerie/Messages_App/Authentification/Vue/Login.php';</script>";
            }
            
        }
        else{
            echo "<script>alert('Mot de passe ou email incorrect!!!!!');</script>";
            // Redirection après échec
            echo "<script>window.location.href = 'http://localhost/Messagerie/Messages_App/Authentification/Vue/Login.php';</script>";
        }

    }
    catch(PDOException $e){
        echo "<script>alert('Erreur lors de l\'inscription : " . htmlspecialchars($e->getMessage()) . "');</script>";
    }
}
?>

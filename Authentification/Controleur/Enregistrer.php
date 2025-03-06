<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../Modele/Connection.php");

if(isset($_POST['submit'])){
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    //verifier la correspondance des mots de passe

    if(($password !== $confirm_password)){
        echo "<script>alert('Les mots de passe ne correspondent pas.');</script>";
    }
    else{

        try{
            //hasher le mot de passe
            $hashpassword = password_hash($password,PASSWORD_DEFAULT);

            //execution de la procedure
            $sql= "EXEC dbo.AjouterUtilisateur @Nom_utilisateur = :Nom_utlisateur,
                @Prenom_utilisateur = :Prenom_utilisateur,
                @Email_utilisateur = :Email_utlisateur,
                @MDP_utilisateur = :MDP_utilisateur
            ";
            $stmt = $conn->prepare($sql);

            //lier les parametres
            $stmt->bindParam(':Nom_utlisateur', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':Prenom_utilisateur', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':Email_utlisateur', $email, PDO::PARAM_STR);
            $stmt->bindParam(':MDP_utilisateur', $hashpassword, PDO::PARAM_STR);

            //Execution de la requete
            if($stmt->execute()){
                echo "<script>alert('Inscription réussie !');</script>";
                header("Location: http://localhost/Messages_App/Authentification/Vue/Login.php",true,301);
                exit();
            }
            else{
                echo "<script>alert('Erreur lors de l\'inscription : " . htmlspecialchars($e->getMessage()) . "');</script>";
            }
        }
        catch(PDOException $e){
            echo "<script>alert('Erreur lors de l\'inscription : " . htmlspecialchars($e->getMessage()) . "');</script>";
        }
        $conn = null;
    }
}
?>
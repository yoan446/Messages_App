<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../Controleur/Enregistrer.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Register.css">
    <title>Enregistrement</title>
</head>
<body>
    <div class="Big_register">
        <div class="img_signup">
            <img src="../Images/signup.jpg" alt="">
        </div>
        <div class="formulaire">
            <span>Sign up</span>
            <form action="./Register.php" method="post">
                <div>
                    <label for="nom">Nom:</label>
                    <input type="text" id="nom" name="nom" required>
                </div>

                <div>
                    <label for="prenom">Prénom:</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div>
                    <label for="confirm_password">Confirmer le mot de passe:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div>
                    <input type="submit" value="S'inscrire" name="submit">
                </div>

                <div>
                    <p>Déjà un compte ? <a href="./Login.php">Se connecter</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
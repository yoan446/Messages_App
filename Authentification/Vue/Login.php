<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("../Modele/Connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Connection</title>
</head>
<body>
    <div class="Big_login">
        <div class="img_singnin">
            <img src="../Images/signin.jpg" alt="log image" >
        </div>
        <div class="Formulaire">
            <span>Sign in</span>
            <form action="#" method="post">
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div>
                    <input type="submit" value="Se connecter" name="submit">
                </div>

                <div>
                    <p>Pas encore de compte ? <a href="./Register.php">S'inscrire</a></p>
                </div>
            </form>
        </div> 
    </div>
</body>
</html>
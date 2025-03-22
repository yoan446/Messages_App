<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection a la BDD
include('../Controlleur/charger_contact.php');
include('../Controlleur/Ajouter_message.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Message.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Messagerie</title>
</head>
<body>
    <div class="tete">
        <span>Chat Box</span>
        <h3 id="nom_recepteur">Destinataire</h3>
        <form action="" method="post">
            <button type="submit"><img src="../Images/exit.png" alt=""></button>
        </form>
    </div>
    <div class="chat_box">
        <div class="discussion">
            <input type="text" name="recherche" id="rechercche" placeholder="Rechercher un contact...">

            <?php foreach ($contacts as $contact) { ?>
                <a href="#" id="charge">
                    <div class="contact" onclick="charger(this)">
                        <img src="../Images/user.png" alt="">
                        <span class="id_recepteur"><?= $contact['Nom_utilisateur'] . ' ' . $contact['Prenom_utilisateur'] ?></span>
                        <h6 class="id_r"><?= $contact['ID_utilisateur'] ?></h6>
                    </div>
                </a>
            <?php } ?>

        </div>

        <div class="messages">
            <div class="chat">
                <div class="envoyeur">
                    <div class="media"><img src="" alt=""></div>
                    <span>Comment vous allez?</span>
                </div>

                <div class="receveur">
                    <span>Je vais bien et vous?</span>
                </div>
                
            </div>

            <div class="saisie">
                <form action="Message.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_rf" id="id_rf">
                    <input type="file" name="fichier" id="fichier" accept=".jpg, .jpeg, .png, .gif, .mp4, .webm">
                    <input type="text" name="ecrire" id="ecrire">
                    <input type="submit" name="envoie" value="" style="background-image: url('../Images/paperplane.png'); background-size: cover; width: 40px; height: 40px; border: none; background-color:transparent;">
                    </form>
            </div>

        </div>
    </div>  
</body>
<script src="./Message.js"></script>
</html>

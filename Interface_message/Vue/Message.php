<?php
// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection a la BDD
include('../Controlleur/charger_contact.php');
include('../Controlleur/Envoie_message.php')
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
                    <span>        </span>
                </div>

                <div class="receveur">
                    <span></span>
                </div>
                
            </div>

           <form action="Message.php" method="post" class="formilaire">
                <input type="hidden" name="copie_id" id="copie_id">
                <input type="text" name="message" id="message">
                <input type="submit" value="Envoyer" id="envoyer" name="envoyer">
           </form>

        </div>
    </div>  
</body>
<script src="./Message.js"></script>
</html>

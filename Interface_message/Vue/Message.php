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
        <h3 id="nom_recepteur">Richard Bona</h3>
        <form action="" method="post">
            <button type="submit"><img src="../Images/exit.png" alt=""></button>
        </form>
    </div>
    <div class="chat_box">
        <div class="discussion">
            <input type="text" name="recherche" id="rechercche" placeholder="Rechercher un contact...">

            <div class="contact">
                <img src="../Images/user.png" alt="">
                <span id="id_recepteur">Richard Bona</span>
            </div>
        </div>

        <div class="messages">
            <div class="chat">
                <div class="envoyeur">
                    <span>Comment vous allez?</span>
                </div>

                <div class="receveur">
                    <span>Je vais bien et vous?</span>
                </div>
                
            </div>

            <div class="saisie">
                <form action="#" method="post">
                    <input type="text" name="ecrire" id="ecrire">
                    <button type="submit"><img src="../Images/paperplane.png" alt=""></button>
                </form>
            </div>

        </div>
    </div>  
</body>
</html>
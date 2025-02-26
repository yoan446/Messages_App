document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.saisie form'); // Sélectionne le formulaire
    const inputText = document.getElementById('ecrire'); // Sélectionne le champ de saisie
    const inputFile = document.getElementById('fichier'); // Sélectionne le champ de fichier
    const messagesDiv = document.querySelector('.messages .chat'); // Sélectionne la div pour les messages

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const messageText = inputText.value; // Récupère le texte du champ de saisie
        const file = inputFile.files[0]; // Récupère le fichier sélectionné

        if (messageText.trim() !== "" || file) { // Vérifie que le message ou le fichier n'est pas vide
            const messageDiv = document.createElement('div'); // Crée un nouvel élément div pour le message
            messageDiv.classList.add('envoyeur'); // Ajoute la classe 'envoyeur'

            if (messageText.trim() !== "") {
                const textSpan = document.createElement('span');
                textSpan.textContent = messageText;
                messageDiv.appendChild(textSpan);
            }

            if (file) {
                const fileType = file.type.split('/')[0];
                if (fileType === 'image') {
                    const image = document.createElement('img');
                    image.src = URL.createObjectURL(file);
                    image.width = 200; // Ajustez la largeur de l'image
                    const mediaDiv = document.createElement('div');
                    mediaDiv.classList.add('media');
                    mediaDiv.appendChild(image);
                    messageDiv.appendChild(mediaDiv);
                } else if (fileType === 'video') {
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.width = 200; // Ajustez la largeur de la vidéo
                    video.controls = true; // Active les contrôles de la vidéo
                    const mediaDiv = document.createElement('div');
                    mediaDiv.classList.add('media');
                    mediaDiv.appendChild(video);
                    messageDiv.appendChild(mediaDiv);
                }
            }

            messagesDiv.appendChild(messageDiv); // Ajoute le nouveau message à la div des messages
            inputText.value = ""; // Réinitialise le champ de saisie
            inputFile.value = ""; // Réinitialise le champ de fichier
        }
    });
});

// Fonction charger reste inchangée
function charger(){
    let id = document.getElementById('id_r').textContent;
    let nom_recepteurs = document.getElementById('id_recepteur').textContent;
    document.getElementById('nom_recepteur').textContent = nom_recepteurs;
    document.getElementById('id_rf').value = id;
}

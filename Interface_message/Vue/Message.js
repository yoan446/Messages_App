document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.formilaire'); // Sélectionne le formulaire
    const inputText = document.getElementById('message'); // Sélectionne le champ de saisie
    const inputHidden = document.getElementById('copie_id'); // Sélectionne le champ caché
    const messagesDiv = document.querySelector('.messages .chat'); // Sélectionne la div pour les messages

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const formData = new FormData(form); // Crée un objet FormData à partir du formulaire

        fetch('../Controlleur/Envoie_Message.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Crée un nouvel élément div pour le message
            const messageDiv = document.createElement('div'); 
            messageDiv.classList.add('envoyeur'); // Ajoute la classe 'envoyeur'
            messageDiv.innerHTML = `<span>${inputText.value}</span>`; // Affiche le contenu du message
            messagesDiv.appendChild(messageDiv); // Ajoute le nouveau message à la div des messages

            // Réinitialise les champs
            inputText.value = ""; 
            inputHidden.value = ""; 
        })
        .catch(error => console.error('Erreur:', error));
    });
});

// Fonction charger reste inchangée
function charger(element){
    let id = element.querySelector('.id_r').textContent;
    let nom_recepteur = element.querySelector('.id_recepteur').textContent;
    
    document.getElementById('nom_recepteur').textContent = nom_recepteur;
    document.getElementById('copie_id').value = id;
}


// Fonction charger reste inchangée
function charger(element){
    let id = element.querySelector('.id_r').textContent;
    let nom_recepteur = element.querySelector('.id_recepteur').textContent;
    
    document.getElementById('nom_recepteur').textContent = nom_recepteur;
    document.getElementById('copie_id').value = id;
}




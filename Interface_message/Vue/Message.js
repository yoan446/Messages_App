document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.saisie form'); // Sélectionne le formulaire
    const input = document.getElementById('ecrire'); // Sélectionne le champ de saisie
    const messagesDiv = document.querySelector('.messages .chat'); // Sélectionne la div pour les messages

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        const messageText = input.value; // Récupère le texte du champ de saisie
        if (messageText.trim() !== "") { // Vérifie que le message n'est pas vide
            const messageDiv = document.createElement('div'); // Crée un nouvel élément div pour le message
            messageDiv.classList.add('envoyeur'); // Ajoute la classe 'envoyeur'
            messageDiv.innerHTML = `<span>${messageText}</span>`; // Ajoute le texte du message

            messagesDiv.appendChild(messageDiv); // Ajoute le nouveau message à la div des messages
            input.value = ""; // Réinitialise le champ de saisie
        }
    });
});


function charger(){
    let id = document.getElementById('id_r').textContent;
    let nom_recepteurs = document.getElementById('id_recepteur').textContent;
    document.getElementById('nom_recepteur').textContent = nom_recepteurs;
    document.getElementById('id_rf').value = id;
}
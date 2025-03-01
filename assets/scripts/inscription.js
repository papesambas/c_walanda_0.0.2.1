document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez le bouton "Rechercher sans soumettre"
    const searchButton = document.querySelector('[data-action="search-without-submit"]');

    const resultsContainer = document.querySelector('#search-results');

    if (!resultsContainer) {
        console.error("L'élément #search-results est introuvable dans le DOM !");
        return;
    }


    if (searchButton) {
        // Récupérez l'URL depuis l'attribut data-url
        const searchUrl = searchButton.getAttribute('data-url');

        // Ajoutez un écouteur d'événement pour le clic
        searchButton.addEventListener('click', function () {
            // Récupérez les données du formulaire
            const form = document.querySelector('form');
            const formData = new FormData(form);

            // Envoyez une requête AJAX pour effectuer la recherche
            fetch(searchUrl, {
                method: 'POST', // ❌ GET ne permet pas d'envoyer un body, utilise POST
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // Indique que c'est une requête AJAX
                },
            })
                .then(response => response.text()) // Récupérez la réponse HTML
                .then(html => {
                    // Remplacez le contenu de la page avec la nouvelle réponse
                    document.querySelector('#search-results').innerHTML = html;
                })
                .catch(error => {
                    console.error('Erreur lors de la recherche :', error);
                });
        });
    }
});

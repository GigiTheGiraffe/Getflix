// films a exclure de la requete pour ne pas les voir, on en rajoute 20 quand le user veut voir 20 autres films
let offset = 0;
// Rajout des 20 films à passer dans la db dans la requete
const limit = 20;
// Booleen pour savoir si loading est deja entrain de travailler
let loading = false;
// Genre du film 
let currentGenre = document.getElementById('genre').value;
// Endroit ou append les films
const moviesContainer = document.getElementById('propal');
// Ensemble pour garder trace des ID de films affichés
let displayedMovieTitle = new Set();
// Est ce qu'il faut sort?
let sort = null;
let countError = 0;
async function loadMovies() {
    if (loading) return;
    if(countError !== 0) {
        alert('Il y a une erreur avec le chargement. Veuiller réessayer plus tard. Nous nous excusons du dérangement.')
        window.removeEventListener('scroll', handleInfiniteScroll);
        return; 
    }
    loading = true;
    // Rajoute les donnees dans la methode POST, donc création du corps de la demande
    const params = new URLSearchParams();
    // Ajout des donnees offset
    params.append('offset', offset);
    // Ajout du genre si il existe dans la requete 
    if (currentGenre) {
        params.append('genre', currentGenre);
    }
    // Ajout du sorting si il existe
    if (sort) {
        params.append('sort', sort);
    }
    try {
        // On recupere la reponse avec le php
        const response = await fetch('../../scripts/show_movies.php', {
            method: 'POST',
            body: params,
        });
        // Récupère les films depuis la réponse JSON
        const moviesData = await response.json();
         // Si aucun film n'est renvoyé, arrêtez le chargement et les demandes api inutile
         if (moviesData.length === 0) {
            // Désactiver l'écouteur d'événements de défilement
            window.removeEventListener('scroll', handleInfiniteScroll);
            return;
        }

        // Met à jour l'offset pour la prochaine requête
        offset += limit;
        // On va iterer dans chaque film renvoyé
        moviesData.forEach(film => {    
            // Vérifie si le nom du film a déjà été affiché
            if (!displayedMovieTitle.has(film.title)) {
                displayedMovieTitle.add(film.title); // Ajoute le nom du film à l'ensemble
                const movieItem = document.createElement('li');
                movieItem.className = 'movie-item';
                // Ajoute juste le genre de la recherche à afficher
                let genre
                if (currentGenre!== null) {
                    genre = currentGenre;
                } else {
                    genre = film.genre_1;
                }
                movieItem.innerHTML = `
                    <a href="fiche_film.php?id=` + film.id + `&source=page.php">
                        <img class="poster" loading="lazy" src="${film.poster_path}" alt="poster of ${film.title}">
                    </a>
                    <div class="text-container">
                        <h5 class="texte">${film.title}</h5>
                        <h5 class="texte">${genre}</h5>
                    </div>
                `;
                moviesContainer.appendChild(movieItem); // Ajoute l'élément à la liste
            }
        });
    } catch (error) {
        console.error('Error loading movies:', error);
        countError++;
    } finally {
        loading = false;
        checkAndLoadMoreMovies();
    }
}


// Charger plus de films lorsque l'utilisateur fait défiler la page // changer pour que ce soit plus fonctionnel genre si l'utilisateur voit le dernier film ou autre
function handleInfiniteScroll() {
    const endOfPage = window.innerHeight + window.scrollY >= document.body.offsetHeight - 100;
    if (endOfPage && !loading) {
        loadMovies();
    }
}
// Si l'ecran est trop grand et donc qu'il y a plus de place que pour 20 films, il faut encore en charger 20 pour que le user puisse scroll
function checkAndLoadMoreMovies() {
    const endOfPageFirst = window.innerHeight >= document.body.offsetHeight;
    if (endOfPageFirst && !loading) {
        loadMovies();
    }
}
// Si le genre change, on remet le offset a 0, on met la liste des films deja affichés a 0, on met la liste de film a 0 puis on charge 20 films
function changeGenre() {
    currentGenre = document.getElementById('genre').value;
    countError = 0;
    offset = 0;
    displayedMovieTitle.clear();
    moviesContainer.innerHTML = '';
    loadMovies();
    /*window.removeEventListener('scroll', handleInfiniteScroll);
    // Reactiver l'ecouteur d'evenements de défilement psq j'ai l'impression qu'il ne se met pas tout le monde
    window.addEventListener('scroll', handleInfiniteScroll); */
}
// Rajoute ecouteur pour quand on change la valeur du bouton select genre
document.getElementById('genre').addEventListener('change', changeGenre);
// Si le genre change, on remet le offset a 0, on met la liste des films deja affichés a 0, on met la liste de film a 0 puis on charge 20 films
function changeSort() {
    sort = document.getElementById('sort').value;
    countError = 0;
    offset = 0;
    displayedMovieTitle.clear();
    moviesContainer.innerHTML = '';
    loadMovies();
    window.removeEventListener('scroll', handleInfiniteScroll);
    // Reactiver l'ecouteur d'evenements de défilement psq j'ai l'impression qu'il ne se met pas tout le monde
    window.addEventListener('scroll', handleInfiniteScroll);
}
// Rajoute ecouteur pour quand on change la valeur du bouton select sort
document.getElementById('sort').addEventListener('change', changeSort);
// Charger les premiers films
loadMovies();
// Quand on scroll, on verifie si infinite scroll est necessaire
window.addEventListener('scroll', handleInfiniteScroll);
// Verifier et charger plus de films si necessaire apres le chargement initial
window.addEventListener('load', checkAndLoadMoreMovies);
// Remet les boutons select à 0 
window.addEventListener('beforeunload', function() {
    document.getElementById('genre').selectedIndex = 0;
    document.getElementById('sort').selectedIndex = 0;
});
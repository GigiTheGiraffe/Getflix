// films a exclure de la requete pour ne pas les voir, on en rajoute 20 quand le user veut voir 20 autres films
let offset = 0;
// Rajout des 20 films à passer dans la db dans la requete
const limit = 20;
// Booleen pour savoir si loading est deja entrain de travailler
let loading = false;
// Genre du film 
//  CHANGER CURRENTGENRE QUAND ON SAIT COMMENT L OBTENIR
let currentGenre = null;
// Endroit ou append les films
const moviesContainer = document.getElementById('propal');
// Ensemble pour garder trace des ID de films affichés
let displayedMovieIds = new Set();
async function loadMovies() {
    if (loading) return;
    loading = true;
    // Rajoute les donnees dans la methode POST, donc création du corps de la demande
    const params = new URLSearchParams();
    // Ajout des donnees offset
    params.append('offset', offset);
    // Ajout du genre si il existe dans la requete 
    //  CHANGER CURRENTGENRE QUAND ON SAIT COMMENT L OBTENIR
    if (currentGenre) {
        params.append('genre', currentGenre);
    }

    try {
        // On recupere la reponse avec le php
        const response = await fetch('show_movies.php', {
            method: 'POST',
            body: params,
        });
        // Récupère les films depuis la réponse JSON
        const moviesData = await response.json();
        // Met à jour l'offset pour la prochaine requête
        offset += limit;
        // On va iterer dans chaque film renvoyé
        moviesData.forEach(film => {
            // Vérifie si l'ID du film a déjà été affiché
            if (!displayedMovieIds.has(film.title)) {
                displayedMovieIds.add(film.title); // Ajoute l'ID à l'ensemble
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
                    <a href="#">
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
    } finally {
        loading = false;
    }
}

// Charger les premiers films
loadMovies();

// Charger plus de films lorsque l'utilisateur fait défiler la page
window.addEventListener('scroll', () => {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100 && !loading) {
        loadMovies();
    }
});
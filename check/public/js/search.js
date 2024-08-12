const searchClient = algoliasearch('D4UHBX61MP', '0c9a89a5b1b3bd417549690a51225551');

const search = instantsearch({
    indexName: 'movies_list',
    searchClient,
});

search.addWidgets([
    instantsearch.widgets.searchBox({
        container: '#searchbox',
        placeholder: 'Search for movies...',
        showReset: false,
        showSubmit: false
    }),

    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            item: `
            <article class="hit">
                <a href="fiche_film.php?id={{id}}&source=page.php" class="hit-link">
                    <img src="{{poster_path}}" alt="{{title}}">
                    <h4 class="hit-name">{{title}}</h4>
                </a>
            </article>
            `,
            empty: '<p class="no-results">No results found.</p>',
        },
    })
]);

search.on('render', () => {
    const query = search.helper.state.query;
    const resultsContainer = document.getElementById('hits');
    if (!query) {
        resultsContainer.style.display = 'none'; // Masquer les résultats si la barre de recherche est vide
    } else {
        resultsContainer.style.display = 'block'; // Afficher les résultats si la barre de recherche a une valeur
    }
});
// Lorsqu'on clique en dehors de la zone de hit ou de la searchbox, on cache la zone de hit //FONCTIONNE PAS
document.addEventListener('click', (event) => {
    const searchBox = document.getElementById('searchbox');
    const resultsContainer = document.getElementById('hits');
    if (!searchBox.contains(event.target) && !resultsContainer.contains(event.target)) {
        resultsContainer.style.display = 'none';
    }
    if (searchBox.contains(event.target)) {
        resultsContainer.style.display = 'block';
    }
});

search.start();
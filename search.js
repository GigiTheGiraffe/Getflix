const searchClient = algoliasearch('D4UHBX61MP', '0c9a89a5b1b3bd417549690a51225551');

const search = instantsearch({
    indexName: 'movies_list',
    searchClient,
});

search.addWidgets([
    instantsearch.widgets.searchBox({
        container: '#searchbox',
        placeholder: 'Search for movies...',
        showReset: false, // Désactiver le bouton de réinitialisation
        showSubmit: false // Désactiver la soumission si tu veux enlever la loupe
    }),

    instantsearch.widgets.infiniteHits({
        container: '#hits',
        templates: {
            item: `
            <article class="hit">
                <a href="{{trailer_link}}" class="hit-link">
                    <img src="{{poster_path}}" alt="{{title}}">
                    <h4 class="hit-name">{{title}}</h4>
                </a>
            </article>
            `,
            empty: '<p class="no-results">No results found.</p>',
            showMoreText: 'Show more',
            loadMoreText: 'Loading more...'
        },
        showMore: true,
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

search.start();


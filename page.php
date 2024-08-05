<?php
include 'show_movies.php';
$randomnFilmArray = getRandomnFilm();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesmovies.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@8.4.0/themes/reset-min.css" integrity="sha256-D+cGTF0LVHjuEf+CDRkHeNw/KTHPg47t1AA/qmzxgtA=" crossorigin="anonymous">
    <title>Movies</title>
</head>

<body>
    <main>
        <section id="movie1">
            <article id="infos">
                <h1 class="titres">Movies</h1>
                <h6 class="titreside"></h6> <!--number of movies-->
            </article>
            <div class="ais-InstantSearch">
                <div class="right-panel">
                    <div id="searchbox"></div>
                    <div id="hits"></div>
                </div>
            </div>

            <article id="lecture">
                <button class="butviolet">filter</button>
                <button class="butblanc">a-z</button>
            </article>
        </section>
        <hr class="purple-divider">
        <section id="movie2">
            <ul id="propal">
                <?php foreach ($randomnFilmArray as $film) : ?>
                    <li class="movie-item">
                        <a href="#">
                            <img class="poster" loading="lazy" src="<?= $film['poster_path'] ?>" width="500" height="500" alt="<?= "poster of " . $film['title'] ?>">
                        </a>
                        <div class="text-container">
                            <h5 class="texte"><?=$film['title'] ?></h5>
                            <h5 class="texte"><?=$film['genre_1'] ?></h5>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.24.0/dist/algoliasearch-lite.umd.js" integrity="sha256-b2n6oSgG4C1stMT/yc/ChGszs9EY/Mhs6oltEjQbFCQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.73.3/dist/instantsearch.production.min.js" integrity="sha256-c10z4sC06kjfoYbw7kBfYpe/CxFqjql/Jqv9yAMexsk=" crossorigin="anonymous"></script>
    <script src="search.js"></script>
</body>

</html>
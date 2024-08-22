<?php
include("../scripts/user_session_check.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesmovies.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@8.4.0/themes/reset-min.css" integrity="sha256-D+cGTF0LVHjuEf+CDRkHeNw/KTHPg47t1AA/qmzxgtA=" crossorigin="anonymous">
    <link href="css/nav.css" rel="stylesheet">
    <title>Movies</title>
</head>
<body>
<navbar>
    <section class="navB">
        <article class="logo">
            <img src="css/logo.png" alt="logo Flouflix" width="60px">
        </article>
        <article class="lien">
            <ul>
                <li>
                    <a  class="home" href="../../index.php">Home</a>
                </li>
                <li>
                    <a class="trend" href="tendance.php">Trending</a>
                </li>
                <li>
                    <a class="movies" href="movies.php">Movies</a>
                </li>                
                <li>
                    <a href="profile.php" class="butvio profil" name="logout">My Profil</a>
                </li>
                <li>
                    <form method="POST" action="../scripts/logout.php" name="logout">
                        <button class="butviolets logout" name="logout">Logout</button>
                    </form>
                </li>
            </ul>
        </article>
    </section>
</navbar>
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
<!-- Bouton de genre-->
                <select class="butviolet" id="genre">
                    <option value="all" selected="selected">All</option>
                    <option value="action">Action</option>
                    <option value="adventure">Adventure</option>
                    <option value="animation">Animation</option>
                    <option value="comedy">Comedy</option>
                    <option value="crime">Crime</option>
                    <option value="documentary">Documentary</option>
                    <option value="drama">Drama</option>
                    <option value="family">Family</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="history">History</option>
                    <option value="horror">Horror</option>
                    <option value="music">Music</option>
                    <option value="mystery">Mystery</option>
                    <option value="romance">Romance</option>
                    <option value="science fiction">Science Fiction</option>
                    <option value="tv movie">TV Movie</option>
                    <option value="thriller">Thriller</option>
                    <option value="war">War</option>
                    <option value="western">Western</option>
                </select>
                <select class="butblanc" id="sort">
                    <option value="" selected="selected">Sort by date</option>
                    <option value="asc">Oldest first</option>
                    <option value="desc">Newest first</option>
                </select>
            </article>
        </section>
        <hr class="purple-divider">
        <section id="movie2">
            <ul id="propal">
            </ul>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.24.0/dist/algoliasearch-lite.umd.js" integrity="sha256-b2n6oSgG4C1stMT/yc/ChGszs9EY/Mhs6oltEjQbFCQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.73.3/dist/instantsearch.production.min.js" integrity="sha256-c10z4sC06kjfoYbw7kBfYpe/CxFqjql/Jqv9yAMexsk=" crossorigin="anonymous"></script>
    <script src="js/search.js"></script>
    <script src="js/page.js"></script>
</body>

</html>
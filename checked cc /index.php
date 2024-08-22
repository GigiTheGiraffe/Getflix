<?php
include_once 'config/config.php';
include 'recommendation.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlouFlix</title>
    <link rel="stylesheet" href="styleshome.css">
    <link href="nav.css" rel="stylesheet">
</head>
<body>
<navbar>
        <section class="navB">
            <article class="logo">
                <img src="logo.png" alt="logo Flouflix" width="60px">
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
                        <button href="profile.php" class="butvio profil" name="logout">My Profil</button>
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
        <hr class="purple-divider">
        <section id="partitexte">
            <article>
                <h1 class="titres">Your favorite movie <br> is already here with&nbsp;us.</h1>
            </article>
            <article id="bloc">
                <h5 class="texte">
                    Welcome to Getflix
                    Getflix is your new gateway to&nbsp;a&nbsp;world of&nbsp;limitless&nbsp;entertainment. 
                    <br>Designed to cater to the needs of movie buffs and series enthusiasts, 
                    Getflix offers you an exceptional streaming experience, wherever you are and at&nbsp;any&nbsp;time.</h5>
                <button class="butviolet">Watch Now !</button>
            </article>
            <hr class="purple-divider">
        </section>
        <section id="partiproposition">
            <article>
                <h1 class="titres2">Now available on Flouflix</h1>
            </article> 
            <article id="blocresume">
                <ul class="movie-item2"> <!--image movie poster and over tittle movie-->
                    <?php foreach ($recommendations as $filmInfo) { ?>
                        <li><a href="https://flouflix.free.nf/public/fiche_film.php?id=<?= $filmInfo['id'] ?>&source=page.php"><img src="<?= $filmInfo['poster_path'] ?>" class="poster" alt="Poster of <?= $filmInfo['title'] ?>">
                                <h2 class="titres2"><?= $filmInfo['title'] ?></h2>
                            </a></li>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>
</body>
</html>

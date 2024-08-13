<?php
include_once 'config/config.php';
include 'recommendation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlouFlix</title>
    <link rel="stylesheet" href="styleshome.css">
</head>
<body>
<header>
    <ul class="navbar">
        <li><a href="default.asp"><img href="/login.html"></a></li>
        <li><a href="public/movies.php">Movies</a></li>
        <li><a href="public/tendance.php">Trend</a></li>
      </ul>
</header>
    <main>
        <hr class="purple-divider">
        <section id="partitexte">
            <article>
                <h1 class="titres">Your favorite movie <br> is already here with us.</h1>
            </article>
            <article id="bloc">
                <h5 class="texte">
                    Welcome to Getflix
                    Getflix is your new gateway to a world of limitless entertainment. 
                    <br>Designed to cater to the needs of movie buffs and series enthusiasts, 
                    Getflix offers you an exceptional streaming experience, wherever you are and at any time.</h5>
                <a href="public/login.php"class="butviolet">Regardez maintenant</a>
            </article>
            <hr class="purple-divider">
        </section>
        <section id="partiproposition">
            <article>
                <h1 class="titres2"> Now available on FlouFlix</h1>
            </article>
            <article id="blocresume">
                <ul class="movie-item2"> <!--image movie poster and over tittle movie-->
                    <?php foreach ($recommendations as $filmInfo) { ?>
                        <li><a href="https://flouflix.free.nf/public/fiche_film.php?id=<?= $filmInfo['id'] ?>&source=page.php"><img src="<?= $filmInfo['poster_path'] ?>" class="poster" alt="Poster of <?= $filmInfo['title'] ?>">
                                <h2 class="titres2 overlay-title"><?= $filmInfo['title'] ?></h2>
                            </a></li>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>
</body>
</html>

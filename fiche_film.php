<?php
include 'get_movie.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesfiche.css">
    <title>FlouFix</title>
</head>
<body>
    <main>
        <section id="part1">
            <article class="img_movie">
                <div class="gradient-overlay"></div><!--note -->
                <img src="<?= $movieInfo['backdrop_path'] ?>" class="backdrop" alt = "Shot taken from <?= $movieInfo['title'] ?>">  <!-- backdrop pass -->
                 <!-- carré noir effet fendu -->
            </article>
            <section id="info">
                <article class="info_film">
                    <h1 class="titres"><?= $movieInfo['title'] ?></h1> <!--nom de film -->
                    <h6 class="titreside"><?= substr($movieInfo['release_date'], 0, 4) ?></h6>  <!-- année  -->
                    <h6 class="titreside"><?= round($movieInfo['vote_average'], 1) ?>/10</h6> <!-- note  -->
                </article>
                <article id="lecture">
                    <button  class="butviolet">Watch</button>
                    <button class="butblanc" id="commentBtn">Comment</button>
                </article>
            </section>
        </section>
        <hr class="purple-divider">
        <!-- divider -->
        <section id="part3" >
            <article class="otherCom">
                <ul class="listCom">
                    <li><p class="com">feeffezfhziefizfz</p><p class="com">feeffezfhziefizfz</p><p class="com">feeffezfhziefizfz</p></li> <!--com1 -->
                    <li><p class="com">cafezfjzeofjzof</p><p class="com">feeffezfhziefizfz</p><p class="com">feeffezfhziefizfz</p></li> <!--com2 -->
                    <li><p class="com">cazejfozejofjzofzofjzpejfopzjfozj</p><p class="com">feeffezfhziefizfz</p><p class="com">feeffezfhziefizfz</p></li> <!--com3 -->
                </ul>
            </article>
            <article class="userCom">
                <form action="">
                    <div>
                        <textarea class="textarea" id="message" name="message" rows="4" cols="50" required></textarea>
                        <label input="message" class="comment">Give us your impression on this movie !<button class="butviolet" type="submit">Send</button></label> 
                    </div>
                </form>
            </article>
        </section>
        <section id="part2">
            <article id="resume">
                <h4 class="genres"><?= $movieInfo['genre_1'] ?></h4> <!--genre-->
                <h7 class="overview"><?= $movieInfo['overview'] ?></h7> <!--overview-->
            </article>
            <article id="suggestion">
                <h2 class="titres2">More like this</h2>
                <ul id="propal">
                    <?php foreach ($recommendations as $filmInfo) { ?> <!--image movie poster and over tittle movie-->
                        <li><a href="http://localhost/Getflix/fiche_film.php?title=<?= urlencode($filmInfo['title']) ?>&source=page.php"><img src="<?= $filmInfo['poster_path'] ?>" class="poster" alt="Poster of <?= $filmInfo['title'] ?>"><h2 class="titres2 overlay-title"><?= $filmInfo['title'] ?></h2></a></li>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>
    <script src="fiche_film.js"></script>
</body>
</html>
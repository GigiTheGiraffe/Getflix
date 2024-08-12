<?php
include '../scripts/get_movie.php';
include '../scripts/get_comments_film.php';
include '../scripts/submit_comment.php';
include '../scripts/user_session_check.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="css/stylesheet" href="stylesfiche.css">
    <title>FlouFix</title>
</head>

<body>
    <main>
    <a href="movies.php">Go back</a>
        <!--<a href="<?= $source ?>">Go back</a> <!-- STYLISER GO BACKKKKKKKKKKKKKKKKKKKKK -->
        <section id="part1">
            <article class="img_movie">
                <div class="gradient-overlay"></div><!--note -->
                <img src="<?= $movieInfo['backdrop_path'] ?>" class="backdrop" alt="Shot taken from <?= $movieInfo['title'] ?>">
            </article>
            <section id="info">
                <article class="info_film">
                    <h1 class="titres"><?= $movieInfo['title'] ?></h1>
                    <h6 class="titreside"><?= substr($movieInfo['release_date'], 0, 4) ?></h6>
                    <h6 class="titreside"><?= round($movieInfo['vote_average'], 1) ?>/10</h6>
                </article>
                <article id="lecture">
                    <button class="butviolet" id="trailerBtn">Watch</button>
                    <button class="butblanc" id="commentBtn">Comment</button>
                </article>
            </section>
        </section>
        <hr class="purple-divider">
        <section id="part4" class="hidden">
            <iframe width="100%" height="500px" src="https://www.youtube.com/embed/<?= explode('=', $movieInfo['trailer_link'])[1] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </section>
        <section id="part3" class="hidden">
            <article class="otherCom">
                <ul class="listCom">
                    <?php foreach ($comments as $comment) { ?>
                        <li>
                            <p class="com"><?= $comment['user'] ?></p>
                            <p class="com"><?= substr($comment['comment_date'], 0, 10) ?></p>
                            <p class="com"><?= $comment['content'] ?></p>
                        </li>
                    <?php } ?>
                </ul>
            </article>
            <article class="userCom">
                <form id="commentForm" method="post">
                    <label for="message" class="comment">Give us your impression on this movie!</label>
                    <textarea id="message" name="message" class="textarea" rows="4" cols="50" placeholder="Write your comment here..." required></textarea>
                    <button id="submit" class="butviolet" type="submit">Send</button>
                </form>
            </article>
        </section>
        <section id="part2">
            <article id="resume">
                <h4 class="genres"><?= $movieInfo['genre_1'] ?></h4>
                <h7 class="overview"><?= $movieInfo['overview'] ?></h7>
            </article>
            <article id="suggestion">
                <h2 class="titres2">More like this</h2>
                <ul id="propal">
                    <?php foreach ($recommendations as $filmInfo) { ?>
                        <li><a href="https://flouflix.free.nf/public/fiche_film.php?id=<?= $filmInfo['id'] ?>&source=page.php"><img src="<?= $filmInfo['poster_path'] ?>" class="poster" alt="Poster of <?= $filmInfo['title'] ?>">
                                <h2 class="titres2 overlay-title"><?= $filmInfo['title'] ?></h2>
                            </a></li>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>
    <script src="js/fiche_film.js"></script>
    <script src="js/comment-validation.js"></script>
</body>

</html>
<?php
// tendances.php
include('famous.php');
include('user_session_check.php');
$movies = array_slice($data['results'], 1, 9);
$firstMovie = $data['results'][0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tendanceStyle.css">
    <title>Tendances</title>
</head>
<body>
    <main>
        <section class="movie1">
            <article>
                <h1 class="titres">Tendances</h1>
                <hr class="purple-divider">
            </article>
            <section id="blocalaune">
                <aside id="infotendance">
                    <h4 class="texte title"><?php echo htmlspecialchars($firstMovie['title']); ?></h4>
                    <h5 class="texte genreid"><?php echo htmlspecialchars(getGenreName($firstMovie['genre_ids'][0])); ?></h5>
                    <h6 class="texte overview"><?php echo htmlspecialchars($firstMovie['overview']); ?></h6>
                </aside>
                <article class="backdrop">
                <a href="http://localhost/Getflix/check/fiche_film.php?id=<?=$firstMovie['id'] ?>&source=tendance.php">
                <img class="bdp" src="<?php echo 'https://image.tmdb.org/t/p/original' . $firstMovie['backdrop_path']; ?>" alt="Backdrop of <?php echo htmlspecialchars($firstMovie['title']); ?>">
                </a>
                </article>
        </section>x²
        </section>
        <section class="blocresume">
            <ul class="main-list">
                <?php foreach ($movies as $movie): ?>
                <li>
                    <a href="http://localhost/Getflix/check/fiche_film.php?id=<?= $movie['id'] ?>&source=tendance.php">
                    <img class="poster" src="<?php echo 'https://image.tmdb.org/t/p/original' . $movie['poster_path']; ?>" alt="Poster of <?php echo htmlspecialchars($movie['title']); ?>">
                    <h5 class="texte title"><?php echo htmlspecialchars($movie['title']); ?></h5>
                    <h5 class="texte genreid"><?php echo htmlspecialchars(getGenreName($movie['genre_ids'][0])); ?></h5>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>
</html>
<?php
// tendances.php
include('famous.php');
$movies = array_slice($data['results'], 1, 9);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Front/styles_tendances.css">
    <title>Tendances</title>
</head>
<body>
    <main>
        <section>
            <article>
                <h1 class="titres">Tendances</h1>
                <hr class="purple-divider">
            </article>
            <article id="blocalaune">
                <aside id="infotendance">fvvfvfv</aside>
                <img id="alaune">
            </article>
        </section>
        <section class="blocresume">
            <ul class="main-list">
                <?php foreach ($movies as $movie): ?>
                <li>
                    <ul>
                        <li></li>
                        <img class="poster" src="<?php echo 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']; ?>" alt="Poster of <?php echo htmlspecialchars($movie['title']); ?>">
                    </ul>
                    <ul>
                        <li><h5 class="texte title"><?php echo htmlspecialchars($movie['title']); ?></h5></li>
                        <li><h5 class="texte genreid"><?php echo htmlspecialchars(getGenreName($movie['genre_ids'][0])); ?></h5></li>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</body>
</html>

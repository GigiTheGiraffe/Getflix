<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlouFlix</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Barre de navigation -->
    <header>
        <nav>
            <div class="logo">FlouFix</div>
            <ul class="nav-links">
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Séries</a></li>
                <li><a href="#">Films</a></li>
                <li><a href="#">Nouveautés</a></li>
                <li><a href="#">Ma liste</a></li>
            </ul>
        </nav>
    </header>

    <!-- Contenu principal -->
    <main>
        <!-- Carrousel de thèmes -->
        <section class="carousel" aria-label="Carrousel de films populaires">
            <h2>Populaire</h2>
            <div class="carousel-inner">
                <article class="carousel-item"><img src="image1.jpg" alt="Image 1"></article>
                <article class="carousel-item"><img src="image2.jpg" alt="Image 2"></article>
                <article class="carousel-item"><img src="image3.jpg" alt="Image 3"></article>
                <!-- Ajouter d'autres éléments ici -->
            </div>
        </section>

        <section class="carousel" aria-label="Carrousel des nouveautés">
            <h2>Nouveautés</h2>
            <div class="carousel-inner">
                <article class="carousel-item"><img src="image4.jpg" alt="Image 4"></article>
                <article class="carousel-item"><img src="image5.jpg" alt="Image 5"></article>
                <article class="carousel-item"><img src="image6.jpg" alt="Image 6"></article>
                <!-- Ajouter d'autres éléments ici -->
            </div>
        </section>

        <!-- Ajouter d'autres sections de carrousels selon les thèmes -->
    </main>

    <script src="script.js"></script>
</body>
</html>

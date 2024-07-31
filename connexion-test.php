<?php
include("account_connection.php");
include("account_creation.php");
?>
<!DOCTYPE html>
<html lang="english">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<body>
    <main>
        <section id="log1">
            <article class="border">
                <h3 class="signin">Log in</h3>
                <!-- divider -->
                <form method="post">
                    <label class="texte" for="user">Nom de compte</label>
                    <input id="user" type="text" name="user">
                    <label class="texte" for="email">Adresse mail</label>
                    <input id="email" type="email" name="email">
                    <label class="texte" for="password">Mot de passe
                    <input id="password" type="password" name="password"></label>
                    <button type="submit" class="butviolet" id="check" name="check">Se connecter</button>
                </form>
            </article>
            <article class="border">
                <form method="post">
                    <h3 class="signin">Sign In</h3>
                    <!-- divider -->
                    <label class="texte" for="user">Nom de compte</label>
                    <input id="user" type="text" name="user">
                    <label class="texte" for="email">Adresse mail</label>
                    <input id="email" type="email" name="email">
                    <label class="texte" for="password">Mot de passe</label>
                    <input id="password" type="password" name="password">
                    <button class="butviolet" type="submit" id="subscribe" name="subscribe">Créer un compte</button>
                </form>
            </article>
        </section>
        <section id="log2">
            <article>
                <h1 class="titres">Maintenant disponible sur Getflix</h1>
                <!-- divider -->
            </article>
            <article>
                <ul>
                    <li>
                        <a href=""><img class="poster" src="" alt="">
                            <h5 id="hover" class="titres2"></h5>
                        </a>
                    </li>
                    <li>
                        <a href=""><img class="poster" src="" alt="">
                            <h5 id="hover" class="titres2"></h5>
                        </a>
                    </li>
                    <li>
                        <a href=""><img class="poster" src="" alt="">
                            <h5 id="hover" class="titres2"></h5>
                        </a>
                    </li>
                </ul>
            </article>
        </section>
    </main>
</body>

</html>
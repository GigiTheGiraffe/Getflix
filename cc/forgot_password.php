<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" href="stylesforgot.css">
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
        <section id="log1">
            <article class="border">
                <form class="form" action="send_reset_link.php" method="POST">
                    <h2 alt="reset password" class="titres">Reset Password</h2>
                    <hr class="purple-divider">
                    <label for="email"><p class="texte">Email of your Flouflix account :</p></label>
                    <input type="email" name="email" id="email" required>
                    <button class="butviolet" type="submit" name="reset">Send me a new link !</button>
                </form>
            </article>
        </section>
        <hr class="purple-divider">
    </main>
</body>
</html>
<?php
include("user_session_check.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot password</title>
    <link rel="stylesheet" href="stylesprofile.css">
    <link href="nav.css" rel="stylesheet">
</head>
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
<body>
    <main>
        <div class="container">
        <section id="log1">
            <article class="border">
                <div class="form">
                    <h2 class="titre">Username</h2>
                    <hr class="purple-divider">
                    <?php
echo "<p class='info_profil'>" . $_SESSION['user_name'] . "</p>";
?>
<h2 class="texte">Email address</h2>
<?php
echo "<p class='info_profil'>" . $_SESSION['user_email'] . "</p>";
?>
                </div>
            </article>
        </section>
        <section id="log1">
            <article class="border">
                <form action="send_reset_link.php" method="POST">
                    <h2 class="titre">Reset Password</h2>
                    <hr class="purple-divider">
                    <label for="email"><p class="texte">Email of your Flouflix account :</p></label>
                    <input type="email" name="email" id="email" required>
                    <button class="butviolet" type="submit" name="reset">Send me a new link !</button>
                </form>
            </article>
        </section>
    </div>
    </main>
</body>

</html>

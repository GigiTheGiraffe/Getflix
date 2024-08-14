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
</head>
<header>
    <ul class="navbar">
        <li><a href="default.asp"><img href="login.html" src="FlouFlixLogo.png"></a></li>
        <li><a class="but" href="login.html">Movies</a></li>
        <li><a class="but" href="login.html">Trend</a></li>
        <li class="butprofil"><a href="">My Profil</a></li>
        <li class="butdeco"><a href="">Déconnexion</a></li>          
      </ul>    
</header>  
<body>
    <main>
        <div class="container">
        <section id="log1">
            <article class="border">
                    <h2 class="texte">Username</h2>
                    <hr class="purple-divider">
                    <?php
echo "<p class='info_profil'>" . $_SESSION['user_name'] . "</p>";
?>
<h2 class="texte">Email address</h2>
<hr class="purple-divider">
<?php
echo "<p class='info_profil'>" . $_SESSION['user_email'] . "</p>";
?>
                </form>
            </article>
        </section>
        <section id="log1">
            <article class="border">
                <form action="send_reset_link.php" method="POST">
                    <h2 class="texte">Reset Password</h2>
                    <hr class="purple-divider">
                    <label for="email"><p class="texte">Email of your Flouflix account :</p></label>
                    <input type="email" name="email" id="email" required>
                    <button class="butblanc" type="submit" name="reset">Send me a new link !</button>
                </form>
            </article>
        </section>
    </div>
        <hr class="purple-divider">
    </main>
</body>

</html>

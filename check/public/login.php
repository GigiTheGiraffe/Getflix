<?php
session_start();
include("../scripts/account_creation.php");
include("../scripts/account_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleslogin.css">
    <title>Tendances</title>
</head>
<body>
<header>
    <ul class="navbar">
        <li><a href="default.asp"><img href="../index.php"></a></li>
        <li><a href="login.php">Movies</a></li>
        <li><a href="login.php">Trend</a></li>
        <li class="butprofil"><a href="login.php">My Profil</a></li>
      </ul>
</header>
    <main>
        <section id="log1">
            <article class="border">
                 <form method="POST"> 
                    <h2 class="texte">Log in</h2>
                    <hr class="purple-divider">
                        <div>
                            <label for="identifier"><p class="texte">Email or Username :</p></label>
                            <input type="text" id="identifier" name="identifier" required>
                        </div>
                        <div>
                            <label for="password"><p class="texte">Password :</p></label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <button class="butblanc" type="submit" name="check">Log in</button>
                        </div>
                </form>
            </article>
            <article class="border">
                <form method="POST">
                    <h2 class="texte">Sign in</h2>
                    <hr class="purple-divider">
                    <div>
                        <label for="username"><p class="texte">Username :</p></label>
                        <input type="text" id="username" name="user" required>
                    </div>
                    <div>
                        <label for="email"><p class="texte">Email :</p></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="password"><p class="texte">Password :</p></label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div>
                        <label for="confirm-password"><p class="texte">Confirm password :</p></label>
                        <input type="password" id="confirm-password" name="confirm_password" required>
                    </div>
                    <div class="boxcheck">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms"><p class="texte2">Accept terms and conditions</p></label>
                    </div>
                    <div>
                        <button class="butblanc" type="submit" name="subscribe">Subscribe</button>
                    </div>
                </form>
            </article>
        </section>
        <section>

        
        </section>
    </main>
</body>
</html>
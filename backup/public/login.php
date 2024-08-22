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
    <link href="css/nav.css" rel="stylesheet">
    <title>Tendances</title>
</head>
<body>
<navbar>
        <section class="navB">
            <article class="logo">
                <img src="css/logo.png" alt="logo Flouflix" width="60px">
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
                        <a href="profile.php" class="butvio profil" name="logout">My Profil</a>
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
                 <form method="POST"> 
                    <h2 class="titre">Log in</h2>
                    <hr class="purple-divider">
                        <div>
                            <label for="identifier"><p class="texte">Email or Username :</p></label>
                            <input type="text" id="identifier" name="identifier" required>
                        </div>
                        <div>
                            <label for="password"><p class="texte">Password :</p></label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="pass">
                            <button class="butviolet" type="submit" name="check">Log in</button>
                            <a href="forgot_password.php" class="texte2">Forgot password</a>
                        </div>
                </form>
            </article>
            <article class="border">
                <form method="POST">
                    <h2 class="titre">Sign in</h2>
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
                        <input class="check" type="checkbox" id="terms" name="terms" required>
                        <label for="terms"><p class="texte2">Accept terms and conditions</p></label>
                    </div>
                    <div class="sub">
                        <button class="butviolet" type="submit" name="subscribe">Subscribe</button>
                    </div>
                </form>
            </article>
        </section>
    </main>
</body>
</html>
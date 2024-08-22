<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>
</head>
<body>
    <section id="log1">
        <article class="border">
            <form action="update_password.php" method="POST">
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                <label class="texte" for="password">Enter a new password :</label>
                <input type="password" name="password" id="password" required>
                <button class="butviolet" type="submit" name="update">Confirm</button>
            </form>
        </article>
    </section>
</body>
</html>

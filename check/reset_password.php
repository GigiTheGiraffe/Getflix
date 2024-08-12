<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe</title>
</head>
<body>
    <form action="update_password.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        <label for="password">Entrez votre nouveau mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <button type="submit" name="update">Réinitialiser le mot de passe</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
</head>
<body>
    <form action="send_reset_link.php" method="POST">
        <label for="email">Entrez votre adresse email :</label>
        <input type="email" name="email" id="email" required>
        <button type="submit" name="reset">Envoyer le lien de réinitialisation</button>
    </form>
</body>
</html>

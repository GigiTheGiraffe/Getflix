<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Tendances</title>
</head>
<body>
    <main>
        <section class="">
            <article class="reset" style="border: 1px solid #000; padding: 20px; width: 300px; margin: 0 auto;">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo '<h2>Check your mailbox.</h2>
                          <p>A new link has been sent to you</p>
                          <p>to reset your password!</p>
                          <p>See you in a little bit.</p>';
                } else {
                    '<form action="" method="post">
                          <h2>Reset Password</h2>
                        <div>
                            <label for="identifier">Email of your Flouflix account:</label>
                            <input type="text" id="identifier" name="identifier" required>
                        </div>
                        <div>
                            <button type="submit">send me a new link !</button>
                        </div>
                    </form>';
                }
                ?>
            </article>
        </section>
        <section>

        <!-- yaura une autre propal de movie -->
        </section>
    </main>
</body>
</html>
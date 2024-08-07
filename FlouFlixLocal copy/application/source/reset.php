<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Reset password</title>
</head>
<body>
    <main>
        <section class="log" style="display: flex; gap: 5vh;">
            
            <article class="confirm">
                <form action="/reset-password" method="post" style="border: 1px solid #000; padding: 20px; width: 300px; margin: 0 auto;">
                    <h2>Confirm new password</h2>
                    <div>
                        <label for="username">New password :</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="email">Confirm password :</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <button type="submit">Reset password</button>
                    </div>
                </form>
            </article>
        </section>
        <section>
<!-- propal movies on hover -->
        
        </section>
    </main>
</body>
</html>
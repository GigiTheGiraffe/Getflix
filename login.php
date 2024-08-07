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
        <section class="log" style="display: flex; gap: 5vh;">
            <article class="login">
                 <form action="/login" method="post" style="border: 1px solid #000; padding: 20px; width: 300px; margin: 0 auto;"> <!--pour linstant ptit elements css dedans  -->
                    <h2>Log in</h2>
                        <div>
                            <label for="identifier">Email or Username :</label>
                            <input type="text" id="identifier" name="identifier" required>
                        </div>
                        <div>
                            <label for="password">Password :</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div>
                            <button type="submit">Log in</button>
                        </div>
                </form>
            </article>
            <article class="sign">
                <form action="/signup" method="post" style="border: 1px solid #000; padding: 20px; width: 300px; margin: 0 auto;">
                    <h2>Sign in</h2>
                    <div>
                        <label for="username">Username :</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="email">Email :</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="password">Password :</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div>
                        <label for="confirm-password">Confirm password :</label>
                        <input type="password" id="confirm-password" name="confirm_password" required>
                    </div>
                    <div>
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">Accept terms and conditions</label>
                    </div>
                    <div>
                        <button type="submit">Subscribe</button>
                    </div>
                </form>
            </article>
        </section>
        <section>

        
        </section>
    </main>
</body>
</html>
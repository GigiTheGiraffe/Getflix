<?php
include 'load_env.php';
include 'get_comments.php';
include 'get_users.php';
include 'delete.php';
include 'get_title_backoffice.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Backoffice Flouflix</title>
    <link href="backoffice-style.css" rel="stylesheet">
</head>

<body class="bg-secondary">
    <header>
        <!-- ajouter logo Flouflix -->
        <img src="" alt="Logo Flouflix">
        <h1>Flouflix Backoffice</h1>
    </header>
    <main>
        <section class="containerPerso">
            <nav>
                <a href="#users">
                    <h2>Users</h2>
                </a>
                <a href="#comments">
                    <h2>Comments</h2>
                </a>
            </nav>
            <div class="table-container switch" id="users">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th colspan="1">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenu de la table users -->
                        <?php
                        foreach ($resultMessage as $row) {
                        ?>
                            <tr>
                                <td><?= $row['user'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['role'] ?></td>
                                <td>
                                    <form method="post"><button type="submit" name="deleteUser" class="btn" value="<?= $row['id'] ?>">Delete</button></form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="table-container switch" id="comments">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th colspan="1">Comment</th>
                            <th>Date</th>
                            <th>Movie</th>
                            <th colspan="1">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenu de la table comments -->
                        <?php
                        foreach ($commentsMessage as $row) {
                        ?>
                                <tr>
                                    <td><?= $row['user'] ?></td>
                                    <td><?= $row['content'] ?></td>
                                    <td><?= $row['comment_date'] ?></td>
                                    <td><?= getTitle($row['movie_DB_Id'])?></td>
                                    <td>
                                        <form method="post"><button type="submit" name="deleteComment" class="btn" value="<?= $row['comment_id'] ?>">Supp</button></form>
                                    </td>
                                </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <script src="backoffice.js" crossorigin="anonymous"></script>
</body>

</html>
<?php
include_once 'load_env.php';
include 'import_page.php';
include 'insert_db.php';

// Boucle pour obtenir la réponse JSON de 50 pages, soit 1000 film.
for ($i = 1; $i < 51; $i++) {
$responses = importPages($i);
insertIntoDb($responses);
}
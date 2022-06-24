<?php

require_once __DIR__ . '/../vendor/autoload.php';


use AR\Manga\Manga;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$view = new Environment($loader);

echo $view->render('crud.twig');

$manga = new Manga();




if (isset($_GET["save_id"]) && isset($_GET["save_title"])) {
    $manga->setId($_GET["save_id"]);
    $manga->setTitle($_GET["save_title"]);

    $manga->save();
}

$mangas = $manga->getAll();
foreach ($mangas as $row) {
    echo $view->render('index.twig', ['id' => $row[0], 'title' => $row[1]]);
}




echo 'Все записи:';
if (isset($_GET["delete_id"])) {
    $manga->setId($_GET["delete_id"]);
    $manga->delete();
}

if (isset($_GET["id"])) {
    $search_id = $_GET["id"];
    $db_results = $manga->findById($search_id);
    echo '-Результат поиска по id:';
    echo $view->render('index.twig', ['id' => $db_results[0], 'title' => $db_results[1]]);
}

if (isset($_GET["name"])) {
    $search_surname = $_GET["name"];
    $db_results = $manga->findByName($search_surname);
    echo '-Результат поиска по имени:';
    foreach ($db_results as $row) {
        echo $view->render('index.twig', ['id' => $row[0], 'title' => $row[1]]);
    }
}

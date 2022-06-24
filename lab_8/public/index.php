<?php

require_once __DIR__ . '/../vendor/autoload.php';


use AR\Manga\Manga;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$view = new Environment($loader);

echo $view->render('crud.twig.html');

$manga = new Manga();


if (isset($_GET["save_id"]) && isset($_GET["save_title"]) && isset($_GET["save_author"])) {
    $manga->setId($_GET["save_id"]);
    $manga->setTitle($_GET["save_title"]);
    $manga->setAuthor($_GET["save_author"]);

    $manga->save();
}

$mangas = $manga->getAll();
echo 'Все записи:';
foreach ($mangas as $row) {

    echo $view->render('index.twig.html', ['id' => $row[0], 'title' => $row[1], 'author' => $row[2]]);
}
echo '-------------';
//
//if (isset($_GET["delete_id"])) {
//    $names->setId($_GET["delete_id"]);
//    $names->delete();
//}
//

//
//if (isset($_GET["id"])) {
//    $search_id = $_GET["id"];
//    $db_results = $names->findById($search_id);
//    echo '-Результат поиска по id:';
//    echo $view->render('index.twig', ['id' => $db_results[0], 'surname' => $db_results[1], 'name' => $db_results[2]]);
//}
//
//if (isset($_GET["surname"])) {
//    $search_surname = $_GET["surname"];
//    $db_results = $names->findBySurname($search_surname);
//    echo '-Результат поиска по фамилии:';
//    foreach ($db_results as $row) {
//        echo $view->render('index.twig', ['id' => $row[0], 'surname' => $row[1], 'name' => $row[2]]);
//    }
//}

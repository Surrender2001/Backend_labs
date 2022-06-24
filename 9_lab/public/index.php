<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Datamapper\EntryRepository;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$view = new Environment($loader);

echo $view->render('forms.twig');

$names = new EntryRepository();

$db_results = $names->getAll();
echo 'Все записи:';
echo $view->render('index.twig', ['db_results' => $db_results]);

if (isset($_GET["save_id"]) && isset($_GET["save_surname"]) && isset($_GET["save_name"])) {
    $names->save($_GET["save_id"], $_GET["save_name"], $_GET["save_surname"]);
}

if (isset($_GET["delete_id"])) {
    $names->delete($_GET["delete_id"]);
}

if (isset($_GET["id"])) {
    $search_id = $_GET["id"];
    echo '-Результат поиска по id:';
    $db_results = $names->findById($search_id);
    echo $view->render('index.twig', ['db_results' => $db_results]);
}

if (isset($_GET["surname"])) {
    $search_surname = $_GET["surname"];
    $db_results = $names->findBySurname($search_surname);
    echo '-Результат поиска по фамилии:';
    echo $view->render('index.twig', ['db_results' => $db_results]);
}

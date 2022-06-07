<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

$user = 'anime';
$pass = 'ismylife';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(dirname(__DIR__) . '/src/templates');
$view = new Environment($loader);

echo $view->render('index.twig');

if (isset($_GET["name"])) {
    $name = $_GET["name"];
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=workers', $user, $pass);
        $query = $dbh->prepare("insert into anime (name) values (\"$name\")");
        $query->execute();
        $rows = $dbh->query('SELECT * from anime');
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    foreach($rows as $row) {
        echo nl2br($row['id'] . ' ' .$row['name'] . "\r\n");
    }
} else {
    echo 'Введите значения';
}
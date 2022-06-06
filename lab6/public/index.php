<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use middle_matryoshka\ClassB;
use middle_matryoshka\small_matryoshka\ClassC;

$loader = new FilesystemLoader(dirname(__DIR__) . '/src/templates');
$view = new Environment($loader);
$log = new Logger('logger1');
$log->pushHandler(new StreamHandler(dirname(__DIR__) . '/src/index.log'));

$classA= new ClassA();
$classB = new ClassB();
$classC = new ClassC();
echo $view->render('index.twig', ['classA' => $classA->printclassA(), 'classB' => $classB->printclassB(), 'classC' => $classC->printclassC()]);
$log->info('Cheto proishodit:)');
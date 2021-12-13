<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Манга</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">

<?php

require_once "../vendor/autoload.php";
require_once "../framework/autoload.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/MainController.php";
require_once "../controllers/Controller404.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/MangaTitleCreateController.php";
require_once "../controllers/MangaTitleDeleteController.php";
require_once "../controllers/MangaTitleUpdateController.php";
require_once "../controllers/SetWelcomeController.php";
require_once "../middlewares/LoginReqMWare.php";


// создаем загрузчик шаблонов, и указываем папку с шаблонами
$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
  "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

$title = "";
$template = "";
$context = [];

$menu = [
  [
    "title" => "Главная",
    "url" => "/",
  ],
  [
    "title" => "Chainsaw Man",
    "url" => "/chainsawman",
  ],
  [
    "title" => "HunterXHunter",
    "url" => "/hunterxhunter",
  ]
];

$pdo = new PDO("mysql:host=localhost;dbname=mangas;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/titles/(?P<id>\d+)", ObjectController::class);
$router->add("/search", SearchController::class);

$router->add("/add", MangaTitleCreateController::class)
       ->middleware(new LoginReqMWare());
$router->add("/titles/(?P<id>\d+)/delete", MangaTitleDeleteController::class)
       ->middleware(new LoginReqMWare());
$router->add("/titles/(?P<id>\d+)/edit", MangaTitleUpdateController::class)
       ->middleware(new LoginReqMWare());
$router->add("/set-welcome/", SetWelcomeController::class);


$router->get_or_default(Controller404::class);

 $context['title'] = $title;
 $context['menu'] = $menu;

?>
</div> 
</body>
</html>
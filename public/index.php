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
require_once "../controllers/MainController.php";
require_once "../controllers/CsmController.php";
require_once "../controllers/CsmImageController.php";
require_once "../controllers/CsmInfoController.php";
require_once "../controllers/HxhController.php";
require_once "../controllers/HxhImageController.php";
require_once "../controllers/HxhInfoController.php";
require_once "../controllers/Controller404.php";

// создаем загрузчик шаблонов, и указываем папку с шаблонами
$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
  "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

$url = $_SERVER["REQUEST_URI"];

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
$controller = new Controller404($twig);

$pdo = new PDO("mysql:host=localhost;dbname=mangas;charset=utf8", "root", "");



if ($url == "/") {
    $controller = new MainController($twig); // создаем экземпляр контроллера для главной страницы
} elseif (preg_match("#^/chainsawman/image#", $url)){
    $controller = new CsmImageController($twig);   
} elseif (preg_match("#^/chainsawman/info#", $url)){
    $controller = new CsmInfoController($twig);
} elseif (preg_match("#/chainsawman#", $url)) {
    $controller = new CsmController($twig);
} elseif (preg_match("#^/hunterxhunter/image#", $url)){
  $controller = new HxhImageController($twig);   
} elseif (preg_match("#^/hunterxhunter/info#", $url)){
  $controller = new HxhInfoController($twig);
} elseif (preg_match("#/hunterxhunter#", $url)) {
  $controller = new HxhController($twig);
}

if ($controller) {
  $controller->setPDO($pdo); // а тут передаем PDO в контроллер
  $controller->get();
}

 $context['title'] = $title;
 $context['menu'] = $menu;

// echo $twig ->render($template, $context);
?>
</div> 
</body>
</html>
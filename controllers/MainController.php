<?php
require_once "BaseSpaceTwigController.php";

class MainController extends BaseSpaceTwigController {
    public $template = "main.twig";
    public $title = "Главная";
    public function getContext(): array{
        // подготавливаем запрос SELECT * FROM space_objects
        // вообще звездочку не рекомендуется использовать, но на первый раз пойдет
        $context = parent::getContext();

        if (isset ($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM titles WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM titles");
        }
        $context['viewed_pages'] = array_reverse($_SESSION['viewed_pages']);

        
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['titles'] = $query->fetchAll();

        return $context;
    }
}
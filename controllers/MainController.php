<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class MainController extends TwigBaseController {
    public $template = "main.twig";
    public $title = "Главная";
    public function getContext(): array{
        // подготавливаем запрос SELECT * FROM space_objects
        // вообще звездочку не рекомендуется использовать, но на первый раз пойдет
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT * FROM titles");
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['titles'] = $query->fetchAll();

        return $context;
    }
}
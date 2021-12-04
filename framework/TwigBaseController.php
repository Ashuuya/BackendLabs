<?php

require_once "BaseController.php"; // обязательно импортим BaseController

class TwigBaseController extends BaseController {
  public $title = ""; // название страницы
  public $template = ""; // шаблон страницы
  protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига
    
  // public function __construct($twig)
  // {
  //     $this->twig = $twig; // пробрасываем его внутрь
  // }

  public function setTwig($twig) {
    $this->twig = $twig;
  }
    
  // переопределяем функцию контекста
  public function getContext() : array
  {
    $context = parent::getContext(); // вызываем родительский метод
    $context['title'] = $this->title; // добавляем title в контекст
    $context['menu'] = [
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
    return $context;
  }
    
  // функция гет, рендерит результат используя $template в качестве шаблона
  // и вызывает функцию getContext для формирования словаря контекста
  public function get(array $context) { // добавил аргумент в get
    echo $this->twig->render($this->template, $context); // а тут поменяем getContext на просто $context
}
}
<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class MainController extends TwigBaseController {
    public $template = "main.twig";
    public $title = "Главная";
    public function getContext(): array{
        $context = parent::getContext();
        // $context['menu'] = [
        //     [
        //       "title" => "Главная",
        //       "url" => "/",
        //     ],
        //     [
        //       "title" => "Chainsaw Man",
        //       "url" => "/chainsawman",
        //     ],
        //     [
        //       "title" => "HunterXHunter",
        //       "url" => "/hunterxhunter",
        //     ]
        //   ];

        return $context;
    }
}

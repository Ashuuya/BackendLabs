<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class HxhController extends TwigBaseController{
    public $template = "__object.twig";
    public $title = "HunterXHunter";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['image_url'] = "/hunterxhunter/image/";
        $context['info_url'] = "/hunterxhunter/info/";


        return $context;
    }
    
}
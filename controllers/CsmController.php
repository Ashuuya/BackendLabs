<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class CsmController extends TwigBaseController{
    public $template = "__object.twig";
    public $title = "Chainsaw Man";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['image_url'] = "/chainsawman/image/";
        $context['info_url'] = "/chainsawman/info/";
        

        return $context;
    }
    
}
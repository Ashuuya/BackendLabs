<?php
require_once "HxhController.php";

class HxhImageController extends HxhController{
    public $template = "base_image.twig";

    public function getContext(): array{
        $context = parent::getContext();
        // $context['is_image'] = true;
        $context['image'] = "/images/hxh_poster.jpg";
        
        return $context;
    }
}
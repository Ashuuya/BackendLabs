<?php
require_once "CsmController.php";

class CsmImageController extends CsmController{
    public $template = "base_image.twig";

    public function getContext(): array{
        $context = parent::getContext();
        // $context['is_image'] = true;
        $context['image'] = "/images/csm_poster.jpg";

        return $context;
    }
}
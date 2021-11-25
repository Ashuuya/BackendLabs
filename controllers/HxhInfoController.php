<?php
require_once "HxhController.php";

class HxhInfoController extends HxhController{
    public $template = "hxh_info.twig";

    public function getContext(): array{
        $context = parent::getContext();


        return $context;
    }
}
<?php
require_once "CsmController.php";

class CsmInfoController extends CsmController{
    public $template = "csm_info.twig";

    public function getContext(): array{
        $context = parent::getContext();


        return $context;
    }
}
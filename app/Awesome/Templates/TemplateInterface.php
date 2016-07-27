<?php namespace App\Awesome\Templates;

interface TemplateInterface {

    public function renderTemplate($pageId);
    public function getByProperty($key, $value, array $relation = array());
}
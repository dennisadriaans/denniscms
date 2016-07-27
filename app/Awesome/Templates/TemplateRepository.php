<?php namespace App\Awesome\Templates;

use App\TemplateSlot;
use App\Awesome\DbRepository;

class TemplateRepository extends DbRepository implements TemplateInterface {

    public $model;

    function __construct(TemplateSlot $model)
    {
        $this->model = $model;
    }


}

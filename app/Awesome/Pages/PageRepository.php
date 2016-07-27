<?php namespace App\Awesome\Pages;

use App\Page;
use App\Awesome\DbRepository;

class PageRepository extends DbRepository implements PageInterface {

    public $model;

    function __construct(Page $model)
    {
        $this->model = $model;
    }


}

<?php namespace App\Awesome\Slots;

use App\PageSlots;
use App\Awesome\DbRepository;

class SlotRepository extends DbRepository implements SlotInterface {

    public $model;

    function __construct(PageSlots $model)
    {
        $this->model = $model;
    }


}
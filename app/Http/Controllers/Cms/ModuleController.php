<?php namespace App\Http\Controllers\Cms;

use App\Awesome\Modules\ModuleInterface as ModuleRepo;
use App\Http\Controllers\Controller;

class ModuleController extends Controller {

    private $ModuleRepo;

    function __construct(ModuleRepo $ModuleRepo)
    {
        $this->ModuleRepo = $ModuleRepo;
    }

    public function store()
    {
        return $this->ModuleRepo->store('test');
    }

}
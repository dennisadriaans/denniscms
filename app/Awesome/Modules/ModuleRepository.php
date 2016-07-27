<?php namespace App\Awesome\Modules;

use DB;
use App\Module;
use App\Awesome\DbRepository;

class ModuleRepository extends DbRepository implements ModuleInterface {

    public $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function store($module, $input)
    {
        $insert = DB::table($module)->insert([$input]);
        if($insert) {
            return;
        } else {
            return 'Can\'t create new '.$module.' record';
        }
    }

    public function update($request, $id)
    {
        return DB::table($request->input('module'))->where('id', '=', $id)->update($request->input('data'));
    }
}

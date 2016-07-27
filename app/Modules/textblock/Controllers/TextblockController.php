<?php

namespace App\Modules\Textblock\Controllers;

use App\Awesome\Modules\ModuleInterface as ModuleRepo;
use Illuminate\Http\Request;
use DB;
use App\ModuleSlot;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TextblockController extends Controller
{

    private $moduleRepo;

    function __construct(ModuleRepo $moduleRepo)
    {
        $this->moduleRepo = $moduleRepo;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->moduleRepo->update($request, $id);
    }

    public function destroy($id)
    {
        //
    }

    public function getTemplate(Request $request)
    {
        $moduleSlotId = $request->input('moduleSlotId');
        $template = $request->input('template');

        return ModuleSlot::where('id', '=', $moduleSlotId)->update(['template' => $template]);
    }
}

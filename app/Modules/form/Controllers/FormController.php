<?php

namespace App\Modules\form\Controllers;

use App\Awesome\Modules\ModuleInterface as ModuleRepo;
use Illuminate\Http\Request;
use DB;
use App\Form;
use App\FormFields;
use App\ModuleSlot;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FormController extends Controller
{

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
        return Form::where('id', '=', $id)->with('fields')->first();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        foreach ($request->input('fields') as $field) {
            FormFields::firstOrCreate([
                'form_id' => $id,
                'label' => $field['label'],
                'type' => $field['type'],
            ]);
        }
        return $request->input('fields');
    }

    public function destroy($id)
    {
        //
    }
}

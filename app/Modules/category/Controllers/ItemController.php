<?php

namespace App\Modules\Category\Controllers;

use App\Awesome\Modules\ModuleInterface as ModuleRepo;
use Illuminate\Http\Request;

use DB;
use App\CategoryProperty;
use App\Item;
use App\ItemProperty;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{

    /*
    private $moduleRepo;

    function __construct(ModuleRepo $moduleRepo)
    {
        $this->moduleRepo = $moduleRepo;
    }
    */



    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        if ($request->input('itemTemplate')) {
            $itemTemplate = $request->input('itemTemplate');
        } else {
            $itemTemplate = '';
        }
        $newItem = Item::firstOrCreate([
            'category_id' => $request->input('category_id'),
            'title' => $request->input('title'),
            'template' => $itemTemplate
        ]);

        $categoryProperties = CategoryProperty::all();
        foreach ($categoryProperties as $props) {
            ItemProperty::firstOrCreate([
                'item_id' => $newItem->id,
                'category_property_id' => $props->id
            ]);
        }


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
        //
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $item_props = ItemProperty::where('item_id', '=', $id)->delete();
        $item->delete();
        return 'done';
    }
}

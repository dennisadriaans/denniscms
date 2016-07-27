<?php

namespace App\Modules\Category\Controllers;

use App\Awesome\Modules\ModuleInterface as ModuleRepo;
use Illuminate\Http\Request;

use DB;
use App\Category;
use App\CategoryProperty;
use App\Item;
use App\ItemProperty;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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

    public function getProperties($id, $itemId)
    {
        $items = ItemProperty::where('item_id', '=', $itemId)
            ->with('properties')->get();

        if($items) {
            $newItem = [];
            foreach ($items as $item) {

                if ($item->properties) {
                    $newItems[] = [
                        "id" => $item->properties->id,
                        "label" => $item->properties->label,
                        "type" => $item->properties->type,
                        "value" => $item->value
                    ];
                }
            }
            return $newItems;
        } else {
            return $items = null;
        }
    }
    public function addProperty(Request $request)
    {
        $items = Item::all();
        $newProp = CategoryProperty::create($request->input());

        foreach ($items as $item) {

            ItemProperty::firstOrCreate([
                'item_id' => $item->id,
                'category_property_id' => $newProp->id
            ]);
        }

        return 'new added';
    }

    public function updateProperty(Request $request)
    {
        $item = Item::find($request->input('id'));
        $item->save();


        foreach ($request->input('properties') as $prop) {

            if ($prop['label'] == 'title' && $prop['value'] == null) {
                ItemProperty::where('id', '=', $prop['id'])->update([
                    'value' => $request->input('title')
                ]);
            } else {
                ItemProperty::where('id', '=', $prop['id'])->update([
                    'value' => $prop['value']
                ]);
            }
        }

        return $request->input('properties');
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return Category::firstOrCreate($request->input());
    }

    public function show($id)
    {
        return 123;
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
        //
    }
}

<?php

namespace App\Modules\Category\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Item;
use App\ItemProperty;

class CommentController extends Controller
{
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
        $comment = $request->except(['_token']);

        $item = Item::firstOrCreate([
            'title' => $request->author,
            'category_id' => 4
        ]);

        ItemProperty::firstOrCreate([
            'value' => $comment['author'],
            'category_property_id' => 5,
            'item_id' => $item->id
        ]);

        ItemProperty::firstOrCreate([
            'value' => $comment['comment'],
            'category_property_id' => 6,
            'item_id' => $item->id
        ]);

        return View('message')->with('message', 'Uw reactie is met succes geplaatst.');;
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
        //
    }
}

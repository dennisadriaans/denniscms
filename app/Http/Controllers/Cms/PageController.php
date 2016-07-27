<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

use App\Page;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{

    public function index()
    {
        return Page::where('is_menu', '=', 1)->get();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $root = Page::where('id', '=', $request->input('menuId'))->first();
        $root->children()->firstOrCreate($request->except('menuId'));
        return 'success';
    }

    public function show($id)
    {
        return Page::where('id', $id)->with('template')->first();
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

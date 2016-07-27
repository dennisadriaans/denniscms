<?php

namespace App\Modules\Image\Controllers;

use App\Awesome\Modules\ModuleInterface as ModuleRepo;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Image;
use App\ModuleSlot;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;


class ImageController extends Controller
{
    private $moduleRepo;

    function __construct(ModuleRepo $moduleRepo)
    {
        $this->moduleRepo = $moduleRepo;
    }

    public function index()
    {
        return Image::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $stored = Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        $file->move(public_path() . '/u/images/', $file->getClientOriginalName() .'.'. $extension);
        Image::firstOrCreate([
            'title' => $file->getClientOriginalName(),
            'url' => '/u/images/' . $file->getClientOriginalName().'.'.$extension
        ]);

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
        $image = Image::find($id);
        $image->delete();
    }

    public function changeImage(Request $request)
    {
        $moduleSlotId = $request->input('moduleSlotId');
        $item = $request->input('item');

        ModuleSlot::where('id', '=', $moduleSlotId)->update([
            'item_id' => $item['id']
        ]);

        Image::where('id', '=', $item['id'])->update([
            'description'=> $item['description']
        ]);

        return $item;

    }
}

<?php namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\ModuleSlot;
use App\PageSlots;

class SlotController extends Controller {

    public function fillslot(Request $request)
    {
        if($request->input('selectedId')) {
            return $this->fillWithExisting($request);
        } else {
            return $this->fillWithNew($request);
        }
    }

    public function disconnect(Request $request)
    {
        $id = $request->input('id');
        PageSlots::where('id', '=', $id)->update([
            'module_slot_id' => null,
        ]);
        return $id;
    }

    public function fillWithExisting(Request $request)
    {
        $module = $request->input('module');
        $selectedId = $request->input('selectedId');
        $pageId = $request->input('pageId');
        $slotId = $request->input('slotId');

        $newModuleSlot = ModuleSlot::create([
            'module_id' => $module,
            'item_id' => $selectedId
        ]);

        $filledslot = PageSlots::where('id', '=', $slotId)->update([
            'module_slot_id' => $newModuleSlot->id,
        ]);

        dd(123);

        return $filledslot;
    }

    public function fillWithNew(Request $request)
    {
        $slotId = $request->input('slotId');
        $module = $request->input('module');
        $moduleId = $request->input('moduleId');
        $title = $request->input('title');

        $id = DB::table($module)->insertGetId([
            'title' => $title
        ]);

        $newModuleSlot = ModuleSlot::create([
            'module_id' => $moduleId,
            'item_id' => $id
        ]);

        $filledslot = PageSlots::where('id', '=', $slotId)->update([
            'module_slot_id' => $newModuleSlot->id,
        ]);
        return 'created new item';
    }
}
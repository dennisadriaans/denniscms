<?php namespace App\Http\Controllers\Cms;

use App\Awesome\Slots\SlotInterface as SlotRepo;
use App\Awesome\Templates\TemplateInterface as TemplateRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Category; //can be removed when transfer to repo
use App\Page;
use App\Image;
use App\PageSlots;
use App\Template;
use App\TemplateSlot;

class AdminController extends Controller
{
    private $SlotRepo;

    function __construct(SlotRepo $SlotRepo, TemplateRepo $TemplateRepo)
    {
        $this->SlotRepo = $SlotRepo;
        $this->TemplateRepo = $TemplateRepo;
    }

    public function dashboard()
    {
        return view('cms.dashboard');
    }

    public function shell()
    {
        $menus = Page::where('parent_id', '=', null)
            ->first()->getDescendantsAndSelf()->toHierarchy();
        return $menus;
    }

    public function page($id)
    {
        return Page::where('id', $id)->with('template')->first();
    }

    public function setlang($lang)
    {
        \Session::put('my.locale', $lang);
        return \Redirect::to('home');
    }

    public function renderSlots(Request $request)
    {
        $pageid = $request->input('pageId');

        //to template repo
        return $this->TemplateRepo->renderTemplate($pageid);
    }

    public function getTemplConf($template)
    {
        $configJson = file_get_contents('../resources/views/templates/'.$template.'/config.json' );
        return $configJson;
    }

    public function getSpec(Request $request)
    {
        $pageId = $request->input('pageId');
        $row = $request->input('row');
        $col = $request->input('col');

        $name = 'r' . $row . 'c' . $col;

        //to template repo
        $slot = TemplateSlot::where('name', '=', $name)
            ->where('page_id', '=', $pageId)
            ->with('pageslots.moduleslot.module')
            ->first();

        return $slot;
    }

    public function getEditSlot(Request $request)
    {
        $slotid = $request->input('id');
        $slot = $this->SlotRepo->firstByProperty('id', $slotid, 'moduleslot.module.templates');
        $module = $slot->moduleslot->module;
        //should refactor
        // get module templates $moduleTemplates = DB::table('module_templates')->where('module_id', '=', $module->id)->get();

        $itemId = $slot->moduleslot->item_id ;

        if($module->name == 'category') {
            return $this->returnCategory($module, $itemId);
        }

        if($module->name == 'image') {
            return $this->returnImage($itemId, $slot, $module);
        }
        //if module = textblock, image more one level modules

        $item = [
            "item" => DB::table($module->name)->where('id', $itemId)->first(),
            "moduleSlot" => $slot->moduleslot,
            "module" => $module
        ];
        return $item;
    }

    public function getModules()
    {
        //$root = Page::find($request->input('menuId'));

        return DB::table('modules')->get();
    }

    public function makeMenu()
    {
        $root = Page::firstOrCreate([
            'title' => 'menu',
            'is_menu' => 1,
            'template_id' => 1,
            'parent_id' => 1,
            'language' => 'en'
        ]);

        $child = $root->children()->firstOrCreate([
            'title' => 'home',
            'template_id' => 9
        ]);
    }

    public function createPage(Request $request)
    {
        return $request->input();
        //return Page::firstOrCreate($request->input());
    }

    public function getItems(Request $request)
    {
        $module = $request->input('module');
        return DB::table($module)->get();
    }


    public function returnCategory($module, $itemId)
    {
        $item = [
            "category" => Category::where('id', '=', $itemId)->with([
                    'items.properties' => function($query) {
                            $query->select();
                        }])->first(),
            "module" => $module
        ];
        return $item;
    }

    public function templates()
    {
        return Template::all();
    }

    public function returnImage($itemId, $slot, $module)
    {
        $item = [
            "item" => Image::where('id', '=', $itemId)->with('items')->first(),
            "moduleSlot" => $slot->moduleslot,
            "module" => $module
        ];
        return $item;
    }
}

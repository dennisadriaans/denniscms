<?php namespace App\Http\Controllers\Cms;

use DB;
use App\Awesome\Pages\PageInterface as PageRepo;
use App\Awesome\Templates\TemplateInterface as TemplateRepo;
use Illuminate\Http\Request;

use App\TemplateSlot;
use App\PageSlots;
use App\Category;
use App\ItemProperty;
use App\Item;
use App\Form;
use App\Page;

use Illuminate\Routing\Controller;

class PageHandler extends Controller {

    private $PageRepo;
    private $TemplateRepo;

    function __construct(PageRepo $PageRepo, TemplateRepo $TemplateRepo)
    {
        $this->PageRepo = $PageRepo;
        $this->TemplateRepo = $TemplateRepo;
    }

    public function setHome()
    {
        return $this->index('home');
    }

    public function index($page = '', $sub = '', $subchild = '')
    {
        $language = \Session::get('my.locale');
        app()->setLocale($language);

        if(! $language) {
            $language = 'nl';
            app()->setLocale($language);
        }

        //if url is not localhost
        //check if first item url is nl/de/en
        //if nl : \App::setLocale('nl');
        //if de : \App::setLocale('de');
        //if en : \App::setLocale('en');

        //\App::setLocale('nl');

        //return menu based on that.

        if($sub) {
            $pageInfo = $this->getPageInfo($page, $language);
            $menu = $this->getMenu($language);

            $items = Item::where('id', '=', $sub)->with([
                'properties' => function($query) {
                        $query->select();
                    }])->first();

                foreach ($items->properties as $prop) {
                    if ($prop->label == 'Afbeeldingen') {
                        $images = ItemProperty::where('category_property_id', '=', $prop->category_property_id)
                            ->where('item_id', '=', $sub)->get();
                    } else {
                        $label = $prop->label;
                        $items->$label = $prop->value;
                    }
                }
            $item = $items;

            if ($item->template) {
                $template = $item->template;
                return view('modules.category.'.$template.'', compact('item', 'pageInfo', 'menu', 'images'));
            } else {
                return view('modules.category.item', compact('item', 'pageInfo', 'menu', 'images'));
            }
        }

        $params = [
            $page, $sub, $subchild
        ];

        foreach ($params as $param) {
            return $this->returnSlots($param, $language);
        }
    }

    public function returnSlots($page, $language)
    {
        $pageInfo = $this->getPageInfo($page, $language);
        $menu = $this->getMenu($language);

        if(empty($pageInfo)) { return 'Sorry, page is not found.';};

        $template = $pageInfo->template;
        $slots = TemplateSlot::where('template_id', $pageInfo->template_id)
            ->where('page_id', '=', $pageInfo->id)
            ->with('pageslots.moduleslot.module')
            ->get();

        if (! $template) {
            return 'Please select a valid page template';
        }

        return $this->returnViewWithSlotItems($slots, $template, $menu, $pageInfo);
    }

    public function returnViewWithSlotItems($slots, $template, $menu, $pageInfo)
    {

        foreach ($slots as $key => $slot) {
            if ($slot->pageslots->moduleslot) {
                $moduleName = $slot->pageslots->moduleslot->module->name;
                $itemId = $slot->pageslots->moduleslot->item_id;
                $moduleTemplate = $slot->pageslots->moduleslot->template;

                if(!empty($moduleTemplate)) {
                    $moduleTemplate = 'modules.' . $moduleName . '.templates.' . $moduleTemplate;
                } else {
                    $moduleTemplate = 'modules.' . $moduleName . '.' . $moduleName;
                }


                /* !!!!!!!!!!!!!!!!!! REFACTOR !!!!!!!!!!!!!!!!!! */
                if($moduleName == 'category') {

                    $categories = Category::where('id', '=', $itemId)->with([
                        'items.properties' => function($query) {
                                $query->select();
                            }])->first();

                    foreach ($categories->items as $item) {
                        foreach ($item->properties as $prop) {
                            $label = $prop->label;
                            $item->$label = $prop->value;
                        }
                    }

                    // slot repo return category
                    $items[] = [
                        $slot->name => [
                            "items" => $categories->items,
                        ],
                        "templ" => $moduleTemplate
                    ];


                } else if ($moduleName == 'form') {
                    // slot repo return form
                    $items[] = [
                        $slot->name => [
                            "items" => Form::where('id', '=', $itemId)
                                    ->with('fields')->first(),
                        ],
                        "templ" => $moduleTemplate
                    ];
                } else if ($moduleName == 'image' || $moduleName == 'textblock') {
                    $items[] = [
                        $slot->name => [
                            "items" => DB::table($moduleName)->where('id', $itemId)->first()
                        ],
                        "templ" => $moduleTemplate
                    ];
                }
            }
        }

        /*
         *
         * return array/object slots
         *
         * slot.r1c1
         *
         *
         *  return view('templates.'.$template->name.'.home', compact('slots'));
         */

        //this is based on root param 1
        return view('templates.'.$template->name.'.home', compact('items', 'menu', 'pageInfo'));
    }

    public function getMenu($language)
    {
        $menu = Page::where('language', '=', $language)
            ->first()->getDescendants()->toHierarchy();
        return $menu;
    }

    public function getPageInfo($page, $language)
    {
        $menu = Page::where('language', '=', $language)->first();
        $pageInfo = Page::where('title', '=', $page)
            ->where('parent_id', '=', $menu->id)
            ->with('template')
            ->first();
        return $pageInfo;
    }

    public function changeTemplate(Request $request)
    {
        $pageId = $request->input('pageId');
        $templateId = $request->input('templateId');

        DB::table('item_property')->where('page_id', '=', $pageId)->delete();
        DB::table('page_slots')->where('page_id', '=', $pageId)->delete();

        $page = Page::find($pageId);
        $page->template_id = $templateId;
        $page->save();
    }
}
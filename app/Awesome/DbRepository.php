<?php namespace App\Awesome;

use DB;
use App\Page;
use App\PageSlots;
use App\TemplateSlot;

abstract class DbRepository {


    public function firstByProperty($key, $value,  $relation = '')
    {

        if(empty($relation)) {
            return $this->model->where($key, '=', $value)->first();
        } else {
            return $this->model->with($relation)->where($key, '=', $value)->first();
        }
    }

    public function getByProperty($key, $value, array $relation = array())
    {
        return $this->model->with($relation)->where($key, '=', $value)->get();
    }

    public function updateSlot($id, $key, $value)
    {
        return $this->model->where('id', '=', $id)->update([
            $key => $value
        ]);
    }

    public function renderTemplate($pageId)
    {
        //* this->pagerepo->renderTemplate()  (to abstract repo)

        $page = Page::where('id', '=', $pageId)->first();
        $template = $page->template;
        $content = file_get_contents('../resources/views/templates/'.$template->name.'/config.json' );
        $template = [];

        $this->renderColumns($pageId, $content, $page);
    }

    /**
     * @param $pageId
     * @param $content
     * @param $page
     */
    public function renderColumns($pageId, $content, $page)
    {
        foreach (json_decode($content) as $rows) {
            foreach ($rows as $rKey => $column) {
                $r = $rKey;
                foreach ($column as $key => $col) {
                    $c = $key;

                    $slot = TemplateSlot::firstOrCreate([
                        "template_id" => $page->template_id,
                        "page_id" => $pageId,
                        "name" => "r" . $r . "c" . $c
                    ]);

                    $checkSlots = PageSlots::where('template_slots_id', $slot->id)
                        ->where('page_id', '=', $pageId)
                        ->first();

                    if (!$checkSlots) {
                        PageSlots::firstOrCreate([
                            'page_id' => $pageId,
                            'template_slots_id' => $slot->id,
                            'module_slot_id' => 0,
                        ]);
                    }

                }
            }
        }
    }


}
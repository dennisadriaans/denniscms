<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageSlots extends Model
{

    protected $fillable = ['page_id', 'module_slot_id', 'template_slots_id'];

    public function moduleslot()
    {
        return $this->belongsTo('App\ModuleSlot', 'module_slot_id');
    }

    public function templateslots()
    {
        return $this->belongsTo('App\TemplateSlot', 'template_slots_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateSlot extends Model
{

    protected $fillable = ['template_id', 'name', 'page_id'];

    public function pageslots()
    {
        return $this->belongsTo('App\PageSlots','id', 'template_slots_id');
    }
}

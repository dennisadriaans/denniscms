<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function templateslots()
    {
        return $this->hasMany('App\TemplateSlot');
    }
}

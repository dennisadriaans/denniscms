<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleSlot extends Model
{
    protected $fillable = ['module_id', 'item_id'];

    public function module()
    {
        return $this->belongsTo('App\Module');
    }

}

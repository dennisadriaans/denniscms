<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemProperty extends Model
{
    protected $fillable = ['category_property_id', 'value', 'item_id'];

    public function properties()
    {
        return $this->belongsTo('App\CategoryProperty', 'category_property_id');
    }
}

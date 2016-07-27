<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProperty extends Model
{
    protected $fillable = ['category_id', 'label', 'item_id', 'type'];

    public function values()
    {
        return $this->hasOne('App\ItemProperty');
    }

}

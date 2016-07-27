<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected  $fillable = ['title', 'category_id', 'template'];

    public function properties()
    {
        return $this->belongsToMany('App\CategoryProperty', 'item_properties');
    }
}

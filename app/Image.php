<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $table = 'image';
    protected $fillable = ['title', 'filename', 'url', 'description'];

    public function items()
    {
        return $this->hasMany('App\ImageItem');
    }
}

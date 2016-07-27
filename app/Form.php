<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public $table = 'form';

    public function fields()
    {
        return $this->hasMany('App\FormFields');
    }
}

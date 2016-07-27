<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{
    protected $fillable = ['label', 'type', 'form_id'];
}

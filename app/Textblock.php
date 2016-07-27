<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Textblock extends Model
{
    protected $table = 'textblock';
    protected $fillable = ['title', 'content'];

    public function getTest()
    {
        return $this->title;
    }
}

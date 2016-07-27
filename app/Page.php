<?php

namespace App;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;

class Page extends Node
{
    protected $fillable = ['title', 'is_menu', 'template_id', 'language', 'parent_id'];

    // 'parent_id' column name
    protected $parentColumn = 'parent_id';

    // 'lft' column name
    protected $leftColumn = 'lft';


    // 'rgt' column name
    protected $rightColumn = 'rgt';

    // 'depth' column name
    protected $depthColumn = 'nesting';

    // guard attributes from mass-assignment
    protected $guarded = array('id', 'parent_id', 'lidx', 'ridx', 'nesting');

    public function pageslots()
    {
        return $this->hasMany('App\PageSlots');
    }

    public function template()
    {
        return $this->belongsTo('App\Template', 'template_id');
    }
}

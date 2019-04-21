<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function blogPosts()
    {
        return $this->belongsToMany('App\BlogPost')->withTimestamps()->as('tagged');
    }
}

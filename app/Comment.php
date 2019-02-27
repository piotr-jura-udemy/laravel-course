<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // blog_post_id
    public function blogPost()
    {
        // return $this->belongsTo('App\BlogPost', 'post_id', 'blog_post_id');
        return $this->belongsTo('App\BlogPost');

    }
}

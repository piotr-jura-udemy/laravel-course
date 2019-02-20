<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}

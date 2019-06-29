<?php

namespace App\Traits;

trait HumanTimestamps 
{
    public function getCreatedAtForHumans()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUpdatedAtForHumans()
    {
        return $this->updated_at->diffForHumans();
    }
}
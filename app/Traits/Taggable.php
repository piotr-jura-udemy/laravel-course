<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Tag;
use Illuminate\Database\Eloquent\Collection;

trait Taggable {
    protected static function bootTaggable() {
        static::updating(function ($model) {
            $model->tags()->sync(static::findTagsInContent($model->content));
        });

        static::created(function ($model) {
            $model->tags()->sync(static::findTagsInContent($model->content));
        });
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    private static function findTagsInContent($content): Collection
    {
        preg_match_all('/@([^@]+)@/m', $content, $tags);

        return Tag::whereIn('name', $tags[1] ?? [])->get();
    }
}
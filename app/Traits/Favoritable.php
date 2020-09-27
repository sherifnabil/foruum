<?php

namespace App\Traits;

use App\Favorite;

trait Favoritable
{
    /**
     * Morph Relation for reply favoriting
     *
     * @return Collection
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * Favorite a reply
     *
     * @return mixed
     */
    public function favorite()
    {
        $attributes = ['user_id'=> auth()->id()];

        if (! $this->favorites()->where($attributes)->exists()) {
          return  $this->favorites()->create($attributes);
        }
    }

    /**
     * unfavorite a reply
     *
     * @return mixed
     */
    public function unFavorite()
    {
        $attributes = ['user_id'=> auth()->id()];

        $this->favorites()->where($attributes)->delete();
    }

    /**
     * count if reply is favorited or not
    *
    * @return boolean
    */
    public function isFavorited()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    /**
     * Get Reply Favorites count
     *
     * @return Int
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

}
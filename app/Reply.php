<?php

namespace App;

use App\Thread;
use App\Favorite;
use App\Favoritable;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable;
    
    protected $guarded = [];
    
    protected $with = ['owner', 'favorites'];

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

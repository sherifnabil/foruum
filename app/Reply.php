<?php

namespace App;

use App\Thread;
use App\Traits\Favoritable;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;
    
    protected $appends = ['favorites_count', 'isFavorited'];
    
    protected $guarded = [];
    
    protected $with = ['owner', 'favorites', 'thread'];
    
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }

}

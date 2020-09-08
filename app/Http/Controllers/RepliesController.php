<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($channelId, Thread $thread)
    {
        $thread->addReply([
            'body'  => request('body'),
            'user_id'  => auth()->user()->id,
        ]);
        
        return back();
    }

    public function update(Request $request, Reply $reply)
    {
        //
    }

    public function destroy(Reply $reply)
    {
        //
    }
}

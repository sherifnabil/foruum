<?php

namespace App\Http\Controllers;

use App\User;
use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilter;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
  
    public function index(Channel $channel, ThreadFilter $filters)
    {
        $threads = $this->getThreads($channel, $filters);
        
        return view('threads.index', compact('threads'));
    }
    
    public function create()
    {
        return view('threads.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     =>  'required',
            'body'      =>  'required',
            'channel_id'=>  'required|exists:channels,id',
        ]);
        $thread = Thread::create([
            'user_id'       => auth()->id(),
            'title'         => request('title'),
            'body'          => request('body'),
            'channel_id'    => request('channel_id'),
        ]);

        return redirect($thread->path());
    }
   
    public function show($channelId, Thread $thread)
    {
        return view('threads.show', ['thread' => $thread]);
    }
   
    public function edit(Thread $thread)
    {
        //
    }
   
    public function update(Request $request, Thread $thread)
    {
        //
    }

    public function destroy(Thread $thread)
    {
        //
    }

    public function getThreads($channel, $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if($channel->exists){

            $threads = $threads->where('channel_id', $channel->id);
        } 

        return $threads->get();

    }
}

<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use App\Thread;
use App\Channel;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
      
        $this->thread = factory(Thread::class)->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
        ->assertSee($this->thread->title);
    }
    
    /** @test */
    public function a_user_can_view_single_thread()
    {
        $this->get($this->thread->path())
        ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
        ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this
        ->get('threads/' . $channel->slug)
        ->assertSee($threadInChannel->title)
        ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_username()
    {
        $this->signIn(create(User::class, ['name'=> 'SherifNabil']));

        $threadBySherif = create(Thread::class, ['user_id' => auth()->id()]);
        $threadNotBySherif = create(Thread::class);

        $this
        ->get('threads?by=SherifNabil')
        ->assertSee($threadBySherif->title)
        ->assertDontSee($threadNotBySherif->title);
        
    }
}

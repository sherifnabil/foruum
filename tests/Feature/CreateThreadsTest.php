<?php

namespace Tests\Feature;

use App\Thread;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->get('threads/create')
        ->assertRedirect('/login');   

        $this->post('threads')
        ->assertRedirect('/login'); 

    }

    /** @test*/
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post('threads', $thread->toArray());

        $this->get($thread->path())
        ->assertSee($thread->title)
        ->assertSee($thread->body);
    }
}
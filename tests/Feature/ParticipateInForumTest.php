<?php

namespace Tests\Feature;

use App\Reply;
use App\User;
use App\Thread;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {   
        $this->post('/threads/some-channel/1/replies', [])
        ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {       
        $thread = create(Thread::class);
        
        $reply = make(Reply::class);
        
        $this->signIn();

        $this->post($thread->path() . '/replies', $reply->toArray());
        
        $this->get($thread->path())
        ->assertSee($reply->body);
    }

}

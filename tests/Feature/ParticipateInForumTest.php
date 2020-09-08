<?php

namespace Tests\Feature;

use App\Reply;
use App\User;
use App\Thread;
use Illuminate\Auth\AuthenticationException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {   
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);
        
        $this->post('/threads/1/replies', []);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = factory(User::class)->create();
        
        $thread = factory(Thread::class)->create();
        
        $reply = factory(Reply::class)->make();
        
        $this->actingAs($user);

        $this->post($thread->path() . '/replies', $reply->toArray());
        
        $this->get($thread->path())
        ->assertSee($reply->body);
    }

}

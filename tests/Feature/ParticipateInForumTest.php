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

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class, ['body' => null]);
       
        $this->post($thread->path() . '/replies', $reply->toArray())
        ->assertSessionHasErrors('body');        
    }

    /** @test */
    public function authorized_users_can_delete_replies()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $response = $this->delete("replies/{$reply->id}");

        $response->assertStatus(302);
        
        $this->assertDatabaseMissing('replies', [['reply_id' => $reply->id]]);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_replies()
    {
        $reply = create(Reply::class);

        $this->delete("replies/{$reply->id}")
        ->assertRedirect('/login');

        $this->signIn()
        ->delete("replies/{$reply->id}")
        ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_update_replies()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $updatedReply = 'You changed reply body';
        
        $this->patch("/replies/". $reply->id, ['body' => $updatedReply]);

        $this->assertDatabaseHas('replies', [
            'id'    => $reply->id,
            'body' => $updatedReply
        ]);
    }

     /** @test */
     public function unauthorized_users_cannot_update_replies()
     {
        $reply = create(Reply::class);

        $this->patch("/replies/{$reply->id}")
        ->assertRedirect('/login');

        $this->signIn()
        ->patch("/replies/{$reply->id}")
        ->assertStatus(403);
     }
}

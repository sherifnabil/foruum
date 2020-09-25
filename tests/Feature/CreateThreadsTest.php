<?php

namespace Tests\Feature;

use App\Reply;
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

        $thread = make(Thread::class);

        $response = $this->post('threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
        ->assertSee($thread->title)
        ->assertSee($thread->body);
    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this
        ->publishThread(['title' => null])
        ->assertSessionHasErrors('title');
    }
   
    /** @test */
    public function a_thread_requires_a_body()
    {
        $this
        ->publishThread(['body' => null])
        ->assertSessionHasErrors('body');        
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        $this
        ->publishThread(['channel_id' => null])
        ->assertSessionHasErrors('channel_id');        
        
        $this
        ->publishThread(['channel_id' => 999])
        ->assertSessionHasErrors('channel_id');        
    }

    public function publishThread($overrides = [])
    {
        $this->signIn();

        $thread = make(Thread::class, $overrides);
       
        return  $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function unauthorized_users_may_not_delete_threads()
    {
        $thread = create(Thread::class);

        $this->delete($thread->path())->assertRedirect('/login');
        
        $this->signIn();
        
        $this->delete($thread->path())->assertStatus(403);
    }

    /** @test */
    public function authorized_users_can_delete_thread()
    {

        $this->signIn();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $this->json('DELETE', $thread->path())
        ->assertStatus(403);

        $this->assertDatabaseMissing('threads', [ 'thread_id' => $thread->id ])
        ->assertDatabaseMissing('replies', [ 'reply_id' => $reply->id ]);
    }

}

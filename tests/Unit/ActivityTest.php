<?php

namespace Tests\Unit;

use App\Activity;
use App\Reply;
use App\Thread;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /** @test */
    public function it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();
        
        $thread = create(Thread::class);
        $activity = Activity::first();

        $this->assertDatabaseHas('activities', [
            'type'          =>  'created_thread',
            'user_id'       =>  auth()->id(),
            'subject_id'    =>  $thread->id,
            'subject_type'  =>  'App\Thread'
        ])
        ->assertEquals($thread->id, $activity->subject->id);
    }

    /** @test */
    public function it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();
        
        $reply = create(Reply::class);

        $this->assertEquals(2, Activity::count());
    }

}

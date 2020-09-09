<?php

namespace Tests\Unit;

use App\Thread;
use App\Channel;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;

class ChannelTest extends TestCase
{
  /** @test */
  public function a_channel_consists_of_threads()
  {
    $channel = create(Channel::class);
    $thread = create(Thread::class, ['channel_id' => $channel->id]);

    $this->assertTrue($channel->threads->contains($thread));
  }
}

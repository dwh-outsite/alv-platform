<?php

namespace Tests\Feature\Admin;

use App\Participant;
use App\Poll;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_change_a_poll_status()
    {
        $poll = factory(Poll::class)->create();

        $request = $this->put('/polls/'.$poll->id, ['status' => 'open']);

        $request->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function a_participant_cannot_change_a_poll_status()
    {
        $participant = factory(Participant::class)->create();
        $this->actingAs($participant);
        $poll = factory(Poll::class)->create();

        $request = $this->put('/polls/'.$poll->id, ['status' => 'open']);

        $request->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function an_admin_can_change_a_poll_status()
    {
        $admin = factory(User::class)->create();
        $this->actingAs($admin, 'admin');
        $poll = factory(Poll::class)->create(['status' => 'closed']);

        $request = $this->put('/polls/'.$poll->id, ['status' => 'open']);

        $request->assertSuccessful();
        $this->assertEquals('open', $poll->refresh()->status);
    }
}

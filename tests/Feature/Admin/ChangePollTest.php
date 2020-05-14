<?php

namespace Tests\Feature\Admin;

use App\Participant;
use App\Poll;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangePollTest extends TestCase
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

    /** @test */
    public function only_a_single_poll_can_be_active()
    {
        $admin = factory(User::class)->create();
        $this->actingAs($admin, 'admin');
        $pollToBeOpened = factory(Poll::class)->create(['status' => 'closed']);
        $pollOpenA = factory(Poll::class)->create(['status' => 'open']);
        $pollOpenB = factory(Poll::class)->create(['status' => 'open']);

        $request = $this->put('/polls/'.$pollToBeOpened->id, ['status' => 'open']);

        $request->assertSuccessful();
        $this->assertEquals('open', $pollToBeOpened->refresh()->status);
        $this->assertEquals('closed', $pollOpenA->refresh()->status);
        $this->assertEquals('closed', $pollOpenB->refresh()->status);
    }
}

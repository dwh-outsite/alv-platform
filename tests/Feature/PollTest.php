<?php

namespace Tests\Feature;

use App\Participant;
use App\PollOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_vote()
    {
        $pollOption = factory(PollOption::class)->create();

        $request = $this->post('/polls/vote/' . $pollOption->id);

        $request->assertRedirect(route('login'));
    }

    /** @test */
    public function a_participant_can_vote_during_an_open_poll()
    {
        $participant = factory(Participant::class)->create();
        $this->actingAs($participant);
        $pollOption = factory(PollOption::class)->create();

        $request = $this->post('/polls/vote/' . $pollOption->id);

        $request->assertSuccessful();
        $this->assertEquals(1, $pollOption->refresh()->votes);
    }

    /** @test */
    public function a_participant_cannot_vote_twice_during_an_open_poll()
    {
        $participant = factory(Participant::class)->create();
        $this->actingAs($participant);
        $pollOption = factory(PollOption::class)->create();

        $request = $this->post('/polls/vote/' . $pollOption->id);

        $request->assertSuccessful();
        $this->assertEquals(1, $pollOption->refresh()->votes);

        $request = $this->post('/polls/vote/' . $pollOption->id);
        $request->assertStatus(422);
        $this->assertEquals(1, $pollOption->refresh()->votes);
    }

    /** @test */
    public function a_participant_cannot_vote_when_a_poll_is_closed()
    {
        $this->withoutExceptionHandling();

        $participant = factory(Participant::class)->create();
        $this->actingAs($participant);
        $pollOption = factory(PollOption::class)->state('closed-poll')->create();

        $request = $this->post('/polls/vote/' . $pollOption->id);
        $request->assertStatus(422);
        $this->assertEquals(0, $pollOption->refresh()->votes);
    }
}

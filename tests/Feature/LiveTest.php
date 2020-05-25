<?php

namespace Tests\Feature;

use App\Participant;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LiveTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_see_the_live_view()
    {
        $request = $this->get(route('live'));

        $request->assertRedirect(route('login'));
    }

    /** @test */
    public function a_participant_can_see_the_live_view_if_the_event_has_started()
    {
        config(['app.event.start_time' => Carbon::now()->subHour()]);
        $this->actingAs(factory(Participant::class)->create());

        $request = $this->get(route('live'));

        $request->assertSuccessful();
    }

    /** @test */
    public function a_participant_cannot_see_the_live_view_if_the_event_has_not_started_yet()
    {
        config(['app.event.start_time' => Carbon::now()->addHour()]);
        $this->actingAs(factory(Participant::class)->create());

        $request = $this->get(route('live'));

        $request->assertRedirect(route('starting_soon'));
    }
}

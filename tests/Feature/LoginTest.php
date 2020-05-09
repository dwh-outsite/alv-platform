<?php

namespace Tests\Feature;

use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_participant_with_a_valid_code_can_login()
    {
        $participant = factory(Participant::class)->create(['code' => 'secret']);

        $request = $this->post('/', ['code' => 'secret']);

        $request->assertRedirect(route('live'));
        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($participant);
    }

    /** @test */
    public function a_participant_with_an_invalid_code_cannot_login()
    {
        factory(Participant::class)->create(['code' => 'secret']);

        $request = $this->post('/', ['code' => 'wrong']);

        $request->assertRedirect(route('login'));
        $this->assertGuest();
    }
}

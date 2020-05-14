<?php

namespace Tests\Feature\Admin;

use App\Participant;
use App\Poll;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddPollTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_add_polls()
    {
        $request = $this->post('/polls', [
            'question' => 'Wat vind je van het jaarverslag?',
            'options' => ['Supermooi', 'Mwah', 'Geen mening']
        ]);

        $request->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function a_participant_cannot_add_polls()
    {
        $participant = factory(Participant::class)->create();
        $this->actingAs($participant);

        $request = $this->post('/polls', [
            'question' => 'Wat vind je van het jaarverslag?',
            'options' => ['Supermooi', 'Mwah', 'Geen mening']
        ]);

        $request->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function an_admin_can_add_polls()
    {
        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create();
        $this->actingAs($admin, 'admin');

        $request = $this->postJson('/polls', [
            'question' => 'Wat vind je van het jaarverslag?',
            'options' => ['Supermooi', 'Mwah', 'Geen mening']
        ]);

        $request->assertSuccessful();
        $poll = Poll::firstOrFail();
        $options = $poll->options->map(fn ($option) => $option->answer);
        $this->assertEquals('Wat vind je van het jaarverslag?', $poll->question);
        $this->assertEquals('closed', $poll->status);
        $this->assertContains('Supermooi', $options);
        $this->assertContains('Mwah', $options);
        $this->assertContains('Geen mening', $options);
    }
}

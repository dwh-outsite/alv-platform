<?php

namespace Tests\Feature;

use App\Mail\Invite;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_participant_can_register_themselves()
    {
        $request = $this->post('/register', [
            'name' => 'Henk',
            'email' => 'henk@ingrid.net',
            'privacy_consent' => true
        ]);

        $request->assertOk();
        $participant = Participant::findOrFail(1);
        $this->assertEquals('Henk', $participant->name);
        $this->assertEquals('henk@ingrid.net', $participant->email);
    }

    /** @test */
    public function a_participant_receives_an_email_after_registering_themselves()
    {
        Mail::fake();

        $request = $this->post('/register', [
            'name' => 'Henk',
            'email' => 'henk@ingrid.net',
            'privacy_consent' => true
        ]);

        $request->assertOk();
        Mail::assertQueued(Invite::class, function (Mailable $mail) {
            return $mail->hasTo('henk@ingrid.net');
        });
    }

    /** @test */
    public function a_participant_cannot_register_themselves_without_a_name()
    {
        $request = $this->post('/register', [
            'email' => 'henk@ingrid.net',
            'privacy_consent' => true
        ]);

        $request->assertRedirect();
        $request->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_participant_cannot_register_themselves_without_an_email()
    {
        $request = $this->post('/register', [
            'name' => 'Henk',
            'privacy_consent' => true
        ]);

        $request->assertRedirect();
        $request->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_participant_cannot_register_themselves_with_an_invalid_email()
    {
        $request = $this->post('/register', [
            'name' => 'Henk',
            'email' => 'henkingrid.net',
            'privacy_consent' => true
        ]);

        $request->assertRedirect();
        $request->assertSessionHasErrors('email');
    }

    /** @test */
    public function a_participant_cannot_register_themselves_without_privacy_consent()
    {
        $request = $this->post('/register', [
            'name' => 'Henk',
            'email' => 'henk@ingrid.net',
        ]);

        $request->assertRedirect();
        $request->assertSessionHasErrors('privacy_consent');
    }

    /** @test */
    public function a_participant_cannot_register_themselves_with_false_privacy_consent()
    {
        $request = $this->post('/register', [
            'name' => 'Henk',
            'email' => 'henk@ingrid.net',
            'privacy_consent' => false
        ]);

        $request->assertRedirect();
        $request->assertSessionHasErrors('privacy_consent');
    }

    /** @test */
    public function a_participant_cannot_register_themselves_twice()
    {
        $requestA = $this->post('/register', [
            'name' => 'Henk',
            'email' => 'henk@ingrid.net',
            'privacy_consent' => true
        ]);

        $requestA->assertOk();

        $requestA = $this->post('/register', [
            'name' => 'Henk',
            'email' => 'henk@ingrid.net',
            'privacy_consent' => true
        ]);

        $requestA->assertSessionHasErrors('email');

        $this->assertEquals(1, Participant::count());
    }

}

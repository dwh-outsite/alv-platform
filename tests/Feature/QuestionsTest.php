<?php

namespace Tests\Feature;

use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_post_a_question()
    {
        $request = $this->post('/questions', ['question' => 'How are you?']);

        $request->assertRedirect(route('login'));
    }

    /** @test */
    public function a_participant_can_post_a_question()
    {
        $participant = factory(Participant::class)->create();
        $this->actingAs($participant);

        $request = $this->postJson('/questions', ['question' => 'How are you?']);

        $question = $participant->questions()->firstOrFail();
        $this->assertEquals('How are you?', $question->question);
    }

    /** @test */
    public function a_participant_cannot_post_a_question_without_amessage()
    {
        $participant = factory(Participant::class)->create();
        $this->actingAs($participant);

        $request = $this->postJson('/questions', []);

        $request->assertJsonValidationErrors('question');
    }
}

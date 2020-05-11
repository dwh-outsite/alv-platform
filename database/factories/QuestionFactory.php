<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Participant;
use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'participant_id' => function () {
            return factory(Participant::class)->create()->id;
        },
        'question' => $faker->sentence,
    ];
});

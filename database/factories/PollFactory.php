<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Poll;
use App\PollOption;
use Faker\Generator as Faker;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'status' => 'open',
        'question' => $faker->sentence,
    ];
});

$factory->define(PollOption::class, function (Faker $faker) {
    return [
        'poll_id' => function () {
            return factory(Poll::class)->create()->id;
        },
        'answer' => $faker->sentence,
        'votes' => 0
    ];
});

$factory->state(PollOption::class, 'closed-poll', function (Faker $faker) {
    return [
        'poll_id' => function () {
            return factory(Poll::class)->create(['status' => 'closed'])->id;
        },
    ];
});

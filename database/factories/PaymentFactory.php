<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Model\Payment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'uuid' => Str::uuid(),
        'payment_date' => $faker->dateTime()->format('Y-m-d'),
        'expires_at' => $faker->dateTime()->format('Y-m-d'),
        'status' => $faker->randomElement(['paid', 'pending']),
        'user_id' => $faker->numberBetween(1, 10)
    ];
});

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Job;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    // Link the factory to the Job model
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(2, true),
            'salary' => fake()->numberBetween(40000, 120000),
            'tags' => implode(',', fake()->words(3)),
            'job_type' => fake()->randomElement(['Full-Time', 'Part-Time', 'Contract', 'Internship', 'Apprenticeship', 'Volunteer', 'Temporary', 'On-Call']),
            'remote' => fake()->boolean(),
            'requirements' => fake()->paragraph(2, true),
            'benefits' => fake()->paragraph(2, true),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
            'zipcode' => fake()->postcode(),
            'contact_email' => fake()->safeEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'company_name' => fake()->company(),
            'company_description' => fake()->paragraph(2, true),
            'company_logo' => fake()->imageUrl(100, 100, 'business', true, 'logo'),
            'company_website' => fake()->url(),
        ];
    }
}
